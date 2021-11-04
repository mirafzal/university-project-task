<?php

namespace App\Http\Requests;

use App\Models\Lesson;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLessonRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lesson_create');
    }

    public function rules()
    {
        return [
            'start_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'end_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'room_id' => [
                'required',
                'integer',
            ],
            'group_id' => [
                'required',
                'integer',
            ],
            'teacher_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
