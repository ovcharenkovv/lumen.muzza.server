<?php namespace App\Repositories;

use Illuminate\Support\Facades\DB;

/**
 * Class RadioRepository
 * @package App\Repositories
 */
class RadioRepository
{
    /**
     * @return mixed
     */
    public function getAll()
    {
        return DB::select('select * from radios');
    }

    /**
     * @param $radioId
     * @return mixed
     */
    public function getRadioShId($radioId)
    {
        $radio = $this->get($radioId);
        return $radio->sh_id;
    }

    /**
     * @param $radioId
     * @return mixed
     */
    public function get($radioId)
    {
        return DB::selectOne('select * from radios where id = ?', [$radioId]);
    }

    /**
     * @param $genreId
     * @return mixed
     */
    public function getByGenreId($genreId)
    {
        return DB::select('select * from radios where genre_id = ? order by name asc',[$genreId]);
    }

}
