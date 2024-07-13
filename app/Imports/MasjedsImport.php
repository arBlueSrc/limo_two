<?php

namespace App\Imports;

use App\Models\Masjed;
use App\Models\Ostan;
use App\Models\Shahrestan;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class MasjedsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $message = "";

        if ($row[1] == "استان"){
            return null;
        }

        $data=Masjed::where('shahrestan','LIKE','%'.$row[2].'%')->where('masjed','LIKE','%'.$row[4].'%')->where('gender','LIKE','%'.$row[5].'%')->first();

        if (isset($data)){
            return null;
        } else{

            $masjed = Masjed::create([
                'ostan'=>"test",
                'shahrestan'=>"test",
                'hoze'=>"test",
                'gender'=>"test",
                'masjed'=>"test",
            ]);

            $check_user_exist = User::where("mobile",'LIKE','%'.$row[7].'%')->exists();

            $ostan = Ostan::where('name', $row[1])->first();
            $shahrestan = Shahrestan::where('name', $row[2])->first();

            if ($ostan == null){
                dd("اسم استان در ردیف ".$row[0]." خطا دارد.");
                return null;
            }

            if ($shahrestan == null){

                $shahrestan = Shahrestan::create([
                    "name" => $row[2],
                    "ostan" => $ostan->id,
                    "amar_code" => "100"
                ]);
                //dd("اسم شهرستان در ردیف ".$row[0]." خطا دارد.") ;
//                return null;
            }

            if ($check_user_exist){

                User::where("mobile",'LIKE','%'.$row[7].'%')->first()->update([
                    'masjed_id'=>$masjed->id,
                    'ostan_id'=>$ostan->id,
                    'shahrestan_id'=>$shahrestan->id,
                    'role'=>"3"
                ]);

            }else{

                User::create([
                    'name'=>$row[6],
                    'mobile'=>$row[7],
                    'masjed_id'=>$masjed->id,
                    'ostan_id'=>$ostan->id,
                    'shahrestan_id'=>$shahrestan->id,
                    'role'=>"3"
                ]);

            }

            return $masjed;
        }
    }
}
