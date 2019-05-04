<?php

use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author1 = new \App\Author;
        $author1->firstName = "Stefanie";
        $author1->lastName = "Huber";
        $author1->save();

        $author2 = new \App\Author;
        $author2->firstName = "Robert";
        $author2->lastName = "Maier";
        $author2->save();

        $author3 = new \App\Author;
        $author3->firstName = "Patrick";
        $author3->lastName = "Sloane";
        $author3->save();

        $author4 = new \App\Author;
        $author4->firstName = "Ken";
        $author4->lastName = "Follet";
        $author4->save();

        $author5 = new \App\Author;
        $author5->firstName = "Noah";
        $author5->lastName = "Gordon";
        $author5->save();

        $author6 = new \App\Author;
        $author6->firstName = "Khaled";
        $author6->lastName = "Hosseini";
        $author6->save();

        $author7 = new \App\Author;
        $author7->firstName = "Donna W.";
        $author7->lastName = "Cross";
        $author7->save();

        $author8 = new \App\Author;
        $author8->firstName = "Ernest";
        $author8->lastName = "Hemingway";
        $author8->save();

    }
}
