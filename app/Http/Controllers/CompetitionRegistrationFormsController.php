<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\masjed;
use App\Models\Ostan;
use App\Models\Shahrestan;
use Illuminate\Http\Request;

class CompetitionRegistrationFormsController extends Controller
{
    public function individualForm(){
//        $ostans = Ostan::all();
        $ostans = Ostan::where('id',8)->get();
        $shahrestans = Shahrestan::where('ostan',$ostans->first()->id)->get();
        $majors=Major::all();
        return view('form.IndividualForm',compact('ostans','shahrestans','majors'));
    }

    public function groupForm(){
//        $ostans = Ostan::all();
        $ostans = Ostan::where('id',8)->get();
        $shahrestans = Shahrestan::where('ostan',$ostans->first()->id)->get();
        return view('form.groupForm',compact('ostans','shahrestans'));
    }
    public function familyForm(){
//        $ostans = Ostan::all();
        $ostans = Ostan::where('id',8)->get();
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
            'shahrestan_id'=>'required'
        ]);

        $shahrestan_name=Shahrestan::where('id',$data['shahrestan_id'])->first()->name;
//        return $shahrestan_name;

//        dd($shahrestan_name);

        $masjeds=masjed::where('shahrestan',"LIKE",$shahrestan_name)->get();

        return $masjeds;
    }


}
