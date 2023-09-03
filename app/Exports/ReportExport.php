<?php

namespace App\Exports;

use App\Models\FollowUp;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportExport implements WithHeadings,WithMapping,FromCollection,WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $companyId;
    protected $year;
    protected $month;

    public function __construct($companyId, $month, $year)
    {
        $this->companyId = $companyId;
        $this->month = $month;
        $this->year = $year;
    }

    public function collection()
    {
        return FollowUp::with('employee')
            ->whereHas('employee', function ($query) {
                $query->where('company_id', $this->companyId);
            })
            ->where('month', $this->month)
            ->where('year', $this->year)
            ->get();
    }

    public function map($followUp): array
    {
        return [
            $followUp->employee->name,
            $followUp->employee->position,
            $followUp->attended_days == 0 ? '0' : $followUp->attended_days,
            $followUp->daily_wages_earned == 0 ? '0' : $followUp->daily_wages_earned,
            $followUp->extra_hours == 0 ? '0' : $followUp->extra_hours,
            $followUp->total_extras == 0 ? '0' : $followUp->total_extras,
            $followUp->incentives == 0 ? '0' : $followUp->incentives,
            $followUp->incentives == 0 ? '0' : $followUp->total_salary,
            $followUp->borrows == 0 ? '0' : $followUp->borrows,
            $followUp->deductions == 0 ? '0' : $followUp->deductions,
            $followUp->net_salary == 0 ? '0' : $followUp->net_salary,

        ];
    }


    public function headings(): array
    {
       return [
           'Employee Name',
           'Position',
           'Attended Days',
           'Earned Wages',
           'Extra Hours',
           'Total Extras',
           'Incentives',
           'Total Salary',
           'Borrows',
           'Deductions',
           'Net Salary',
       ];
    }

    public function styles(Worksheet $sheet)
    {
        $totalColumns = 11; // Change this to the actual number of columns
        $totalWidth = 187;  // Total width in characters

        $columnWidth = $totalWidth / $totalColumns;

        // Set equal width for each column
        for ($i = 1; $i <= $totalColumns; $i++) {
            $sheet->getColumnDimensionByColumn($i)->setWidth($columnWidth);

        }

    }


}
