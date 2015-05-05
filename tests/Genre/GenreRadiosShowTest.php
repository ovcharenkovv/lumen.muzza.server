<?php

class GenreRadiosShowTest extends TestCase
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
            [1, 800, 'Chill', 'Chill', 10, '/img/chill.jpg']
        );

        DB::insert(
            'INSERT INTO radios
            (id, sh_id, name, sh_name, genre, stream_url, genre_id) VALUES (?, ?, ?, ?, ?, ?, ?)',
            [
                1,
                23683,
                'FD LOUNGE RADIO',
                'FD LOUNGE RADIO',
                'Lounge',
                'http://listen.radionomy.com/FD-LOUNGE-RADIO?icy=http',
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

        DB::delete('DELETE FROM radios WHERE id = ?', [1]);
        DB::delete('DELETE FROM genres WHERE id = ?', [1]);
    }


    /**
     * A test for one genres endpoint with radios
     *
     * @return void
     */
    public function testGetGenreRadiosShow()
    {
        $response = $this->call('GET', '/genres/1');

        $this->assertResponseOk();

        $data = json_decode($response->getContent());

        $this->assertEquals(23683, $data->radios[0]->sh_id);
        $this->assertEquals('FD LOUNGE RADIO', $data->radios[0]->name);
        $this->assertEquals('FD LOUNGE RADIO', $data->radios[0]->sh_name);
        $this->assertEquals('Lounge', $data->radios[0]->genre);
        $this->assertEquals('http://listen.radionomy.com/FD-LOUNGE-RADIO?icy=http', $data->radios[0]->stream_url);


    }


}
