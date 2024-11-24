<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        // Mengambil semua data categories
        $categories = Categories::all();
        return view('categories-view', compact('categories'));
    }

    public function create()
    {
        return view('create-categories-view');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        // Simpan data buku
        Categories::create([
            'name' => $request->name
        ]);

        return redirect()->route('categories-index')->with('success', 'Category added successfully.');
    }


    public function edit(Categories $categories)
    {
        return view('edit-categories-view', compact('categories'));
    }


    public function update(Request $request, Categories $categories)
    {
        // Validasi input
       $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        // Update data user
        $categories->name = $validatedData['name'];
        $categories->save();
        return redirect()->route('categories-index')->with('success', 'Category updated successfully.');
    }


    public function destroy(Categories $categories)
    {
        $categories->delete();
        return redirect()->route('categories-index')->with('success', 'Category deleted successfully.');
    }
}
