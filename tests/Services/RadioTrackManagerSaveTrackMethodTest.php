<?php

use App\Repositories\RadioTrackRepository as RadioTrackRepo;
use App\Services\RadioTrackManager;

class RadioTrackManagerSaveTrackMethodTest extends TestCase
{


    /**
     * Track add to db
     */
    public function testSaveRadioTrackSuccess()
    {
        $radioTrackTitle = "Artist - TrackName";
        $genreId = $this->generateRandomId();
        $radioId = $this->generateRandomId();

        DB::insert('INSERT INTO genres (id) VALUES (?)', [$genreId]);
        DB::insert('INSERT INTO radios (id, genre_id) VALUES (?, ?)', [$radioId, $genreId]);

        $clientMock = $this->getMock('App\Services\Shoutcast\ShoutcastClient', [], [], '', false);
        $radioTrackRepoMock = $this->getMock('App\Repositories\RadioTrackRepository');
        $radioRepoMock = $this->getMock('App\Repositories\RadioRepository');

        $trackManager = new RadioTrackManager(
            $clientMock,
            $radioTrackRepoMock,
            $radioRepoMock
        );


        $this->assertTrue($trackManager->saveRadioTrack($radioTrackTitle, $radioId));

        $radioTrackRepo = new RadioTrackRepo();
        $track = $radioTrackRepo->getLastRadioTrack($radioId);

        $this->assertEquals($radioTrackTitle, $track->title);

        DB::delete('DELETE FROM radio_tracks WHERE id = ?', [$track->id]);
        DB::delete('DELETE FROM radios WHERE id = ?', [$radioId]);
        DB::delete('DELETE FROM genres WHERE id = ?', [$genreId]);
    }

    /**
     * Track is not valid and should not add to bd
     */
    public function testSaveRadioTrackFailed()
    {
        $radioTrackTitles = ["", "  ", "String String"];
        $genreId = $this->generateRandomId();
        $radioId = $this->generateRandomId();

        DB::insert('INSERT INTO genres (id) VALUES (?)', [$genreId]);
        DB::insert('INSERT INTO radios (id, genre_id) VALUES (?, ?)', [$radioId, $genreId]);

        $clientMock = $this->getMock('App\Services\Shoutcast\ShoutcastClient', [], [], '', false);
        $radioTrackRepoMock = $this->getMock('App\Repositories\RadioTrackRepository');
        $radioRepoMock = $this->getMock('App\Repositories\RadioRepository');

        $trackManager = new RadioTrackManager(
            $clientMock,
            $radioTrackRepoMock,
            $radioRepoMock
        );

        foreach ($radioTrackTitles as $title) {
            $this->assertFalse($trackManager->saveRadioTrack($title, $radioId));
        }

        DB::delete('DELETE FROM radios WHERE id = ?', [$radioId]);
        DB::delete('DELETE FROM genres WHERE id = ?', [$genreId]);
    }




}