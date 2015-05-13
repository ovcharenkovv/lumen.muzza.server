<?php namespace App\Services;

use App\Repositories\RadioRepository as RadioRepo;
use App\Repositories\RadioTrackRepository as RadioTrackRepo;
use App\Services\Shoutcast\ShoutcastClient as Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


/**
 * Class RadioTrackManager
 * @package App\Services
 */
class RadioTrackManager
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var RadioTrackRepo
     */
    protected $radioTrackRepo;


    /**
     * @param Client $client
     * @param RadioTrackRepo $radioTrackRepo
     * @param RadioRepo $radioRepo
     */
    public function __construct(Client $client, RadioTrackRepo $radioTrackRepo, RadioRepo $radioRepo)
    {
        $this->client = $client;
        $this->radioTrackRepo = $radioTrackRepo;
        $this->radioRepo = $radioRepo;
    }


    /**
     * @param $radioId
     * @return bool
     * @throws \Exception
     */
    public function refreshTracks($radioId)
    {
        $radio = $this->radioRepo->get($radioId);
        $currentRadioTrack = $this->client->getStationObject($radio->sh_id);

        $lastRadioTrack = $this->radioTrackRepo->getLastRadioTrack($radioId);

        if ($lastRadioTrack) {

            $lastTrackCreateAt = Carbon::createFromFormat('Y-n-j G:i:s', $lastRadioTrack->created_at);

            if (Carbon::now()->diffInSeconds( $lastTrackCreateAt) <= 60) {
                return true;
            }

            if (!$currentRadioTrack->CurrentTrack || $lastRadioTrack->title == $currentRadioTrack->CurrentTrack ) {
                return true;
            }
        }





        $this->saveRadioTrack($currentRadioTrack->CurrentTrack, $radioId);

        return true;

    }


    /**
     * @param $title
     * @param $radioId
     */
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