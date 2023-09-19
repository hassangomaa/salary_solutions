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
<table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User"DIR="RTL">
                <thead>
                    <tr>
                        <th colspan="5">مرتبات شهر</th>
                        <th colspan="10" style="text-align:center">
                            {{ $date }}
                        </th>
                    </tr>

                    <tr>
                        <th>م</th>
                        <th>الكود</th>
                        <th>مرتب شهر</th>
                        <th>الاسم</th>
                        <th>الوظيفه</th>
                        <th>راتب شهري</th>
                        <th>ايام الحضور</th>
                        <th>راتب يومي</th>
                        <th>الاضافي</th>
                        <th>حافز انتاج</th>
                        <th>بدل انتظام</th>
                        <th>اجمالي الراتب</th>
                        <th>سلف</th>
                        <th>خصم</th>
                        <th>صافي الراتب</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($followUps as $item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $item->id }}</td>
                            <td>{{ $date }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->position }}</td>
                            <td>0</td>
                            <td>{{ $item->followUps ? ($item->followUps->first())?$item->followUps->first()->attended_days:'0' : '0' }}</td>
                            @php
                                $days += $item->followUps ? (($item->followUps->first())?$item->followUps->first()->attended_days:0) : 0;
                            @endphp
                            <td>{{ $item->daily_fare }}</td>
                            <td>{{ $item->incentives->sum('bonus') }}</td>
                            <td>{{ $item->incentives->sum('incentive') }}</td>
                            <td>{{ $item->incentives->sum('regularity') }}</td>
                            @php
                                $bouns += $item->incentives->sum('bonus');
                                $inc += $item->incentives->sum('incentive');
                                $regural += $item->incentives->sum('regularity');
                            @endphp
                            <td>
                                {{ $item->daily_fare * ($item->followUps->isNotEmpty() ? (($item->followUps->first())?$item->followUps->first()->attended_days:0) : 0) +
                                    $item->incentives->sum('bonus') +
                                    $item->incentives->sum('incentive') +
                                    $item->incentives->sum('regularity') }}
                            </td>
                            <td>{{ $item->employeeBorrowinng->first() ? $item->employeeBorrowinng->first()->amount : 0 }}
                            </td>
                            <td>{{ $item->deductions->sum('housing') + $item->deductions->sum('penalty') + $item->deductions->sum('absence') }}
                            </td>
                            <td>
                                {{ ($item->daily_fare * ($item->followUps ? (($item->followUps->first())?$item->followUps->first()->attended_days:0) : 0)) +
                                    (($item->incentives->sum('bonus') +
                                    $item->incentives->sum('incentive') +
                                    $item->incentives->sum('regularity'))) -
                                    ($item->deductions->sum('housing') + $item->deductions->sum('penalty') + $item->deductions->sum('absence')+($item->employeeBorrowinng->first() ? $item->employeeBorrowinng->first()->amount : 0) )
                                     }}
                            </td>
                            @php
                                $total_salary += $item->daily_fare * ($item->followUps->isNotEmpty() ? (($item->followUps->first())?$item->followUps->first()->attended_days:0) : 0) +
                                    $item->incentives->sum('bonus') +
                                    $item->incentives->sum('incentive') +
                                    $item->incentives->sum('regularity');

                                $borrows += $item->employeeBorrowinng->first() ? $item->employeeBorrowinng->first()->amount : 0;
                                $deduction += $item->deductions->sum('housing') + $item->deductions->sum('penalty') + $item->deductions->sum('absence');
                                $net_salary += ($item->daily_fare * ($item->followUps ? (($item->followUps->first())?$item->followUps->first()->attended_days:0) : 0)) +
                                    (($item->incentives->sum('bonus') +
                                    $item->incentives->sum('incentive') +
                                    $item->incentives->sum('regularity'))) -
                                    ($item->deductions->sum('housing') + $item->deductions->sum('penalty') + $item->deductions->sum('absence')+($item->employeeBorrowinng->first() ? $item->employeeBorrowinng->first()->amount : 0) )
                                     
                            @endphp

                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>{{ $days }}</b></td>
                        <td></td>
                        <td><b>{{ $bouns }}</b></td>
                        <td><b>{{ $inc }}</b></td>
                        <td><b>{{ $regural }}</b></td>
                        <td><b>{{ $total_salary }}</b></td>
                        <td><b>{{ $borrows }}</b></td>
                        <td><b>{{ $deduction }}</b></td>
                        <td><b>{{ $net_salary }}</b></td>
                    </tr>

                </tbody>
            </table>
