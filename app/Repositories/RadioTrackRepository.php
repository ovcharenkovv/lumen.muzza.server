<?php namespace App\Repositories;

use Illuminate\Support\Facades\DB;

/**
 * Class RadioTrackRepository
 * @package App\Repositories
 */
class RadioTrackRepository
{
    /**
     * @param $radioId
     * @return mixed
     */
    public function getLastRadioTrackTitle($radioId)
    {
        $radioTrack = $this->getLastRadioTrack($radioId);
        return $radioTrack->title;
    }

    /**
     * @param $radioId
     * @return mixed
     */
    public function getLastRadioTrack($radioId)
    {
        $radioTracks = $this->getByRadioId($radioId);
        return array_shift($radioTracks);
    }

    /**
     * @param $radioId
     * @param int $limit
     * @return mixed
     */
    public function getByRadioId($radioId, $limit = 10)
    {
        return DB::select("
            select *, CONCAT_WS(' - ', artist_name, track_name) as title
            from radio_tracks
            where radio_id = ?
            order by created_at
            desc limit ?
            ", [$radioId, $limit]
        );
    }



}
