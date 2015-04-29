<?php

class RadioTest extends TestCase {

    /**
     * A test for radio endpoint
     *
     * @return void
     */
    public function testGetRadiosIndex()
    {
        $response = $this->call('GET', '/radios');

        $this->assertResponseOk();

        $data = json_decode($response->getContent(),true);

        $this->assertArrayHasKey('sh_id', $data[0]);
        $this->assertArrayHasKey('name', $data[0]);
        $this->assertArrayHasKey('sh_name', $data[0]);
        $this->assertArrayHasKey('genre', $data[0]);
        $this->assertArrayHasKey('stream_url', $data[0]);

        $this->assertArrayNotHasKey('undefined', $data[0]);

        $this->assertEquals(606342, $data[0]['sh_id']);
        $this->assertEquals('Alt Rock 101', $data[0]['name']);
        $this->assertEquals('Alt Rock 101', $data[0]['sh_name']);
        $this->assertEquals('Punk', $data[0]['genre']);
        $this->assertEquals('http://streaming.radionomy.com/AltRock101', $data[0]['stream_url']);

        $this->assertNotEquals('undefined', $data[0]['name']);


    }

}
