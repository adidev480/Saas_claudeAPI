@extends('admin.admin_master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-header border-bottom border-dashed d-flex align-items-center">
            <h4 class="header-title">Edit Review  </h4>
        </div>

        <div class="card-body">
            
    <form action="{{ route('update.review') }}" method="post" enctype="multipart/form-data" >
        @csrf
        
        <input type="hidden" name="id" value="{{ $review->id }}">

        <div class="row g-2">
            
            <div class="mb-3 col-md-6">
                <label for="inputEmail4" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $review->name }}">
            </div>

           <div class="mb-3 col-md-6">
                <label for="inputEmail4" class="form-label">Post</label>
                <input type="text" name="post" class="form-control" value="{{ $review->post }}" >
            </div>

            <div class="mb-3 col-md-12">
                <label for="inputEmail4" class="form-label">Message</label>
                <textarea name="message" class="form-control" id="example-textarea" rows="3">{{ $review->message }}</textarea>
            </div>
 
              <div class="mb-3 col-md-6">
                <label for="inputEmail4" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" id="image" >
            </div>

              <div class="mb-3 col-md-6">
                <label for="inputEmail4" class="form-label"> </label>
                 <img id="showImage" src="{{ asset($review->image)  }}"  class="rounded-circle avatar-xl img-thumbnail" style="width: 80px; height:80px;" >
            </div>
            
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