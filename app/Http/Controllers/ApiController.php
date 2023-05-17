<?php

namespace App\Http\Controllers;

use App\Models\masjed;
use App\Models\Ostan;
use App\Models\Shahrestan;

class ApiController extends Controller
{
    public function check()
    {
        $masjeds = masjed::all();
        foreach ($masjeds as $masjed) {
//            $s = Shahrestan::where('name',$masjed->shahrestan)->first();
//            if ($s == null){
//
//
//                $ostan_id = Ostan::where('name', $masjed->ostan)->first() ;
//
//                if ($ostan_id == null){
//                    dd($masjed->ostan);
//                }else{
//                    $ostan_id = $ostan_id->id;
//                }
//
//                Shahrestan::create([
//                    "name" => $masjed->shahrestan,
//                    "ostan" => $ostan_id,
//                    "amar_code" => 10
//                ]);
//
//            }

            $s = Shahrestan::where('name', $masjed->shahrestan)->first();
            $s_o = Ostan::where('id', $s->ostan)->first();

            if ($s_o->name != $masjed->ostan){
                $id = Ostan::where('name', $masjed->ostan)->first();
                if ($id == null) {
                    dd($masjed->ostan);
                } else {
                    $id = $id->id;
                }
                $s->update([
                    "ostan" => $id
                ]);
            }

        }
    }
}
