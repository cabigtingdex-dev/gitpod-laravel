<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BatchStoreBookRequest;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Support\Arr;

class BookBatchController extends Controller
{  
    public function batchStore(Request $request)
    {
        $newBooks = $request->input('newBooks');

        $bookIds = [];

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

    
    public function batchUpdate(Request $request)
    {
        $bookIds = $request->input('bookIds');
        $booksData = $request->input('booksData');

        $bookCount = count($bookIds);

        for($i = 0; $i < $bookCount; $i++)
        {
            $book = Book::firstOrFail($bookIds[$i]);

            $book->update($booksData[$i]);
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
