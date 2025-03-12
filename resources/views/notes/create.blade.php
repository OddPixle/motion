@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold">Create Note in {{ $folder->name }}</h1>
    <form action="{{ route('folders.notes.store', $folder) }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Note Title" class="block w-full p-3 border rounded-lg mb-4">
        <button type="submit" class="px-4 py-2 bg-green-600 text-black rounded-lg">Create Note</button>
    </form>
</div>
@endsection
