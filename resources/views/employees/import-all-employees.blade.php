@extends('layouts.admin')
@section('content')
    @include('partials.menu',[$flag])
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('employee.importEmployees') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-4">
            <input type="file" class="form-control" name="excel_file" accept=".xlsx, .xls">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Upload Excel File</button>
            </div>
        </div>
    </form>


@endsection
