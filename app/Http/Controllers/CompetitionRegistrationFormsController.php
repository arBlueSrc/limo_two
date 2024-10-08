<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Masjed;
use App\Models\Ostan;
use App\Models\Shahrestan;
use Illuminate\Http\Request;

class CompetitionRegistrationFormsController extends Controller
{
    public function individualForm(){
        $ostans = Ostan::where('id',8)->get();
        $shahrestans = Shahrestan::where('ostan',$ostans->first()->id)->get();
        $majors=Major::all();
        $masjeds = Masjed::where('ostan', $ostans->get(0)->name)->where('shahrestan', $shahrestans->get(0)->name)->where('gender', "!=", "خواهر")->get();

        return view('form.IndividualForm',compact('ostans','shahrestans','majors','masjeds'));
    }

    public function groupForm(){
        $ostans = Ostan::where('id',8)->get();
//        $ostans = Ostan::where('id',8)->get();
        $shahrestans = Shahrestan::where('ostan',$ostans->first()->id)->get();
        return view('form.groupForm',compact('ostans','shahrestans'));
    }

    public function familyForm(){
        $ostans = Ostan::where('id',8)->get();
//        $ostans = Ostan::where('id',8)->get();
        $shahrestans = Shahrestan::where('ostan',$ostans->first()->id)->get();
        return view('form.familyForm',compact('ostans','shahrestans'));
    }

    public function getChildShahrestans(Request $request)
    {
        //geting shahrestans by ajax request
        if(! $request->ajax()) {
            return response()->json([
                'status' => 'not ajax request',
            ]);
        }
        $valid_data=$request->validate([
            'ostan_id'=>['required']
        ]);
        $childShahrestans=Shahrestan::where('ostan',$valid_data['ostan_id'])->get();
        return $childShahrestans;
    }

    public function getRelatedMasjeds(Request $request)
    {

        if(! $request->ajax()) {
            return response()->json([
                'status' => 'not ajax request',
            ]);
        }
        $data=$request->validate([
            'shahrestan_id'=>'required',
            'gender'=>''
        ]);

        $shahrestan_name=Shahrestan::where('id',$data['shahrestan_id'])->first()->name;

        if ($request->gender == null){
            $masjeds=Masjed::where('shahrestan',"LIKE",$shahrestan_name)->get();
        }else{
            switch ($data['gender']) {
                case "1":
                    $gender_filter = "برادر";
                    break;
                case "0":
                    $gender_filter = "خواهر";
                    break;
                default:
                    $gender_filter = "برادر";
            }
            $masjeds=Masjed::where('shahrestan',"LIKE",$shahrestan_name)->whereIn('gender',[$gender_filter, "مشترک"])->get();
         }

        return $masjeds;

    }


    public function getRelatedMajors(Request $request)
    {

        if(! $request->ajax()) {
            return response()->json([
                'status' => 'not ajax request',
            ]);
        }

        $data=$request->validate([
            'year'=>'required',
            'gender'=>'required'
        ]);

        $majors=Major::where('from_year',"<=",$data['year'])->Where('to_year',">=",$data['year'])->whereIn('gender',[$data['gender'], 2])->get();

        return $majors;

    }



}
