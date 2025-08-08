<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CameraController extends Controller
{
    public function index($index)
    {


        return view('screens.candidate.camera.index', get_defined_vars());
    }

    public function ocr($index, Request $request) {
       dd($index, $request->all());
    }
}
