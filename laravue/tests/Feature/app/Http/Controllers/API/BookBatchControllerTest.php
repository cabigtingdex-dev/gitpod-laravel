<?php

namespace Tests\Feature\app\Http\Controllers\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;

class BookBatchControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

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
