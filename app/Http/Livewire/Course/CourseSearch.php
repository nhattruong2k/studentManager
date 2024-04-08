<?php

namespace App\Http\Livewire\Course;

use App\Models\Course;
use Livewire\Component;

class CourseSearch extends Component
{
    public function render()
    {
        $coursets = Course::all();
        return view('admin.course.livewire.course-search')->with(['coursets' => $coursets]);
    }
}
