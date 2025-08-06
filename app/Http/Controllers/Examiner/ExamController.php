<?php

namespace App\Http\Controllers\Examiner;

use App\Http\Controllers\Controller;
use App\Models\ExamHall;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        return view('screens.examiner.exams.index',get_defined_vars());
    }
    public function create()
    {

        $halls = auth()->user()->exam_halls()->get();

        return view('screens.examiner.exams.create',get_defined_vars());
    }
    public function store(Request $request)
    {
        dd($request->all());

        return redirect()->route('examiner.exams.index');
    }

    public function edit($id)
    {
        return view('screens.examiner.exams.create');
    }
    public function update($id)
    {
        return redirect()->route('examiner.exams.index');
    }
}
