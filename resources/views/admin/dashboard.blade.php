@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>
    <h2 class="text-lg font-semibold mb-2">Users & Folders</h2>
    <ul>
        @foreach($users as $user)
            <li class="mb-2">
                <span class="font-semibold">{{ $user->name }}</span> - {{ $user->folders_count }} folders
            </li>
        @endforeach
    </ul>
</div>
@endsection
