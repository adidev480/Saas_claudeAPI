@extends('client.master')
@section('client')

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
        <h1 class="h4 mb-0">Bank Transfer Details</h1>
        <p class="mb-0 text-white">Complete your plan ugrade</p>
                </div>
    
    <div class="card-body">
        <form action="{{ route('plans.processPayment',$transaction->id) }}" method="POST">
         @csrf

        <input type="hidden" name="transaction_id"  value="{{ $transaction->id }}" >

        <div class="mb-4">
   <p class="text-white">Please transfer ${{ $transaction->amount }} to the following account: </p>
   <p class="text-white">
    Bank: example bank <br>
    Account name: xai company<br>
    Account Number :  343434343434<br>
    Swift Code : SRE3434
   </p>
   <input type="text" name="user_transaction_id" class="form-control mt-2" placeholder="Enter your Transaction ID" required >
        </div>
    <button type="submit" class="btn btn-primary">Submit Payment Details</button>

        </form> 
    </div> 

            </div> 
        </div> 
    </div> 
</div>  


@endsection