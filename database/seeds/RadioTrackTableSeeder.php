<?php

use Illuminate\Database\Seeder;

class RadioTrackTableSeeder extends Seeder {

    public function run()
    {
        DB::table('radio_tracks')->delete();

        DB::insert(
            'insert into radio_tracks
            (id, artist_name, track_name, radio_id) values (?, ?, ?, ?)',
            [
                1,
                "Aerosmith",
                "Livin On The Edge",
                1
            ]
        );

        DB::insert(
            'insert into radio_tracks
            (id, artist_name, track_name, radio_id) values (?, ?, ?, ?)',
            [
                2,
                "Eagles",
                "Take it to the limit",
                1
            ]
        );

    }

}