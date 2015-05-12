<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Repositories\GenreRepository as GenreRepo;
use App\Repositories\RadioRepository as RadioRepo;


/**
 * Class GenreController
 * @package App\Http\Controllers
 */
class GenreController extends Controller {

    /**
     * @var GenreRepo
     */
    private $genreRepo;

    /**
     * @param GenreRepo $genreRepo
     * @param RadioRepo $radioRepo
     */
    public function __construct(GenreRepo $genreRepo, RadioRepo $radioRepo ) {
        $this->genreRepo = $genreRepo;
        $this->radioRepo = $radioRepo;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return response()->json(
            $this->genreRepo->getAll()
        );
    }

    /**
     * @param $genreId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($genreId)
    {
        $genre = $this->genreRepo->get($genreId);

        $genre->radios = $this->radioRepo->getByGenreId($genreId);

        return response()->json(
            $genre
        );
    }

}