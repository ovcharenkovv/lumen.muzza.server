<?php namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class RadioTrackRepository
{
    public function getRadioTracks($radioId, $limit = 10)
    {
        return DB::select("select * from radio_tracks where radio_id = ? limit ?",[$radioId,$limit]);
    }
}
