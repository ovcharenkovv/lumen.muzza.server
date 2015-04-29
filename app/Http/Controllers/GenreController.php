<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GenreController extends Controller {

    public function index()
    {
        return response()->json(
            DB::select('select * from genres order by name asc')
        );
    }

    public function show($id)
    {
        $radios = DB::select('select * from radios where genre_id = ? order by name asc',[$id]);

        $genre = DB::selectOne('select * from genres where id = ?',[$id]);
        $genre->radios = $radios;

        return response()->json(
            $genre
        );
    }

}