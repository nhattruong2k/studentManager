<?php

namespace App\Http\Livewire\Course;

use App\Models\Course;
use Livewire\Component;

class CourseList extends Component
{
    public function render()
    {
        $coursets = Course::all();
        return view('admin.course.livewire.course-list')->with(['coursets' => $coursets]);
    }
}
