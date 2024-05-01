<?php

namespace App\Http\Controllers;

use App\Imports\MasjedsImport;
use App\Models\masjed;
use App\Models\Ostan;
use App\Models\Shahrestan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MosqueUserController extends Controller
{
    public function create()
    {
        $this->authorize('is_superadmin');
        $ostans = Ostan::all();
        $shahrestans = Shahrestan::where('ostan', $ostans->first()->id)->get();
        $masjeds = masjed::all();
        return view('admin.mosqueUser.create', compact('ostans', 'shahrestans','masjeds'));
    }

    public function uploadMasjedFile(){
        return view('admin.masjedExcel.excel-upload');
    }

    public function saveMasjedFile(Request $request){

        /*set_time_limit(0);
                ini_set('max_execution_time', '0'); // for infinite time of execution*/
        Excel::import(new MasjedsImport, request()->file('file'));
        return redirect()->back()->with('message','اطلاعات با موفقیت ذخیره شد');
    }

}
