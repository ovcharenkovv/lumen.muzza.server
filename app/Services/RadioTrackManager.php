<?php namespace App\Services;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Services\Shoutcast\ShoutcastClient as Client;
use App\Repositories\RadioTrackRepository as RadioTrackRepo;
use App\Repositories\RadioRepository as RadioRepo;



class RadioTrackManager
{

    protected $client;

    protected $radioTrackRepo;


    public function __construct(Client $client, RadioTrackRepo $radioTrackRepo, RadioRepo $radioRepo)
    {
        $this->client = $client;
        $this->radioTrackRepo = $radioTrackRepo;
        $this->radioRepo = $radioRepo;
    }


    public function refreshTracks($radioId)
    {
        $radio = $this->radioRepo->get($radioId);

        if(!$radio) {
            return;
        }

        $radioTracks = $this->radioTrackRepo->getRadioTracks($radioId);

        $lastRadioTrack = array_shift($radioTracks);

        if (!$lastRadioTrack || !$lastRadioTrack->created_at) {
            return;
        }

        $lastTrackCreateAt = Carbon::createFromFormat('Y-n-j G:i:s', $lastRadioTrack->created_at);

        if (Carbon::now()->diffInSeconds( $lastTrackCreateAt) <= 60) {
            return;
        }

        $currentRadioTrack = $this->client->getStationObject($radio->sh_id);

        if (!$currentRadioTrack->CurrentTrack || $lastRadioTrack->title == $currentRadioTrack->CurrentTrack ) {
            return;
        }

        $this->saveRadioTrack($currentRadioTrack->CurrentTrack, $radioId);

    }


    public function saveRadioTrack($title, $radioId) {

        if (empty($title)) {
            return;
        }

        $currentTrack = explode(" - ", $title);

        if (count($currentTrack) < 2 || empty($currentTrack[0]) && empty($currentTrack[1])) {
            return;
        }

        array_push($currentTrack, $radioId);

        return DB::insert(
            'insert into radio_tracks (artist_name, track_name, radio_id) values (?, ?, ?)', $currentTrack
        );
    }

}