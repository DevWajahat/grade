<?php

namespace App\Http\Controllers\Examiner;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamHall;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        // dd($request->all(),$request->sections);


        $exam =  auth()->user()->exams()->create([
            'title' => $request->exam_title,
            'exam_hall_id' => $request->exam_hall,
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


        return redirect()->route('examiner.exams.index');
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

        return redirect()->route('examiner.exams.index');
    }
}
