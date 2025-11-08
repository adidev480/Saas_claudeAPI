<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Project;
use App\Services\ClaudeService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class UserProjectController extends Controller
{

    use AuthorizesRequests;
    private ClaudeService $claudeService;

    public function __construct(ClaudeService $claudeService){
        $this->claudeService = $claudeService;
    }
    //End Method 



     public function UserAllProjects(){
        $projects = Auth::user()->projects()->latest()->get();
        return view('client.backend.projects.index',compact('projects'));
    }
    // End Method 

    public function UserProjectsCreate(){
     return view('client.backend.projects.create');
    }
     // End Method 

    public function UserProjectsStore(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'api_prompt' => 'nullable|string',
        ]);

        $user = Auth::user();

        // Skip limits for admin 
        if (!$user->isAdmin()) {
           $plan = $user->plan;

           if ($user->projects()->count() >= $plan->template_limit ) {
            return redirect()->back()->with('error','You have reached your project limit. Upgrade your plan');
           }

        if ($request->api_prompt) {
            $tokenCost = 20;
            if ($user->token_used + $tokenCost > $plan->token_limit) {
                 return redirect()->back()->with('error','Insufficient tokens. Upgrate your plan.');
            }
         } 

        }

        // Create the project 
        $project = $user->projects()->create([
            'name' => $request->name,
            'description' => $request->description
        ]);

      // If there have any API Prompt is provided then it will be generate the website..

    if ($request->api_prompt && !$user->isAdmin()) {
       try {

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

        // Add to check history 
        $user->increment('token_used', 20);
        
        $project->addChatMessage('user',$request->api_prompt);
        $project->addChatMessage('assistant', 'Initial website generated successfully!');        
       } catch (\Exception $e) {
         Log::error('Failed to generate website' . $e->getMessage(), ['project_id' => $project->id ]);
       }
    }

    return redirect()->route('user.projects.edit',$project);

    }
    // End Method 

    public function UserProjectsEdit(Project $project){

        $this->authorize('update',$project);
        return view('client.backend.projects.edit',compact('project'));

    }
    // End Method


}