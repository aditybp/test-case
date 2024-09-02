<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return Book::all();
    }

    public function show($id)
    {
        return Book::find($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_year' => 'required|digits:4|integer',
        ]);

        return Book::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title' => 'string|max:255',
            'author' => 'string|max:255',
            'published_year' => 'digits:4|integer',
        ]);

        $book->update($request->all());

        return $book;
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(['message' => 'Book Deleted']);
    }
}
