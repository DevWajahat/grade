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
            'total_marks' => 0
        ]);

        $totalMarks = 0;

        foreach ($request->answers as $questionId => $answer) {
            if ($answer !== null) {


                $question = Question::find($questionId);

                $questionText = $question->question_text;


                $correctAnswer = CorrectAnswer::where('question_id', $question->id)->first();

                if ($correctAnswer == null) {
                    $response = Http::withHeaders([
                        'x-goog-api-key' => env('GEMINI_API'),
                        'Content-Type' => 'application/json',
                    ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent', [
                        'system_instruction' => [
                            'parts' => [
                                [
                                    'text' => 'You are a helpful and fair exam grader. Grade the student\'s answer for the following question.'
                                ]
                            ]
                        ],
                        'contents' => [
                            [
                                'parts' => [
                                    [
                                        'text' => "Question: {$questionText}\nStudent Answer: {$answer}\nTotal Marks: {$question->marks}"
                                    ]
                                ]
                            ]
                        ],
                        'generationConfig' => [
                            'responseMimeType' => 'application/json',
                            'responseSchema' => [
                                'type' => 'object',
                                'properties' => [
                                    'marks_obtained' => [
                                        'type' => 'number'
                                    ],
                                    'feedback' => [
                                        'type' => 'string'
                                    ],
                                    'correct_answer' => [
                                        'type' => 'string'
                                    ]
                                ],
                                'propertyOrdering' => [
                                    'marks_obtained',
                                    'feedback',
                                    'correct_answer'
                                ],
                                'required' => [
                                    'marks_obtained',
                                    'feedback',
                                    'correct_answer'
                                ]
                            ]
                        ]
                    ]);
                    $geminiOutput = $response->json('candidates');
                    $geminiOutput = $geminiOutput[0]['content']['parts'][0]['text'];
                    $structureOutput = json_decode($geminiOutput);

                    $obtainMarks = $structureOutput->marks_obtained;
                    $totalMarks += $obtainMarks;
                    $feedback = $structureOutput->feedback;

                    $CorrectAnswer = $structureOutput->correct_answer;

                    $correctAnswer = CorrectAnswer::create([
                        'question_id' => $questionId,
                        'answer_content' => $CorrectAnswer
                    ]);

                    $userAnswers = UserAnswer::create([
                        'user_exam_attempt_id' => $examAttempt->id,
                        'question_id' => $question->id,
                        'answer_content' => $answer . " ",
                        'marks' => $obtainMarks,
                        'corrected_by' => 'AI',
                        'feedback' => $feedback
                    ]);
                } else {

                    $response = Http::withHeaders([
                        'x-goog-api-key' => env('GEMINI_API'),
                        'Content-Type' => 'application/json',
                    ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent', [
                        'system_instruction' => [
                            'parts' => [
                                [
                                    'text' => 'You are a helpful and fair exam grader. Grade the student\'s answer for the following question.'
                                ]
                            ]
                        ],
                        'contents' => [
                            [
                                'parts' => [
                                    [
                                        'text' => "Question: {$questionText}\nStudent Answer: {$answer}\nTotal Marks: {$question->marks} \n Correct Answer: {$correctAnswer->answer_content}"
                                    ]
                                ]
                            ]
                        ],
                        'generationConfig' => [
                            'responseMimeType' => 'application/json',
                            'responseSchema' => [
                                'type' => 'object',
                                'properties' => [
                                    'marks_obtained' => [
                                        'type' => 'number'
                                    ],
                                    'feedback' => [
                                        'type' => 'string'
                                    ]
                                ],
                                'propertyOrdering' => [
                                    'marks_obtained',
                                    'feedback',

                                ],
                                'required' => [
                                    'marks_obtained',
                                    'feedback',
                                ]
                            ]
                        ]
                    ]);
                    $geminiOutput = $response->json('candidates');
                    $geminiOutput = $geminiOutput[0]['content']['parts'][0]['text'];
                    $structureOutput = json_decode($geminiOutput);

                    $obtainMarks = $structureOutput->marks_obtained;
                    $totalMarks += $obtainMarks;
                    $feedback = $structureOutput->feedback;

                    $userAnswers = UserAnswer::create([
                        'user_exam_attempt_id' => $examAttempt->id,
                        'question_id' => $question->id,
                        'answer_content' => $answer,
                        'marks' => $obtainMarks,
                        'corrected_by' => 'AI',
                        'feedback' => $feedback
                    ]);
                }
            }
            // dd($request->all(), $questionId, $answer, $examAttempt, $id, $exam, $user);
        }

        $examAttempt->update([
            'total_marks' => $totalMarks
        ]);


        return response()->json([
            'success' => true,
            'message' => 'Exam Submitted Succesfully.',
            'total_marks' => $totalMarks,
            'redirect' => route('candidate.dashboard')
        ]);
    }
}
