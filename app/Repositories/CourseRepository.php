<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository extends BaseRepository
{

    protected $courses;
    
    public function __construct(Course $courses)
    {
        $this->courses = $courses;
    }
}
