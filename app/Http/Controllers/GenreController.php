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
        return response()->json(
            DB::selectOne('select * from genres where id = ?',[$id])
        );
    }

}