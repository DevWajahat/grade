<?php

namespace App\Http\Controllers\Examiner;

use App\Http\Controllers\Controller;
use App\Models\CorrectAnswer;
use App\Models\Exam;
use App\Models\ExamHall;
use App\Models\Question;
use App\Models\UserAnswer;
use App\Models\UserExamAttempt;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExamController extends Controller
{
    public function index()
    {

        $exams = Exam::all();

        return view('screens.examiner.exams.index', get_defined_vars());
    }
    public function create()
    {

        $halls = auth()->user()->exam_halls()->get();

        return view('screens.examiner.exams.create', get_defined_vars());
    }

    public function updateExamStatus(Request $request)
    {

        $exam = Exam::find($request->id);
        $exam->update(['status' => $request->status]);
        return response()->json([
            'status' => 'success',
            'message' => 'Status Updated Successfully.'
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all(),$request->sections);


        $exam =  auth()->user()->exams()->create([
            'title' => $request->exam_title,
            'exam_hall_id' => $request->exam_hall,
            'total_marks' => $request->exam_total_marks,
            'duration_minutes' => $request->exam_duration
        ]);

        foreach ($request->sections as $section) {
            $i = 1;

            $sec = $exam->sections()->create([
                'title' => 'Section ' . $i,
            ]);
            ++$i;
            foreach ($section['questions'] as $question) {

                $que = $sec->questions()->create([
                    'question_text' => $question["text"],
                    'type' => $question["type"],
                    'marks' => $question["marks"]
                ]);
                // dd($question["options"]);

                if (array_key_exists('options', $question) && $question["options"] && $question["options"] !== null) {
                    foreach ($question["options"] as $option) {

                        $opt = $que->options()->create([
                            'option_text' => $option["text"]
                        ]);
                    }
                }
            }
        }


        return redirect()->route('examiner.exams.index')->with('message', 'exam added to examHall successfully.');
    }

    public function edit($id)
    {
        $halls = auth()->user()->exam_halls()->get();
        $exam = Exam::with(['sections.questions.options'])->findOrFail($id);

        return view('screens.examiner.exams.edit', compact('halls', 'exam'));
    }

    /**
     * Fetch exam data for a given ID via AJAX.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getExamData($id)
    {
        $exam = Exam::with(['sections.questions.options'])->find($id);

        if (!$exam) {
            return response()->json(['error' => 'Exam not found'], 404);
        }

        return response()->json($exam);
    }
    public function update(Request $request, $id)
    {
        $exam = auth()->user()->exams()->findOrFail($id);

        $exam->update([
            'title' => $request->exam_title,
            'exam_hall_id' => $request->exam_hall,
            'total_marks' => $request->exam_total_marks,
            'duration_minutes' => $request->exam_duration
        ]);

        // Delete existing sections, questions, and options to re-create them.
        // This is a simple but effective way to handle complex updates.

        foreach ($exam->sections as $section) {
            foreach ($section->questions as $question) {
                $question->options()->delete();
            }
            $section->questions()->delete();
        }
        $exam->sections()->delete();

        foreach ($request->sections as $sIndex => $section) {
            $sec = $exam->sections()->create([
                'title' => 'Section ' . ($sIndex + 1), // Use sIndex to make it dynamic
            ]);

            if (isset($section['questions']) && is_array($section['questions'])) {
                foreach ($section['questions'] as $qIndex => $question) {
                    $que = $sec->questions()->create([
                        'question_text' => $question['text'],
                        'type' => $question['type'],
                        'marks' => $question['marks']
                    ]);

                    if (isset($question['options']) && is_array($question['options'])) {
                        foreach ($question['options'] as $oIndex => $option) {
                            $opt = $que->options()->create([
                                'option_text' => $option['text'],
                            ]);

                            // Mark the correct option based on the request data
                            if (isset($question['correct_option']) && $question['correct_option'] == $oIndex) {
                                $opt->is_correct = true;
                                $opt->save();
                            }
                        }
                    }
                }
            }
        }

        return redirect()->route('examiner.exams.index')->with('message','Exam updated Successfully.');
    }

    public function result($id)
    {
        $userExamAttempts = UserExamAttempt::where('exam_id', $id)->get();

        return view('screens.examiner.exams.result', get_defined_vars());
    }
    public function candidateResult($id)
    {
        $examAttempt = UserExamAttempt::with([
            'userAnswers' => function ($query) {
                $query->with(['question', 'question.options', 'question.correctAnswer']);
            }
        ])->findOrFail($id);  // Use findOrFail for better error handling; removes need for ->first()

        $exam = Exam::with('sections.questions.options')->findOrFail($examAttempt->exam_id);

        if (!$examAttempt || !$exam) {
            abort(404, 'Exam results not found.');
        }

        return view('screens.examiner.exams.candidate-result', get_defined_vars());
    }
    public function updateExamAttemptGrades(Request $request, $id)
    {
        $examAttemptId = $id;
        $grades = $request->input('grades');
        $totalMarks = 0;
        DB::transaction(function () use ($grades, $examAttemptId, &$totalMarks) {
            $examAttempt = UserExamAttempt::findOrFail($examAttemptId);
            foreach ($grades as $gradeData) {
                $questionId = $gradeData['question_id'];
                $question = Question::findOrFail($questionId);
                $userAnswer = UserAnswer::where('user_exam_attempt_id', $examAttemptId)
                    ->where('question_id', $questionId)
                    ->first();
                if ($userAnswer) {
                    $userAnswer->feedback = $gradeData['feedback'] ?? null;
                    if ($question->type === 'multiple-choice') {
                        $correctAnswerText = $gradeData['correct_answer_content'] ?? null;
                        if ($correctAnswerText) {
                            $isCorrect = ($userAnswer->answer_content === $correctAnswerText);
                            $userAnswer->marks = $isCorrect ? $question->marks : 0;
                        }
                        CorrectAnswer::updateOrCreate(
                            ['question_id' => $question->id],
                            ['answer_content' => $correctAnswerText]
                        );
                    } else {
                        $userAnswer->marks = $gradeData['marks'] ?? 0;
                        $correctAnswerText = $gradeData['correct_answer_content'] ?? null;
                        if ($correctAnswerText) {
                            CorrectAnswer::updateOrCreate(
                                ['question_id' => $question->id],
                                ['answer_content' => $correctAnswerText]
                            );
                        }
                    }
                    $userAnswer->save();
                    $totalMarks += $userAnswer->marks;
                }
            }
            $examAttempt->total_marks = $totalMarks;
            $examAttempt->save();
        });
        return response()->json(['success' => true, 'message' => 'Grades updated successfully.']);
    }

    public function gradeWithAi($id)
    {
        try {
            $examAttempt = UserExamAttempt::with(['exam.sections.questions.options', 'userAnswers'])->findOrFail($id);
            $userAnswers = $examAttempt->userAnswers;
            $questions = $examAttempt->exam->sections->flatMap(function ($section) {
                return $section->questions;
            });

            $questionsAndAnswers = $questions->map(function ($question) use ($userAnswers) {
                $userAnswer = $userAnswers->firstWhere('question_id', $question->id);
                $userAnswerText = $userAnswer->answer_content ?? 'Not answered';
                $correctAnswer = $question->correctAnswer->answer_content ?? 'Not available';
                $options = $question->options->pluck('option_text')->toArray();

                return [
                    'question_id' => $question->id,
                    'question_text' => $question->question_text,
                    'user_answer' => $userAnswerText,
                    'correct_answer' => $correctAnswer,
                    'question_marks' => $question->marks,
                    'type' => $question->type,
                    'options' => $options
                ];
            });

            $systemInstruction = [
                'parts' => [
                    [
                        'text' => 'You are a professional and unbiased examiner. Your task is to grade exam answers, provide helpful feedback, and ensure the output is in the specified JSON format. Your tone should be formal and objective.'
                    ]
                ]
            ];

            $responseSchema = [
                'type' => 'array',
                'items' => [
                    'type' => 'object',
                    'properties' => [
                        'question_id' => ['type' => 'string'],
                        'obtained_marks' => ['type' => 'integer'], // Renamed for clarity
                        'total_marks' => ['type' => 'integer'], // New field for total marks
                        'feedback' => ['type' => 'string'],
                        'correct_answer_content' => ['type' => 'string']
                    ],
                    'required' => ['question_id', 'obtained_marks', 'total_marks', 'feedback', 'correct_answer_content']
                ]
            ];

            $prompt = 'Grade the following exam attempts. For each question, provide an "obtained_marks" value (from 0 to the total marks), a "total_marks" value, a "feedback" text, and the "correct_answer_content". Always match the question IDs provided in the input. Ensure the `obtained_marks` field accurately reflects the quality of the user\'s answer in relation to the correct answer. The `total_marks` should be the same as the `question_marks` value provided in the input. The output should be a JSON array of objects, one for each question, following the defined schema. Input: ' . json_encode($questionsAndAnswers->toArray());

            $response = Http::post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . env('GEMINI_API'), [
                'system_instruction' => $systemInstruction,
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'response_mime_type' => 'application/json',
                    'response_schema' => $responseSchema,
                ],
            ]);

            $aiGrades = $response->json();

            return response()->json([
                'success' => true,
                'message' => 'AI grading complete.',
                'ai_grades' => $aiGrades
            ]);

        } catch (\Exception $e) {
            Log::error('AI Grading Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'AI grading failed due to an internal error.','error',$e->getMessage()], 500);
        }
    }
}
