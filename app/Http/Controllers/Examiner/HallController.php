<?php

namespace App\Http\Controllers\Examiner;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHallRequest;
use App\Models\ExamHall;
use Illuminate\Http\Request;

class HallController extends Controller
{
    public function index()
    {
        return view('screens.examiner.halls.index');
    }
    public function create()
    {
        return view('screens.examiner.halls.create');
    }
    public function store(StoreHallRequest $request)
    {

        $hallCode = Str::random(8);

        auth()->user()->exam_halls()->create([
            'title' => $request->title,
                'hall_code' => $hallCode
        ]);



        return back()->with('message', 'Hall added Successfully.');
    }
    public function edit()
    {
        return view('screens.examiner.halls.edit');
    }
    public function update()
    {
        return back();
    }
}
