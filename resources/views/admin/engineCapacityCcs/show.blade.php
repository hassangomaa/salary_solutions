@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.engineCapacityCc.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.engine-capacity-ccs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.engineCapacityCc.fields.id') }}
                        </th>
                        <td>
                            {{ $engineCapacityCc->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.engineCapacityCc.fields.engine_capacity_cc') }}
                        </th>
                        <td>
                            {{ $engineCapacityCc->engine_capacity_cc }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.engine-capacity-ccs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection