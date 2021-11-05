<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Models\Lesson',
            'date_field' => 'start_time',
            'field'      => 'id',
            'prefix'     => '',
            'suffix'     => '',
            'route'      => 'admin.lessons.edit',
        ],
    ];

    public function index()
    {
        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => $model->group->name . ' | Room №' . $model->room->name. ' | ' . $model->teacher->name,
                    'start' => $crudFieldValue,
                    'end' => $model->end_time,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
