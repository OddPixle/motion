@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 flex">
    <!-- Sidebar: Folders -->
    <aside class="w-1/4 bg-white shadow-md p-4 rounded-lg">
        <h2 class="text-xl font-semibold mb-4">📁 Folders</h2>
        <a href="{{ route('folders.create') }}" class="block px-4 py-2 mb-2 text-white bg-blue-600 rounded-lg text-center hover:bg-blue-700">+ New Folder</a>
        
        <ul>
            @foreach ($folders as $folder)
                <li class="mb-2">
                    <a href="{{ route('dashboard', ['folder' => $folder->id]) }}" class="block px-4 py-2 bg-gray-100 rounded-lg hover:bg-gray-200">
                        {{ $folder->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </aside>

    <!-- Main Content: Notes List -->
    <main class="w-3/4 p-6">
        @if (request()->has('folder'))
            @php
                $currentFolder = $folders->firstWhere('id', request()->folder);
            @endphp
            
            @if ($currentFolder)
                <h2 class="text-2xl font-semibold mb-4">📂 {{ $currentFolder->name }} - Notes</h2>
                <a href="{{ route('folders.notes.create', $currentFolder) }}" class="block px-4 py-2 mb-2 text-white bg-green-600 rounded-lg text-center hover:bg-green-700">+ New Note</a>

                <ul>
                    @foreach ($currentFolder->notes as $note)
                        <li class="flex justify-between items-center bg-white shadow p-3 rounded-lg mb-2">
                            <span class="text-lg">{{ $note->title }}</span>
                            <form action="{{ route('folders.notes.destroy', [$currentFolder, $note]) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="text-red-500">🗑️</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">Folder not found.</p>
            @endif
        @else
            <h2 class="text-2xl font-semibold mb-4">📂 Select a Folder</h2>
            <p class="text-gray-500">Click a folder on the left to view its notes.</p>
        @endif
    </main>
</div>
@endsection
