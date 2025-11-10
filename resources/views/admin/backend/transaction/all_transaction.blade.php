@extends('admin.admin_master')
@section('content')


<div class="row">
<div class="col-xl-12">
    <div class="card">
    <div class="card-header border-bottom justify-content-between d-flex flex-wrap align-items-center gap-2">
    <div class="flex-shrink-0 d-flex align-items-center gap-2">
        <div class="position-relative">
           <h3>All Transaction</h3>
        </div>
    </div> 
   
</div>


        <div class="card-body">
            
            <div class="table-responsive-sm"> 
    <table class="table table-striped mb-0">
        <thead>
            <tr>
                <th>Sl</th>
                <th>User Name </th>
                <th>Plan</th>
                <th>Transaction Id</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($plan as $key=> $item) 
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->plan->name }}</td>
                <td>{{ $item->transaction_id }}</td>
                <td>{{ $item->amount }}</td>
                 <td>{{ $item->status }}</td>
               
                 <td class="text-muted">
 <div class="hstack gap-1 justify-content-end">
    <form action="{{ route('update.transaction',$item->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <select name="status" class="form-control form-control-sm">
            <option value="" disabled>Select Status</option>
            <option value="pending" {{ $item->status === 'pending' ? 'selected' : '' }} >Pending</option>
            <option value="approved" {{ $item->status === 'approved' ? 'selected' : '' }} >Approved</option>
            <option value="rejected" {{ $item->status === 'rejected' ? 'selected' : '' }} >Rejected</option>
        </select>
        <button type="submit" class="btn btn-ghost-success rounded-pill btn-sm">Update</button>
    </form>

 </div>
                </td>
            </tr>
         @endforeach
                
            
        </tbody>
    </table>
            </div> <!-- end table-responsive-->
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->


</div>






@endsection