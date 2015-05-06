<?php

use App\Services\Shoutcast\ShoutcastClient;
use GuzzleHttp\Client;

class ShoutcastClientTest extends TestCase
{
    public function testGetStationObject()
    {
        $client = new ShoutcastClient(
            new Client()
        );

        $station = $client->getStationObject(914897);

        $this->assertEquals("New. Music. Unfiltered. idobi.com", $station->Name);
        $this->assertNotEmpty($station->CurrentTrack);

    }

}