<?php

class RadioTrackIndexTest extends TestCase
{
    /**
     * @var
     */
    private $genreId;
    /**
     * @var
     */
    private $radioId;
    /**
     * @var
     */
    private $trackId;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->generateIds();

        DB::insert(
            'INSERT INTO genres
            (id, sh_id, name, sh_name, radios_amount, bg) VALUES (?, ?, ?, ?, ?, ?)',
            [$this->genreId, 800, 'Punk', 'Punk', 10, '/img/Punk.jpg']
        );


        DB::insert(
            'INSERT INTO radios
            (id, sh_id, name, sh_name, genre, stream_url, genre_id) VALUES (?, ?, ?, ?, ?, ?, ?)',
            [
                $this->radioId,
                606342,
                'Alt Rock 101',
                'Alt Rock 101',
                'Punk',
                'http://streaming.radionomy.com/AltRock101',
                $this->genreId
            ]
        );

        DB::insert(
            'INSERT INTO radio_tracks
            (id, artist_name, track_name, radio_id) VALUES (?, ?, ?, ?)',
            [
                $this->trackId,
                "Aerosmith",
                "Livin On The Edge",
                $this->radioId
            ]
        );


    }

    /**
     *
     */
    public function generateIds()
    {
        $this->genreId = $this->generateRandomId();
        $this->radioId = $this->generateRandomId();
        $this->trackId = $this->generateRandomId();
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();

        DB::delete('DELETE FROM radio_tracks WHERE id = ?', [$this->trackId]);

        DB::delete('DELETE FROM radios WHERE id = ?', [$this->radioId]);

        DB::delete('DELETE FROM genres WHERE id = ?', [$this->genreId]);

    }


    /**
     * A test for radio tracks
     *
     * @return void
     */
    public function testGetRadioTrackIndex()
    {
        $response = $this->call('GET', "/radios/$this->radioId/tracks");

        $this->assertResponseOk();

        $tracks = json_decode($response->getContent());
        $this->assertTrue(count($tracks) > 0);

        $track = end($tracks);

        $this->assertObjectHasAttribute('artist_name', $track);
        $this->assertObjectHasAttribute('track_name', $track);
        $this->assertObjectHasAttribute('title', $track);

    }


}
