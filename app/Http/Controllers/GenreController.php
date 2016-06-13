<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GenreController extends Controller {

    public function index()
    {
        dd('exit');
        return response()->json(
            DB::select('select * from genres order by name asc')
        );
    }

    public function show($id)
    {
        $genre = DB::selectOne('select * from genres where id = ?',[$id]);

        if ($genre) {
            $genre->radios = DB::select('select * from radios where genre_id = ? order by name asc',[$id]);
        }


        return response()->json(
            $genre
        );
    }

}
