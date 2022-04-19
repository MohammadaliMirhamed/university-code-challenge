<?php

namespace App\Contract;

use Illuminate\Http\Request;

interface CourseRepositoryInterface
{
    /**
     *  create a new registration.
     *
     *  @param Request $request
     *  @return array
     */
    public function list(Request $request) : array;
}
