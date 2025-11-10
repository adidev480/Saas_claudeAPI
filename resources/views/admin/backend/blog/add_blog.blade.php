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
        <div class="row g-2">
        <div class="mb-3 col-md-6">
            <label for="input2" class="form-label">Blog Title</label>
            <input class="form-control" type="text" id="blog-title" placeholder="Enter blog title"> 
        </div>
    
        <div class="col-md-6 mt-4">
           <label for="input2" class="form-label"> </label>
           <button class="btn btn-primary" onclick="generateBlog()" >Generate</button> 
        </div>

        <div class="mb-3 col-md-12">
            <div id="editor" style="height :400px;" > </div> 
        </div>

        <div class="mb-3 col-md-6">
             <label for="category" class="form-label">Category </label>
            <select name="category" id="category" class="form-select">
                <option value="" selected="">Select Category</option>
                <option value="AI">AI</option>
                <option value="Software">Software</option>
                <option value="ChatGpt">ChatGpt</option>
                <option value="Gemini">Gemini</option>
                <option value="Claude">Claude</option> 
            </select>
        </div>

       <div class="mb-3 col-md-6">
            <label for="input2" class="form-label">Image</label>
            <input class="form-control" name="image" type="file" id="image" > 
        </div> 
      </div>

    <button class="btn btn-info" onclick="saveBlog()">Save to Database</button>

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

    async function generateBlog(){
        const title = document.getElementById('blog-title').value;

        if (!title) {
            alert('Please enter a title');
            return
        }

        try {
            const response = await fetch(`/generate-blog/${encodeURIComponent(title)}` , {
                method : 'GET',
                headers: {
                    'Accept': 'application/json',
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error status: ${response.status}`); 
            }

        const data = await response.json();
        if (data.success) {
            quill.setContents([{ insert: data.content }])
        } else {
            alert('Error: ' + data.message);
        } 
        } catch (error) {
            console.error('Generate blog error:',error);
        } 
    }


    async function saveBlog(){
        const content = quill.root.innerHTML;
        const title = document.getElementById('blog-title').value;
        const category = document.getElementById('category').value;
        const imageInput = document.getElementById('image');
        let image = '';

    try {
        if (imageInput.files && imageInput.files[0]) {
            const formData = new FormData();
            formData.append('image', imageInput.files[0]);
            formData.append('title', title);
            formData.append('content', content);
            formData.append('category',category);

            const uploadResponse = await fetch('/save-blog',{
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            });

        if (!uploadResponse.ok) {
            throw new Error(`HTTP error status: ${uploadResponse.status}`);
        }

        const result = await uploadResponse.json();
        alert(result.message);
        return; // EXIT AFTER SUCCESSFULLY SAVE
            
        } else {
            // if there have no image send this json data with other data
            const response = await fetch('/save-blog',{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ title,content,category, image })
            });

        if (!response.ok) {
            throw new Error(`HTTP error status: ${response.status}`);
        }

        const result = await response.json();
        alert(result.message); 
        } 
    } catch (error) {
        console.error('Save blog error',error);
       }

    } 

</script>



@endsection