@extends('layouts.admin')
@section('content')
    @include('partials.menu',[$flag])

{{--    <div style="margin-bottom: 10px;" class="row">--}}
{{--        <!-- Add Company Button -->--}}
{{--        <div class="col-lg-12">--}}
{{--            <a class="btn btn-success" href="{{ route('company.create') }}">--}}
{{--                Add Employee Attendance--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="card">
        <div class="card-header">
            Reports List
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                <!-- Table Header Columns -->
                <tr>
                    <th>ID</th>
                    <th>File Name</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Download</th>
                </tr>
                </thead>
                <tbody>
                <!-- Loop through companies -->
                @foreach($files as $file)
                    <tr>
                        <td>{{ $file->id }}</td>
                        <td>{{ $file->file_name }}</td>
                        <td>{{ $file->month }}</td>
                        <td>{{ $file->year }}</td>
                        <td>
                            <a href="{{ route('excel.downloadFile',$file->id) }}" class="btn btn-primary">
                                Download Excel
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

