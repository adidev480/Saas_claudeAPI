@extends('client.master')
@section('client')

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-white">My Projects</h1>
        <a href="{{ route('user.projects.create') }}" class="btn btn-primary">New Project</a> 
    </div>

@if ($projects->count() > 0)
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    @foreach ($projects as $project)
    <div class="col">
        <div class="card h-100 shadow-sm hover-shadow-lg transition">
    <div class="card-body p-4">
        <h3 class="card-title h6 text-white mb-2">{{ $project->name }}</h3>
        <p class="card-text text-muted mb-3">{{ $project->description }}</p>
        <p class="card-text text-muted mb-3">Updated {{ $project->updated_at->diffForHumans() }}</p> 
    <div class="d-flex gap-2">
        <a href="{{ route('user.projects.edit',$project) }}" class="btn btn-primary btn-sm">Edit</a>
        </div>
    </div>

        </div>

    </div>
        
    @endforeach 
  </div>

  @else
  <div class="text-center py-5">
    <div class="text-muted mb-3">
         <svg class="bi bi-file-earmark-plus mx-auto" width="48" height="48" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                    <path d="M8 6h2a.5.5 0 0 1 0 1H8v2a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h2V5a.5.5 0 0 1 1 0v1z"/>
                </svg> 
    </div>
    <h3 class="h5 text-white mb-2">No Projects Yet</h3>
    <p class="text-muted mb-4">Get started by creating your first AI-Generated website</p>
    <a href="{{ route('user.projects.create') }}" class="btn btn-primary">Cerate Your First Project</a> 
  </div>
    
@endif 
    
</div>

<style>
 .hover-shadow-lg {
    transition: box-shadow 0.3s ease;
}

.hover-shadow-lg:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
} 
</style> 

@endsection