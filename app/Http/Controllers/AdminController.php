<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminLogout(Request $request){

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function AdminLogin(Request $request){

        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){

            $user = Auth::user();

            $verificationCode = random_int(10000,99999);
            session(['verification_code'=> $verificationCode, 'user_id'=>$user->id ]);

            Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));
            Auth::logout();

            return redirect()->route('custom.verification.form')->with('status','verification code send to your mail');


        }

        return redirect()->back()->withErrors(['email' => 'Invalid Credentials Provided']);



    }

    public function AdminDashboard(){
        return view('admin.index');
    }

    public function ShowVerification(){
            return view('auth.verify');
    }


    public function VerificationVerify(Request $request){
       
        $request->validate(['code' => 'required|numeric']);

        $user = User::where('id',session('user_id'))->first();
        $role = $user->role;

        if($request->code == session('verification_code') ){
       
            Auth::loginUsingId(session('user_id'));

            
            session()->forget(['verfication_code','user_id']);
            
            if($role === 'admin'){
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended(route('dashboard'));
            
        }

        return back()->withErrors(['code'=>'Invalid Verfication Code']);
    }

    public function AdminProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile', compact('profileData'));

    }

    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        $oldPhotopath = $data->photo;

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $filename =  time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/admin_images'), $filename);
            $data->photo = $filename;

            if($oldPhotopath && $oldPhotopath !== $filename){
                $this->deleteOldImage($oldPhotopath);
            }


        }



        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    private function deleteOldImage(string $oldPhotopath) : void {
        $fullPath = public_path('upload/admin_images/'.$oldPhotopath);
        if(file_exists($fullPath)){
            unlink($fullPath);
        }
    }


    public function AdminChangePassword(){
        return view('admin.change_password');
    }

    public function AdminPasswordUpdate(Request $request){
        $user = Auth::user();
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if(!Hash::check($request->old_password, $user->password)){
            $notification = array(
                'message' => 'Admin Profile Updated Successfully',
                'alert-type' => 'danger'
            );
            return back()->with($notification);
        }

        User::whereId($user->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        Auth::logout();

        $notification = array(
                'message' => 'Admin Password Updated Successfully',
                'alert-type' => 'success'
            );
        return redirect()->route('login')->with($notification);



    }
}
