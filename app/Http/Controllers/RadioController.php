<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Repositories\RadioTrackRepository as RadioTrack;

/**
 * Class RadioController
 * @package App\Http\Controllers
 */
class RadioController extends Controller {

    private $tracks;

    public function __construct(RadioTrack $tracks) {

        $this->tracks = $tracks;
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
        $tracks = $this->tracks->getRadioTracks($id);

        return response()->json(
            $tracks
        );
    }

}