<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Review;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ReviewController extends Controller
{
    public function AllReview(){
        $review = Review::latest()->get();
        return view('admin.backend.review.all_review',compact('review'));
    }
    // End Method 

    public function AddReview(){
        return view('admin.backend.review.add_review');
    }
     // End Method 

     public function StoreReview(Request $request){ 

        if ($request->file('image')) {
           $image = $request->file('image');
           $manager = new ImageManager(new Driver());
           $nameGen = hexdec(uniqid()) . '.'. $image->getClientOriginalExtension();  
           $img = $manager->read($image);
           $img->resize(60,60)->save(public_path('upload/review/'.$nameGen));
           $imageUrl = 'upload/review/'.$nameGen; 

            Review::create([
            'name' => $request->name,
            'post' => $request->post,
            'message' => $request->message,
            'image' => $imageUrl,
        ]);

         $notification = array(
            'message' => 'Review Inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.review')->with($notification); 

        } 
    }
    //End Method 

    public function EditReview($id){
        $review = Review::findOrFail($id);
        return view('admin.backend.review.edit_review', compact('review'));

    }
    //End Method 

    public function UpdateReview(Request $request){

        $review_id = $request->id;
        $review = Review::findOrFail($review_id); 

        if ($request->file('image')) {
           $image = $request->file('image');
           $manager = new ImageManager(new Driver());
           $nameGen = hexdec(uniqid()) . '.'. $image->getClientOriginalExtension();  
           $img = $manager->read($image);
           $img->resize(60,60)->save(public_path('upload/review/'.$nameGen));
           $imageUrl = 'upload/review/'.$nameGen; 

           if (file_exists(public_path($review->image))) {
             @unlink(public_path($review->image));
           }

            Review::find($review_id)->update([
            'name' => $request->name,
            'post' => $request->post,
            'message' => $request->message,
            'image' => $imageUrl,
        ]);

         $notification = array(
            'message' => 'Review updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.review')->with($notification); 

        } else {

            Review::find($review_id)->update([
            'name' => $request->name,
            'post' => $request->post,
            'message' => $request->message, 
        ]);

         $notification = array(
            'message' => 'Review updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.review')->with($notification);

        } 
    }
    //End Method 

     public function DeleteReview($id){
        $review = Review::findOrFail($id);
        if ($review->image && file_exists(public_path($review->image))) {
            unlink(public_path($review->image));
        }

        $review->delete();

        $notification = array(
            'message' => 'Review deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    //End Method 




} 