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
        $coursePart->save();

        return response($coursePart, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CoursePart  $coursePart
     * @return \Illuminate\Http\Response
     */
    public function updateVideo(Request $request, CoursePart $coursePart)
    {
        if($request->file){
            $file=$request->file;
            $filename=time().'.'.$file->getClientOriginalExtension();
            $coursePart->video_url = $filename;
            $file->move('uploads/videos/', $filename);
            $coursePart->video_desc = $request->video_desc;
            $coursePart->save();
        }

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
