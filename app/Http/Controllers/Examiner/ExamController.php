<?php

namespace App\Http\Controllers\Examiner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        return view('screens.examiner.exams.index');
    }
    public function create()
    {
        return view('screens.examiner.exams.create');
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
