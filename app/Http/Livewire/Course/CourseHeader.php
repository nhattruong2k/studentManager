<?php

namespace App\Http\Livewire\Course;

use Livewire\Component;

class CourseHeader extends Component
{
    public function render()
    {
        $title = "Danh Sách Khóa Học";
        return view('admin.course.livewire.course-header')->with(['title' => $title]);
    }
}
