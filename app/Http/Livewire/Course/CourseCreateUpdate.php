<?php

namespace App\Http\Livewire\Course;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CourseCreateUpdate extends Component
{
    public $courseId,
        $action,
        $course,
        $ten_khoa_hoc,
        $start_date,
        $end_date,
        $orderby;

    public function rules()
    {
        return [
            'ten_khoa_hoc' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'ten_khoa_hoc.required' => 'Chưa nhập tên khóa học',
            'start_date.required' => 'Chưa nhập ngày bắt đầu',
            'end_date.required' => 'Chưa nhập ngày kết thúc',
        ];
    }

    public function mount($courseId)
    {
        $this->courseId = $courseId;
        $this->modalSetup($courseId);
    }

    public function modalSetup($courseId)
    {
        if ($courseId == 0) {
            $this->action = 'create';
        } elseif ($courseId > 0) {
            $this->action = 'update';
        } else {
            $this->action = 'delete';
        }
        $this->course = Course::find(abs($courseId));

        if ($this->course) {
            $this->getData();
        }
    }

    public function getData()
    {
        if ($this->course) {
            // $this->ma_khoa_hoc = '';
            $this->ten_khoa_hoc = $this->course->ten_khoa_hoc;
            $this->start_date = $this->course->start_date;
            $this->end_date = $this->course->end_date;
        } else {
            // $this->ma_khoa_hoc = '';
            $this->ten_khoa_hoc = '';
            $this->start_date = '';
            $this->end_date = '';
        }

        $this->resetErrorBag();
    }

    public function create()
    {

        $this->validate();
        $course = Course::create([
            'ma_khoa_hoc' => trim('KH'  . date_parse($this->start_date)['year']),
            'ten_khoa_hoc' => trim($this->ten_khoa_hoc),
            'start_date' => trim($this->start_date),
            'end_date' => trim($this->end_date),
            'orderby' => trim(Course::where('orderby', 'desc')->first() + 1),
            'create_by' => trim(Auth::user()->id),
            'update_by' => trim(Auth::user()->id)
        ]);

        return redirect(route(Course::LIST));
    }

    public function update()
    {
        $this->validate();
        $course = $this->course->update([
            'ma_khoa_hoc' => trim('KH' . substr(date_parse($this->start_date)['year'], -3)),
            'ten_khoa_hoc' => trim($this->ten_khoa_hoc),
            'start_date' => trim($this->start_date),
            'end_date' => trim($this->end_date),
            'update_by' => trim(Auth::user()->id)
        ]);

        return redirect(route(Course::LIST));
    }

    public function render()
    {
        return view('admin.course.livewire.course-create-update');
    }
}
