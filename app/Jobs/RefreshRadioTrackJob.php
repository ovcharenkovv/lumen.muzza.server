<?php namespace App\Jobs;

use App\Services\RadioTrackManager;

/**
 * Class RefreshRadioTrackJob
 * @package App\Jobs
 */
class RefreshRadioTrackJob extends Job
{
    /**
     * @var
     */
    protected $radioId;


    /**
     * @param $radioId
     */
    function __construct($radioId)
    {
        $this->radioId = $radioId;
    }

    /**
     * @param RadioTrackManager $radioTrackManager
     */
    public function handle(RadioTrackManager $radioTrackManager)
    {
        $radioTrackManager->refreshTracks($this->radioId);
        $this->delete();
    }

}