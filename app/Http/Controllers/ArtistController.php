<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ArtistService;

class ArtistController extends Controller
{
    /**
     * Display artist list in json mode.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJson()
    {
         return ArtistService::getList()->toJson();
    }
}