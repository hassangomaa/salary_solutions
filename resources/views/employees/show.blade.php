@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
        Show Employee
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('employee.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                           ID
                        </th>
                        <td>
                            {{ $employee->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                        Name
                        </th>
                        <td>
                            {{ $employee->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                        Position
                        </th>
                        <td>
                            {{ $employee->position }}
                        </td>
                    </tr>

<tr>
                        <th>
                        Daily Fare
                        </th>
                        <td>
                            {{ $employee->daily_fare }}
                        </td>
                    </tr>

<tr>
                        <th>
                        Credit
                        </th>
                        <td>
                            {{ $employee->credit }}
                        </td>
                    </tr>


                    <tr>
                        <th>
                           Phone
                        </th>
                        <td>
                            {{ $employee->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                          Address
                        </th>
                        <td>
                            {{ $employee->address }}
                        </td>
                    </tr>
                    </tbody>
                </table>
{{--                <div class="form-group">--}}
{{--                    <a class="btn btn-default" href="{{ route('employee.index') }}">--}}
{{--                       Go Back--}}
{{--                    </a>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>

{{--    <div class="card">--}}
{{--        <div class="card-header">--}}
{{--            {{ trans('global.relatedData') }}--}}
{{--        </div>--}}
{{--        <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="#seller_products" role="tab" data-toggle="tab">--}}
{{--                    {{ trans('cruds.product.title') }}--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--        <div class="tab-content">--}}
{{--            <div class="tab-pane" role="tabpanel" id="seller_products">--}}
{{--                @includeIf('admin.employees.relationships.sellerProducts', ['products' => $employee->sellerProducts])--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

@endsection
