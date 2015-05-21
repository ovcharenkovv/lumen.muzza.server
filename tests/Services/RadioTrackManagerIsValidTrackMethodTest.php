<?php

use App\Services\RadioTrackManager;

class RadioTrackManagerIsValidTrackMethodTest extends TestCase
{

    protected $trackManager;

    protected $trackManagerMethod;


    public function setUp()
    {
        parent::setUp();

        $clientMock = $this->getMock('App\Services\Shoutcast\ShoutcastClient', [], [], '', false);
        $radioTrackRepoMock = $this->getMock('App\Repositories\RadioTrackRepository');
        $radioRepoMock = $this->getMock('App\Repositories\RadioRepository');

        $this->trackManager = new RadioTrackManager(
            $clientMock,
            $radioTrackRepoMock,
            $radioRepoMock
        );

        $this->trackManagerMethod = $this->getMethod('App\Services\RadioTrackManager', 'isTrackValid');

    }


    /**
     * Test for track validation
     */
    public function testIsTrackValid()
    {

        $this->assertTrue(
            $this->trackManagerMethod->invoke($this->trackManager, "Track Name - Artist")
        );
        $this->assertTrue(
            $this->trackManagerMethod->invoke($this->trackManager, "One - Two - Tree")
        );


        $this->assertFalse(
            $this->trackManagerMethod->invoke($this->trackManager, "Test Test")
        );
        $this->assertFalse(
            $this->trackManagerMethod->invoke($this->trackManager, null)
        );
        $this->assertFalse(
            $this->trackManagerMethod->invoke($this->trackManager, "")
        );
        $this->assertFalse(
            $this->trackManagerMethod->invoke($this->trackManager, " ")
        );
        $this->assertFalse(
            $this->trackManagerMethod->invoke($this->trackManager, "  \n\t")
        );

    }


}