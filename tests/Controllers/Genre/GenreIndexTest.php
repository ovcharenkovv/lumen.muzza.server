<?php

class GenreIndexTest extends TestCase
{
    /**
     * @var
     */
    private $genreId;

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
            [$this->genreId, 800, 'Chill', 'Chill', 10, '/img/chill.jpg']
        );
    }

    /**
     *
     */
    public function generateIds()
    {
        $this->genreId = $this->generateRandomId();
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();

        DB::delete('DELETE FROM genres WHERE id = ?', [$this->genreId]);
    }


    /**
     * A test for genres array endpoint
     *
     * @return void
     */
    public function testGetGenresIndex()
    {
        $response = $this->call('GET', '/genres');

        $this->assertResponseOk();

        $data = json_decode($response->getContent());

        $this->assertEquals($this->genreId, $data[0]->id);
        $this->assertEquals(800, $data[0]->sh_id);
        $this->assertEquals('Chill', $data[0]->name);
        $this->assertEquals('Chill', $data[0]->sh_name);
        $this->assertEquals(10, $data[0]->radios_amount);
        $this->assertEquals('/img/chill.jpg', $data[0]->bg);

        $this->assertNotEquals('undefined', $data[0]->name);
    }

}
