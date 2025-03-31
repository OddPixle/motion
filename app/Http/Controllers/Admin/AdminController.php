<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::withCount('folders')->get();
        return view('admin.dashboard', compact('users'));
    }

    public function notes()
    {
        $notes = Note::with('folder.user')->latest()->paginate(20);
        return view('admin.notes', compact('notes'));
    }

    public function destroyNote(Note $note)
    {
        $note->delete();
        return redirect()->route('admin.notes')->with('success', 'Note deleted.');
    }
}
