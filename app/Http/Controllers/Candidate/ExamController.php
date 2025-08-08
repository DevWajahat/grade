<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index($id)
    {

        $exam = Exam::find($id);

        return view('screens.candidate.exam.index',get_defined_vars());
    }
}
