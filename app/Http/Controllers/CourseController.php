<?php

namespace App\Http\Controllers;

use App\Course;
use App\CoursePart;
use App\CourseProgress;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',[
            'only'=>[
                'index','show','create'
            ]
        ]);
    }

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
        return Course::with('author:id,name')->get()->toJson();
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
        $course->author_id = $request->user_id;
        $course->save();

        return response($course, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Course $course
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
     * Store a newly created resource in storage.
     *
     * @param Course $course
     * @param User $user
     * @return integer
     */
    public function getProgress(Course $course,User $user)
    {
        return CourseProgress::where('course_id',$course->id)->where('user_id',$user->id)->first()->progress;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Course $course
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
     * @param Course $course
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
     * @param Course $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->courseParts()->delete();
        $course->delete();
        return response(null,204);
    }
}
