<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('post_id');
            $table->string('body');
            $table->timestamps();
        });

        DB::table('comments')->insert(
            array(
                array('user_id' => '8', 'post_id' => '1', 'body' => 'Ahah So true!!', 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' =>  \Carbon\Carbon::now()),
                array('user_id' => '8', 'post_id' => '2', 'body' => "Ahah! Funny!", 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' =>  \Carbon\Carbon::now()),
                array('user_id' => '6', 'post_id' => '2', 'body' => "Great Stuff Iggy!", 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' =>  \Carbon\Carbon::now()),
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
