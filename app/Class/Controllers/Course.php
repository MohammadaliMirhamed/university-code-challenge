<?php

namespace App\Class\Controllers;

use App\Models\Course as CourseModel;
use App\Models\Registration;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;


class Course
{
    /**
     * return the status of course capacity
     *
     * @param int $course_id
     * @return bool
     */
    static function hasCapasity($course_id)
    {
        $course_capasity = CourseModel::find($course_id)['capacity'];
        $course_registrations = Registration::where('course_id', $course_id)->count();

        if ($course_registrations >= $course_capasity) {
            return false;
        }

        return true;
    }

    /**
     * clear the cache of course
     *
     * @return void
     */
    static function clearCourseCache()
    {
        // get all keys
        $keys = Redis::keys('courses:index:*');

        // loop through keys
        foreach ($keys as $key) {
            // explode key
            $key = explode(env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'), $key);

            // delete key
            Redis::del($key);
        }
    }
}

