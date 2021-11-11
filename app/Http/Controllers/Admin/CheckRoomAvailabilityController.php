<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCheckRoomAvailabilityRequest;
use App\Http\Requests\StoreCheckRoomAvailabilityRequest;
use App\Http\Requests\UpdateCheckRoomAvailabilityRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoomAvailabilityController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('check_room_availability_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.checkRoomAvailabilities.index');
    }

    public function create()
    {
        abort_if(Gate::denies('check_room_availability_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.checkRoomAvailabilities.create');
    }

    public function store(StoreCheckRoomAvailabilityRequest $request)
    {
        $checkRoomAvailability = CheckRoomAvailability::create($request->all());

        return redirect()->route('admin.check-room-availabilities.index');
    }

    public function edit(CheckRoomAvailability $checkRoomAvailability)
    {
        abort_if(Gate::denies('check_room_availability_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.checkRoomAvailabilities.edit', compact('checkRoomAvailability'));
    }

    public function update(UpdateCheckRoomAvailabilityRequest $request, CheckRoomAvailability $checkRoomAvailability)
    {
        $checkRoomAvailability->update($request->all());

        return redirect()->route('admin.check-room-availabilities.index');
    }

    public function show(CheckRoomAvailability $checkRoomAvailability)
    {
        abort_if(Gate::denies('check_room_availability_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.checkRoomAvailabilities.show', compact('checkRoomAvailability'));
    }

    public function destroy(CheckRoomAvailability $checkRoomAvailability)
    {
        abort_if(Gate::denies('check_room_availability_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkRoomAvailability->delete();

        return back();
    }

    public function massDestroy(MassDestroyCheckRoomAvailabilityRequest $request)
    {
        CheckRoomAvailability::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
