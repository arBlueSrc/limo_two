<?php

namespace App\Imports;

use App\Models\Ostan;
use App\Models\Shahrestan;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class ShahrestaniManagerImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $message = "";

        if ($row[1] == "استان") {
            return null;
        }

        $check_user_exist = User::where("mobile", 'LIKE', '%' . $row[4] . '%')->exists();

        $ostan = Ostan::where('name', $row[1])->first();
        $shahrestan = Shahrestan::where('name', $row[2])->first();

        if ($ostan == null) {
            return null;
        }

        if ($shahrestan == null) {

            $shahrestan = Shahrestan::create([
                "name" => $row[2],
                "ostan" => $ostan->id,
                "amar_code" => "100"
            ]);

        }

        if ($check_user_exist) {

            $user = User::where("mobile", 'LIKE', '%' . $row[4] . '%')->first()->update([
                'ostan_id' => $ostan->id,
                'shahrestan_id' => $shahrestan->id,
                'role' => "4"
            ]);

        } else {

            $user = User::create([
                'name' => $row[3],
                'mobile' => $row[4],
                'ostan_id' => $ostan->id,
                'shahrestan_id' => $shahrestan->id,
                'role' => "4"
            ]);

        }

        return null;

    }
}
