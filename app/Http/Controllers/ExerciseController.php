<?php

namespace App\Http\Controllers;

use App\CoursePart;
use App\CourseProgress;
use App\Exercise;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CoursePart $coursePart
     * @return Response
     */
    public function indexJson(CoursePart $coursePart)
    {
        return Exercise::where('course_part_id',$coursePart->id)->get()->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'question'=>'required',
            'answer'=>'required'
        ]);
        $exercise = new Exercise();
        $exercise->question = $request->question;
        $exercise->answer = $request->answer;
        $exercise->course_part_id=$request->course_part_id;
        $exercise->save();
        return response($exercise,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exercise  $exercise
     * @return Response
     */
    public function show(Exercise $exercise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exercise  $exercise
     * @return Response
     */
    public function edit(Exercise $exercise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exercise  $exercise
     * @return Response
     */
    public function update(Request $request, Exercise $exercise)
    {
        $this->validate($request,[
            'progress'=>'required'
        ]);
        $exercise->progress = $request->progress;
        $exercise->save();
        $exercise->users()->sync([$request->user_id],false);

        return response($exercise,200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exercise  $exercise
     * @return Response
     */
    public function destroy(Exercise $exercise)
    {
        $exercise->users()->detach();
        $exercise->delete();
        return response(null, 204);
    }
}
