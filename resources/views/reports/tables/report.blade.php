
<table DIR="RTL" >
    <thead>
        <tr>
            <th>مجموع الموظفين</th>
            <td>{{ $followUps->count() }}</td>
        </tr>
        @foreach ($followUps as $item)
        <tr>
            <td>
            <table border="2" DIR="RTL" >
                <thead>
                        <tr>
                            <td ><b>{{ $i++ }}</b></td>
                            <th><b>م</b></th>
                        </tr>
                        <tr>
                            <td><b>{{ $date_name  }}</b></td>
                            <th style="background:#92d050"><b>مرتب شهر</b></th>
                        </tr>
                        <tr>
                            <td><b>{{ $item->id }}</b></td>
                            <th><b>الكود</b></th>
                        </tr>
                        <tr>
                            <td><b>{{ $item->name }}</b></td>
                            <th><b>الاسم</b></th>
                        </tr>
                        <tr>
                            <td><b>{{$item->position}}</b></td>
                            <th><b>الوظيفه</b></th>
                        </tr>
                        <tr>
                            <td><b>{{ $item->followUps ? ($item->followUps->first())?$item->followUps->first()->attended_days:'0' : '0' }}</b></td>
                            <th><b>ايام الحضور</b></th>
                        </tr>
                        <tr>
                            <td><b>{{$item->daily_fare }}</b></td>
                            <th><b>راتب يومي</b></th>
                        </tr>
                        <tr>
                            <td><b>{{ $item->incentives->sum('bonus') }}</b></td>
                            <th><b>الاضافي</b></th>
                        </tr>
                        <tr>
                            <td><b>{{ $item->incentives->sum('regularity') }}</b></td>
                            <th><b>بدل انتظام</b></th>
                        </tr>
                        <tr >
                            <td style="background:#c3d69b"><b>{{ $item->daily_fare * ($item->followUps->isNotEmpty() ? (($item->followUps->first())?$item->followUps->first()->attended_days:0) : 0) +
                                $item->incentives->sum('bonus') +
                                $item->incentives->sum('incentive') +
                                $item->incentives->sum('regularity') }}</b></td>
                        <th style="background:#c3d69b"><b>اجمالي الراتب</b></th>
                        </tr>
                        <tr>
                            <td><b>{{ $item->employeeBorrowinng->first() ? $item->employeeBorrowinng->first()->amount : 0 }}</b></td>
                            <th><b>سلف </b></th>
                        </tr>
                        <tr>
                            <td><b>{{ $item->deductions->sum('housing') + $item->deductions->sum('penalty') + $item->deductions->sum('absence') }}</b></td>
                            <th><b>خصم </b></th>
                        </tr>
                        <tr >
                            <td style="background:#c3d69b"><b>{{ ($item->daily_fare * ($item->followUps ? (($item->followUps->first())?$item->followUps->first()->attended_days:0) : 0)) +
                                (($item->incentives->sum('bonus') +
                                $item->incentives->sum('incentive') +
                                $item->incentives->sum('regularity'))) -
                                ($item->deductions->sum('housing') + $item->deductions->sum('penalty') + $item->deductions->sum('absence')+($item->employeeBorrowinng->first() ? $item->employeeBorrowinng->first()->amount : 0) ) }}</b></td>
                        <th style="background:#c3d69b"><b>الصافى</b></th>
                        </tr>
                    </thead>

                </table>
            </td>
        </tr>
        <tr>
            <th>--</th>
            <td>--</td>
        </tr>
            @endforeach

    </thead>
</table>
