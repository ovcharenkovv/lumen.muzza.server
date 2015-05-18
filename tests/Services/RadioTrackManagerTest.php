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

        $this->assertTrue($trackManager->isTrackValid("Test - Test"));
        $this->assertTrue($trackManager->isTrackValid("One - Two - Tree"));


        $this->assertFalse($trackManager->isTrackValid("Test Test"));
        $this->assertFalse($trackManager->isTrackValid(null));
        $this->assertFalse($trackManager->isTrackValid(""));
        $this->assertFalse($trackManager->isTrackValid("     "));

    }


}