<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\FileReader;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MapController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAddresses()
    {
        //Read File
        $fileReader = new FileReader(storage_path('jsonformatter.txt'));

        //Return json data
        return response()->json([
            'data' => $fileReader->getLocationsMap()
        ]);

    }
}
