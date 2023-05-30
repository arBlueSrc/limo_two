<?php

namespace App\Exports;

use App\Models\FamilyResult;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FamilyResultExport implements FromCollection,withHeadings,withMapping
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
            $row->name,
            $row->ostan()->first()->name ?? "",
            $row->shahrestan()->first()->name ?? "",
            $row->mosque()->first()->hoze,
            $row->mosque()->first()->masjed,
            $row->father_name,
            $row->father_national_code,
            jdate($row->birthdate)->format('Y-m-d'),
            $row->father_phone,
            $row->mother_name,
            $row->mother_phone,
            $row->childs[0]->name ?? "",
            isset($row->childs[0]->birthdate)? jdate($row->childs[0]->birthdate)->format('Y-m-d') : "",
            $row->childs[1]->name ?? "",
            isset($row->childs[1]->birthdate)? jdate($row->childs[1]->birthdate)->format('Y-m-d') : "",
            $row->childs[2]->name ?? "",
            isset($row->childs[2]->birthdate)? jdate($row->childs[2]->birthdate)->format('Y-m-d') : "",
            $row->childs[3]->name ?? "",
            isset($row->childs[3]->birthdate)? jdate($row->childs[3]->birthdate)->format('Y-m-d') : ""
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
            'نام خانواده',
            'استان',
            'شهرستان',
            'حوزه',
            'مسجد',
            'نام و نام خانوادگی پدر خانواده',
            'کد ملی پدر خانواده',
            'تاریخ تولد پدر خانواده',
            'شماره تماس پدر خانواده',
            'نام و نام خانوادگی مادر خانواده',
            'شماره تماس مادر خانواده',
            'نام فرزند اول',
            'تاریخ تولد فرزند اول',
            'نام فرزند دوم',
            'تاریخ تولد فرزند دوم',
            'نام فرزند سوم',
            'تاریخ تولد فرزند سوم',
            'نام فرزند چهارم',
            'تاریخ تولد فرزند چهارم',
        ];
    }
}
