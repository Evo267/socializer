<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('body');
            $table->timestamps();
        });

        DB::table('posts')->insert(
            array(
                array('id' => '1', 'user_id' => '2', 'body' => 'Some of my friends are like a slinky – completely useless, but fun to push down stairs.'
                    , 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' =>  \Carbon\Carbon::now()),                
                array('id' => '2', 'user_id' => '3', 'body' => 'I hate it when I’m singing along to a song and the artist gets the words wrong', 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' =>  \Carbon\Carbon::now()),
                array('id' => '3', 'user_id' => '4', 'body' => 'I intend to live forever, or die trying.', 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' =>  \Carbon\Carbon::now()),
                array('id' => '4', 'user_id' => '5', 'body' => 'Weather forecast for tonight: Dark with a chance of tomorrow in the morning.', 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' =>  \Carbon\Carbon::now()),
                array('id' => '5', 'user_id' => '6', 'body' => '…did a lot of nothing yesterday, but I didn’t finish, so I’m going to do it again today!', 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' =>  \Carbon\Carbon::now()),
                array('id' => '6', 'user_id' => '7', 'body' => 'I am a bomb technician. If you see me running, try to keep up.', 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' =>  \Carbon\Carbon::now()),
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
        Schema::dropIfExists('posts');
    }
}
