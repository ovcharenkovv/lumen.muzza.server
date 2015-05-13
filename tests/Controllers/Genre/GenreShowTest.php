<?php

class GenreShowTest extends TestCase
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
            [100, 777, 'Jazz', 'Jazz', 50, '/img/jazz.jpg']
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

        DB::delete('DELETE FROM genres WHERE id = ?', [100]);
    }


    /**
     * A test for one genres endpoint
     *
     * @return void
     */
    public function testGetGenresShow()
    {
        $response = $this->call('GET', '/genres/1');

        $this->assertResponseOk();

        $data = json_decode($response->getContent());

        $this->assertEquals(777, $data->sh_id);
        $this->assertEquals('Jazz', $data->name);
        $this->assertEquals('Jazz', $data->sh_name);
        $this->assertEquals(50, $data->radios_amount);
        $this->assertEquals('/img/jazz.jpg', $data->bg);

        $this->assertNotEquals('undefined', $data->name);
    }

}
