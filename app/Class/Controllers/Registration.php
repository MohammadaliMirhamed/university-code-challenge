<?php

namespace App\Class\Controllers;

use App\Models\Registration as RegistrationModel;

class Registration
{
    /**
     * return the status of student registration
     *
     * @param int $course_id, int $student_id
     * @return bool
     */
    static function studentHasCourse($student_id, $course_id)
    {
        $student_count = RegistrationModel::where(['student_id' => $student_id, 'course_id' => $course_id])->count();

        if ($student_count > 0) {
            return true;
        }

        return false;
    }
}

