<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'topics', function (Blueprint $table)
        {
            $table->increments( 'id' );
            $table->string( 'topic_name' )->unique();
            $table->string( 'details' );

        } );

        Schema::table( 'discussions', function (Blueprint $table)
        {
            $table->integer( 'topic_id' )->unsigned();
            $table->foreign( 'topic_id' )->references( 'id' )->on( 'topics' );
        } );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table( 'discussions', function (Blueprint $table)
        {
            $table->dropForeign('topic_id') ;
            $table->dropColumn('topic_id') ;
        } );
        Schema::dropIfExists( 'topics' );
    }
}
