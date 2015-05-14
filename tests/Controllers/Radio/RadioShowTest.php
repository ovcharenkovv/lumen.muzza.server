<?php

class RadioShowTest extends TestCase
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
            [$this->genreId, 800, 'Acoustic Blues', 'Acoustic Blues', 10, '/img/Acoustic-Blues.jpg']
        );


        DB::insert(
            'INSERT INTO radios
            (id, sh_id, name, sh_name, genre, stream_url, genre_id) VALUES (?, ?, ?, ?, ?, ?, ?)',
            [
                $this->radioId,
                23683,
                'A Better Classic Blues Vintage Station',
                'A Better Classic Blues Vintage Station',
                'Acoustic Blues',
                'http://listen.radionomy.com/A-Better-Classic-Blues-Vintage-Station?icy=http',
                $this->genreId
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
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();

        DB::delete('DELETE FROM radios WHERE id = ?', [$this->radioId]);

        DB::delete('DELETE FROM genres WHERE id = ?', [$this->genreId]);
    }


    /**
     * A test for one radio endpoint
     *
     * @return void
     */
    public function testGetRadiosShow()
    {
        $response = $this->call('GET', "/radios/$this->radioId");

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
