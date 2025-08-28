<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\UserExamAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Question;
use App\Models\CorrectAnswer;
use App\Models\UserAnswer;

class ExamController extends Controller
{
    public function index($id)
    {
        $exam = Exam::with(['sections.questions.options'])->find($id);
        return view('screens.candidate.exam.index', get_defined_vars());
    }

    public function submitExam(Request $request, $id)
    {
        $exam = Exam::find($id);
        $user = auth()->user();

        $examAttempt = UserExamAttempt::create([
            'user_id' => $user->id,
            'exam_id' => $exam->id,
            'finished_at' => $request->finished_at,
            'total_marks' => null
        ]);

        foreach ($request->answers as $questionId => $answer) {
            if ($answer !== null) {
                $question = Question::find($questionId);

                $userAnswers = UserAnswer::create([
                    'user_exam_attempt_id' => $examAttempt->id,
                    'question_id' => $question->id,
                    'answer_content' => $answer,
                    'marks' => null,
                    'corrected_by' => null,
                    'feedback' => null
                ]);
            }
        }

        // return redirect()->route('candidate.dashboard')->with('success', 'Exam submitted successfully.');
        return response()->json([
            'success' => true,
            'message' => 'Exam submitted Successfully.',
            'redirect' => route('candidate.dashboard'),
            'total_marks' => null
        ]);
    }
}
