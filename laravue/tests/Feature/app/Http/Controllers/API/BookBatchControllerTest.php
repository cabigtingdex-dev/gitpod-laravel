<?php

namespace Tests\Feature\app\Http\Controllers\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;

class BookBatchControllerTest extends TestCase
{

    public function test_if_batch_store_endpoint_responds_200()
    {
        $newBooks = [
            [
                'title' => 'Oyo Boy',
                'author' => 'Biksoto',
                'category' => 'Rated X',
                'description' => 'qeqqweqew',
                'publishing_house' => 'MCC',
                'publishing_date' => now()
            ],
            [
                'title' => 'Bartolome',
                'author' => 'Bindisel',
                'category' => 'Rated R',
                'description' => 'qeqqweqew',
                'publishing_house' => 'UMC',
                'publishing_date' => now()
            ]
        ];

        $response = $this->post('api/books/batch', [
            'newBooks' => $newBooks
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseCount('books', 2);

        
    }

    public function test_if_batch_destroy_endpoint_responds_204()
    {
        $books = Book::factory()->count(3)->create();

        $response = $this->delete('/api/books/batch', [
            'bookIds' => [1, 2, 3]
        ]);

        $this->assertDatabaseCount('books', 0);

        $response->assertStatus(204);        
    }

}
