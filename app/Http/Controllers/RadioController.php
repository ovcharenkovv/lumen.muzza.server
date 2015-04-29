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

}