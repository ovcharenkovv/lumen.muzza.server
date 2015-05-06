<?php

class RadioTrackIndexTest extends TestCase
{

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        DB::insert(
            'INSERT INTO genres
            (id, sh_id, name, sh_name, radios_amount, bg) VALUES (?, ?, ?, ?, ?, ?)',
            [1, 800, 'Punk', 'Punk', 10, '/img/Punk.jpg']
        );


        DB::insert(
            'INSERT INTO radios
            (id, sh_id, name, sh_name, genre, stream_url, genre_id) VALUES (?, ?, ?, ?, ?, ?, ?)',
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
            'INSERT INTO radio_tracks
            (id, artist_name, track_name, radio_id) VALUES (?, ?, ?, ?)',
            [
                1,
                "Aerosmith",
                "Livin On The Edge",
                1
            ]
        );


    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();

        DB::delete('DELETE FROM radio_tracks WHERE id = ?', [1]);

        DB::delete('DELETE FROM radios WHERE id = ?', [1]);

        DB::delete('DELETE FROM genres WHERE id = ?', [1]);

    }


    /**
     * A test for radio tracks
     *
     * @return void
     */
    public function testGetRadioTrackIndex()
    {
        $response = $this->call('GET', '/radios/1/tracks');

        $this->assertResponseOk();

        $data = json_decode($response->getContent());

        $this->assertEquals('Aerosmith', $data[0]->artist_name);
        $this->assertEquals('Livin On The Edge', $data[0]->track_name);

        $this->assertNotEquals('undefined', $data[0]->artist_name);

    }


}
