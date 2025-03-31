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
<script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/list@2"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/code@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/image@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/table@latest"></script>



<script type="module">

    // Get Note Data from Laravel
    const noteId = {{ $note->id }};
    const folderId = {{ $folder->id }};
    let noteContent = @json($note->content); 

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
        tools: {
            header: Header, 
            list: {class: EditorjsList, inlineToolbar: true, config: { defaultStyle: 'unordered' },},
            code: CodeTool,
            image: {
                class: ImageTool,
                config: {
                    endpoints: {
                        byFile: "{{ url('/upload-image') }}", // Your backend file uploader endpoint
                    }
                    additionalRequestHeaders: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                }
             },
             table: Table,
        }
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
        // Redirect to the dashboard with folder param
        window.location.href = "{{ route('dashboard', ['folder' => $folder->id]) }}";
    })
    .catch(error => console.error("Error saving note:", error));
});
</script>
@endsection
