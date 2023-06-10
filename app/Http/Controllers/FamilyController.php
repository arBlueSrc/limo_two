<?php

namespace App\Http\Controllers;

use App\Exports\FamilyResultExport;
use App\Exports\GroupResultExport;
use App\Models\FamilyResult;
use App\Models\GroupResult;
use App\Models\masjed;
use App\Models\Ostan;
use App\Models\Shahrestan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FamilyController extends Controller
{
    public function index(Request $request){
        $current_user=auth()->user();
        $selected=null;
        if ($current_user->isOstaniAdmin()){
            // ostani admin
            $users=FamilyResult::where('ostan_id',$current_user->ostan_id)->paginate(10);
            $ostans=Ostan::where('id',$current_user->ostan_id)->get();
            $shahrestans=Shahrestan::where('ostan',$current_user->ostan_id)->get();
            $request->ostan=auth()->user()->ostan_id;
            $selected['ostan'] = $ostans->first()->id;
        }
        else{
            $users = FamilyResult::paginate(10);
            $ostans = Ostan::all();
            $shahrestans = Shahrestan::where('ostan', $ostans->first()->id)->get();
        }
        return view('admin.family.index',compact('users','ostans','shahrestans','selected'));
        }
        public function show(FamilyResult $user){
            return view('admin.family.show',compact('user'));
        }
        public function filterUsers(Request $request){
            if (auth()->user()->isOstaniAdmin()){
                $request->ostan=auth()->user()->ostan_id;
            }
            return redirect()->route('family.search.show')->with(['ostan'=>$request->ostan,'shahrestan'=>$request->shahrestan,'mosque'=>$request->mosque]);
        }
        public function filterFamiliesShow(Request $request){
            $selected = [];
            $masjeds = null;
//        dd($request->all());
            if ($request->session()->get('ostan')) {
                $users = FamilyResult::where('ostan_id', $request->session()->get('ostan'));
                $selected['ostan'] = $request->session()->get('ostan');

                if ($request->session()->get('shahrestan')) {
                    $users = $users->where('shahrestan_id', $request->session()->get('shahrestan'));
                    $selected['shahrestan'] = $request->session()->get('shahrestan');
                }
                if ($request->session()->get('mosque')) {
                    $selected['mosque'] = $request->session()->get('mosque');
                    $users = $users->where('mosque_id', $request->session()->get('mosque'));
                }
            } else {
                $users = FamilyResult::query();
            }
//        UserController::$excel_data=$users->get();
            $excel_data = $users->get();
            session()->flash('excel', $excel_data);
//        dd($excel_data);
            $users = $users->paginate(10);

            $ostans = Ostan::all();
//        dd(isset($selected['shahrestan']));

            if (isset($selected['ostan'])) {
                $shahrestans = Shahrestan::where('ostan', $selected['ostan'])->get();
//            dd($shahrestans);
            } else {
                $shahrestans = Shahrestan::where('ostan', $ostans->first()->id)->get();
//            dd($shahrestans);
            }
            if (isset($selected['shahrestan'])) {
                $shahrestan_name = Shahrestan::where('id', $selected['shahrestan'])->first()->name;
                $masjeds = masjed::where('shahrestan', "LIKE", $shahrestan_name)->get();
            }
            $request->session()->keep(['ostan', 'shahrestan','mosque']);
            //        dd($shahrestans);
//        $users = User::paginate(15);
//        return redirect()->back()->with(['users'=>$users,'ostans'=>$ostans,'shahrestans'=>$shahrestans]);
            return view('admin.family.index', compact('users', 'ostans', 'shahrestans', 'selected', 'masjeds', 'excel_data'));
        }
        public function exportAllFamilies(){
            $excel_data = FamilyResult::all();
            return Excel::download(new FamilyResultExport($excel_data), 'users.xlsx');
        }
}
