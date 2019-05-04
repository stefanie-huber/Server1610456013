<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Query\Builder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //die folgende methode ist zu datenbanknahe
        /*DB::table('books')->insert([
            'title' => 'Stolz und Vorurteil',
            'isbn' => '1234567899',
            'subtitle' => 'Untertitel',
            'rating' => 5,
            'description' => "Jane Austen's Meisterwerk",
            'published' => new DateTime()
        ]);*/

//        $book = new \App\Book();
//        $book->title = "Stolz und Vorurteil";
//        $book->isbn = "1234567899";
//        $book->subtitle = "eine dramatische Romanze";
//        $book->rating = 9;
//        $book->description = "Jane Austen's Meisterwerk";
//        $book->published = new DateTime();
//        $book->price = 10.29;
//
//        //get first user
//        $user = \App\User::all()->first();
//        //user hinzufügen
//        $book->user()->associate($user);
//        //speichern in DB!!
//        $book->save();
//
//        //alle authoren suchen und die Id werte sammeln (mit pluck)
//        $authors = \App\Author::all()->pluck("id");
//        $book->authors()->sync($authors);
//        $orders2 = \App\Order::all()->pluck("id");
//        $book->orders()->sync($orders2);
//        $book->save();
//
//        //add images to book
//        $image1 = new \App\Image();
//        $image1->title = "Cover 1";
//        $image1->url = "https://m.media-amazon.com/images/I/71aEJV+ctrL._AC_UL436_.jpg";
//        $image1->book()->associate($book);
//        $image1->save();
//
//        $image2 = new \App\Image();
//        $image2->title = "Cover english";
//        $image2->url = "https://m.media-amazon.com/images/I/71r9qdiBIcL._AC_UL436_.jpg";
//        $image2->book()->associate($book);
//        $image2->save();


        //---------------------------------------------------
        //----------------------------------------------------

//        $book2 = new \App\Book();
//        $book2->title = "Moby Dick";
//        $book2->isbn = "1234567888";
//        $book2->subtitle = "Der Bestseller von Melville";
//        $book2->rating = 9;
//        $book2->description = "";
//        $book2->published = new DateTime();
//        $book2->price = 15.99;
//
//        //get first user
//        $user = \App\User::all()->first();
//        //user hinzufügen
//        $book2->user()->associate($user);
//        //speichern in DB!!
//        $book2->save();
//
//        //alle authoren suchen und die Id werte sammeln (mit pluck)
//        $authors = \App\Author::all()->pluck("id");
//        $book2->authors()->sync($authors);
//        $orders = App\Order::all()->pluck("id");
//        $book2->orders()->sync($orders);
//        $book2->save();
//
//        //add images to book
//        $image5 = new \App\Image();
//        $image5->title = "Cover";
//        $image5->url = "https://images-eu.ssl-images-amazon.com/images/I/515V6UweFsL.jpg";
//        $image5->book()->associate($book2);
//        $image5->save();
//
//
//
//
//        //---------------------------------------------------
//        //----------------------------------------------------
//
//
//
//        $book3 = new \App\Book();
//        $book3->title = "Die Säulen der Erde";
//        $book3->isbn = "3785705778";
//        $book3->subtitle = "";
//        $book3->rating = 9.5;
//        $book3->description = "der Bestseller";
//        $book3->published = new DateTime();
//        $book3->price = 24.95;
//
//        //get first user
//        $user = \App\User::all()->first();
//        //user hinzufügen
//        $book3->user()->associate($user);
//        //speichern in DB!!
//        $book3->save();
//
//        //alle authoren suchen und die Id werte sammeln (mit pluck)
//        $authors2 = \App\Author::all()->pluck("id");
//        $book3->authors()->sync($authors2);
//        $orders3 = \App\Order::all()->pluck("id");
//        $book3->orders()->sync($orders3);
//        $book3->save();
//
//        //add images to book
//        $image3 = new \App\Image();
//        $image3->title = "Cover";
//        $image3->url = "https://images-na.ssl-images-amazon.com/images/I/518W7uMSibL._SX333_BO1,204,203,200_.jpg";
//        $image3->book()->associate($book3);
//        $image3->save();
//
//        $image4 = new \App\Image();
//        $image4->title = "Ken Follett";
//        $image4->url = "https://images-na.ssl-images-amazon.com/images/I/51Tdw0fbKqL._US230_.jpg";
//        $image4->book()->associate($book3);
//        $image4->save();
//


        /*
        //update:
        //$book = \App\Book::find(1);
        //$book->title = "Pride and Prejudice";
        //$book->save();

        //delete:
       //$book->delete();

       //findOrCreate updateOrCreate
        //$book = \App\Book::findOrCreate(['title'=>"Buchtitel"]);
        //$book = \App\Book::updateOrCreate(['title'=>"Buchtitel"], ['description'=>"new description"]);
*/
        //-----------------beispiele--------------------
        /*
        //neues image zu einem buch hinzufügen
        $book->images()->save($image);

        //mehrere Bilder zu diesem Buch hinzufügen
        $book->images()->saveMany([$image1, $image2]);

        //wenn ich einen user zu einem buch zuweisen möchte
        $book->user()->associate($user);
        $book->save();

        //wenn ich diesen user wieder wegkicken möchte
        $book->user()->dissociate($user);

        //m:n beziehungen
        //author zu buch hinzufügen
        $book->authors()->attach($authorId);

        //author wieder rauslöschen ausm buch
        $book->authors()->dettach($authorId);

        //alle authoren ausm buch löschen
        $book->authors()->dettach();

        //mehrere authoren zum buch hinzufügen
        //die authoren mit id 1,2,3 werden hinzugefügt
        //falls 1 schon drin ist, werden nur 2 und 3 hinzugefügt
        //falls 4 drin ist, wird dieser raugsgekickt
        $book->authors()->sync([1,2,3]);

        */
    }
}
