@extends('client.master')
@section('client')

<div class="min-vh-100 bg-light">
    <div class="bg-white shadow-sm border-bottom">
        <div class="container-fluid">
            <div class="row py-3 align-items-center">
                <div class="col">
            <h1 class="h4 mb-0 text-dark">{{ $project->name }}</h1>
            <p class="text-muted mb-0">{{ $project->description }}</p>
                </div>
            <div class="col-auto">
                <div class="d-flex gap-2">
                    <button onclick="previewProject()" class="btn btn-primary">Preview</button>
                    <a href="{{ route('projects.export', $project) }}" class="btn btn-success">Export</a>
                </div> 
            </div> 
            </div> 
        </div> 
    </div>


<div class="container-fluid">
    <div class="row h-100">
        <!---- Chat Panel Start  --->
    <div class="col-4 border-end bg-white">
        <div class="card h-100">
            <div class="card-header bg-light">
        <h2 class="h6 mb-0 text-dark">AI Assistant</h2>
        <p class="text-muted mb-0 small">Tell me what you want to build or modify</p>
            </div>

<div id="chat-history" class="card-bory p-3 flex-grow-1 overflow-auto" style="max-height: calc(100vh - 200px);">
    @if ($project->chat_history)
     @foreach ($project->chat_history as $message)
     <div class="chat-message {{ $message['role'] === 'user' ? 'text-end' : 'text-start'}} mb-2">
        <div class="d-inline-block {{ $message['role'] === 'user' ? 'bg-primary text-white ms-4' : 'bg-light text-dark me-4'}} p-2 rounded">
            {{ $message['content'] }}
        </div>
        <div class="text-muted small mt-1">
            {{ \Carbon\Carbon::parse($message['timestamp'])->format('H:i') }}
        </div> 
     </div> 
     @endforeach 

    @else
    <div class="text-center text-muted mt-4">
        <p>Start a conversation to generate your website!</p>
        <p class="small mt-2">Try : "Cerate a modern landing page for a teach startup"</p> 
    </div> 
        
    @endif  
</div>

<div class="card-footer bg-light">
    <form id="chat-form" class="d-flex gap-2">
        @csrf
    <input type="text" id="chat-input" placeholder="Describe what you want to change" class="form-control flex-grow-1" required>
    <button type="submit" id="send-button" class="btn btn-primary">Send</button>
    </form> 
</div> 
        </div> 
    </div> 

        <!---- Chat Panel End   --->


 <!---- Preview Panel Start   --->

 <div class="col-8 bg-light">
    <div class="card h-100">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h2 class="h6 mb-0 text-dark">Live Preview</h2>
        <div class="btn-group">
            <button class="btn btn-outline-secondary preview-mode-btn active">Desktop</button>
            <button class="btn btn-outline-secondary preview-mode-btn ">Tablet</button>
            <button class="btn btn-outline-secondary preview-mode-btn ">Mobile</button> 
        </div> 
        </div>

    <div class="card-body p-3 d-flex flex-column">
        <div id="preview-container" class="flex-grow-1 position-relative overflow-auto" style="min-height: calc(100vh - 150px);">
            <iframe id="preview-frame" class="w-100 h-100 border rounded shadow-sm bg-white" src="about:blank"> </iframe> 
        </div> 
    </div> 
    </div> 
 </div>


  <!---- Preview Panel End   --->
 
    </div> 
</div>  
</div>

  <!---- Loading Div   --->
  <div id="loading-overlay" class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex align-items-center justify-content-center hidden" style="z-index: 1050">
    <div class="bg-white p-4 rounded shadow">
        <div class="spinner-border text-primary mb-2" role="status">
            <span class="visually-hidden">Loading...</span> 
        </div>
        <p class="text-dark mb-0">Generating your website...</p> 
    </div> 
  </div>

  <script>
    const projectId = {{ $project->id }}

    document.addEventListener('DOMContentLoaded', async function() {
        await updatePreview();
        document.getElementById('chat-form').addEventListener('submit', handleChatSubmit);
        scrollChatToBottom();
    });

async function handleChatSubmit(e) {
    e.preventDefault();
    const input = document.getElementById('chat-input');
    const message = input.value.trim();
    if(!message) return;

    addChatMessage('user',message);
    input.value = '';
    showLoading();

    try {
        const response = await fetch(`/api/projects/${projectId}/chat`,{
            method: 'POST',
            headers: {
                'Content-Type' : 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept' : 'application/json',
            },
            credentials: 'same-origin',
            body: JSON.stringify({ message })
        });

    const data = await response.json();
    if (data.success) {
        addChatMessage('assistant', 'Website updated successfully');
        updatePreview();
    } else {
        addChatMessage('assistant', 'Error:' + data.message);
    } 
    } catch (error) {
        console.error(error);
         addChatMessage('assistant', 'Server error. Plase try again');
    } finally {
         hideLoading();
    } 
}

async function updatePreview() {
    try {
        const response = await fetch(`/api/projects/${projectId}/preview`);
        if(!response.ok) throw new Error(`HTTP error status: ${response.status}`);
        const data = await response.json();
        console.log('Preview data:' , data);
        if (data.html) {
            updatePreviewFrame(data.html);
        } else {
            addChatMessage('assistant', 'No content avaiable. Plz provide a prompt to generate the website');
        }
    } catch (e) {
        console.error('Preview update failed',e);
         addChatMessage('assistant', 'Failed to load preview:' + e.message);
    } 
}

function updatePreviewFrame(html){
    const frame = document.getElementById('preview-frame');
    try {
        frame.srcdoc = html;
    } catch (e) {
        console.error('Failed to set srcdoc', e);
    }
}


function addChatMessage(role, content){
    const chatHistory = document.getElementById('chat-history');
    const div = document.createElement('div');
    div.className = `chat-message ${role === 'user' ? 'text-end' : 'text-start'} mb-2 `;
    const time = new Date().toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'});

    div.innerHTML = `
    <div class="d-inline-block ${role === 'user' ? 'bg-primary text-white ms-4' : 'bg-light text-dark me-4'} p-2 rounded">${ content }</div>
        <div class="text-muted small mt-1"> ${time} </div>  
    `;

    chatHistory.appendChild(div);
    scrollChatToBottom();  
}

function scrollChatToBottom(){
    const chatHistory = document.getElementById('chat-history');
    chatHistory.scrollTop = chatHistory.scrollHeight;
}

function previewProject(){
    window.open(`/projects/${projectId}/preview`, '_blank');
}

function showLoading(){
    document.getElementById('loading-overlay').classList.remove('hidden');
    document.getElementById('send-button').disabled = true;
}

function hideLoading(){
    document.getElementById('loading-overlay').classList.add('hidden');
    document.getElementById('send-button').disabled = false;
}

  </script>

<style>
.chat-message {
    animation: fadeIn 0.3s ease-in;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
#preview-frame {
    transition: all 0.3s ease;
}
#preview-container {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: calc(100vh - 150px); /* Increased minimum height */
}
.hidden {
    display: none !important;
}
</style>

@endsection