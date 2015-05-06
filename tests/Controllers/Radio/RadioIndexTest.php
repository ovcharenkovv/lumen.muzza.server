<?php

class RadioIndexTest extends TestCase
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
