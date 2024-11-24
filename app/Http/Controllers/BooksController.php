<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{


    public function index(Request $request)
    {
        // Ambil semua data users dan categories
        $users = User::all();
        $categories = Categories::all();

        // Query awal untuk books
        $query = Books::with('categories');

        // Filter berdasarkan user (jika ada)
        if ($request->filled('user')) {
            $query->where('user_id', $request->user);
        }

        // Filter berdasarkan kategori (jika ada parameter 'category')
        if ($request->has('category') && $request->category) {
            $query->whereHas('categories', function ($query) use ($request) {
                $query->where('categories.id', $request->category);
            });
        }

        // Eksekusi query untuk mendapatkan hasil
        $books = $query->get();

        return view('books-view', compact('books', 'categories', 'users'));
    }



    public function create()
    {
        //Mengambil semua data categories
        $categories = Categories::all();

        return view('create-book-view', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'categories' => ['required', 'array'],
            'categories.*' => ['exists:categories,id'],
        ]);

        // Proses upload image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('book_images', 'public');
        }


        // Simpan data buku
        $book = Books::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'image' => $imagePath,    // Path gambar

        ]);

        // Menghubungkan buku dengan kategori
        $book->categories()->attach($request->categories);



        return redirect()->route('books-index')->with('success', 'Book added successfully.');
    }

    public function edit(Books $book)
    {
        //Mengambil semua data categories
        $categories = Categories::all();

        return view('edit-book-view', compact('book', 'categories'));
    }


    public function update(Request $request, Books $book)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'categories' => ['required', 'array'],
            'categories.*' => ['exists:categories,id'],
        ]);

        //Ambil data buku berdasarkan id
        $book = Books::findOrFail($request->id);

        //Update data buku
        $book->title = $validatedData['title'];
        $book->author = $validatedData['author'];
        $book->description = $validatedData['description'];
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($book->image) {
                $oldImagePath = storage_path('app/public/' . $book->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $imagePath = $request->file('image')->store('book_images', 'public');
            $book->image = $imagePath;
        }
        $book->save();



        //Update relasi kategori
        $book->categories()->sync($validatedData['categories']);

        return redirect()->route('books-index')->with('success', 'Book updated successfully.');
    }


    //Function untuk memnjiaman buku
    public function loan(Request $request, Books $book)
    {
        //Validasi user_id
        $validatedData = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
        ]);

        // Periksa apakah buku sudah dipinjam
        if ($book->user_id !== null) {
            return redirect()->back()->with('error', 'The book is already loaned to another user.');
        }

        $book->update([
            'user_id' => $validatedData['user_id'],
        ]);

        return redirect()->route('books-index')->with('success', 'Book loaned successfully.');
    }

    public function resetLoan(Books $book)
    {
        // Set user_id menjadi null
        $book->update([
            'user_id' => null,
        ]);

        return back()->with('success', 'Book loan has been reset.');
    }





    public function destroy(Books $book)
    {
        // Cek apakah buku ada
        if ($book) {
            $book->delete(); // Hapus buku
            return redirect()->route('books-index')->with('success', 'Book deleted successfully.');
        }
        return redirect()->route('books-index')->with('error', 'Book not found.');
    }
}
