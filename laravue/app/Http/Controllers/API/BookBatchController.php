<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Support\Arr;

class BookBatchController extends Controller
{  
    public function batchStore(Request $request)
    {
        $newBooks = $request->input('newBooks');

        $bookCount = count($newBooks);

        $bookIds = [];

        for($i = 0; $i < $bookCount; $i++)
        {
            $book = Book::create([
                'title' => $newBooks[$i]['title'],
                'author' => $newBooks[$i]['author'],
                'category' => $newBooks[$i]['category'],
                'publishing_house' => $newBooks[$i]['publishing_house'],
                'publishing_date' => $newBooks[$i]['publishing_date']
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
