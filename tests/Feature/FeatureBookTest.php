<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\User;

use Illuminate\Support\Carbon;
use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertNotNull;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
    /**
     * @format: Y-m-d H
     * @param: eg: 2022-10-20 09
     */
    public function timeToString($time)
    {
        return (Carbon::createFromFormat('Y-m-d H', $time)->toDateTimeString());
    }

    public function testAnonymousUserBookOneHourCourt1At_9amTo_10am()
    {
        $postData = [
            'number' => '1',
            'time_book_start' => $this->timeToString('2022-10-20 09'),
            'time_book_end' => $this->timeToString('2022-10-20 10'),
            'phone_no' => '0134567890',
            'name' => 'Fifa'
        ];
        $response = $this->post('/book', $postData);

        $response->assertSuccessful()->assertViewHasAll(['is_save' => true]);

        $book_id = $response->getOriginalContent()->getData()['book_id'];
        $book = Book::find($book_id);
        assertNotNull($book, 'Record Book Should Not Be Empty');
        assertNotNull($book->anonymous_id, 'annoymous_id Should Not Be Empty');
        assertNull($book->user_id, 'user_id Should Be Empty');

        //! assertDatabaseHas need to be extacly the same, and cannot compare one two column in a row...use other assertion instead like assertNotNull
        // $this->assertDatabaseHas('books', Book::find($d['book_id'])->toArray());
        // $book_id = $response->json()['book_id'];
        // ->assertJson([
        //     'is_save' => true
        // ]);

    }


    // public function testAccountUserBookOneHourCourt1At_9amTo_10am()
    // {
    //     $user = User::find(1);
    //     $postData = [
    //         'number' => '1',
    //         'time_book_start' => $this->timeToString('2022-10-20 09'),
    //         'time_book_end' => $this->timeToString('2022-10-20 10'),
    //         'phone_no' => $user->phone_no,
    //         'name' => $user->name,
    //     ];

    //     $response = $this->actingAs($user)->post('/book', $postData);
    //     $response->assertSuccessful()->assertViewHasAll(['is_save' => true]);
    //     $book_id = $response->getOriginalContent()->getData()['book_id'];
    //     $book = Book::find($book_id);
    //     assertNotNull($book);
    //     assertNotNull($book->user_id);
    //     assertNull($book->anonymous_id);
    // }

    // public function testAnnoymousUserBookAt_9amTo_10amAtCourt1WhileAlreadyHaveBookOneAt_10amTo_11amAtCourt1 () {
    //     $bookOne = Book::create([
    //         'court_id' => '1',
    //         'user_id' => 1,
    //         'time_book_start' => $this->timeToString('2022-10-20 09'),
    //         'time_book_end' => $this->timeToString('2022-10-20 10'),
    //         'state' => 'booked',
    //     ]);

    //     $postData = [
    //         'number' => '1',
    //         'time_book_start' => $this->timeToString('2022-10-20 10'),
    //         'time_book_end' => $this->timeToString('2022-10-20 11'),
    //         'phone_no' => '0134567899',
    //         'name' => 'Auntie Helen'
    //     ];

    //     $response = $this->post('/book', $postData);
    //     $response->assertSuccessful();
    // }

    // public function testAnnoymousUserTryingToBookWithNonExistCourtIdShouldFailed()
    // {
    //     $postData = [
    //         'number' => '999',
    //         'time_book_start' => $this->timeToString('2022-10-20 09'),
    //         'time_book_end' => $this->timeToString('2022-10-20 10'),
    //         'phone_no' => '0134567890',
    //         'name' => 'Fifa'
    //     ];
    //     $response = $this->post('/book', $postData);
    //     $response->assertInvalid([
    //         "number"
    //     ])->assertStatus(302);
    // }

    // public function testAnnoymousUserBookSameDateTimeForTimeBookStartAndTimeBookEndCourt1ShouldFailed()
    // {
    //     $postData = [
    //         'number' => '1',
    //         'time_book_start' => $this->timeToString('2022-10-20 10'),
    //         'time_book_end' => $this->timeToString('2022-10-20 10'),
    //         'phone_no' => '0134567890',
    //         'name' => 'Fifa'
    //     ];
    //     $response = $this->post('/book', $postData);
    //     $response->assertInvalid([
    //         "time_book_end"
    //     ])->assertStatus(302);
    // }

    // public function testAnnoymousUserBookAtTheSameTimeAndDateAsBookOneWithSameCourt1ShouldFailed()
    // {
    //     $bookOne = Book::create([
    //         'court_id' => '1',
    //         'user_id' => 1,
    //         'time_book_start' => $this->timeToString('2022-10-20 09'),
    //         'time_book_end' => $this->timeToString('2022-10-20 10'),
    //         'state' => 'booked',
    //     ]);

    //     $postData = [
    //         'number' => '1',
    //         'time_book_start' => $this->timeToString('2022-10-20 09'),
    //         'time_book_end' => $this->timeToString('2022-10-20 10'),
    //         'phone_no' => '0134567899',
    //         'name' => 'Auntie Helen'
    //     ];

    //     $response = $this->post('/book', $postData);
    //     $response->assertInvalid([
    //         'time_book_start' => 'The time book has already been taken.',
    //     ])->assertStatus(302);

    // }

    // public function testAnnoymousUserBookAtTheSameTimeAndDateAsBookOneWithDifferentCourt()
    // {
    //     $bookOne = Book::create([
    //         'court_id' => '1',
    //         'user_id' => 1,
    //         'time_book_start' => $this->timeToString('2022-10-20 09'),
    //         'time_book_end' => $this->timeToString('2022-10-20 10'),
    //         'state' => 'booked',
    //     ]);

    //     $postData = [
    //         'number' => '2',
    //         'time_book_start' => $this->timeToString('2022-10-20 09'),
    //         'time_book_end' => $this->timeToString('2022-10-20 10'),
    //         'phone_no' => '0134567899',
    //         'name' => 'Auntie Helen'
    //     ];

    //     $response = $this->post('/book', $postData);
    //     $response->assertSuccessful();
    // }

    // public function testAnnoymousUserBook_11am_to_1pmWhileBookOneAlreadyBook_9am_to_12pmShouldFailedWithSameCourt()
    // {
    //     $bookOne = Book::create([
    //         'court_id' => '1',
    //         'user_id' => 1,
    //         'time_book_start' => $this->timeToString('2022-10-20 09'),
    //         'time_book_end' => $this->timeToString('2022-10-20 12'),
    //         'state' => 'booked',
    //     ]);

    //     $postData = [
    //         'number' => '1',
    //         'time_book_start' => $this->timeToString('2022-10-20 11'),
    //         'time_book_end' => $this->timeToString('2022-10-20 13'),
    //         'phone_no' => '0134567899',
    //         'name' => 'Auntie Helen'
    //     ];

    //     $response = $this->post('/book', $postData);
    //     $response->assertStatus(302);
    // }

    // public function testAnnoymousUserBook_09am_to_11pmWhileBookOneAlreadyBook_10am_to_12pmShouldFailedWithSameCourt()
    // {
    //     $bookOne = Book::create([
    //         'court_id' => '1',
    //         'user_id' => 1,
    //         'time_book_start' => $this->timeToString('2022-10-20 10'),
    //         'time_book_end' => $this->timeToString('2022-10-20 12'),
    //         'state' => 'booked',
    //     ]);

    //     $postData = [
    //         'number' => '1',
    //         'time_book_start' => $this->timeToString('2022-10-20 09'),
    //         'time_book_end' => $this->timeToString('2022-10-20 11'),
    //         'phone_no' => '0134567899',
    //         'name' => 'Auntie Helen'
    //     ];

    //     $response = $this->post('/book', $postData);
    //     // $response->assertStatus(302);
    //     $response->assertInvalid([
    //         'time_book_end'
    //     ])->assertStatus(302);
    // }
}
