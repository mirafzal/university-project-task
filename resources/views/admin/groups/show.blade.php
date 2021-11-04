@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.group.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.groups.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.id') }}
                        </th>
                        <td>
                            {{ $group->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.name') }}
                        </th>
                        <td>
                            {{ $group->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.user') }}
                        </th>
                        <td>
                            @foreach($group->users as $key => $user)
                                <span class="label label-info">{{ $user->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.groups.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#group_lessons" role="tab" data-toggle="tab">
                {{ trans('cruds.lesson.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#group_users" role="tab" data-toggle="tab">
                {{ trans('cruds.user.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="group_lessons">
            @includeIf('admin.groups.relationships.groupLessons', ['lessons' => $group->groupLessons])
        </div>
        <div class="tab-pane" role="tabpanel" id="group_users">
            @includeIf('admin.groups.relationships.groupUsers', ['users' => $group->groupUsers])
        </div>
    </div>
</div>

@endsection