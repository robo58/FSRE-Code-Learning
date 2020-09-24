<?php

namespace App\Http\Controllers\SuperAdmin;

use App\CoursePart;
use App\CourseProgress;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Documents;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $file=Documents::all();
        return view('superadmin.documents.view', compact('file'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.documents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=new Documents;

        if($request->file('file')){
            $file=$request->file('file');
                $filename=time().'.'.$file->getClientOriginalExtension();
                $request->file->move('uploads/', $filename);

                $data->file = $filename;
        }
        $data->title = $request->title;
        $data->description = $request->description;
        $data->course_part_id = $request->course_part_id;
        $data->save();

        return response($data, 200);
    }

    public function get(CoursePart $part)
    {
        return response(Documents::where('course_part_id',$part->id)->get()->toJson(),200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=Documents::find($id);
        return view('superadmin.documents.details', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Documents $file
     * @return \Illuminate\Http\Response
     */

    public function download(Documents $file)
    {
        $name = preg_replace('/\s+/', '_', $file->title);
        return response()->download('uploads/'.$file->file, $name);
    }

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Documents $document)
    {
        $document->delete();

        return response(null,204);
    }
}
