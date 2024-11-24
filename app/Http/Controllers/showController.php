<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\User;
use Illuminate\Http\Request;

class showController extends Controller
{
    public function showAll(){
        $users = User::all(); // Ambil semua data user
        $books = Books::with('categories')->get();
        return view('app', compact('users', 'books'));
    }
}
