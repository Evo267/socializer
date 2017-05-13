<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('likeable_id');
            $table->string('likeable_type');
            $table->timestamps();
        });

        DB::table('likes')->insert(
            array(
                array('user_id' => '3', 'likeable_id' => '1', 'likeable_type' => 'App\Post'),
                array('user_id' => '4', 'likeable_id' => '1', 'likeable_type' => 'App\Post'),
                array('user_id' => '5', 'likeable_id' => '1', 'likeable_type' => 'App\Post'),
                array('user_id' => '6', 'likeable_id' => '1', 'likeable_type' => 'App\Post'),

                array('user_id' => '3', 'likeable_id' => '2', 'likeable_type' => 'App\Post'),
                array('user_id' => '4', 'likeable_id' => '2', 'likeable_type' => 'App\Post'),
                array('user_id' => '5', 'likeable_id' => '2', 'likeable_type' => 'App\Post'),
                array('user_id' => '6', 'likeable_id' => '2', 'likeable_type' => 'App\Post'),
                array('user_id' => '7', 'likeable_id' => '2', 'likeable_type' => 'App\Post'),
                array('user_id' => '8', 'likeable_id' => '2', 'likeable_type' => 'App\Post'),
                array('user_id' => '9', 'likeable_id' => '2', 'likeable_type' => 'App\Post'),
                array('user_id' => '10', 'likeable_id' => '2', 'likeable_type' => 'App\Post'),
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
        Schema::dropIfExists('likes');
    }
}
