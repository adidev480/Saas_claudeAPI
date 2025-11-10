@extends('admin.admin_master')
@section('content')

<!-- Include Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

<!-- Include Quill JS -->
<script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-buttom border-dashed d-flex align-items-center">
        <h4 class="header-title">Blog Post Generator</h4>
            </div>

    <div class="card-body">
    <form id="blog-form"  action="{{ route('update.blog') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $blog->id }}">

        <div class="row g-2">
        <div class="mb-3 col-md-6">
            <label for="input2" class="form-label">Blog Title</label>
            <input class="form-control" name="title" type="text" id="blog-title" value="{{ $blog->title }}" > 
        </div>
     

        <div class="mb-3 col-md-12">
            <div id="editor" style="height :400px;" > </div>
            <input type="hidden" name="content" id="content" > 
        </div>

        <div class="mb-3 col-md-6">
             <label for="category" class="form-label">Category </label>
            <select name="category" id="category" class="form-select">
                <option value="" selected="">Select Category</option>
                <option value="AI" {{ $blog->category == 'AI' ? 'selected' : '' }} >AI</option>
                <option value="Software" {{ $blog->category == 'Software' ? 'selected' : '' }}>Software</option>
                <option value="ChatGpt" {{ $blog->category == 'ChatGpt' ? 'selected' : '' }}>ChatGpt</option>
                <option value="Gemini" {{ $blog->category == 'Gemini' ? 'selected' : '' }}>Gemini</option>
                <option value="Claude" {{ $blog->category == 'Claude' ? 'selected' : '' }}>Claude</option> 
            </select>
        </div>

       <div class="mb-3 col-md-6">
            <label for="input2" class="form-label">Image</label>
            <input class="form-control" name="image" type="file" id="image" > 
           <img src="{{ asset($blog->image) }}" style="width: 70px; height:40px;">           
        </div> 
      </div>

    <button class="btn btn-info" type="submit">Save Changes</button>
  </form>
    </div>


        </div> 
    </div> 
</div> 


<script>
     var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'link'],
                [{'list': 'ordered'}, {'list': 'bullet'}],
                ['image']
            ]
        }
    });

       @if ($blog->content)
            try {
                // Assuming content is stored as HTML
                quill.root.innerHTML = `{!! $blog->content !!}`;
            } catch (e) {
                console.error('Error setting Quill content:', e);
                toastr.error('Failed to load blog content.');
            }
        @endif

  document.getElementById('blog-form').addEventListener('submit', function () {
  document.getElementById('content').value = quill.root.innerHTML;
    });
 
</script>



@endsection