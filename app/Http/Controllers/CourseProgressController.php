<?php

namespace App\Http\Controllers;

use App\CourseProgress;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;


class CourseProgressController extends Controller
{


    public function indexJson($id)
    {
        return CourseProgress::where('user_id', $id)->get()->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     * @param  \App\CourseProgress  $courseProgress
     * @return \Illuminate\Http\Response
     */
    public function show(CourseProgress $courseProgress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CourseProgress  $courseProgress
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseProgress $courseProgress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CourseProgress  $courseProgress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseProgress $courseProgress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CourseProgress  $courseProgress
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseProgress $courseProgress)
    {
        //
    }
}
