<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Repositories\RadioTrackRepository as RadioTrackRepo;
use App\Services\RadioTrackManager;

/**
 * Class RadioController
 * @package App\Http\Controllers
 */
class RadioController extends Controller {

    private $radioTrackRepo;

    private $radioTrackManager;

    public function __construct(RadioTrackRepo $radioTrackRepo, RadioTrackManager $radioTrackManager) {

        $this->radioTrackRepo = $radioTrackRepo;
        $this->radioTrackManager = $radioTrackManager;
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
        $this->radioTrackManager->refreshTracks($id, 914897);

        $tracks = $this->radioTrackRepo->getRadioTracks($id);

        return response()->json(
            $tracks
        );
    }

}