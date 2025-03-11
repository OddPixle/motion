<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $folders = Auth::user()->folders()->with('notes')->get();
        return view('dashboard', compact('folders'));
    }
}
