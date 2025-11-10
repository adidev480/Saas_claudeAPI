@extends('admin.admin_master')
@section('content')


<div class="row">
<div class="col-xl-12">
    <div class="card">
    <div class="card-header border-bottom justify-content-between d-flex flex-wrap align-items-center gap-2">
    <div class="flex-shrink-0 d-flex align-items-center gap-2">
        <div class="position-relative">
           <h3>All Blogs</h3>
        </div>
    </div>

    <a href="{{ route('add.blog') }}" class="btn btn-primary"><i class="ti ti-plus me-1"></i>Add Blog</a>
</div>


        <div class="card-body">
            
            <div class="table-responsive-sm"> 
    <table class="table table-striped mb-0">
        <thead>
            <tr>
                <th>Sl</th>
                <th>Title </th>
                <th>Category</th>
                <th>Image</th> 
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($blogs as $key=> $item) 
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->category }}</td>
                <td> <img src="{{ asset($item->image) }}" alt="" style="width: 70px; height:40px;"> </td>  
                <td class="text-muted">
<a href="{{ route('edit.blog',$item->id) }}" class="link-reset fs-20 p-1"> <i class="ti ti-pencil"></i></a>
<a href="{{ route('delete.blog',$item->id) }}" class="link-reset fs-20 p-1" id="delete"> <i class="ti ti-trash"></i></a>
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