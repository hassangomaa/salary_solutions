@extends('layouts.admin')
@section('content')
    @include('partials.menu', [$flag])
    @include('partials.reports')
    @php
        $i = 1;
        $days = 0;
        $bouns = 0;
        $inc = 0;
        $regural = 0;
        $total_salary = 0;
        $borrows = 0;
        $deduction = 0;
        $net_salary = 0;
    @endphp
    <div class="card">
        <div class="card-header">
            {{ trans('reports.reports_list') }}
        </div>

        <div class="card-body">

            <form method="get" style="display: flex;flex-direction: row-reverse;" action="{{ route('Reports.indexOnlyTrashed') }}">
                {{-- <label for="search">{{ trans('global.filter') }}</label> --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">

                            <div class="row">
                                <a href="{{ route('Reports.index') }}" >
                                <button name="revert"
                                        value="revert"
                                        class="btn btn-info"
                                        type="button">
                                  الذهاب الي   الحاليه
                                </button>
                                </a>

                            </div>
                            <div class="row">
                                <input class="form-control col-md-4" type="month" id="" name="date"
                                placeholder="{{ trans('global.search_placeholder') }}">
                                <input class="form-control col-md-4" type="number"  min="1" id="" name="to_days"
                                placeholder=" الي عدد ايام">
                                <input class="form-control col-md-4" type="number"  min="1" id="" name="from_days"
                                placeholder=" من عدد ايام">

                            </div>




                            </div>


                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="action" value="filter"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></button>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" name="action" value="excel"> <svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-file-earmark-excel" viewBox="0 0 16 16">
                                    <path
                                        d="M5.884 6.68a.5.5 0 1 0-.768.64L7.349 10l-2.233 2.68a.5.5 0 0 0 .768.64L8 10.781l2.116 2.54a.5.5 0 0 0 .768-.641L8.651 10l2.233-2.68a.5.5 0 0 0-.768-.64L8 9.219l-2.116-2.54z" />
                                    <path
                                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                </svg></button>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <a href="{{ route('Reports.index') }}" class="btn btn-primary"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                                    <path
                                        d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                                </svg></a>
                        </div>
                    </div>
                </div>


            </form>
            @include('reports.tables.salaries')
        </div>
        {{-- {{ $files->links('vendor.pagination.bootstrap-5') }} --}}
    </div>
@endsection
