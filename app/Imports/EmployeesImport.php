<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeesImport implements ToModel,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    protected $companyId;
    public function __construct($companyId)
    {
        $this->companyId = $companyId;
    }


    public function model(array $row)
    {
//        dd($row);
               return new Employee([
          'name' => $row['asm_almothf'],
          'position'=> $row['rtbh_almothf'],
          'daily_fare' => $row['agr_alyomy'],
          'overtime_hour_fare' => $row['agr_alsaaa_aladafy'],
          'phone'=> $row['hatf_almothf'],
          'address'=> $row['aanoan_almothf'],
          'company_id' => $this->companyId
      ]);

    }
}
