<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRadioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('radios', function($table)
        {
            $table->increments('id');
            $table->integer('sh_id');
            $table->string('name', 255);
            $table->string('sh_name', 255);
            $table->string('genre', 100);
            $table->string('stream_url', 255);

            $table->index('genre');
        });

    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('radios');
	}

}
