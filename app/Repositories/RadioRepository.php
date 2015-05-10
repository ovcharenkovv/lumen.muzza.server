<?php namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class RadioRepository
{
    public function get($radioId)
    {
        return DB::selectOne('select * from radios where id = ?',[$radioId]);
    }
}
