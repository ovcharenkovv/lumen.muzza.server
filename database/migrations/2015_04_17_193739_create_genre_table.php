<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenreTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres', function($table)
        {
            $table->increments('id');
            $table->integer('sh_id');
            $table->string('name', 100);
            $table->string('sh_name', 100);
            $table->integer('radios_amount');
            $table->string('bg', 255);

            $table->index('radios_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('genres');
    }

}
