@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold">{{ $folder->name }} - Notes</h1>

    <!-- Inline Create Note Form -->
    <form action="{{ route('folders.notes.store', $folder) }}" method="POST" class="mt-4 flex items-center gap-2">
        @csrf
        <input type="text" name="title" placeholder="New Note Title..." class="p-2 border rounded-lg w-full" required>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Create</button>
    </form>

    <ul class="mt-4">
        @foreach ($folder->notes as $note)
            <li class="p-3 border rounded-lg flex justify-between items-center">
                <a href="{{ route('folders.notes.edit', [$folder, $note]) }}" class="text-lg font-semibold text-blue-600 hover:underline">
                    ✍️ Edit {{ $note->title }}
                </a>
                <form action="{{ route('folders.notes.destroy', [$folder, $note]) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="text-red-500">🗑️</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection
