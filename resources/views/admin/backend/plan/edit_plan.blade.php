@extends('admin.admin_master')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-header border-bottom border-dashed d-flex align-items-center">
            <h4 class="header-title">Edit Plan</h4>
        </div>

        <div class="card-body">
            
    <form  action="{{ route('update.plans') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $plan->id }}">
        <div class="row g-2">
            
            <div class="mb-3 col-md-6">
                <label for="inputEmail4" class="form-label">Plan Name</label>
                <input type="text" name="name" class="form-control" value="{{ $plan->name }}">
            </div>

           <div class="mb-3 col-md-6">
                <label for="inputEmail4" class="form-label">Token Limit</label>
                <input type="text" name="token_limit" class="form-control" value="{{ $plan->token_limit }}">
            </div>

            <div class="mb-3 col-md-6">
                <label for="inputEmail4" class="form-label">Template Limit</label>
                <input type="text" name="template_limit" class="form-control" value="{{ $plan->template_limit }}">
            </div>

            <div class="mb-3 col-md-6">
                <label for="inputEmail4" class="form-label">Price</label>
                <input type="text" name="price" class="form-control" value="{{ $plan->price }}">
            </div>





              {{-- <div class="mb-3 col-md-6">
                <label for="inputEmail4" class="form-label"> </label>
                 <img id="showImage" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg') }}"  class="rounded-circle avatar-xl img-thumbnail" style="width: 80px; height:80px;" >
            </div> --}}
            
        </div>
 

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
        </div> <!-- end card-body -->
    </div> <!-- end card-->
</div> <!-- end col -->
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    })

</script>


@endsection