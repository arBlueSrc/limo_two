<?php

namespace App\Http\Controllers;

use App\Exports\GroupResultExport;
use App\Models\GroupResult;
use App\Models\masjed;
use App\Models\Ostan;
use App\Models\Shahrestan;
use App\Models\SingleResult;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GroupController extends Controller
{
    public function index()
    {
        $users=GroupResult::paginate(10);
        $excel_data=SingleResult::all();
        $ostans=Ostan::all();
        $shahrestans=Shahrestan::where('ostan',$ostans->first()->id)->get();
        return view('admin.group.index',compact('users','ostans','shahrestans'));
    }
    public function show(GroupResult $user)
    {
//        dd($user->mosque()->first());
        return view('admin.group.show',compact('user'));
    }
    public function filterUsers(Request $request)
    {
        $selected=[];
        $masjeds=null;
//        dd($request->all());
        if ($request->ostan){
            $users=GroupResult::where('ostan_id',$request->ostan);
            $selected['ostan']=$request->ostan;

            if ($request->shahrestan){
                $users=$users->where('shahrestan_id',$request->shahrestan);
                $selected['shahrestan']=$request->shahrestan;
            }
            if ($request->mosque){
                $selected['mosque']=$request->mosque;
                $users=$users->where('mosque_id',$request->mosque);
            }
        }
        else{
            $users=GroupResult::query();
        }
//        UserController::$excel_data=$users->get();
        $excel_data=$users->get();
        session()->flash('excel',$excel_data);
//        dd($excel_data);
        $users=$users->paginate(10);


        $ostans=Ostan::all();
//        dd(isset($selected['shahrestan']));

        if ( isset( $selected['ostan']) ){
            $shahrestans = Shahrestan::where('ostan', $selected['ostan'])->get();
//            dd($shahrestans);
        }
        else {
            $shahrestans = Shahrestan::where('ostan', $ostans->first()->id)->get();
//            dd($shahrestans);
        }
        if (isset($selected['shahrestan'])){
            $shahrestan_name=Shahrestan::where('id',$selected['shahrestan'])->first()->name;
            $masjeds=masjed::where('shahrestan',"LIKE",$shahrestan_name)->get();
        }

        //        dd($shahrestans);
//        $users = User::paginate(15);
//        return redirect()->back()->with(['users'=>$users,'ostans'=>$ostans,'shahrestans'=>$shahrestans]);
        return view('admin.group.index',compact('users','ostans','shahrestans','selected','masjeds','excel_data'));
    }

    public function exportAllGroups()
    {
        $excel_data=GroupResult::all();
        return Excel::download(new GroupResultExport($excel_data), 'users.xlsx');
    }
}
