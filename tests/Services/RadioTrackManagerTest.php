<?php
//use App\Repositories\RadioRepository as RadioRepo;
//use App\Repositories\RadioTrackRepository as RadioTrackRepo;
//use App\Services\Shoutcast\ShoutcastClient as Client;

use App\Services\RadioTrackManager;

class RadioTrackManagerTest extends TestCase
{

    public function testIsTrackValid()
    {
        $clientMock = $this->getMock('App\Services\Shoutcast\ShoutcastClient',[],[],'',false);
        $radioTrackRepoMock = $this->getMock('App\Repositories\RadioTrackRepository');
        $radioRepoMock = $this->getMock('App\Repositories\RadioRepository');

        $trackManager = new RadioTrackManager($clientMock, $radioTrackRepoMock, $radioRepoMock);

        $method = $this->getMethod('App\Services\RadioTrackManager', 'isTrackValid');


        $this->assertTrue(
            $method->invoke($trackManager, "Track Name - Artist")
        );
        $this->assertTrue(
            $method->invoke($trackManager, "One - Two - Tree")
        );


        $this->assertFalse(
            $method->invoke($trackManager, "Test Test")
        );
        $this->assertFalse(
            $method->invoke($trackManager, null)
        );
        $this->assertFalse(
            $method->invoke($trackManager, "")
        );
        $this->assertFalse(
            $method->invoke($trackManager, " ")
        );
        $this->assertFalse(
            $method->invoke($trackManager, "  \n\t")
        );



    }


}