@extends('layouts.admin')
@section('content')
    @include('partials.menu', [$flag])

    <div class="card">
        <div class="card-header">
            {{ trans('reports.reports_list') }}
        </div>

        <div class="card-body">
            <div class="col-lg-6">
                <a class="btn btn-success" href="{{route('company.clickToGenerateReport')}}">
                انشئ التقرير لهذا الشهر
                </a>
            </div>
            <div class="form-group">
                <label for="search">{{ trans('global.search') }}</label>
                <input class="form-control" type="text" id="search" name="search" placeholder="{{ trans('global.search_placeholder') }}">
            </div>

            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                <tr>
                    <th>{{ trans('reports.id') }}</th>
                    <th>{{ trans('reports.file_name') }}</th>
                    <th>{{ trans('reports.month') }}</th>
                    <th>{{ trans('reports.year') }}</th>
                    <th>{{ trans('reports.download') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($files as $file)
                    <tr>
                        <td>{{ $file->id }}</td>
                        <td>{{ $file->file_name }}</td>
                        <td>{{ $file->month }}</td>
                        <td>{{ $file->year }}</td>
                        <td>
                            <a href="{{ route('excel.downloadFile',$file->id) }}" class="btn btn-primary">
                                {{ trans('reports.download') }} Excel
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $files->links('vendor.pagination.bootstrap-5') }}
    </div>
@endsection
