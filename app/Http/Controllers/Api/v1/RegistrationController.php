<?php
namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\StoreRegistrationRequest;
use App\Http\Requests\UpdateRegistrationRequest;
use App\Http\Controllers\Controller;
use App\Class\Controllers\Course as CourseFunction;
use App\Class\Controllers\Registration as RegisterFunction;
use App\Models\Registration;
use App\Models\Course;
use Illuminate\Support\Facades\Redis;
use App\Repository\RegistrationRepository;
use _;

class RegistrationController extends Controller
{
    /**
     *  Display a listing of the registration.
     *
     *  @param Course $course
     *  @return \Illuminate\Http\JsonResponse
     */
    public function index(Course $course)
    {
        // redis cache key
        $key = 'registration:index:'.$course->id;

        // if redis cache exist
        if (Redis::exists($key)) {
            return response()->json(json_decode(Redis::get($key)));
        }

        // Get all registrations
        $registrations = $course->registrations()->get();

        // set redis cache
        Redis::set($key, json_encode($registrations));

        // return response
        return response()->json([
            'status' => 'success',
            'message' => 'Registrations retrieved successfully',
            'details' => $registrations
        ], 200);
    }

    /**
     *  Store a new registration in storage.
     *  @param StoreRegistrationRequest $request
     *  @param Course $course
     *  @return \Illuminate\Http\JsonResponse
     */
    public function store(Course $course, RegistrationRepository $regisrationRepo, StoreRegistrationRequest $request)
    {
        // get capasity of course & student registeration
        $course_capasity_status = CourseFunction::hasCapasity($course->id);
        $student_registration_status = RegisterFunction::studentHasCourse($request->student_id, $course->id);

        // check if student has course
        if ($student_registration_status) {
            return response()->json([
                'status' => 'error',
                'message' => 'Student has already registered for this course'
            ], 400);
        }

        // check if course has no capasity
        if (!$course_capasity_status) {
            return response()->json([
                'status' => 'error',
                'message' => 'Course capasity is full'
            ], 400);
        }

        // store registration
        $registration = $regisrationRepo->create($request, $course->id);

        // remove redis cache
        Redis::del('registration:index:'.$course->id);

        // remove course list cache
        CourseFunction::clearCourseCache();

        // return response
        return response()->json([
            'status' => 'success',
            'message' => 'Registration successful',
            'details' => $registration
        ], 201);
    }

    /**
     *  Display the specified registration.
     *
     *  @param Course $course
     *  @param int $registration_id
     *  @return \Illuminate\Http\JsonResponse
     */
    public function show(Course $course ,$registration_id)
    {
        // redis cache key
        $key = 'registration:show:'.$registration_id;

        // if redis cache exist
        if (Redis::exists($key)) {
            return response()->json(json_decode(Redis::get($key)));
        }

        // get registration
        $registration = $course->registrations()->with(['student','course'])->findOrFail($registration_id);

        // set redis cache
        Redis::set($key, json_encode($registration));

        // return response
        return response()->json([
            'status' => 'success',
            'message' => 'Registration retrieved successfully',
            'details' => $registration
        ], 200);
    }

    /**
     *  Update the specified registration in storage.
     *
     *  @param \App\Http\Requests\UpdateRegistrationRequest $request
     *  @param \App\Models\Registration $registration
     *  @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRegistrationRequest $request, Registration $registration)
    {
        return _::unImplemented();
    }

    /**
     *  Remove the specified registration from storage.
     *
     *  @param \App\Models\Registration $registration
     *  @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Registration $registration)
    {
        return _::unImplemented();
    }

}

