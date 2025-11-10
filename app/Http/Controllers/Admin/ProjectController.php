<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Project;
use App\Models\Transaction;
use App\Services\ClaudeService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{

    use AuthorizesRequests;
    private ClaudeService $claudeService;

    public function __construct(ClaudeService $claudeService){
        $this->claudeService = $claudeService;
    }
    //End Method 


    public function AllProjects(){
        $projects = Auth::user()->projects()->latest()->get();
        return view('admin.backend.projects.index',compact('projects'));
    }
    // End Method 

    public function CreateProject(){
        return view('admin.backend.projects.create');
    }
      // End Method 

    public function StoreProject(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'api_prompt' => 'nullable|string',
        ]);

        // Create the project 
        $project = Auth::user()->projects()->create([
            'name' => $request->name,
            'description' => $request->description
        ]);

      // If there have any API Prompt is provided then it will be generate the website..

    if ($request->api_prompt) {
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

        $project->addChatMessage('user',$request->api_prompt);
        $project->addChatMessage('assistant', 'Initial website generated successfully!');        
       } catch (\Exception $e) {
         Log::error('Failed to generate website' . $e->getMessage(), ['project_id' => $project->id ]);
       }
    }

    return redirect()->route('projects.edit',$project);

    }
    // End Method 

    public function EditProject(Project $project){

        $this->authorize('update',$project);
        return view('admin.backend.projects.edit',compact('project'));

    }
    // End Method 
     public function ViewPreview(Project $project){
        $this->authorize('view',$project);
        return view('admin.backend.projects.preview', compact('project'));

     }


 public function Export(Project $project){

        $this->authorize('view',$project);

        $html = $project->html_content;
        $css = $project->css_content;
        $js = $project->js_content;

        // Combine into the single HTML File
        $fullHtml = str_replace(
            '</head>',
            "<style>$css</style>\n</head>",
            $html
        );

         $fullHtml = str_replace(
            '</body>',
            "<script>$js</script>\n</body>",
            $fullHtml
        );

        return response($fullHtml)
            ->header('Content-Type','text/html')
            ->header('Content-Disposition','attachment; filename="' . $project->name . '.html"'); 

    }

    public function AllOrders(){
        $plan = Transaction::with(['user', 'plan'])->get();
        return view('admin.backend.transaction.all_transaction',compact('plan'));
    }
    // End Method 

    public function UpdateTransaction(Request $request, $id){
        $transaction = Transaction::findOrFail($id);
        $newStatus = $request->input('status');

        if (!in_array($newStatus, ['pending','approved','rejected'])) {
            return redirect()->back()->with('error','Invalid status selected');
        }

        $transaction->status = $newStatus;
        $transaction->save();

        if ($newStatus === 'approved') {
           $user = $transaction->user;
           $user->plan_id = $transaction->plan_id;
           $user->token_used = 0;
           $user->save();
        }

         $notification = array(
            'message' => 'Transaction updates successfully',
            'alert-type' => 'success'
        ); 
        return redirect()->route('all.orders')->with($notification);  
    }



} 