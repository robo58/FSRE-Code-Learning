<?php

namespace App\Http\Controllers;

use App\Course;
use App\CoursePart;
use App\CourseProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('courses.index');
    }

    public function indexJson()
    {
        return Course::all()->toJson();
    }


    public function partsJson(Course $course)
    {
        return CoursePart::where('course_id', $course->id)->get()->toJson();
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
     * @param \Illuminate\Http\Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'category_id'=>'required'
        ]);
        $course = new Course();
        $course->title = $request->title;
        $course->category_id = $request->category_id;
        $course->author_id = 1;
        $course->save();

        return response($course, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $br = CourseProgress::where('course_id',$course->id)->where('user_id',Auth::id())->count();
        if($br > 0){
            return view('courses.show')->withCourse($course);
        }else{
            return view('courses.enroll')->withCourse($course);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('courses.edit')->withCourse($course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $course->title = $request->title;
        $course->save();
        return response($course,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->courseParts()->delete();
        $course->delete();
        return response(null,204);
    }
}
