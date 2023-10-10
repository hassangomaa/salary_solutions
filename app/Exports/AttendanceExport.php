<?php

namespace App\Exports;


use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
// use Maatwebsite\Excel\Concerns\FromView;
// use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
class AttendanceExport implements FromView , WithEvents
{
    public $period,$month_name;

    public function __construct($period,$month_name)
    {
        $this->period = $period;
        $this->month_name  =$month_name;
    }
    public function view(): View
    {
        $company_id=Session::get('companyId');

        $employees =Employee::where('company_id',$company_id)->get();

        return view('reports.tables.attendance2',['employees'=>$employees,'period'=>$this->period,'month_name'=>$this->month_name]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                /** @var Sheet $sheet */
                $sheet = $event->sheet;

                $styleArray = [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ];

                $fieldName = $event->sheet->getDelegate();
                $event->sheet->freezePane('B3');
                // $event->sheet->freezePane('');

                /******* set columns to autosize *********/
                for ($i = 0; $i <= 20; $i++) {
                    $column = Coordinate::stringFromColumnIndex($i);
                    $event->sheet->getColumnDimension($column)->setAutoSize(true);
                }
                //  center and change background color of header
                $event->sheet->getStyle('A2:AI3')->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'c0504d',
                        ],
                    ],
                ]);

                // $event->sheet->getStyle('A:B')->applyFromArray([
                //     'fill' => [
                //         'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                //         'startColor' => [
                //             'argb' => 'FF30FF00',
                //         ],
                //     ],
                // ]);

            },
        ];
    }


}
