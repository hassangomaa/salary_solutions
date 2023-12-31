<?php

namespace App\Exports;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
// use Maatwebsite\Excel\Concerns\FromView;
// use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class SalariesExport implements FromView , WithEvents
{
    public $month;
    public $year;
    public $month_salary;
    public $request;
    //trashed
    public $trashed;
    public function __construct($month, $year, $month_salary, Request $request, $trashed)
    {
        $this->month = $month;
        $this->year = $year;
        $this->month_salary = $month_salary;
        $this->request = $request;
        $this->trashed = $trashed;
    }

    public function view(): View
    {
        $company_id = session()->all()['companyId'];
        $month = $this->month;
        $year = $this->year;

        $followUps = Employee::with([

            'followUps' => function ($q) use ($month, $year) {
                $q->where('month', $month)->where('year', $year);
            },
            "deductions" => function ($dq) use ($month, $year) {
                $dq->where('month', $month)->where('year', $year);
            },
            "incentives" => function ($qi) use ($month, $year) {
                $qi->where('month', $month)->where('year', $year);
            },
            "employeeBorrowinng" => function ($qb) use ($month, $year) {
                $qb->whereHas('date', function ($subq) use ($month, $year) {
                    $subq->where('month', $month)->where('year', $year);
                });
            },
        ])
            ->where('company_id', $company_id)
            ->whereYear('created_at', '<=', $year)
            ->whereMonth('created_at', '<=', $month)
            //if trashed  true then call ->withTrashed() then anyway get()
            ->when($this->trashed, function ($q) {
                return $q->onlyTrashed();
            })
            ->get();



        return view('reports.tables.salaries', [
            'followUps' => $followUps,
            'date' => $this->month_salary,
            'i' => $i = 1,
            'request' => $this->request, // Pass the request to the view
        ]);
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
                $event->sheet->getStyle('A3:O3')->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => '92d050',
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
