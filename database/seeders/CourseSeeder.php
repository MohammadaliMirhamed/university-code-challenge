<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{

    /**
     * Run the database seeds.use Illuminate\Database\Console\Seeds\WithoutModelEvents;
     *
     * @return void
     */
    public function run()
    {
        Course::factory(15)->create();
    }
}
