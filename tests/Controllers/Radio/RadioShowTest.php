<?php

class RadioShowTest extends TestCase
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
            [100, 800, 'Acoustic Blues', 'Acoustic Blues', 10, '/img/Acoustic-Blues.jpg']
        );


        DB::insert(
            'INSERT INTO radios
            (id, sh_id, name, sh_name, genre, stream_url, genre_id) VALUES (?, ?, ?, ?, ?, ?, ?)',
            [
                200,
                23683,
                'A Better Classic Blues Vintage Station',
                'A Better Classic Blues Vintage Station',
                'Acoustic Blues',
                'http://listen.radionomy.com/A-Better-Classic-Blues-Vintage-Station?icy=http',
                100
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

        DB::delete('DELETE FROM radios WHERE id = ?', [200]);

        DB::delete('DELETE FROM genres WHERE id = ?', [100]);
    }


    /**
     * A test for one radio endpoint
     *
     * @return void
     */
    public function testGetRadiosShow()
    {
        $response = $this->call('GET', '/radios/200');

        $this->assertResponseOk();

        $data = json_decode($response->getContent());

        $this->assertEquals(23683, $data->sh_id);
        $this->assertEquals('A Better Classic Blues Vintage Station', $data->name);
        $this->assertEquals('A Better Classic Blues Vintage Station', $data->sh_name);
        $this->assertEquals('Acoustic Blues', $data->genre);
        $this->assertEquals('http://listen.radionomy.com/A-Better-Classic-Blues-Vintage-Station?icy=http', $data->stream_url);

        $this->assertNotEquals('undefined', $data->name);


    }

}
