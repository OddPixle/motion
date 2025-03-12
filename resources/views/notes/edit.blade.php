@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <a href="{{ route('dashboard', ['folder' => $folder->id]) }}" class="block px-4 py-2 bg-gray-100 rounded-lg hover:bg-gray-200">
    ← Back to Notes</a>
    <h1 class="text-2xl font-bold mt-4">Editing: {{ $note->title }}</h1>

    <!-- Editor.js Container -->
    <div id="editorjs" class="mt-6 p-4 border rounded-lg bg-white shadow-md"></div>

    <button id="saveButton" class="mt-4 px-6 py-3 text-black bg-green-600 rounded-lg hover:bg-green-700">
        💾 Save Note
    </button>
</div>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@header"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@list"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@code"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@checklist"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@quote"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@embed"></script>



<script type="module">

    // Get Note Data from Laravel
    const noteId = {{ $note->id }};
    const folderId = {{ $folder->id }};
    let noteContent = @json($note->content); 

    console.log(noteContent);

    if (noteContent == null || noteContent == '') {
        noteContent = { "blocks": [] }; // Default Empty Content
    }else{
        noteContent=JSON.parse(noteContent);
    }

    // Initialize Editor.js
    const editor = new EditorJS({
        holder: 'editorjs',
        placeholder: "Start writing...",
        data: noteContent,
        /*tools: {
            header: { class: window.Header, inlineToolbar: true },
            list: { class: window.List, inlineToolbar: true },
            code: { class: window.CodeTool },
            checklist: { class: window.Checklist },
            quote: { class: window.Quote, inlineToolbar: true },
            embed: { class: window.Embed }
        }*/
    });

    // Save Note Content
    document.getElementById("saveButton").addEventListener("click", async () => {
        const outputData = await editor.save();

        fetch(`/folders/${folderId}/notes/${noteId}`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ content: JSON.stringify(outputData) })
        })
        .then(response => response.json())
        .then(data => {
            alert("Note saved successfully!");
            window.location.href = `/folders/${folderId}/notes`;
        })
        .catch(error => console.error("Error saving note:", error));
    });
</script>
@endsection
