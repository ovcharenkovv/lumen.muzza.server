<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGenreIdToRadios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('radios', function(Blueprint $table)
        {
            $table->integer('genre_id')->unsigned();

            $table->foreign('genre_id')
                ->references('id')
                ->on('genres')
                ->onDelete('cascade')
            ;
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('radios', function($table)
        {
            $table->dropForeign('radios_genre_id_foreign');
            $table->dropColumn('genre_id');
        });
	}

}
