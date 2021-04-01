<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;

use App\Http\Resources\BookResource;

use App\Http\Resources\BookCollection;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new BookCollection(Book::all());

        //$authors = Book::all();

        //return response()->json($books, 200);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newBook = Book::addBook($request->all());

        return response ()->json($newBook, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book =  Book::find($id);
        if ($book){
            return new BookResource($book);
        }
        else{
            return response()->json(['message' => 'Book does not exist!'], 404);
        }
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Book $book 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $updateBook = Book::updateBook($book, $request->all());

        return response ()->json($updateBook, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response ()->json('', 204);
    }
}

