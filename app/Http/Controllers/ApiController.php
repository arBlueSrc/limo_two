<?php

namespace App\Http\Controllers;

use App\Exports\MosExport;
use App\Exports\MosShahrExport;
use App\Exports\SingleResultExport;
use App\Models\masjed;
use App\Models\Ostan;
use App\Models\Shahrestan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ApiController extends Controller
{
    public function check()
    {
//        $masjeds = masjed::all();
//        foreach ($masjeds as $masjed) {
////            $s = Shahrestan::where('name',$masjed->shahrestan)->first();
////            if ($s == null){
////
////
////                $ostan_id = Ostan::where('name', $masjed->ostan)->first() ;
////
////                if ($ostan_id == null){
////                    dd($masjed->ostan);
////                }else{
////                    $ostan_id = $ostan_id->id;
////                }
////
////                Shahrestan::create([
////                    "name" => $masjed->shahrestan,
////                    "ostan" => $ostan_id,
////                    "amar_code" => 10
////                ]);
////
////            }
//
//            $s = Shahrestan::where('name', $masjed->shahrestan)->first();
//            $s_o = Ostan::where('id', $s->ostan)->first();
//
//            if ($s_o->name != $masjed->ostan){
//                $id = Ostan::where('name', $masjed->ostan)->first();
//                if ($id == null) {
//                    dd($masjed->ostan);
//                } else {
//                    $id = $id->id;
//                }
//                $s->update([
//                    "ostan" => $id
//                ]);
//            }
//        }

        echo "hi";
    }

    public function getMos()
    {
        $mos = array();

        $single_result = DB::table('single_result')
            ->select('mosque_id', DB::raw('count(mosque_id) as total'))
            ->groupBy('mosque_id')
            ->get();

        $family_result = DB::table('group_result')
            ->select('mosque_id', DB::raw('count(mosque_id) as total'))
            ->groupBy('mosque_id')
            ->get();

        $group_result = DB::table('family_result')
            ->select('mosque_id', DB::raw('count(mosque_id) as total'))
            ->groupBy('mosque_id')
            ->get();

        $mosqs = masjed::get();

//        $mos_group_hoze = DB::table('masjeds')
//            ->select('mosque_id', DB::raw('count(mosque_id) as total'))
//            ->groupBy('mosque_id')
//            ->get();

        foreach ($mosqs as $item){
            $single_count = $single_result->where('mosque_id', $item->id)->first()->total ?? 0;
            $family_count = $family_result->where('mosque_id', $item->id)->first()->total ?? 0;
            $group_count = $group_result->where('mosque_id', $item->id)->first()->total ?? 0;

            $total = $single_count + ($family_count * 2) + ($group_count * 2);

            if ($total > 49){
                $item->total = $total;
                array_push($mos, $item);
            }
        }

        return Excel::download(new MosExport(collect($mos)), 'mos.xlsx');
    }


    public function getMosShahr()
    {
        $mos = array();

        $single_result = DB::table('single_result')
            ->select('shahrestan_id', DB::raw('count(shahrestan_id) as total'))
            ->groupBy('shahrestan_id')
            ->get();

        $family_result = DB::table('group_result')
            ->select('shahrestan_id', DB::raw('count(shahrestan_id) as total'))
            ->groupBy('shahrestan_id')
            ->get();

        $group_result = DB::table('family_result')
            ->select('shahrestan_id', DB::raw('count(shahrestan_id) as total'))
            ->groupBy('shahrestan_id')
            ->get();

//        $mos_group_hoze = DB::table('masjeds')
//            ->select('mosque_id', DB::raw('count(mosque_id) as total'))
//            ->groupBy('mosque_id')
//            ->get();

        $shahrestan = Shahrestan::all();

        foreach ($shahrestan as $item){

            $single_count = $single_result->where('shahrestan_id', $item->id)->first()->total ?? 0;
            $family_count = $family_result->where('shahrestan_id', $item->id)->first()->total ?? 0;
            $group_count = $group_result->where('shahrestan_id', $item->id)->first()->total ?? 0;

            $total = $single_count + ($family_count * 2) + ($group_count * 2);

            if ($total > 99){
                $item->total = $total;
                $item->ostan_name = Ostan::find($item->ostan)->name;
                array_push($mos, $item);
            }

        }

        return Excel::download(new MosShahrExport(collect($mos)), 'mosshahr.xlsx');
    }
}
