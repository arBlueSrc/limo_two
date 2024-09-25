<?php

namespace App\Http\Controllers;

use App\Exports\MosExport;
use App\Exports\MosShahrExport;
use App\Exports\SingleResultExport;
use App\Models\FamilyResult;
use App\Models\GroupResult;
use App\Models\Masjed;
use App\Models\Ostan;
use App\Models\Shahrestan;
use App\Models\SingleResult;
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

        $mosqs = Masjed::get();

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


    public function deleteRep()
    {
        $masjeds = Masjed::all();
        foreach ($masjeds as $ms){

            $repetitive = Masjed::where("ostan", $ms->ostan)
                ->where("shahrestan", $ms->shahrestan)
                ->where("hoze", $ms->hoze)
                ->where("gender", $ms->gender)
                ->where("masjed", $ms->masjed)
                ->where("id" , "!=" , $ms->id)
                ->get();

            if (sizeof($repetitive) != 0){
                foreach ($repetitive as $rep){


                    //check in results
                    $single = SingleResult::where('mosque_id', $rep->id)->first();
                    if ($single != null){
                        $single->mosque_id = $ms->id;
                        $single->save();
                    }

                    //check in group
                    $group = GroupResult::where('mosque_id', $rep->id)->first();
                    if ($group != null){
                        $group->mosque_id = $ms->id;
                        $group->save();
                    }

                    //check in family
                    $family = FamilyResult::where('mosque_id', $rep->id)->first();
                    if ($group != null){
                        $group->mosque_id = $ms->id;
                        $group->save();
                    }

                    $rep->delete();
                }
            }

        }

        echo "Done!";
    }



    public function checkPeyk()
    {

        $text = "تست";
        $phone = "09127305627";

        $url = 'https://peyk313.ir/API/V1.0.0/Send.ashx';
        $dataArray = array(
            'privateKey' => "67d84858-50c4-4dd1-9ad1-c4f1ae758462",
            'number' => "660005",
            'text' => $text,
            'isFlash' => "true",
            'udh' => 1,
            'mobiles' => $phone,
            'clientIDs' => 1,
        );
        $data = http_build_query($dataArray);

        $getUrl = $url . "?" . $data;

        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $contents = file_get_contents($getUrl, false, stream_context_create($arrContextOptions));

        $response = json_decode($contents, true);

        dd($response);

    }

}
