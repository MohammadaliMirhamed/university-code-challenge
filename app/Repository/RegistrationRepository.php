<?php

namespace App\Repository;

use App\Contract\RegistrationRepositoryInterface;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationRepository implements RegistrationRepositoryInterface
{
    /**
    *  create a new registration.
    *
    *  @param Request $request
    *  @param int $course_id
    *  @return array
    */
   public function create(Request $request, int $course_id) : array
   {
        $registration = new Registration();
        $registration->student_id = $request->student_id;
        $registration->course_id = $course_id;
        $registration->save();

        return $registration->toArray();
   }
}
