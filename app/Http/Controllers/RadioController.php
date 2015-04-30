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

    public function indexTracks($id)
    {
        $tracks = DB::select('select * from radio_tracks where radio_id = ?',[$id]);

        return response()->json(
            $tracks
        );
    }


}