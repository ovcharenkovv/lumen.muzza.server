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

        $currentRadioTrackObj = $this->client->getCachedStationObject(
            $this->radioRepo->getRadioShId($radioId)
        );

        if (empty($lastRadioTrackObj) && $this->isCurrentRadioTrackObjValid($currentRadioTrackObj)) {
            $this->saveRadioTrack($currentRadioTrackObj->CurrentTrack, $radioId);
        }


        if ($this->isLastRadioTrackObjValid($lastRadioTrackObj) &&
            $this->isCurrentRadioTrackObjValid($currentRadioTrackObj) &&
            $this->isTrackObjTitlesNotSame($lastRadioTrackObj, $currentRadioTrackObj)
        )
        {
            $this->saveRadioTrack($currentRadioTrackObj->CurrentTrack, $radioId);
        }

    }


    /**
     * @param $lastRadioTrack
     * @return bool
     */
    public function isLastRadioTrackObjValid($lastRadioTrack) {
        return
            isset($lastRadioTrack->title) &&
            !empty($lastRadioTrack->title)
        ;
    }

    /**
     * @param $currentRadioTrackObj
     * @return bool
     */
    public function isCurrentRadioTrackObjValid($currentRadioTrackObj) {
        return
            isset($currentRadioTrackObj->CurrentTrack) &&
            !empty($currentRadioTrackObj->CurrentTrack)&&
            strpos($currentRadioTrackObj->CurrentTrack, '-')
        ;
    }
    public function isTrackObjTitlesNotSame($lastRadioTrackObj,$currentRadioTrackObj) {
        return $lastRadioTrackObj->title != $currentRadioTrackObj->CurrentTrack;
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