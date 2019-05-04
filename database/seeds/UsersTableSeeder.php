<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /** $user = new \App\User();
        $user->name = "testuser";
        $user->email = "test@test.com";
        $user->password = bcrypt('secret');
        $user->save();*/

       $user = new \App\User();
       $user->first_name = "Stefanie";
       $user->last_name = "Huber";
       $user->street = "Neckreith";
       $user->house_number = "2";
       $user->postal_code = "5163";
       $user->town = "Palting";
       $user->email = "test@test.com";
       $user->password = bcrypt('secret');
       $user->is_admin = true;
       $user->save();


        $user2 = new \App\User();
        $user2->first_name = "Sylvia";
        $user2->last_name = "Winkler";
        $user2->street = "Sportplatzstraße";
        $user2->house_number = "5";
        $user2->postal_code = "5166";
        $user2->town = "Lochen";
        $user2->email = "test@test2.com";
        $user2->password = bcrypt('secret');
        $user2->is_admin = false;
        $user2->save();


        $user2 = new \App\User();
        $user2->first_name = "Verena";
        $user2->last_name = "Grundner";
        $user2->street = "Hauptstraße";
        $user2->house_number = "5";
        $user2->postal_code = "5163";
        $user2->town = "Lochen";
        $user2->email = "test@test3.com";
        $user2->password = bcrypt('secret');
        $user2->is_admin = false;
        $user2->save();


    }
}
