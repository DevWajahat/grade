<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Requests\JoinHallRequest;
use App\Models\Exam;
use App\Models\ExamHall;
use App\Models\UserExamAttempt;
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

        return view('screens.candidate.dashboard.examination', get_defined_vars());
    }
    public function results($code)
    {
        $examHall = ExamHall::where('hall_code', $code)->firstOrFail();
        $user = auth()->user();

        // Get all public exams associated with the exam hall
        $exams = $examHall->exams()->where('status', 'public')->get();

        // Get all exam attempts by the current user for these exams
        $examAttempts = $user->user_exam_attempts()->whereIn('exam_id', $exams->pluck('id'))->get()->keyBy('exam_id');

        // Calculate metrics for summary cards
        $totalExams = $exams->count();
        $completedExams = $examAttempts->count();

        // Calculate average score
        $totalAchievedMarks = 0;
        $totalPossibleMarks = 0;

        foreach ($examAttempts as $attempt) {
            $exam = $exams->firstWhere('id', $attempt->exam_id);
            if ($exam) {
                $totalAchievedMarks += $attempt->total_marks;
                $totalPossibleMarks += $exam->total_marks;
            }
        }

        $averageScore = 0;
        if ($totalPossibleMarks > 0) {
            $averageScore = number_format(($totalAchievedMarks / $totalPossibleMarks) * 100, 2);
        }

        // Calculate best score
        $bestScore = 0;
        foreach ($examAttempts as $attempt) {
            $exam = $exams->firstWhere('id', $attempt->exam_id);
            if ($exam && $exam->total_marks > 0) {
                $percentage = ($attempt->total_marks / $exam->total_marks) * 100;
                if ($percentage > $bestScore) {
                    $bestScore = $percentage;
                }
            }
        }
        $bestScore = number_format($bestScore, 2);

        return view('screens.candidate.dashboard.results', get_defined_vars());
    }

    public function examResult($id)
    {
        $examAttempt = UserExamAttempt::where('user_id', auth()->user()->id)
            ->where('exam_id', $id)
            ->with([
                'userAnswers' => function ($query) {
                    $query->with(['question', 'question.options', 'question.correctAnswer']);
                }
            ])
            ->first();

        $exam = Exam::with('sections.questions.options')->find($id);

        if (!$examAttempt || !$exam) {
            abort(404, 'Exam results not found.');
        }

        return view('screens.candidate.dashboard.examresult', compact('examAttempt', 'exam'));
    }

    public function people($code)
    {
        $examHall = ExamHall::where('hall_code', $code)->first();

        return view('screens.candidate.dashboard.people', get_defined_vars());
    }
}
