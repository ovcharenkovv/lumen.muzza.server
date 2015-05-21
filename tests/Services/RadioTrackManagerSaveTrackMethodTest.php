<?php

use App\Repositories\RadioTrackRepository as RadioTrackRepo;
use App\Services\RadioTrackManager;

class RadioTrackManagerSaveTrackMethodTest extends TestCase
{
    protected $trackManager;

    protected $genreId, $radioId;

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


        $this->genreId = $this->generateRandomId();
        $this->radioId = $this->generateRandomId();

        DB::insert('INSERT INTO genres (id) VALUES (?)', [$this->genreId]);
        DB::insert('INSERT INTO radios (id, genre_id) VALUES (?, ?)', [$this->radioId, $this->genreId]);


    }

    public function tearDown()
    {
        parent::tearDown();

        DB::delete('DELETE FROM radios WHERE id = ?', [$this->radioId]);
        DB::delete('DELETE FROM genres WHERE id = ?', [$this->genreId]);
    }




    /**
     * Track add to db
     */
    public function testSaveRadioTrackSuccess()
    {
        $radioTrackTitle = "Artist - TrackName";

        $this->assertTrue($this->trackManager->saveRadioTrack($radioTrackTitle, $this->radioId));

        $radioTrackRepo = new RadioTrackRepo();
        $track = $radioTrackRepo->getLastRadioTrack($this->radioId);

        $this->assertEquals($radioTrackTitle, $track->title);

        DB::delete('DELETE FROM radio_tracks WHERE id = ?', [$track->id]);
    }

    /**
     * Track is not valid and should not add to bd
     */
    public function testSaveRadioTrackFailed()
    {
        $radioTrackTitles = ["", "  ", "String String"];

        foreach ($radioTrackTitles as $title) {
            $this->assertFalse($this->trackManager->saveRadioTrack($title, $this->radioId));
        }

    }




}