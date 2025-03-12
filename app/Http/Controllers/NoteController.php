<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Folder $folder)
    {
        $notes = $folder->notes;
        return view('notes.index', compact('folder', 'notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Folder $folder)
    {
        return view('notes.create', compact('folder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Folder $folder)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
    
        $note = $folder->notes()->create([
            'title' => $request->title,
            'content' => json_encode(['blocks' => []]) // Empty content for Editor.js
        ]);
    
        return redirect()->route('folders.notes.edit', [$folder, $note]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Folder $folder, Note $note)
    {
        return view('notes.edit', compact('folder', 'note'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Folder $folder, Note $note)
    {
        $request->validate([
            'content' => 'required' // Ensure content is provided
        ]);
    
        $note->update(['content' => $request->content]);
    
        return response()->json(['success' => true, 'message' => 'Note updated successfully']);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Folder $folder, Note $note)
    {
        $note->delete();
        return redirect()->route('folders.notes.index', $folder)->with('success', 'Note deleted');
    }
}
