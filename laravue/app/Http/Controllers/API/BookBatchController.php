<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BatchStoreBookRequest;
use App\Http\Requests\BatchUpdateBookRequest;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Support\Arr;

class BookBatchController extends Controller
{  
    public function batchStore(BatchStoreBookRequest $request)
    {
        $newBooks = $request->validated()['newBooks'];

        $bookIds = [];

        // $newBookList = $newBooks['newBooks'];

        foreach ($newBooks as $newBook)
        {
            $book = Book::create([
                'title' => $newBook['title'],
                'author' => $newBook['author'],
                'category' => $newBook['category'],
                'description' => $newBook['description'],
                'publishing_house' => $newBook['publishing_house'],
                'publishing_date' => $newBook['publishing_date']
            ]);

            $bookIds = Arr::prepend($bookIds, $book->id);
        }

        return BookResource::collection(Book::findMany($bookIds));
    }

    
    public function batchUpdate(BatchUpdateBookRequest $request)
    {
        $bookIds = $request->validated()['bookIds'];
        $booksData = $request->validated()['booksData'];

        foreach ($booksData as $index => $bookData)
        {
            $bookToUpdate = Book::find($bookIds[$index]);

            $bookToUpdate->update($booksData[$index]);
        }

        return BookResource::collection(Book::findMany($bookIds));
    }

   
    public function batchDestroy(Request $request)
    {
        $bookIds = $request->input('bookIds');

        Book::whereIn('id', $bookIds)->delete();

        return response()->noContent();
    }

}
