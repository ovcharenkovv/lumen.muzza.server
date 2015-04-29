<?php

use Illuminate\Database\Seeder;

class RadioTableSeeder extends Seeder {

    public function run()
    {
        DB::table('radios')->delete();

        DB::insert(
            'insert into radios
            (id, sh_id, name, sh_name, genre, stream_url) values (?, ?, ?, ?, ?, ?)',
            [1, 606342, 'Alt Rock 101','Alt Rock 101','Punk','http://streaming.radionomy.com/AltRock101']
        );

        DB::insert(
            'insert into radios
            (id, sh_id, name, sh_name, genre, stream_url) values (?, ?, ?, ?, ?, ?)',
            [2, 23683, 'A Better Classic Blues Vintage Station','A Better Classic Blues Vintage Station','Acoustic Blues','http://listen.radionomy.com/A-Better-Classic-Blues-Vintage-Station?icy=http']
        );


    }

}