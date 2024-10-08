<?php

namespace App\Http\Controllers;

use App\Exports\FamilyResultExport;
use App\Models\FamilyResult;
use App\Models\GroupResult;
use App\Models\Masjed;
use App\Models\Ostan;
use App\Models\Shahrestan;
use App\Models\SingleResult;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FamilyController extends Controller
{
    public function index(Request $request)
    {
        $current_user = auth()->user();
        $selected = null;
        if ($current_user->isOstaniAdmin()) {
            // ostani admin
            $users = FamilyResult::where('ostan_id', $current_user->ostan_id)->paginate(10);
            $ostans = Ostan::where('id', $current_user->ostan_id)->get();
            $shahrestans = Shahrestan::where('ostan', $current_user->ostan_id)->get();
            $request->ostan = auth()->user()->ostan_id;
            $selected['ostan'] = $ostans->first()->id;
        } else if ($current_user->isMosjedAdmin()) {
            // ostani admin
            $users = FamilyResult::where('mosque_id', $current_user->masjed_id)->paginate(10);
            $ostans = Ostan::where('id', $current_user->ostan_id)->get();
            $shahrestans = Shahrestan::where('ostan', $current_user->ostan_id)->get();
            $selected['ostan'] = $current_user->ostan_id;
        }  else if ($current_user->isShahrestanAdmin()) {
            // ostani admin
            $users = FamilyResult::where('shahrestan_id', $current_user->shahrestan_id)->paginate(10);
            $ostans = Ostan::where('id', $current_user->ostan_id)->get();
            $shahrestans = Shahrestan::where('ostan', $current_user->ostan_id)->get();
            $masjeds = Masjed::where('ostan', Ostan::find($current_user->ostan_id)->name)->where('shahrestan', Shahrestan::find($current_user->shahrestan_id)->name)->get();
            $selected['ostan'] = $current_user->ostan_id;
            return view('admin.family.index', compact('users', 'ostans', 'shahrestans', 'selected','masjeds'));
        }  else {
            $users = FamilyResult::paginate(10);
            $ostans = Ostan::all();
            $shahrestans = Shahrestan::where('ostan', $ostans->first()->id)->get();
        }
        return view('admin.family.index', compact('users', 'ostans', 'shahrestans', 'selected'));
    }

    public function show(FamilyResult $user)
    {
        return view('admin.family.show', compact('user'));
    }

    public function filterUsers(Request $request)
    {
        if (auth()->user()->isOstaniAdmin()) {
            $request->ostan = auth()->user()->ostan_id;
        }
        return redirect()->route('family.search.show')->with(['ostan' => $request->ostan, 'shahrestan' => $request->shahrestan, 'mosque' => $request->mosque]);
    }

    public function filterFamiliesShow(Request $request)
    {

        $selected = [];
        $masjeds = null;
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

            if ($request->session()->get('shahrestan')) {
                $users = $users->where('shahrestan_id', $request->session()->get('shahrestan'));
                $selected['shahrestan'] = $request->session()->get('shahrestan');
            }

            if ($request->session()->get('mosque')) {
                $selected['mosque'] = $request->session()->get('mosque');
                $users = $users->where('mosque_id', $request->session()->get('mosque'));
            }
        }
        $excel_data = $users->get();
        session()->flash('excel', $excel_data);

        $login_user = auth()->user();

        if ($login_user->isOstaniAdmin() && $request->session()->get('shahrestan') == null) {
            $users->where('ostan_id', $login_user->ostan_id);
        }

        if ($login_user->isShahrestanAdmin() && $request->session()->get('mosque') == null) {
            $users->where('shahrestan_id', $login_user->shahrestan_id);
        }


        $users = $users->paginate(10);

        $ostans = Ostan::all();

        if (isset($selected['ostan'])) {
            $shahrestans = Shahrestan::where('ostan', $selected['ostan'])->get();
        } else {
            $shahrestans = Shahrestan::where('ostan', $ostans->first()->id)->get();
        }
        if (isset($selected['shahrestan'])) {
            $shahrestan_name = Shahrestan::where('id', $selected['shahrestan'])->first()->name;
            $masjeds = Masjed::where('shahrestan', "LIKE", $shahrestan_name)->get();
        }
        $request->session()->keep(['ostan', 'shahrestan', 'mosque']);
        //        dd($shahrestans);
//        $users = User::paginate(15);
//        return redirect()->back()->with(['users'=>$users,'ostans'=>$ostans,'shahrestans'=>$shahrestans]);

        if (isset($selected['shahrestan'])) {
            $shahrestan_name = Shahrestan::where('id', $selected['shahrestan'])->first()->name;
            $masjeds = masjed::where('shahrestan', "LIKE", $shahrestan_name)->get();
        }

        $current_user = auth()->user();
        if ($current_user->isShahrestanAdmin()) {
            // ostani admin
            $masjeds = Masjed::where('ostan', Ostan::find($current_user->ostan_id)->name)->where('shahrestan', Shahrestan::find($current_user->shahrestan_id)->name)->get();
        }


        return view('admin.family.index', compact('users', 'ostans', 'shahrestans', 'selected', 'masjeds', 'excel_data'));
    }

    public function exportAllFamilies(Request $request)
    {

        if (auth()->user()->role == 2){
            $users = FamilyResult::where('ostan_id', auth()->user()->ostan_id);

            if ($request->session()->get('shahrestan')) {
                $users = $users->where('shahrestan_id', $request->session()->get('shahrestan'));
                $selected['shahrestan'] = $request->session()->get('shahrestan');
            }
            if ($request->session()->get('mosque')) {
                $selected['mosque'] = $request->session()->get('mosque');
                $users = $users->where('mosque_id', $request->session()->get('mosque'));
            }

        }elseif(auth()->user()->role == 4){
            $users = FamilyResult::where('ostan_id', auth()->user()->ostan_id);
            $users = $users->where('shahrestan_id', auth()->user()->shahrestan_id);

            if ($request->session()->get('mosque')) {
                $selected['mosque'] = $request->session()->get('mosque');
                $users = $users->where('mosque_id', $request->session()->get('mosque'));
            }

        }else{
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
        }


        $excel_data = $users->get();

        return Excel::download(new FamilyResultExport($excel_data), 'users.xlsx');
    }
}
