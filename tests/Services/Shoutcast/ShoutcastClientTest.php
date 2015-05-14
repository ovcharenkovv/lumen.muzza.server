<?php

use App\Services\Shoutcast\ShoutcastClient;
use GuzzleHttp\Client;

class ShoutcastClientTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testGetStationObject()
    {
        $client = new ShoutcastClient(
            new Client()
        );

        $station = $client->getStationObject(914897);

        $this->assertEquals("New. Music. Unfiltered. idobi.com", $station->Name);
        $this->assertObjectHasAttribute('CurrentTrack', $station);

    }

    /**
     * @throws Exception
     */
    public function testException()
    {
        $test = function() {

            $client = new ShoutcastClient(
                new Client()
            );

            $client->getStationObject(0);

        };

        $this->assertException( $test, 'Exception', 0, 'Station not found' );

    }

}