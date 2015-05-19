<?php namespace App\Services;

use App\Repositories\RadioRepository as RadioRepo;
use App\Repositories\RadioTrackRepository as RadioTrackRepo;
use App\Services\Shoutcast\ShoutcastClient as Client;
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
     * @var RadioRepo
     */
    protected $radioRepo;

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
     */
    public function refreshTracks($radioId)
    {
        $currentRadioTrack = $this->client->getCurrentRadioTrack(
            $this->radioRepo->getRadioShId($radioId)
        );

        if ($this->isTrackValid($currentRadioTrack)) {

            $lastRadioTrack = $this->radioTrackRepo->getLastRadioTrackTitle($radioId);

            if ($currentRadioTrack != $lastRadioTrack) {
                return $this->saveRadioTrack($currentRadioTrack, $radioId);
            }
        }

        return false;

    }

    /**
     * @param $title
     * @return bool
     */
    protected function isTrackValid($title)
    {
        return trim($title) && strpos($title, '-');
    }

    /**
     * @param $title
     * @param $radioId
     */
    public function saveRadioTrack($title, $radioId)
    {

        $currentTrack = explode(" - ", $title);

        array_push($currentTrack, $radioId);

        return DB::insert(
            'insert into radio_tracks (artist_name, track_name, radio_id) values (?, ?, ?)', $currentTrack
        );
    }

}