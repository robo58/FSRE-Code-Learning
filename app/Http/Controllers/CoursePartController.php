<?php

namespace App\Http\Controllers;

use App\Category;
use App\CoursePart;
use Illuminate\Http\Request;

class CoursePartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function indexJson($course_id)
    {
        dd($course_id);
        return CoursePart::all()->toJson();
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
        $this->validate($request, [
            'title'=>'required'
        ]);
        $part = new CoursePart();
        $part->title=$request->title;
        $part->course_id = $request->course_id;
        $part->save();
        return response($part, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CoursePart  $coursePart
     * @return \Illuminate\Http\Response
     */
    public function show(CoursePart $coursePart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CoursePart  $coursePart
     * @return \Illuminate\Http\Response
     */
    public function edit(CoursePart $coursePart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CoursePart  $coursePart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CoursePart $coursePart)
    {
        $coursePart->title = $request->coursePart['title'];
        $coursePart->body = $request->coursePart['body'];
        $coursePart->video_url = $request->coursePart['video_url'];
        $coursePart->video_desc = $request->coursePart['video_desc'];
        $coursePart->save();

        return response($coursePart, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CoursePart  $coursePart
     * @return \Illuminate\Http\Response
     */
    public function destroy(CoursePart $coursePart)
    {
        $coursePart->delete();
        return response(null,204);
    }
}
