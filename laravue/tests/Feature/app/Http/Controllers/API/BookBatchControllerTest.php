<?php

namespace Tests\Feature\app\Http\Controllers\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use Illuminate\Support\Arr;

class BookBatchControllerTest extends TestCase
{

    public function test_if_batch_store_endpoint_responds_200()
    {
        $data = [
                'newBooks' => [
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
                ]
        ];

        $response = $this->postJson('api/books/batch', $data);

        $response->assertStatus(200);

        $this->assertDatabaseCount('books', 2);

        $this->assertDatabaseHas('books', [
                                            'title' => 'Oyo Boy', 
                                            'title' => 'Bartolome'
                                        ]);
    }

    public function test_if_batch_update_endpoint_responds_200()
    {
        $books = Book::factory()->count(3)->create()->toArray();

        $bookIds = Arr::pluck($books, 'id');

        $this->assertDatabaseCount('books', 3);

        $data = [
                'bookIds' => $bookIds,
                'booksData' => [
                    [
                        'title' => 'Oyo Boy',
                        'author' => 'Biksoto',
                    ],
                    [
                        'author' => 'Maykelbi',
                    ],
                    [
                        'publishing_house' => 'Macabebe'
                    ]
                ]
        ];

        $response = $this->put('api/books/batch', $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('books', [
                                            'author' => 'Biksoto',
                                            'author' => 'Maykelbi'
                                        ]);
        
        $this->assertDatabaseHas('books', [
                                            'title' => 'Oyo Boy'
                                        ]);

        $this->assertDatabaseHas('books', [
            'publishing_house' => 'Macabebe'
        ]);                                
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
