<?php

namespace App\Exports;

use App\Models\CompanyPayment;
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

class ExpensesExport implements FromView, WithEvents
{
    public $date;
    public $trashed;
    public $request;

    public function __construct($date, $request, $trashed)
    {
        $this->date = $date;
        $this->trashed = $trashed;
        $this->request = $request;

    }

    public function view(): View
    {
        $date = $this->date;
        $company_id = Session::get('companyId');

        $expenses = CompanyPayment::whereBetween('created_at',
            [
                Carbon::parse($date)->startOfMonth(),
                Carbon::parse($date)->endOfMonth()
            ])
            ->where('company_id', $company_id)
            ->when($this->trashed, function ($q) {
                return $q->onlyTrashed(); // Use onlyTrashed() with a lowercase 'o'
            })
            ->get();


        return view('reports.tables.expenses', ['expenses' => $expenses]);
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                /** @var Sheet $sheet */
                $sheet = $event->sheet;

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
