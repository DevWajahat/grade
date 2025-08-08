<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Requests\JoinHallRequest;
use App\Models\ExamHall;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $examHalls = auth()->user()->examination_halls()->get();

        return view("screens.candidate.dashboard.index", get_defined_vars());
    }

    public function join_hall(JoinHallRequest $request)
    {

        $hall = ExamHall::where('hall_code', $request->code)->first();
        // dd($hall);

        if ($hall == null) {
            return response()->json([
                'status' => false,
                'message' => 'enter correct Hall Code',
            ], 400);
        }

        auth()->user()->examination_halls()->attach($hall->id);

        return response()->json([
            'status' => true,
            'message' => 'You\'ve been joined to this hall successfully. ',
            'hall_title' => $hall->title,
            'hall_examiner_name' => $hall->user->first_name . ' ' . $hall->user->last_name
        ], 200);
    }
    public function examination($code)
    {
        $examHall = ExamHall::where('hall_code', $code)->first();

        $exams = $examHall->exams()->where('status', 'public')->withCount('questions')->get();

        return view('screens.candidate.dashboard.examination',get_defined_vars());
    }
    public function results($code)
    {

         $examHall = ExamHall::where('hall_code', $code)->first();

        return view('screens.candidate.dashboard.results',get_defined_vars());
    }
}
