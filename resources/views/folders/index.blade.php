@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold">Your Folders</h1>
    <a href="{{ route('folders.create') }}" class="mt-4 inline-block px-4 py-2 bg-blue-500 text-black rounded-lg">+ New Folder</a>

    <ul class="mt-4">
        @foreach ($folders as $folder)
            <li class="p-3 border rounded-lg flex justify-between items-center">
                <div>
                    <a href="{{ route('folders.notes.index', $folder) }}" class="text-lg font-semibold">{{ $folder->name }}</a>
                </div>
                <div class="flex gap-2">
                    <!-- Rename Button (Opens Modal) -->
                    <button onclick="openRenameModal('{{ $folder->id }}', '{{ $folder->name }}')" class="text-yellow-500">✏️</button>
                    <a href="{{ route('folders.notes.edit', [$folder, $note]) }}" class="text-lg font-semibold text-blue-600 hover:underline">
                        ✍️ Edit {{ $note->title }}
                    </a>
                    <!-- Delete Button -->
                    <form action="{{ route('folders.destroy', $folder) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="text-red-500">🗑️</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>

<!-- Rename Folder Modal -->
<div id="renameModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold">Rename Folder</h2>
        <form id="renameForm" method="POST">
            @csrf @method('PUT')
            <input type="text" id="renameInput" name="name" class="block w-full p-2 border rounded-lg mt-3" required>
            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="closeRenameModal()" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript for Modal -->
<script>
    function openRenameModal(folderId, folderName) {
        document.getElementById('renameInput').value = folderName;
        document.getElementById('renameForm').action = `/folders/${folderId}`;
        document.getElementById('renameModal').classList.remove('hidden');
    }

    function closeRenameModal() {
        document.getElementById('renameModal').classList.add('hidden');
    }
</script>
@endsection
