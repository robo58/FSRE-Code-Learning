<?php

namespace App\Http\Controllers;

use App\CourseProgress;
use App\Exercise;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class CourseProgressController extends Controller
{


    public function indexJson($id)
    {
        return CourseProgress::where('user_id', $id)->get()->toJson();
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
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $item = new CourseProgress();
        $item->course_id = $request->course_id;
        $item->user_id = $request->user_id;
        $item->progress = 1;
        $item->save();
    }

    /**
     * Display the specified resource.
     *
     * @param CourseProgress $courseProgress
     * @return Response
     */
    public function show(CourseProgress $courseProgress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CourseProgress $courseProgress
     * @return Response
     */
    public function edit(CourseProgress $courseProgress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param CourseProgress $courseProgress
     * @return Response
     */
    public function update(Request $request, CourseProgress $courseProgress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return Response
     * @throws ValidationException
     */
    public function updateProgress(Request $request, User $user)
    {
        $this->validate($request,[
            'progress'=>'required',
            'exercise_id'=>'required|numeric',
            'course_id'=>'required|numeric'
        ]);

        $courseProgress = CourseProgress::where('user_id',$user->id)->where('course_id',$request->course_id)->first();
        $courseProgress->progress = $request->progress;
        $courseProgress->save();
        $user->exercises()->sync([$request->exercise_id],false);

        return response($user->exercises->toJson(),200);
    }

    public function getExercises(User $user)
    {
        return $user->exercises->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CourseProgress $courseProgress
     * @return Response
     */
    public function destroy(CourseProgress $courseProgress)
    {
        //
    }
}
