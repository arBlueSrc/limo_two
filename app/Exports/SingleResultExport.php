<?php

namespace App\Exports;

use App\Models\Major;
use App\Models\masjed;
use App\Models\Ostan;
use App\Models\Shahrestan;
use App\Models\SingleResult;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SingleResultExport implements FromCollection,withHeadings,withMapping
{
    public function __construct($data)
    {
        $this->data=$data;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
//        return SingleResult::all();
        return $this->data;
    }
    public function map($row): array
    {
        // TODO: Implement map() method.
        return [
          $row->id,
          $row->name,
          $row->national_code,
          $row->phone,
          Ostan::find($row->ostan_id)->name,
          Shahrestan::find($row->shahrestan_id)->name,
          masjed::find($row->mosque_id)->hoze,
          masjed::find($row->mosque_id)->masjed,
          Major::find($row->major)->name,
          jdate($row->birthday)->format('Y-m-d')
        ];
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
            'id',
            'نام و نام خانوادگی',
            'کد ملی',
            'موبایل',
            'استان',
            'شهرستان',
            'حوزه',
            'مسجد',
            'رشته',
            'تاریخ تولد',
        ];
    }
}
