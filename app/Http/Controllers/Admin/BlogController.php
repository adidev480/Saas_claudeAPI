<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Blog;
use App\Services\ClaudeService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use GuzzleHttp\Client; 
use Illuminate\Support\Facades\Log;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class BlogController extends Controller
{

    private string $apiKey;
    private string $baseUrl = 'https://api.anthropic.com';

    public function __construct(){
        $this->apiKey = config('services.claude.api_key');
        Log::info('Cladue API KEY BLOG: ' . $this->apiKey);
    }



    public function AllBlog(){
        $blogs = Blog::latest()->get();
        return view('admin.backend.blog.all_blog',compact('blogs'));
    }
    //End Method 

    public function AddBlog(){
        return view('admin.backend.blog.add_blog');
    }
    //End Method 

    public function GenerateBlog($title){
        if (!$this->apiKey) {
            return response()->json(['success' => false, 'message' => 'Claude API Key is not configuerd'],500);
        }
      
    $client = new Client();

    try {

        $response = $client->post($this->baseUrl . '/v1/messages',[
            'headers' => [
                'x-api-key' => $this->apiKey,
                'content-type' => 'application/json',
                'anthropic-version' => '2023-06-01'
        ],
        'json' => [
            'model' => 'claude-sonnet-4-5',
            'max_tokens' => 10000,
            'messages' => [
                [
                    'role' => 'user',
                    'content' => "Write a complete, SEO-optimized blog post with the title: '$title'. Include an introduction, 3-5 sections with headings, and a conclusion. Suggest placeholder image URLs where relevant (e.g., https://placehold.co/600x400)."
                ]
            ],
        ],
        'timeout' => 300,
    ]);

    $data = json_decode($response->getBody(), true);
    if (isset($data['content']) && is_array($data['content']) && !empty(
        $data['content'][0]['text'])) {
        $content = $data['content'][0]['text'];
    } else {
        $content = 'Error generating contant: Invalid resosne format';
    }
     
    return response()->json(['success' => true, 'content' => $content]);

    } catch (\Exception $e) {
       return response()->json(['success' => false, 'message' => 'Filed to genearate blog' . $e->getMessage()], 500);
    } 

    }
    //End Method 


     public function SaveBlog(Request $request){
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'category' => 'nullable|string',
            'image' => 'nullable|image',
        ]);

        $imageUrl = null;

        if ($request->hasFile('image')) {
           $image = $request->file('image');
           $manager = new ImageManager(new Driver());
           $nameGen = hexdec(uniqid()) . '.'. $image->getClientOriginalExtension();  
           $img = $manager->read($image);
           $img->resize(872,470)->save(public_path('upload/blog/'.$nameGen));
           $imageUrl = 'upload/blog/'.$nameGen;

        }

        $blog = Blog::create([
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content,
            'image' => $imageUrl,
        ]);

        return response()->json(['message' => 'Blog Saved Successfully', 'id' => $blog->id ]);

    }

    public function EditBlog($id){
        $blog = Blog::findOrFail($id);
        return view('admin.backend.blog.edit_blog',compact('blog'));
    }
    //End Method 

     public function UpdateBlog(Request $request){

        $blog_id = $request->id;
        $blog = Blog::findOrFail($blog_id); 

        if ($request->file('image')) {
           $image = $request->file('image');
           $manager = new ImageManager(new Driver());
           $nameGen = hexdec(uniqid()) . '.'. $image->getClientOriginalExtension();  
           $img = $manager->read($image);
           $img->resize(872,470)->save(public_path('upload/blog/'.$nameGen));
           $imageUrl = 'upload/blog/'.$nameGen;

           if (file_exists(public_path($blog->image))) {
             @unlink(public_path($blog->image));
           }

            Blog::find($blog_id)->update([
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content,
            'image' => $imageUrl,
        ]);

         $notification = array(
            'message' => 'Blog updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog')->with($notification); 

        } else {

            Blog::find($blog_id)->update([
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content, 
        ]);

         $notification = array(
            'message' => 'Blog updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog')->with($notification); 

        } 
    }
    //End Method 

    public function DeleteBlog($id){
        $blog = Blog::findOrFail($id);
        if ($blog->image && file_exists(public_path($blog->image))) {
            unlink(public_path($blog->image));
        }

        $blog->delete();

        $notification = array(
            'message' => 'Blog deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    //End Method 






}