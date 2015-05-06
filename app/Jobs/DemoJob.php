<?php namespace App\Jobs;

class DemoJob extends Job
{

    public function handle()
    {
        $this->delete();
    }

}