<?php

namespace App\Exports;

use App\Models\Masjed;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MosExport implements FromCollection,withHeadings,withMapping
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
        return [
          $row->id,
          $row->ostan,
          $row->shahrestan,
          $row->hoze,
          $row->Masjed,
          $row->total
        ];
    }

    public function headings(): array
    {
        return [
            'شناسه',
            'استان',
            'شهرستان',
            'حوزه',
            'مسجد',
            'تعداد ثبت نام'
        ];
    }
}
