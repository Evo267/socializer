<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->integer('imageable_id');
            $table->string('imageable_type');
            $table->timestamps();
        });

        DB::table('images')->insert(
            array(
                array('filename' => 'slinky.png', 'imageable_id' => '1', 'imageable_type' => 'App\Post'),
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
        Schema::dropIfExists('images');
    }
}
