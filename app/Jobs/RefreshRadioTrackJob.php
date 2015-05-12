<?php namespace App\Jobs;

use App\Services\RadioTrackManager;

class RefreshRadioTrackJob extends Job
{
    protected $radioId;


    function __construct($radioId)
    {
        $this->radioId = $radioId;
    }

    public function handle(RadioTrackManager $radioTrackManager)
    {
        $radioTrackManager->refreshTracks($this->radioId);
        $this->delete();
    }

}