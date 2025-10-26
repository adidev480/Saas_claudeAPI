<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PlanController extends Controller
{
    public function AllPlans(){
        $plans = Plan::latest()->get();
        return view('admin.backend.plan.all_plan', compact('plans'));
    }

    public function AddPlans(){
        return view('admin.backend.plan.add_plan');
    }

    public function StorePlans(Request $request){
        Plan::create([
            'name' => $request->name,
            'token_limit' => $request->token_limit,
            'template_limit' => $request->template_limit,
            'price' => $request->price,
        ]);

        $notification = array(
            'message' => 'Plan inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.plans')->with($notification);


    }

    public function EditPlans($id){
        $plan = Plan::find($id);
        return view('admin.backend.plan.edit_plan',compact('plan'));

    }

    public function UpdatePlan(Request $request){
        $plan_id = $request->id;
        Plan::find($plan_id)->update([
            'name' => $request->name,
            'token_limit' => $request->token_limit,
            'template_limit' => $request->template_limit,
            'price' => $request->price,
        ]);

        $notification = array(
            'message' => 'Plan updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.plans')->with($notification);

    }

    public function DeletePlan($id){
        Plan::find($id)->delete();
        $notification = array(
            'message' => 'Plan deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
