<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;
use App\Jobs\RefreshRadioTrackJob;

use App\Repositories\RadioRepository as RadioRepo;
use App\Repositories\RadioTrackRepository as RadioTrackRepo;

/**
 * Class RadioController
 * @package App\Http\Controllers
 */
class RadioController extends Controller {

    /**
     * @var RadioRepo
     */
    private $radioRepo;
    /**
     * @var RadioTrackRepo
     */
    private $radioTrackRepo;

    /**
     * @param RadioRepo $radioRepo
     * @param RadioTrackRepo $radioTrackRepo
     */
    public function __construct( RadioRepo $radioRepo, RadioTrackRepo $radioTrackRepo) {
        $this->radioRepo = $radioRepo;
        $this->radioTrackRepo = $radioTrackRepo;
    }

    /**
     * Return all radios
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return response()->json(
            $this->radioRepo->getAll()
        );
    }

    /**
     * Return radios data by id
     *
     * @param int $radioId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($radioId)
    {
        return response()->json(
            $this->radioRepo->get($radioId)
        );
    }

    /**
     * Return radio tracks by id
     *
     * @param int $radioId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexTracks($radioId)
    {
        Queue::push(new RefreshRadioTrackJob($radioId));

        return response()->json(
            $this->radioTrackRepo->getByRadioId($radioId)
        );
    }

}