<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RadioController extends Controller {

    public function index()
    {
        return response()->json(
            DB::select('select * from radios')
        );
    }

    public function show($id)
    {
        return response()->json(
            DB::selectOne('select * from radios where id = ?',[$id])
        );
    }

}