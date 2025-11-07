@extends('admin.admin_master')
@section('content')

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-white">
            My projects
        </h1>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">New Project</a>
    </div>

    @if($projects->count() > 0)
        <div class="row row-col-1 row-cols-md-2 row-cols-md-3 g-4">
            @foreach ($projects as $project )
                <div class="col">
                    <div class="card h-100 shadow-sm hover-shadow-lg transition">
                        <div class="card-body p-4">
                            <h3 class="card-title h6 text-white mb-2">
                                {{ $project->name }}
                            </h3>

                            <p class="card-text text-muted mb-3"> {{ $project->description }} </p>
                            <p class="card-text text-muted mb-3"> Update at {{ $project->updated_at->diffForHumans() }} </p>
                            
                            <div class="d-flex gap-2">
                                <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary btn-sm">Edit</a>
                            </div>
                        </div>


                    </div>
                </div>
                
            @endforeach
        </div>

    @else
    <div class="text-center py-5">
        <div class="text-muted mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-abacus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 3v18" /><path d="M19 21v-18" /><path d="M5 7h14" /><path d="M5 15h14" /><path d="M8 13v4" /><path d="M11 13v4" /><path d="M16 13v4" /><path d="M14 5v4" /><path d="M11 5v4" /><path d="M8 5v4" /><path d="M3 21h18" /></svg>
        </div>
        <h3 class="h5 text-white mb-2">No Projects Yet</h3>
        <p class="text-muted mb-4">Get started by creating your first AI-generated website</p>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">Create your first project</a>
    </div>    
    @endif

</div>

<style>
    .hover-shadow-lg{
        transition: box-shadow 0.3s ease;
    }
    
    .hover-shadow-lg:hover{
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15) !important;
    }

</style>
@endsection