<?php

use Illuminate\Database\Seeder;

class GenreTableSeeder extends Seeder {

    public function run()
    {
        DB::table('genres')->delete();

        DB::insert(
            'insert into genres
            (id, sh_id, name, sh_name, radios_amount, bg) values (?, ?, ?, ?, ?, ?)',
            [1, 777, 'Jazz','Jazz',50,'/img/jazz.jpg']
        );

        DB::insert(
            'insert into genres
            (id, sh_id, name, sh_name, radios_amount, bg) values (?, ?, ?, ?, ?, ?)',
            [2, 800, 'Chill','Chill',10,'/img/chill.jpg']
        );

        DB::insert(
            'insert into genres
            (id, sh_id, name, sh_name, radios_amount, bg) values (?, ?, ?, ?, ?, ?)',
            [3, 0, 'Lounge','Lounge',0,'/img/lounge.jpg']
        );


    }

}