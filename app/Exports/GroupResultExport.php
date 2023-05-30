<?php

namespace App\Exports;

use App\Models\GroupResult;
use App\Models\Major;
use App\Models\masjed;
use App\Models\Ostan;
use App\Models\Shahrestan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class GroupResultExport implements FromCollection,withHeadings,withMapping
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
        return $this->data;
    }
    public function map($row): array
    {
        // TODO: Implement map() method.
        return [
            $row->id,
            $row->name_group,
            $row->ostan()->first()->name ?? "",
            $row->shahrestan()->first()->name ?? "",
            $row->mosque()->first()->hoze,
            $row->mosque()->first()->masjed,
            $row->type == 1 ?  "شرکت به صورت مدل اول (هر فرد یک تکلیف)" : "شرکت به صورت مدل دوم (حفظ گروهی سوره مبارکه الرحمن)",
            $row->head_name,
            $row->head_national_code,
            $row->head_phone,
            jdate($row->birthday)->format('Y-m-d'),
            $row->second_name,
            $row->second_phone,
            $row->third_name,
            $row->third_phone,
            /*Ostan::find($row->ostan_id)->name,
            Shahrestan::find($row->shahrestan_id)->name,
            masjed::find($row->mosque_id)->hoze,
            masjed::find($row->mosque_id)->masjed,
            Major::find($row->major)->name,
            jdate($row->birthday)->format('Y-m-d')*/
        ];
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
            'شناسه',
            'نام گروه',
            'استان',
            'شهرستان',
            'حوزه',
            'مسجد',
            'مدل شرکت گروه',
            'نام و نام خانوادگی سرگروه',
            'کد ملی سرگروه',
            'شماره تماس سرگروه',
            'تاریخ تولد سرگروه',
            'نام و نام خانوادگی نفر دوم',
            'شماره تماس نفر دوم',
            'نام و نام خانوادگی نفر سوم',
            'شماره تماس نفر سوم',
        ];
    }
}
