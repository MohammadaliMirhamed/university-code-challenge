<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Repository\CourseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use _;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CourseRepository $courseRepository)
    {
        // define pagination
        $page = $request->input('page', 1);

        // redis cache key
        $key = 'courses:index:' . $page;

        // if redis cache exist
        if (Redis::exists($key)) {
            return response()->json(json_decode(Redis::get($key)));
        }

        // get courses
        $courses = $courseRepository->list($request);

        // set redis cache
        Redis::set($key, json_encode($courses));

        // return response
        return response()->json([
            'status' => 'success',
            'message' => 'Courses retrieved successfully',
            'details' => $courses
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        return _::unImplemented();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        // redis cache key
        $key = 'courses:show:'.$course->id;

        // if redis cache exist
        if (Redis::exists($key)) {
            return response()->json(json_decode(Redis::get($key)));
        }

        // set redis cache
        Redis::set($key, json_encode($course));

        // return response
        return response()->json([
            'status' => 'success',
            'message' => 'Course retrieved successfully',
            'details' => $course
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        return _::unImplemented();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        return _::unImplemented();
    }
}
