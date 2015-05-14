<?php

class RadioIndexTest extends TestCase
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
     * A test for radio array endpoint
     *
     * @return void
     */
    public function testGetRadiosIndex()
    {
        $response = $this->call('GET', '/radios');

        $this->assertResponseOk();

        $data = json_decode($response->getContent());


        $this->assertEquals(606342, $data[0]->sh_id);
        $this->assertEquals('Alt Rock 101', $data[0]->name);
        $this->assertEquals('Alt Rock 101', $data[0]->sh_name);
        $this->assertEquals('Punk', $data[0]->genre);
        $this->assertEquals('http://streaming.radionomy.com/AltRock101', $data[0]->stream_url);

        $this->assertNotEquals('undefined', $data[0]->name);

    }

}
