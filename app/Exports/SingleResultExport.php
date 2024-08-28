<?php

namespace App\Exports;

use App\Models\Major;
use App\Models\Masjed;
use App\Models\Ostan;
use App\Models\Shahrestan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SingleResultExport implements FromCollection, withHeadings, withMapping
{
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->data;
    }

    public function map($row): array
    {

        $gender = "مرد";
        if ($row->gender == 0){
            $gender = "زن";
        }

        return [
            $row->id,
            $row->name,
            $row->national_code,
            $row->phone,
            $gender,
            $row->job,
            Ostan::find($row->ostan_id)->name,
            Shahrestan::find($row->shahrestan_id)->name ?? "",
            Masjed::find($row->mosque_id)->hoze ?? "",
            Masjed::find($row->mosque_id)->masjed ?? "",
            Major::find($row->major)->name,
            jdate($row->birthday)->format('Y-m-d')
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'نام و نام خانوادگی',
            'کد ملی',
            'موبایل',
            'جنسیت',
            'شغل',
            'استان',
            'شهرستان',
            'حوزه',
            'مسجد',
            'رشته',
            'تاریخ تولد',
        ];
    }


}
