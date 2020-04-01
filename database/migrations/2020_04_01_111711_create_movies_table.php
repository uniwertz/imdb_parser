<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id');

            // "title" => "The Invisible Man"
            $table->string('title', 256);

            // "poster" => "..."
            $table->string('poster', 2048)->nullable();

            // "release_date" => "5 March 2020"
            $table->date('release_date');

            // "rating" => "7.3"
            $table->float('rating', 8, 2)->default(0);

            // "genres" => array
            $table->json('genres')->nullable();

            // "director" => "Leigh Whannell"
            $table->string('director', 256);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
