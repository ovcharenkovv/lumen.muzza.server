<?php

use Illuminate\Http\Request;

class GenreTest extends TestCase {

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

        $this->assertEquals(800, $data[0]->sh_id);
        $this->assertEquals('Chill', $data[0]->name);
        $this->assertEquals('Chill', $data[0]->sh_name);
        $this->assertEquals(10, $data[0]->radios_amount);
        $this->assertEquals('/img/chill.jpg', $data[0]->bg);

        $this->assertNotEquals('undefined', $data[0]->name);
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

    /**
     * A test for one genres endpoint with radios
     *
     * @return void
     */
    public function testGetGenreRadiosShow()
    {
        $response = $this->call('GET', '/genres/3');

        $this->assertResponseOk();

        $data = json_decode($response->getContent());

        $this->assertEquals(23683, $data->radios[0]->sh_id);
        $this->assertEquals('FD LOUNGE RADIO', $data->radios[0]->name);
        $this->assertEquals('FD LOUNGE RADIO', $data->radios[0]->sh_name);
        $this->assertEquals('Lounge', $data->radios[0]->genre);
        $this->assertEquals('http://listen.radionomy.com/FD-LOUNGE-RADIO?icy=http', $data->radios[0]->stream_url);


    }



}
