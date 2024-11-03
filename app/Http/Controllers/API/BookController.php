<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::get();
        return $this->responseSuccess('Data Retrieved Successfully', $books->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( BookRequest $request, Book $book)
    {
        $book->update($request->validated());
        return $this->responseSuccess('updated Successfully', $book->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return $this->responseSuccess('Deleted Successfully', $book->toArray());
    }
}
