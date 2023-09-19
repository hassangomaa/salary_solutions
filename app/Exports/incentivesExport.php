<?php

namespace App\Exports;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
// use Maatwebsite\Excel\Concerns\FromView;
// use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Border;
class incentivesExport implements FromView , WithEvents
{
    public $month, $year;

    public function __construct($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
    }
    public function view(): View
    {

    $month=$this->month;
    $year=$this->year;

    $employees=Employee::with([
        "incentives"=>function($q)use($month,$year){
                $q->where('month',$month)->where('year',$year);
        },
        ])->get();

        return view('reports.tables.incentives',['employees'=>$employees]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                /** @var Sheet $sheet */
                $sheet = $event->sheet;

                $event->sheet->freezePane('A2');

                /******* set columns to autosize *********/
                for ($i = 0; $i <= 20; $i++) {
                    $column = Coordinate::stringFromColumnIndex($i);
                    $event->sheet->getColumnDimension($column)->setAutoSize(true);
                }

                $styleArray = [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ];
                return [
                    AfterSheet::class => function (AfterSheet $event) {
                        $event->sheet->getStyle('A1:B199') // Modify the cell range as per your table
                            ->getBorders()
                            ->getAllBorders()
                            ->setBorderStyle(Border::BORDER_THIN);
                    },
                ];



            },
        ];
    }


}
