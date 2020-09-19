<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
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
        $request->validate([
            'name' => ['required', 'string','unique:courses'],
            'estmated_time' => ['required', 'Integer'],
            'info' => ['required'],
        ]);

        Course::create($request->all());
        return redirect()->route('course')->with('status', 'Added new Course');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => ['required', 'string',"unique:courses,name,$course->id,id"],
            'estmated_time' => ['required', 'Integer'],
            'info' => ['required'],
        ]);
        //return $request;
        $course->name = $request->name;
        $course->info = $request->info;
        $course->estmated_time = $request->estmated_time;
        $course->save();

        return redirect()->route('course')->with('status', 'Course Updated Successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->students()->delete();
        $course->delete();
        return redirect()->route('course')->with('status', 'Course Deleted Sucssessfuly');
    }
}
