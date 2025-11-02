@extends('admin.admin_master')
@section('content')

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="h4 mb-0">Create New Project</h1>
                    <p class="mb-0 text-white-50">Start building your AI generated website</p>

                </div>

                <form action="" class="card-body" method="POST" id="project-form">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold text-white">
                            Project Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="e.g, My Awesome website" required>
                        <small class="text-muted">Give your project a descriptive name</small>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold text-white">
                            Description <span class="text-muted">(Optional)</span>
                        </label>
                        <textarea style="width: -webkit-fill-available;" name="description" id="description" rows="3" placeholder="Describe your project.. what kind of project do you want to build?"></textarea>
                        <small class="text-muted">This will help the AI understand your project better</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-white">
                            Quick Start Templates <span class="text-muted">(Optional)</span>
                        </label>


                       <div class="row row-cols-1 row-cols-md-2 g-3">
                            <div class="col">
                                <div class="card template-option h-100" onclick="selectTemplate('landing')">
                                    <div class="card-body text-center p-3">
                                        <div class="mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments-pin"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 10a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M6 4v4" /><path d="M6 12v8" /><path d="M13.071 14.31a2 2 0 1 0 -1.071 3.69" /><path d="M12 4v10" /><path d="M12 18v2" /><path d="M16 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M18 4v1" /><path d="M18 9v2.5" /><path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" /><path d="M19 18v.01" /></svg>
                                        </div>
                                        <h6>Landing Page</h6>
                                        <p class="card-text text-muted small">Business or Product Showcase</p>
                                    </div>

                                </div>

                            </div>


                            <div class="col">
                                <div class="card template-option h-100" onclick="selectTemplate('portfolio')">
                                    <div class="card-body text-center p-3">
                                        <div class="mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" /><path d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" /></svg>
                                        </div>
                                        <h6>Portfolio Page</h6>
                                        <p class="card-text text-muted small">Personal Or Creative Showcase</p>
                                    </div>

                                </div>

                            </div>


                            <div class="col">
                                <div class="card template-option h-100" onclick="selectTemplate('blog')">
                                    <div class="card-body text-center p-3">
                                        <div class="mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pencil-bolt"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /><path d="M19 16l-2 3h4l-2 3" /></svg>
                                        </div>
                                        <h6>Blog Page</h6>
                                        <p class="card-text text-muted small">Content-focused website</p>
                                    </div>

                                </div>

                            </div>

                            <div class="col">
                                <div class="card template-option h-100" onclick="selectTemplate('custom')">
                                    <div class="card-body text-center p-3">
                                        <div class="mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-settings-heart"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.231 20.828a1.668 1.668 0 0 1 -.906 -1.145a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c.509 .123 .87 .421 1.084 .792" /><path d="M14.882 11.165a3.001 3.001 0 1 0 -4.31 3.474" /><path d="M18 22l3.35 -3.284a2.143 2.143 0 0 0 .005 -3.071a2.242 2.242 0 0 0 -3.129 -.006l-.224 .22l-.223 -.22a2.242 2.242 0 0 0 -3.128 -.006a2.143 2.143 0 0 0 -.006 3.071l3.355 3.296z" /></svg>
                                        </div>
                                        <h6>Custom</h6>
                                        <p class="card-text text-muted small">Start from scratch</p>
                                    </div>

                                </div>

                            </div>



                       </div>


                       <input type="hidden" name="template_type" id="template_type" value="">

                       <small>Choose a template toget started faster, or go to custom</small>
                    </div>

                    <div id="initial-prompt-section" class="mb-3" style="display: none;">
                        <label for="initial_prompt" class="form-label fw-semibold text-white">Initial AI Prompt</label>
                        <textarea name="initial-prompt" id="initial-prompt" rows="3" class="form-control" placeholder="Tell the AI what you want to build.."></textarea>
                        <small>This willbe the first message send to AI to create the project</small>
                    </div>


                    <input type="hidden" name="api_prompt" id="api_prompt" value="">

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="{{ route('all.projects') }}" class="text-decoration-none text-secondary fw-medium" >Back to project</a>
                        <div>
                            <button type="button" onclick="window.history.back()" class="btn btn-outline-secondary me-2">Cancel</button>
                            <button type="submit" class="btn btn-primary">Create Project</button>
                        </div>
                    </div>


                </form>

            </div>

            <div class="card mt-4 bg-light">
                <div class="card-body">
                    <h2 class="h5  card-title text-primary mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-bulb"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7" /><path d="M9 16a5 5 0 1 1 6 0a3.5 3.5 0 0 0 -1 3a2 2 0 0 1 -4 0a3.5 3.5 0 0 0 -1 -3" /><path d="M9.7 17l4.6 0" /></svg> Getting started tip
                    </h2>
                    <ul class="list-unstyled  text-muted small">
                        <li>
                            <strong>Be Specific:</strong> The more detail you provide the better your AI-generated website will be.
                        </li>
                        <li><strong>Template Help:</strong> Selecting a template gives the AI context about what type of website you want.</li>
                        <li><strong>Iterate Later:</strong> You can always redefine and modify your website after creation using chat interface</li>
                    </ul>
                </div>
            </div>

            @if(Auth::user()->projects()->count() > 0)
            <div class="card mt-4">
                <div class="card-body">
                    <h2 class="h5 card-title text-white mb-3">Your Recent Projects
                    </h2>
                    @foreach (Auth::user()->projects()->latest()->limit(3)->get() as $project)
                        <div class="d-flex justify-content-between align-items-center py-2" {{ !$loop->last ? 'border-bottom' : '' }}></div>
                        <div>
                        <h6>{{ $project->name }}</h6>
                        <small claass="text-muted">Update at {{ $project->updated_at->diffForHumans() }}</small>
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
        })
        event.currentTarget.classList.remove('border','border-secondary');
        event.currentTarget.classList.add('border-primary','bg-light');

        document.getElementById('template_type').value = type;
        const promptSection = document.getElementById('initial-prompt-section');
        const promptTextarea = document.getElementById('initial-prompt');
        const apiPromptInput = document.getElementById('api_prompt');

        if(type && type != 'custom') {
            promptSection.style.display = 'block';
            const defaultPrompts = {
                'landing' : 'Create a modern, professional landing page for a tech startup.',
                'portfolio' : 'Create a cretive portfolio website for a designer. Include section for  about, projects/gallery, skills, and contact.',
                'blog' : 'Create a clean readable blog website. Includea header with navigation, main content area for blog posts, sidebar with recent posts and categories, and footer.' 
            };

            console.log(defaultPrompts[type])
            promptTextarea.value =  defaultPrompts[type] || '';
            apiPromptInput.value =  defaultPrompts[type] || '';
        }else{
            promptSection.style.display = 'none';
            promptTextarea.value = '';
            apiPromptInput.value = '';
        }

    }

    document.addEventListener('DOMContentLoaded', function(){
        const form = document.getElementById('project-form');
        const nameInput = document.getElementById('name');
        const descriptionTextarea = document.getElementById('description');
        const apiPromptInput = document.getElementById('api_prompt');
         nameInput.focus();
         descriptionTextarea.addEventListener('input',function(){
            if(!document.getElementById('template_type').value){
                apiPromptInput.value = this.value
            }
         });

         form.addEventListener('submit',function(e){
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = `<span class="spinner-border spiner-border-sm me-2" role="status" aria-hidden="true"></span>Creating Project..`;

         });

    });

    const descriptionTextarea = document.getElementById('description');
    if(descriptionTextarea){
        descriptionTextarea.addEventListener('input',function(){
            const maxLength = 500;
            const currentLength = this.value.length;
            let counter = document.getElementById('description-counter');
            if(!counter){
                counter = document.createElement('div');
                counter.id = 'description-counter';
                counter.className = 'text-muted small mt-1 text-end';

            }

            counter.textContent = `${currentLength}/${maxLength} characters`;
            if(currentLength > maxLength * 0.9){
                counter.classList.add('text-warning');
            }else{
                counter.classList.reamove('text.warning');
            }
        })
    }
</script>
<style>
    .template-option{
        transition: all 0.2s ease;
    }

    .template-option:hover{
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    input:focus, textarea:focus {
        box-shadow: 0 0 0 0.2rem rgba(13, 110,253,0.25) !important;
    }

    .btn-primary:hover{
        box-shadow: 0 4px 12px rgba(13,110,253,0.3);
    }
</style>
@endsection