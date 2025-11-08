<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Plan;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function UserLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
    //End Method 


    public function UserProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('client.client_profile',compact('profileData'));
    }
        //End Method 

    public function UserProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        $oldPhotoPath = $data->photo;

        if ($request->hasFile('photo')) {
           $file = $request->file('photo');
           $filename = time().'.'.$file->getClientOriginalExtension();
           $file->move(public_path('upload/user_images'),$filename);
           $data->photo = $filename;
        }

        if ($oldPhotoPath && $oldPhotoPath !== $filename) {
            $this->deleteOldImage($oldPhotoPath);
        }

        $data->save();

        $notification = array(
            'message' => 'User Profile updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }
     //End Method 

    private function deleteOldImage(string $oldPhotoPath) : void {
        $fullPath = public_path('upload/user_images/'.$oldPhotoPath);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
     }
      //End private Method 

   public function UserChangePassword(){

        return view('client.change_password');

    }
      //End Method 

   public function UserPasswordUpdate(Request $request){

     $user = Auth::user();
     $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|confirmed'
     ]);

     if (!Hash::check($request->old_password, $user->password)) {
        
        $notification = array(
            'message' => 'Old Password Does not Match!',
            'alert-type' => 'error'
        ); 
        return back()->with($notification); 
     }

     User::whereId($user->id)->update([
        'password' => Hash::make($request->new_password) 
     ]);

     Auth::logout();

     $notification = array(
            'message' => 'Password Updated Successfully',
            'alert-type' => 'error'
        ); 
        return redirect()->route('login')->with($notification); 

    }
       //End Method 


    public function PlanUpgrade(){
        $plans = Plan::all();
        return view('client.backend.plans.upgrade',compact('plans'));
    }
      //End Method 

      //End Method 

    public function PlanSubscribe(Request $request, $planId){

        $plan = Plan::findOrFail($planId);
        $user = Auth::user();

        if ($user->plan->name === $plan->name) {
            return redirect()->back()->with('error','You are already on this plan');
        }

       $transaction = Transaction::create([
        'user_id' => $user->id,
        'plan_id' => $plan->id,
        'transaction_id' => 'PENDING_'. time(), // Temporary id
        'amount' => $plan->price,
        'status' => 'pending',
        'created_at' => now(),
        'updated_at' => now(),
       ]);

       return redirect()->route('plans.payment',$transaction->id)->with('success','Plz provide your bank transfer details');

    }
    //End Method 

    public function showPaymentForm($transactionId){

        $transaction = Transaction::findOrFail($transactionId);
        if ($transaction->user_id !== Auth::id()) {
            return redirect()->back()->with('error','Unauthorized access');
        }
        return view('client.backend.plans.payment',compact('transaction')); 

    }
     //End Method 

     public function ProcessPayment(Request $request, $transactionId){

        $request->validate([
            'user_transaction_id' => 'required|string'
        ]);
    
        $transaction = Transaction::findOrFail($transactionId);
        if ($transaction->user_id !== Auth::id()) {
            return redirect()->back()->with('error','Unauthorized access');
        }

        $transaction->update([
            'transaction_id' => $request->user_transaction_id,
            'status' => 'pending'
        ]);

    return redirect()->route('user.projects.edit', Auth::user()->projects()->first())->with('success', 'Your payment details have been submitted. plz wait for admin verification');
     }


} 