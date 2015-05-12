<?php namespace App\Repositories;

use Illuminate\Support\Facades\DB;

/**
 * Class GenreRepository
 * @package App\Repositories
 */
class GenreRepository
{
    /**
     * @return mixed
     */
    public function getAll()
    {
        return DB::select('select * from genres order by name asc');
    }

    /**
     * @param $genreId
     * @return mixed
     */
    public function get($genreId)
    {
        return DB::selectOne('select * from genres where id = ?',[$genreId]);
    }


}
