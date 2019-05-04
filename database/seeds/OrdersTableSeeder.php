<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = new \App\Order();
        $order->total_price = 10.70;
        $order->state = 1;
        $order->comment = "wird bearbeitet";

        //user rausholen von fk
        $user = \App\User::all()->first();
        //$user = 1;
        $order->user()->associate($user);
        //$order->user_id = 1;
        $order->save();

        $books = \App\Book::all()->pluck("id");
        $order->books()->sync($books);
        $order->save();


        /**$order2 = new \App\Order();
        $order2->total_price = 21.125;
        $order2->state = 3;
        $order2->comment = "";

        //user rausholen von fk
        //$user2 = \App\User::all()->first();
        //$order2->user()->associate($user2);
        $user2 = 3;
        $order2->user()->associate($user2);
        //$order2->user_id = 2;
        $order2->save();*/

    }
}
