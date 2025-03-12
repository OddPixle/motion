@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold">Create Folder</h1>
    <form action="{{ route('folders.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Folder Name" class="block w-full p-3 border rounded-lg mb-4">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-black rounded-lg">Create</button>
    </form>
</div>
@endsection
