<?php

namespace App\Repository;

use App\Contract\CourseRepositoryInterface;
use App\Models\Course;
use App\Models\Registration;
use Illuminate\Http\Request;

class CourseRepository implements CourseRepositoryInterface
{
    /**
    *  create a new registration.
    *
    *  @param Request $request
    *  @param int $course_id
    *  @return array
    */
   public function list(Request $request) : array
   {
        // get courses
        $courses = Course::paginate(10);

        // get registrations of each course
        $registrations = Registration::whereIn('course_id', $courses->pluck(['id']))
            ->groupBy('course_id')
            ->selectRaw('course_id, count(*) as total')
            ->get();

        // specify each course avaiablity
        foreach ($courses as $course) {
            $course->status = 'available';
            foreach ($registrations as $registration) {
                if ($course->id == $registration->course_id) {
                    if ($course->capacity <= $registration->total) {
                        $course->status = 'unavailable';
                    }
                }
            }
        }

        return $courses->toArray();
   }
}
