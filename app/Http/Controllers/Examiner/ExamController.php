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
        return view('screens.examiner.exams.index',get_defined_vars());
    }
    public function create()
    {

        $halls = auth()->user()->exam_halls()->get();

        return view('screens.examiner.exams.create',get_defined_vars());
    }
    public function store(Request $request)
    {
        // dd($request->all(),$request->sections);


        $exam =  auth()->user()->exams()->create([
            'title' => $request->exam_title,
            'exam_hall_id' => $request->exam_hall,
            'duration_minutes' =>$request->exam_duration
        ]);

        foreach($request->sections as $section)
        {
                     $i = 1 ;

                  $sec = $exam->sections()->create([
                      'title' => 'Section '. $i,
                  ]);

            foreach($section['questions'] as $question){

                $que = $sec->questions()->create([
                    'question_text' => $question["text"],
                    'type' => $question["type"],
                    'marks' => $question["marks"]
                ]);
                // dd($question["options"]);

                if(array_key_exists('options', $question) && $question["options"] && $question["options"] !== null) {
                    foreach($question["options"] as $option){

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
        return view('screens.examiner.exams.create');
    }
    public function update($id)
    {
        return redirect()->route('examiner.exams.index');
    }
}
