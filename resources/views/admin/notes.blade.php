@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">All Notes</h1>

    <table class="w-full border">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 text-left">Title</th>
                <th class="p-2 text-left">User</th>
                <th class="p-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notes as $note)
            <tr class="border-b">
                <td class="p-2">{{ $note->title }}</td>
                <td class="p-2">{{ $note->folder->user->name ?? 'N/A' }}</td>
                <td class="p-2">
                    <form action="{{ route('admin.notes.destroy', $note) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">🗑️ Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $notes->links() }}
    </div>
</div>
@endsection
