@extends('admin.admin_master')
@section('content')

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow-sm">
                
                <div class="card-header bg-primary text-white">
                    <h1 class="h4 mb-0">Create New Project</h1>
                    <p class="mb-0 text-white-50">Start building your AI-Generated Website</p> 
                </div>

    <form action="{{ route('projects.store') }}" class="card-body" method="POST" id="project-form">
        @csrf

     <div class="mb-3">
        <label for="name" class="form-label fw-semibold text-white">Project Name <span class="text-danger">*</span> </label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="e.g, My Awesome Website" required>
        <small class="text-muted">Give your project a descriptive name</small>
     </div>

      <div class="mb-3">
        <label for="description" class="form-label fw-semibold text-white">Description <span class="text-muted">(Optional)</span> </label>
         <textarea name="description" id="description" rows="3" class="form-control" placeholder="Describe your project.. what kind of website do you want to build?"></textarea>
        <small class="text-muted">This will help the AI understand your project better</small>
     </div>

 <div class="mb-3">
        <label class="form-label fw-semibold text-white">Quick Start Templates <span class="text-muted">(Optional)</span> </label>
       
        <div class="row row-cols-1 row-cols-md-2 g-3">
            <div class="col">
    <div class="card template-option h-100" onclick="selectTemplate('landing')">
                    <div class="card-body text-center p-3">
                        <div class="mb-2">
    <svg class="bi bi-lightning-fill text-primary" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
    <path d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.07z"/>
    </svg> 
           </div> 

        <h6 class="card-title mb-1">Landing Page</h6>
        <p class="card-text text-muted small">Business or Product Showcase</p>
                    </div> 
                </div> 
            </div> 


    <div class="col">
                <div class="card template-option h-100" onclick="selectTemplate('portfolio')">
                    <div class="card-body text-center p-3">
                        <div class="mb-2">
    <svg class="bi bi-person-fill text-success" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
    </svg> 
           </div> 

        <h6 class="card-title mb-1">Portfolio Page</h6>
        <p class="card-text text-muted small">Personal Or Creative Showcase</p>
                    </div> 
                </div> 
            </div> 



    <div class="col">
                <div class="card template-option h-100" onclick="selectTemplate('blog')">
                    <div class="card-body text-center p-3">
                        <div class="mb-2">
    <svg class="bi bi-pencil-fill text-purple" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.707l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
    </svg>
           </div> 

        <h6 class="card-title mb-1">Blog Page</h6>
        <p class="card-text text-muted small">Content-focused website</p>
                    </div> 
                </div> 
            </div> 


    <div class="col">
                <div class="card template-option h-100" onclick="selectTemplate('custom')">
                    <div class="card-body text-center p-3">
                        <div class="mb-2">
     <svg class="bi bi-gear-fill text-secondary" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c-1.4-.413-1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.86z"/>
   </svg>
           </div> 

        <h6 class="card-title mb-1">Custom</h6>
        <p class="card-text text-muted small">Start from Scratch</p>
                    </div> 
                </div> 
            </div> 

 
        </div>  

    <input type="hidden" name="template_type" id="template_type" value="">
    <small>Choose a template to get started faster, or go to custom</small> 
     </div> 

    <div id="initial-prompt-section" class="mb-3" style="display: none">
        <label for="initial_prompt" class="form-label fw-semibold text-white">Initial Ai Prompt</label>
        <textarea name="initial_prompt" id="initial_prompt" rows="3" class="form-control" placeholder="Tell the AI exactly what you want to build..."></textarea>
        <small>This will be first message send to the AI when you create the project</small> 
    </div>

    <input type="hidden" name="api_prompt" id="api_prompt" value="">

    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
        <a href="{{ route('all.projects') }}" class="text-decoration-none text-secondary fw-medium"> Back to Projects</a>
        <div>
            <button type="button" onclick="window.history.back()" class="btn btn-outline-secondary me-2">Cancel</button>
            <button type="submit" class="btn btn-primary">Create Project</button>
        </div> 
    </div> 
    </form> 
        </div> 

     <!-- Help Section -->
            <div class="card mt-4 bg-light">
                <div class="card-body">
                    <h2 class="h5 card-title text-primary mb-3">💡 Getting Started Tips</h2>
                    <ul class="list-unstyled text-muted small">
                        <li><strong>Be Specific:</strong> The more details you provide, the better your AI-generated website will be.</li>
                        <li><strong>Templates Help:</strong> Selecting a template gives the AI context about what type of website you want.</li>
                        <li><strong>Iterate Later:</strong> You can always refine and modify your website after creation using the chat interface.</li>
                    </ul>
                </div>
            </div>

     <!-- Recent Project Section -->
    @if (Auth::user()->projects()->count() > 0)
      <div class="card mt-4">
        <div class="card-body">
            <h2 class="h5 card-title text-white mb-3">Your Recent Projects</h2>
        @foreach (Auth::user()->projects()->latest()->limit(3)->get() as $project)
        <div class="d-flex justify-content-between align-items-center py-2 {{ !$loop->last ? 'border-bottom' : '' }} ">
        </div>
        <div>
        <h6>{{ $project->name }}</h6>
        <small class="text-muted">{{ $project->updated_at->diffForHumans() }}</small>
        </div>
        <a href="" class="text-primary fw-medium text-decoration-none">Continue</a> 
        @endforeach 
        </div> 
      </div> 
    @endif



        </div> 
    </div> 
</div> 


<script>
    function selectTemplate(type){
        document.querySelectorAll('.template-option').forEach(option => {
            option.classList.remove('border-primary','bg-light');
            option.classList.add('border','border-secondary');
        });

    event.currentTarget.classList.remove('border','border-secondary');
    event.currentTarget.classList.add('border-primary','bg-light');

    document.getElementById('template_type').value = type;

    const promptSection = document.getElementById('initial-prompt-section');
    const promptTextarea = document.getElementById('initial_prompt');
    const apiPromptInput = document.getElementById('api_prompt');

    if (type && type !== 'custom') {
        promptSection.style.display = 'block';
        const defaultPrompts = {
            'landing': 'Create a modern, professional landing page for a tech startup. ',
            'portfolio': 'Create a creative portfolio website for a designer. Include sections for about, projects/gallery, skills, and contact.',
            'blog': 'Create a clean, readable blog website. Include a header with navigation, main content area for blog posts, sidebar with recent posts and categories, and footer.'
        };
      promptTextarea.value = defaultPrompts[type] || '';
      apiPromptInput.value = defaultPrompts[type] || '';
    }else {
        promptSection.style.display = 'none';
        promptTextarea.value = '';
        apiPromptInput.value = '';
      }

    }

document.addEventListener('DOMContentLoaded',function(){
    const form = document.getElementById('project-form');
    const nameInput = document.getElementById('name');
    const descriptionTextarea = document.getElementById('description');
    const apiPromptInput = document.getElementById('api_prompt');

    nameInput.focus();

    /// update api_prompt for when description will be change 
    descriptionTextarea.addEventListener('input', function(){
        if (!document.getElementById('template_type').value) {
            apiPromptInput.value = this.value;            
        }
    });

    form.addEventListener('submit', function(e){
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
            Creating Project.... 
        `;
    });
});

const descriptionTextarea = document.getElementById('description');
if (descriptionTextarea) {
    descriptionTextarea.addEventListener('input', function(){
        const maxLength = 500;
        const currentLength = this.value.length;

    let counter = document.getElementById('description-counter');
    if (!counter) {
        counter = document.createElement('div');
        counter.id = 'description-counter';
        counter.className = 'text-muted small mt-1 text-end';
    }
    counter.textContent = `${currentLength}/${maxLength} characters`;
    if (currentLength > maxLength * 0.9) {
        counter.classList.add('text-warning');
    }else {
        counter.classList.remove('text-warning')
      }
    });
} 
</script>

 <style>
.template-option {
    transition: all 0.2s ease;
}

.template-option:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

input:focus, textarea:focus {
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25) !important;
}

.btn-primary:hover {
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
}
</style>

@endsection