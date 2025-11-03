<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ClaudeService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{

    use AuthorizesRequests;
    private ClaudeService $claudeService;

    public function __construct(ClaudeService $claudeService){
        $this->claudeService  = $claudeService;
    }

    public function AllProjects(){
        $projects = Auth::user()->projects()->latest()->get();
        return view('admin.backend.projects.index', compact('projects'));
    }

    public function CreateProject(){
        return view('admin.backend.projects.create');
    }

    public function StoreProject(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'api_prompt' => 'nullable|string',
        ]);

        $project = Auth::user()->projects()->create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        if($request->api_prompt){
            try{

                ///If there are any API prompt is provided then it be generate the website 

                $context = [
                    'html_content' => $project->html_content,
                    'css_content' => $project->css_content,
                    'js_content' => $project->js_content,
                ];

                $generated = $this->claudeService->generateWebsite($request->api_prompt, $context);

                $project->update([
                    'html_content' => $generated['html'],
                    'css_content' => $generated['css'],
                    'js_content' => $generated['js'],
                    

                ]);

                ///Add to chat history

                $project->addChatMessage('user', $request->pi_prompt);
                $project->addChatMessage('assistant', 'Initial website generated successfully!');

            }catch(\Exception $e){

                Log::error('Failed to generate website' . $e->getMessage(), ['project_id']);

            }
        }

        return redirect()->route('projects.edit', $project);
        

    }

    public function EditProject(Project $project){
        $this->authorize('update',$project);
        return view('admin.backend.projects.edit',compact('project'));
    }
}
