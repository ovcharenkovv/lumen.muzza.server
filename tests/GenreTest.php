<?php

class GenreTest extends TestCase {

    /**
     * A test for genres endpoint
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->call('GET', '/genres');

        $this->assertResponseOk();

        $data = json_decode($response->getContent(),true);

        $this->assertArrayHasKey('sh_id', $data[0]);
        $this->assertArrayHasKey('name', $data[0]);
        $this->assertArrayHasKey('sh_name', $data[0]);
        $this->assertArrayHasKey('radios_amount', $data[0]);
        $this->assertArrayHasKey('bg', $data[0]);

        $this->assertArrayNotHasKey('undefined', $data[0]);

        $this->assertEquals(777, $data[0]['sh_id']);
        $this->assertEquals('Jazz', $data[0]['name']);
        $this->assertEquals('Jazz Sh', $data[0]['sh_name']);
        $this->assertEquals(50, $data[0]['radios_amount']);
        $this->assertEquals('/img/jazz.jpg', $data[0]['bg']);

        $this->assertNotEquals('undefined', $data[0]['name']);



    }

}
