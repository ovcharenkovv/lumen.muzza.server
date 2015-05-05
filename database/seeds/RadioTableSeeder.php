<?php

use Illuminate\Database\Seeder;

class RadioTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('radios')->delete();

        DB::insert(
            'insert into radios
            (id, sh_id, name, sh_name, genre, stream_url, genre_id) values (?, ?, ?, ?, ?, ?, ?)',
            [
                1,
                606342,
                'Alt Rock 101',
                'Alt Rock 101',
                'Punk',
                'http://streaming.radionomy.com/AltRock101',
                1
            ]
        );

        DB::insert(
            'insert into radios
            (id, sh_id, name, sh_name, genre, stream_url, genre_id) values (?, ?, ?, ?, ?, ?, ?)',
            [
                2,
                23683,
                'A Better Classic Blues Vintage Station',
                'A Better Classic Blues Vintage Station',
                'Acoustic Blues',
                'http://listen.radionomy.com/A-Better-Classic-Blues-Vintage-Station?icy=http',
                1
            ]
        );


        DB::insert(
            'insert into radios
            (id, sh_id, name, sh_name, genre, stream_url, genre_id) values (?, ?, ?, ?, ?, ?, ?)',
            [
                3,
                23683,
                'FD LOUNGE RADIO',
                'FD LOUNGE RADIO',
                'Lounge',
                'http://listen.radionomy.com/FD-LOUNGE-RADIO?icy=http',
                3
            ]
        );

        DB::insert(
            'insert into radios
            (id, sh_id, name, sh_name, genre, stream_url,genre_id) values (?, ?, ?, ?, ?, ?, ?)',
            [
                4,
                366449,
                'GrooveWave - Lounge',
                'GrooveWave - Lounge',
                'Lounge', 'http://162.210.36.10:8924/;?icy=http',
                3
            ]
        );

    }

}