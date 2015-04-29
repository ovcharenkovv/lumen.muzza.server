<?php

use Illuminate\Database\Seeder;

class GenreTableSeeder extends Seeder {

    public function run()
    {
        DB::table('genres')->delete();

        DB::insert(
            'insert into genres
            (sh_id, name, sh_name, radios_amount, bg) values (?, ?, ?, ?, ?)',
            [777, 'Jazz','Jazz Sh',50,'/img/jazz.jpg']
        );

        DB::insert(
            'insert into genres
            (sh_id, name, sh_name, radios_amount, bg) values (?, ?, ?, ?, ?)',
            [800, 'Chill','Chill Sh',0,'/img/chill.jpg']
        );


    }

}