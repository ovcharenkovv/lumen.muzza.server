<?php

use Illuminate\Database\Migrations\Migration;

class CreateRadioTrackTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('radio_tracks', function($table)
        {
            $table->increments('id');
            $table->string('artist_name', 255);
            $table->string('track_name', 255);

            $table->integer('radio_id')->unsigned();
            $table->foreign('radio_id')
                ->references('id')
                ->on('radios')
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
        Schema::drop('radio_tracks');
	}

}
