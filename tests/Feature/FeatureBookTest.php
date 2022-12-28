<?php

namespace Tests\Feature;

use App\Models\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;

class FeatureBookTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        //? https://laravel.com/docs/5.8/database-testing#using-seeds
        // Run the DatabaseSeeder...
        $this->seed();
    }

    public function testBookOneHourCourt1At_9amTo_10am()
    {
        $postData =[
            'number' => '1',
            'time_book' => "09.10/10/2022",
        ];
        $response = $this->post('/book',$postData);

        $response->assertStatus(200)->assertJson([
            'isSave' => true
        ]);
        $book_id = $response->json()['book_id'];
        assertNotNull(Book::find($book_id),'Record Book is Empty');

        // dd(Book::find($d['book_id']));
        //! assertDatabaseHas need to be extacly the same, and cannot compare one two column in a row...use other assertion instead like assertNotNull
        // $this->assertDatabaseHas('books', Book::find($d['book_id'])->toArray());


    }
}
