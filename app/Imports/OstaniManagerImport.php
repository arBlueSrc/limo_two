<?php

namespace App\Imports;

use App\Models\Ostan;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class OstaniManagerImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {


        if ($row[1] == "استان") {
            return null;
        }

        $check_user_exist = User::where("mobile", 'LIKE', '%' . $row[3] . '%')->exists();

        $ostan = Ostan::where('name', $row[1])->first();

        if ($ostan != null) {
            if ($check_user_exist) {

                $user = User::where("mobile", 'LIKE', '%' . $row[3] . '%')->first()->update([
                    'ostan_id' => $ostan->id,
                    'role' => "2"
                ]);

            } else {

                $user = User::create([
                    'name' => $row[2],
                    'mobile' => $row[3],
                    'ostan_id' => $ostan->id,
                    'role' => "2"
                ]);
            }
        } else {
            return null;
        }


    }

}
