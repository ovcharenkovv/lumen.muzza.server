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
     */
    public function refreshTracks($radioId)
    {
        $lastRadioTrackObj = $this->radioTrackRepo->getLastRadioTrack($radioId);

        if ($this->isTrackCreatedMoreThen($lastRadioTrackObj, 60)) {

            $currentRadioTrackObj = $this->client->getCachedStationObject(
                $this->radioRepo->getRadioShId($radioId)
            );

            if ($this->validBothTracks($currentRadioTrackObj, $lastRadioTrackObj)) {
                $this->saveRadioTrack($currentRadioTrackObj->CurrentTrack, $radioId);
            }
        }

    }

    /**
     * @param $lastRadioTrack
     * @param int $seconds
     * @return bool
     */
    public function isTrackCreatedMoreThen($lastRadioTrack, $seconds = 60)
    {

        if (!$lastRadioTrack) {
            return true;
        }

        $lastTrackCreateAt = Carbon::createFromFormat('Y-n-j G:i:s', $lastRadioTrack->created_at);

        if (Carbon::now()->diffInSeconds($lastTrackCreateAt) > $seconds) {
            return true;
        }

        return false;
    }

    /**
     * @param $currentRadioTrackObj
     * @param $lastRadioTrackObj
     * @return bool
     */
    public function validBothTracks($currentRadioTrackObj, $lastRadioTrackObj)
    {

        if (!$currentRadioTrackObj->CurrentTrack) {
            return false;
        }

        if (!strpos($currentRadioTrackObj->CurrentTrack, '-')) {
            return false;
        }

        if ($lastRadioTrackObj && $lastRadioTrackObj->title == $currentRadioTrackObj->CurrentTrack) {
            return false;
        }

        return true;
    }


    /**
     * @param $title
     * @param $radioId
     */
    public function saveRadioTrack($title, $radioId) {

        $currentTrack = explode(" - ", $title);

        array_push($currentTrack, $radioId);

        return DB::insert(
            'insert into radio_tracks (artist_name, track_name, radio_id) values (?, ?, ?)', $currentTrack
        );
    }

}