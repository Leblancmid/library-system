<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $books = [
            ['title' => 'You Don\'t Know JS',                  'author' => 'Kyle Simpson',           'isbn' => '9781491904244', 'copies_total' => 4, 'copies_available' => 2],
            ['title' => 'The Lean Startup',                    'author' => 'Eric Ries',              'isbn' => '9780307887894', 'copies_total' => 5, 'copies_available' => 5],
            ['title' => 'Deep Work',                           'author' => 'Cal Newport',            'isbn' => '9781455586691', 'copies_total' => 3, 'copies_available' => 0],
            ['title' => 'Sapiens',                             'author' => 'Yuval Noah Harari',      'isbn' => '9780062316097', 'copies_total' => 5, 'copies_available' => 3],
            ['title' => 'The Mythical Man-Month',              'author' => 'Frederick P. Brooks',    'isbn' => '9780201835953', 'copies_total' => 2, 'copies_available' => 2],
            ['title' => 'Refactoring',                         'author' => 'Martin Fowler',          'isbn' => '9780134757599', 'copies_total' => 3, 'copies_available' => 1],
            ['title' => 'Introduction to Algorithms',          'author' => 'Thomas H. Cormen',       'isbn' => '9780262033848', 'copies_total' => 4, 'copies_available' => 2],
            ['title' => 'The Art of War',                      'author' => 'Sun Tzu',                'isbn' => '9780140439199', 'copies_total' => 6, 'copies_available' => 6],
            ['title' => '1984',                                'author' => 'George Orwell',          'isbn' => '9780451524935', 'copies_total' => 7, 'copies_available' => 5],
            ['title' => 'To Kill a Mockingbird',               'author' => 'Harper Lee',             'isbn' => '9780061935466', 'copies_total' => 5, 'copies_available' => 3],
            ['title' => 'Thinking, Fast and Slow',             'author' => 'Daniel Kahneman',        'isbn' => '9780374533557', 'copies_total' => 4, 'copies_available' => 1],
            ['title' => 'The Hitchhiker\'s Guide to the Galaxy', 'author' => 'Douglas Adams',       'isbn' => '9780345391803', 'copies_total' => 4, 'copies_available' => 4],
            ['title' => 'Don\'t Make Me Think',                'author' => 'Steve Krug',             'isbn' => '9780321965516', 'copies_total' => 3, 'copies_available' => 2],
            ['title' => 'Zero to One',                         'author' => 'Peter Thiel',            'isbn' => '9780804139021', 'copies_total' => 4, 'copies_available' => 3],
            ['title' => 'The Phoenix Project',                 'author' => 'Gene Kim',               'isbn' => '9781942788294', 'copies_total' => 3, 'copies_available' => 0],
            ['title' => 'A Brief History of Time',             'author' => 'Stephen Hawking',        'isbn' => '9780553380163', 'copies_total' => 5, 'copies_available' => 4],
        ];

        foreach ($books as &$book) {
            $book['created_at'] = $now;
            $book['updated_at'] = $now;
        }

        DB::table('books')->insert($books);
    }
}
