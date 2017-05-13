<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('avatar')->default('default.png');
            $table->string('cover')->default('default.jpg');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->boolean('bot')->default('0');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                array('first_name' => 'Dre', 'last_name' => 'Kurtis', 'avatar' => 'dre.jpg','email' => 'SocializerDre@mail.com', 'bot' => '1'),
                array('first_name' => 'Iggy', 'last_name' => 'Cass', 'avatar' => 'iggy.jpg','email' => 'SocializerIggy@mail.com', 'bot' => '1'),
                array('first_name' => 'Jonathan', 'last_name' => 'Rian', 'avatar' => 'jonathan.jpg','email' => 'SocializerJonathan@mail.com', 'bot' => '1'),
                array('first_name' => 'Lela', 'last_name' => 'Clarissa', 'avatar' => 'lela.jpg','email' => 'SocializerLela@mail.com', 'bot' => '1'),
                array('first_name' => 'Lexus', 'last_name' => 'Anemone', 'avatar' => 'lexus.jpg','email' => 'SocializerLexus@mail.com', 'bot' => '1'),
                array('first_name' => 'Livia', 'last_name' => 'Celinda', 'avatar' => 'livia.jpg','email' => 'SocializerLivia@mail.com', 'bot' => '1'),
                array('first_name' => 'Patti', 'last_name' => 'Joana', 'avatar' => 'patti.jpg','email' => 'SocializerPatti@mail.com', 'bot' => '1'),
                array('first_name' => 'Reinaldo', 'last_name' => 'Russel', 'avatar' => 'reinaldo.jpg','email' => 'SocializerReinaldo@mail.com', 'bot' => '1'),
                array('first_name' => 'Tyron', 'last_name' => 'Devyn', 'avatar' => 'tyron.jpg','email' => 'SocializerTyron@mail.com', 'bot' => '1'),
                array('first_name' => 'Wyatt', 'last_name' => 'Garland', 'avatar' => 'wyatt.jpg','email' => 'SocializerWyatt@mail.com', 'bot' => '1'),
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
        Schema::dropIfExists('users');
    }
}
