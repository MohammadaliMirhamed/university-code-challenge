<?php

namespace App\Contract;

use Illuminate\Http\Request;

interface RegistrationRepositoryInterface
{
    /**
     *  create a new registration.
     *
     *  @param Request $request
     *  @param int $course_id
     *  @return array
     */
    public function create(Request $request, int $course_id) : array;
}
