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
use PhpOffice\PhpSpreadsheet\Style\Border;
class AppositionExport implements FromView , WithEvents
{
    public $month, $year;
    public $trashed;


    public function __construct($month, $year, $trashed)
    {
        $this->month = $month;
        $this->year = $year;
        $this->trashed = $trashed;
    }
    public function view(): View
    {

    $month=$this->month;
    $year=$this->year;
    $company_id=Session::get('companyId');

    $employees=Employee::with([
        "borrows"=>function($q)use($month,$year){
                $q->where('month',$month)->where('year',$year);
        },
        ])->where('company_id',$company_id)->whereYear('created_at','<=',$year)
        ->whereMonth('created_at','<=',$month)
        //if trashed  true then call ->withTrashed() then anyway get()
        ->when($this->trashed, function ($q) {
            return $q->onlyTrashed();
        })
        ->get();

        return view('reports.tables.apposition',['employees'=>$employees]);
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
