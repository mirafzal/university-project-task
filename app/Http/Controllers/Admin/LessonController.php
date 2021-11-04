<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLessonRequest;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\Room;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lesson_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessons = Lesson::with(['room', 'group', 'teacher'])->get();

        $rooms = Room::get();

        $groups = Group::get();

        $users = User::get();

        return view('admin.lessons.index', compact('lessons', 'rooms', 'groups', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('lesson_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rooms = Room::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $groups = Group::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $teachers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lessons.create', compact('rooms', 'groups', 'teachers'));
    }

    public function store(StoreLessonRequest $request)
    {
        $lesson = Lesson::create($request->all());

        return redirect()->route('admin.lessons.index');
    }

    public function edit(Lesson $lesson)
    {
        abort_if(Gate::denies('lesson_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rooms = Room::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $groups = Group::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $teachers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lesson->load('room', 'group', 'teacher');

        return view('admin.lessons.edit', compact('rooms', 'groups', 'teachers', 'lesson'));
    }

    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        $lesson->update($request->all());

        return redirect()->route('admin.lessons.index');
    }

    public function show(Lesson $lesson)
    {
        abort_if(Gate::denies('lesson_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson->load('room', 'group', 'teacher');

        return view('admin.lessons.show', compact('lesson'));
    }

    public function destroy(Lesson $lesson)
    {
        abort_if(Gate::denies('lesson_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson->delete();

        return back();
    }

    public function massDestroy(MassDestroyLessonRequest $request)
    {
        Lesson::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
