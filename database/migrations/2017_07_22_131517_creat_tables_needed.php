<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatTablesNeeded extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'questions', function (Blueprint $table)
        {
            $table->increments( 'id' );
            $table->string( 'the_question' )->unique();
            $table->text( 'details' )->nullable( true );
            $table->integer( 'user_id' )->unsigned();
            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' );
            $table->timestamp( 'asked_at' );
        } );

        Schema::create( 'answers', function (Blueprint $table)
        {
            $table->increments( 'id' );
            $table->text( 'the_answer' );
            $table->timestamp( 'answred_at' );
            $table->integer( 'question_id' )->unsigned();
            $table->foreign( 'question_id' )->references( 'id' )->on( 'questions' );
            $table->integer('user_id')->unsigned() ;
            $table->foreign('user_id')->references('id')->on('users');
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'answers' );
        Schema::dropIfExists( 'questions' );
    }
}
