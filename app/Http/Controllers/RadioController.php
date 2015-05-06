<?php namespace App\Http\Controllers;

use App\Services\Shoutcast\TrackParser as ShTrackParser;
use Illuminate\Support\Facades\DB;

/**
 * Class RadioController
 * @package App\Http\Controllers
 */
class RadioController extends Controller {

    /**
     * The shoutcast track parser instance.
     */
    protected $shTrackParser;

    /**
     * Create a new controller instance.
     *
     * @param ShTrackParser $shTrackParser
     */
    public function __construct(ShTrackParser $shTrackParser)
    {
        $this->shTrackParser = $shTrackParser;
    }

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
//        var_dump(
//            $this->shTrackParser->get(1)
//        );

        $tracks = DB::select('select * from radio_tracks where radio_id = ?',[$id]);

        return response()->json(
            $tracks
        );
    }

}