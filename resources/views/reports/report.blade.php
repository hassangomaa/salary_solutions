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
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #print, #print * {
            visibility: visible;
        }
        #print {
            position: fixed;
            left: 0;
            top: 0;
        }
        .no-print, .no-print *
    {
        display: none !important;
    }
    }

</style>
    <div class="card">
        <div class="card-header ">
            {{ trans('reports.reports_list') }}
        </div>

        <div class="card-body">


            <form method="get" style="display: flex;flex-direction: row-reverse;" action="{{ route('Reports.report') }}">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input class="form-control" type="month" id="" name="date"
                                placeholder="{{ trans('global.search_placeholder') }}">
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
                            <a href="{{ route('Reports.report') }}" class="btn btn-primary"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                                    <path
                                        d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                                </svg></a>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-info" onclick="printContent()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                              </svg></button>
                        </div>
                    </div>
                </div>


            </form>

<div id="print">
    <table DIR="RTL" style="display: flex;">
        <thead>
                    <tr class="no-print">
                        <th><b>مجموع الموظفين</</th>
                        <td>{{ $followUps_count }}</td>
                    </tr>
                    @foreach ($followUps as $item)
                    <tr>
                        <td><b>
                        <table   class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User" DIR="RTL">
                            <thead>
                                    <tr>
                                        <th><b>م</b></th>
                                        <td><b>{{ $i++ }}</b></td>
                                    </tr>
                                    <tr>
                                        <th style="background:#92d050">مرتب شهر</b></th>
                                        <td><b>{{ $date_name  }}</b></td>
                                    </tr>
                                    <tr>
                                        <th><b>الكود</b></th>
                                        <td><b>{{ $item->id }}</b></td>
                                    </tr>
                                    <tr>
                                        <th><b>الاسم</b></th>
                                        <td><b>{{ $item->name }}</b></td>
                                    </tr>
                                    <tr>
                                        <th><b>الوظيفه</b></th>
                                        <td><b>{{$item->position}}</b></td>
                                    </tr>
                                    <tr>
                                        <th><b>ايام الحضور</b></th>
                                        <td><b>{{ $item->followUps ? ($item->followUps->first())?$item->followUps->first()->attended_days:'0' : '0' }}</b></td>
                                    </tr>
                                    <tr>
                                        <th><b>راتب يومي</b></th>
                                        <td><b>{{$item->daily_fare }}</b></td>
                                    </tr>
                                    <tr>
                                        <th><b>الاضافي</b></th>
                                        <td><b>{{ $item->incentives->sum('bonus') }}</b></td>
                                    </tr>
                                    <tr>
                                        <th><b>بدل انتظام</b></th>
                                        <td><b>{{ $item->incentives->sum('regularity') }}</b></td>
                                    </tr>
                                    <tr style="background:#c3d69b">
                                        <th >اجمالي الراتب</b></th>
                                        <td><b>{{ $item->daily_fare * ($item->followUps->isNotEmpty() ? (($item->followUps->first())?$item->followUps->first()->attended_days:0) : 0) +
                                            $item->incentives->sum('bonus') +
                                            $item->incentives->sum('incentive') +
                                            $item->incentives->sum('regularity') }}</b></td>
                                    </tr>
                                    <tr>
                                        <th><b>سلف </b></th>
                                        <td><b>{{ $item->employeeBorrowinng->first() ? $item->employeeBorrowinng->first()->amount : 0 }}</b></td>
                                    </tr>
                                    <tr>
                                        <th><b>خصم </b></th>
                                        <td><b>{{ $item->deductions->sum('housing') + $item->deductions->sum('penalty') + $item->deductions->sum('absence') }}</b></td>
                                    </tr>
                                    <tr style="background:#c3d69b">
                                        <th >الصافى</b></th>
                                        <td><b>{{ ($item->daily_fare * ($item->followUps ? (($item->followUps->first())?$item->followUps->first()->attended_days:0) : 0)) +
                                            (($item->incentives->sum('bonus') +
                                            $item->incentives->sum('incentive') +
                                            $item->incentives->sum('regularity'))) -
                                            ($item->deductions->sum('housing') + $item->deductions->sum('penalty') + $item->deductions->sum('absence')+($item->employeeBorrowinng->first() ? $item->employeeBorrowinng->first()->amount : 0) ) }}</b></td>
                                    </tr>
                                </thead>

                            </table>
                        </b></td>
                    </tr>
                    <tr>
                        <th><b></b></th>
                        <td><b></b></td>
                    </tr>
                        @endforeach
                </thead>
                <div class="no-print">
                    {{$followUps->appends($_GET)->links("pagination::bootstrap-4")}}
                </div>
            </table>
        </div>
                    </div>
        {{-- {{ $files->links('vendor.pagination.bootstrap-5') }} --}}
    </div>
@endsection


<script>
    function printContent() {
        var printContent = document.getElementById("print").innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    }
</script>
