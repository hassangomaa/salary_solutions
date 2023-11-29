<?php

namespace App\Exports;

use App\Models\Employee;
use App\Models\Safe\SafeTransactions;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;

// use Maatwebsite\Excel\Concerns\FromView;
// use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Border;

class safeTransactionsExport implements FromView, WithEvents
{
    public $date, $safe_id;
    public $trashed;

    public function __construct($date, $safe_id, $trashed)
    {
        $this->date = $date;
        $this->safe_id = $safe_id;
        $this->trashed = $trashed;
    }

    public function view(): View
    {

        $date = $this->date;
        $safe_id = $this->safe_id;
        $trashed = $this->trashed;
        $company_id = session()->all()['companyId'];
//    dd($company_id);

        $safes_trans = SafeTransactions::
//        whereBetween('created_at', [Carbon::parse($date)->startOfMonth(), Carbon::parse($date)->endOfMonth()])
          with('safe')->where(function ($q) use ($safe_id) {
                if ((isset($safe_id)) && $safe_id != "")
                    $q->where('safe_id', $safe_id);
            })
//            ->where('company_id', $company_id)
            ->when($this->trashed, function ($q) {
                return $q->onlyTrashed(); // Use onlyTrashed() with a lowercase 'o'
            })
            ->get();
        return view('reports.tables.safe_transctions', ['safes_trans' => $safes_trans]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
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
