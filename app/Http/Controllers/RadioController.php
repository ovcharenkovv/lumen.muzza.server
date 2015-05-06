<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

/**
 * Class RadioController
 * @package App\Http\Controllers
 */
class RadioController extends Controller {

    /**
     * Return all radios
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return response()->json(
            DB::select('select * from radios')
        );
    }

    /**
     * Return radios data by id
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($id)
    {
        return response()->json(
            DB::selectOne('select * from radios where id = ?',[$id])
        );
    }

    /**
     * Return radio tracks by id
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexTracks($id)
    {
        $tracks = DB::select('select * from radio_tracks where radio_id = ?',[$id]);

        return response()->json(
            $tracks
        );
    }

}