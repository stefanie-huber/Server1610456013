<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id'); //primary key
            $table->string('isbn')->unique();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->date('published')->nullable();
            $table->integer('rating')->default(0);
            $table->string('description')->nullable();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->double('price')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
