<?php

namespace App\Http\Controllers;

use App\Exports\SingleResultExport;
use App\Imports\OstaniManagerImport;
use App\Imports\ShahrestaniManagerImport;
use App\Models\FamilyResult;
use App\Models\GroupResult;
use App\Models\Major;
use App\Models\Masjed;
use App\Models\Ostan;
use App\Models\Shahrestan;
use App\Models\SingleResult;
use App\Models\UploadFile;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Morilog\Jalali\CalendarUtils;

//use Illuminate\Routing\Route;

class UserController extends Controller
{
    public $excel_data;

    public function index()
    {
        $current_user = auth()->user();
        $selected = null;
        if ($current_user->isOstaniAdmin()) {
            // ostani admin
            $users = SingleResult::where('ostan_id', $current_user->ostan_id)->paginate(10);
            $ostans = Ostan::where('id', $current_user->ostan_id)->get();
            $shahrestans = Shahrestan::where('ostan', $current_user->ostan_id)->get();
            $selected['ostan'] = $ostans->first()->id;
        } else if ($current_user->isMosjedAdmin()) {
            // ostani admin
            $users = SingleResult::where('mosque_id', $current_user->masjed_id)->paginate(10);
            $ostans = Ostan::where('id', $current_user->ostan_id)->get();
            $shahrestans = Shahrestan::where('ostan', $current_user->ostan_id)->get();
            $selected['ostan'] = $current_user->ostan_id;
        } else if ($current_user->isShahrestanAdmin()) {
            // ostani admin
            $users = SingleResult::where('shahrestan_id', $current_user->shahrestan_id)->paginate(10);
            $ostans = Ostan::where('id', $current_user->ostan_id)->get();
            $shahrestans = Shahrestan::where('ostan', $current_user->ostan_id)->get();
            $masjeds = Masjed::where('ostan', Ostan::find($current_user->ostan_id)->name)->where('shahrestan', Shahrestan::find($current_user->shahrestan_id)->name)->get();
            $selected['ostan'] = $current_user->ostan_id;
            $selected['shahrestan'] = $current_user->shahrestan_id;
            return view('admin.user.index', compact('users', 'ostans', 'shahrestans', 'selected', 'masjeds'));
        } else {
            $users = SingleResult::paginate(10);
            $ostans = Ostan::all();
            $shahrestans = Shahrestan::where('ostan', $ostans->first()->id)->get();
        }
        return view('admin.user.index', compact('users', 'ostans', 'shahrestans', 'selected'));
    }

    public function ostanUsers()
    {
        $users = User::where('role', 2)->orWhere('role', 4)->paginate(10);
        $ostans = Ostan::all();
        return view('admin.user.index-ostani', compact('users', 'ostans'));
    }

    public function shahrestanUsers()
    {
        $users = User::where('role', 2)->orWhere('role', 4)->paginate(10);
        $ostans = Ostan::all();
        $shahrestans = Shahrestan::where('ostan', $ostans->first()->id)->get();
        return view('admin.user.index-shahrestani', compact('users', 'ostans', 'shahrestans'));
    }

    public function create()
    {
        $this->authorize('is_superadmin');
        $ostans = Ostan::all();
        $shahrestans = Shahrestan::where('ostan', $ostans->first()->id)->get();
        return view('admin.user.create', compact('ostans', 'shahrestans'));
    }

    public function store(Request $request)
    {
        $this->authorize('is_superadmin');

        $data['month'] = str_pad($request->month, 2, '0', STR_PAD_LEFT);
        $data['day'] = str_pad($request->day, 2, '0', STR_PAD_LEFT);
//        $birth_date=$data['year'].'/'.$data['month'].'/'.$data['day'].' 00:00';
        $birth_date = $request->year . '/' . $data['month'] . '/' . $data['day'];

        $birth_date = CalendarUtils::createDatetimeFromFormat('Y/m/d', $birth_date);
        $user = User::where('mobile', $request->mobile)->first();
        if ($user) {
            $user->name = $request->name;
            $user->national_code = $request->national_code;
            $user->mobile = $request->mobile;
            $user->role = $request->role;
            $user->ostan_id = $request->ostan_id;
            $user->masjed_id = $request->masjed_id;
            $user->shahrestan_id = $request->shahrestan_id;
            $user->birthday = $birth_date;
            $user->update();
        } else {
            User::create([
                'name' => $request->name,
                'national_code' => $request->national_code,
                'mobile' => $request->mobile,
                'role' => $request->role,
                'ostan_id' => $request->ostan_id,
                'masjed_id' => $request->masjed_id,
                'shahrestan_id' => $request->shahrestan_id,
                'birthday' => $birth_date
            ]);
        }
        return redirect()->back()->with('message', 'کاربر با موفقیت افزوده شد');
    }

    public function show(SingleResult $user)
    {
        return view('admin.user.show', compact('user'));
    }

    public function destroy($id, Request $request)
    {
        User::destroy($request->input('delete_id'));
        return back();
    }

    public function deleteUser(Request $request)
    {
        User::destroy($request->user);
        return back();
    }


    public function exportExcel()
    {
        $results = User::get();
        // Submission form
        $filename = "result_" . date('Ymd') . ".csv";
        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        echo "\xEF\xBB\xBF"; // UTF-8 BOM


        //create heading
        $heading = array(
            'ردیف',
            'نام',
            'نام خانوادگی',
            'سن',
            'تحصیلات',
            'جنسیت',
            'شماره موبایل ثبت نامی',
            'شماره موبایل مجازی',
            'شبکه های داخلی',
            'شبکه های خارجی',
            'اکانت توئیتر',
            'اکانت اینستاگرام'
        );

        echo implode(",", array_values($heading)) . "\n";

        foreach ($results as $result) {
            $gender = "مرد";
            if ($result->gender == 0) {
                $gender = "زن";
            }
            $edu = "";
            switch ($result->edu) {
                case 0:
                    $edu = "دانش آموز";
                    break;
                case 1:
                    $edu = "سیکل";
                    break;
                case 2:
                    $edu = "دیپلم";
                    break;
                case 3:
                    $edu = "فوق دیپلم";
                    break;
                case 4:
                    $edu = "کارشناسی";
                    break;
                case 5:
                    $edu = "کارشناسی ارشد";
                    break;
                case 6:
                    $edu = "دکتری";
                    break;
                case 7:
                    $edu = "حوزوی سطح 1";
                    break;
                case 8:
                    $edu = "حوزوی سطح 2";
                    break;
                case 9:
                    $edu = "حوزوی سطح 3";
                    break;
                case 10:
                    $edu = "حوزوی سطح 4";
                    break;
                default:
                    $edu = "نامشخص";
                    break;
            }

            $data1 = $result->id;
            $data2 = $result->name;
            $data3 = $result->lname;
            $data4 = $result->age;
            $data5 = $edu;
            $data6 = $gender;
            $data7 = $result->mobile;
            $data8 = $result->social_mobile;
            $data9 = str_replace(",", "-", $result->internal_socials);
            $data10 = str_replace(",", "-", $result->external_social);;
            $data11 = $result->twitter_account;
            $data12 = $result->instagram_account;

            $rows = [
                $data1,
                $data2,
                $data3,
                $data4,
                $data5,
                $data6,
                $data7,
                $data8,
                $data9,
                $data10,
                $data11,
                $data12
            ];
            echo implode(",", array_values($rows)) . "\n";
        }
        mb_convert_encoding($filename, 'UTF-16LE', 'UTF-8');
        exit();
    }

    public function filterUsers(Request $request)
    {
        if (auth()->user()->isOstaniAdmin()) {
            $request->ostan = auth()->user()->ostan_id;
        }
        return redirect()->route('users.search.show')->with(['ostan' => $request->ostan, 'shahrestan' => $request->shahrestan, 'mosque' => $request->mosque]);
        return view('admin.user.index', compact('users', 'ostans', 'shahrestans', 'selected', 'masjeds', 'excel_data'));
    }

    public function filterUsersPost(Request $request)
    {
        if (auth()->user()->isOstaniAdmin()) {
            $request->ostan = auth()->user()->ostan_id;
        }
        return redirect()->route('users.filter.sms')->with(['ostan' => $request->ostan, 'shahrestan' => $request->shahrestan, 'mosque' => $request->mosque]);
//        return view('admin.user.sms-filter-users', compact('users', 'ostans', 'shahrestans', 'selected', 'masjeds', 'excel_data'));
    }

    public function export(Request $request)
    {
        if ($request->ostan) {
            $users = SingleResult::where('ostan_id', $request->ostan);
            $selected['ostan'] = $request->ostan;
            if ($request->shahrestan) {
                $users = $users->where('shahrestan_id', $request->shahrestan);
                $selected['shahrestan'] = $request->shahrestan;
            }
            if ($request->mosque) {
                $selected['mosque'] = $request->mosque;
                $users = $users->where('mosque_id', $request->mosque);
            }
        } else {
            $users = SingleResult::query();
        }
        $excel_data = $users->get();
        $request->session()->keep(['ostan', 'shahrestan', 'mosque']);
//        dd(session()->get('excel'));
//        $excel_data=session()->get('excel');
//        dd(UserController::$excel_data);
        /* $aaa=new UserController();
        $aaa->excel_data=1;
     //        dd($aaa::excel_data);
             dd($aaa->excel_data);*/
//        $obj=new SingleResultExport();
        return Excel::download(new SingleResultExport($excel_data), 'users.xlsx');
//        return Excel::download($obj->collection(), 'users.xlsx');
    }

    /*public function filterUsersShow(){
        return view('admin.user.index',compact('users','ostans','shahrestans'));
    }*/
    public function exportAllUsers()
    {
        $excel_data = SingleResult::all();
        return Excel::download(new SingleResultExport($excel_data), 'users.xlsx');
    }

    public function filterUsersShow(Request $request)
    {
        $login_user = auth()->user();
//      dd(Route::currentRouteName());
        $selected = [];
        $selected['ostan'] = null;
        $selected['shahrestan'] = null;
        $selected['mosque'] = null;
        $masjeds = null;
//        dd($request->all());
        if ($login_user->isOstaniAdmin()) {

        }
        if ($request->session()->get('ostan')) {
            $users = SingleResult::where('ostan_id', $request->session()->get('ostan'));
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
            $users = SingleResult::query();

            if ($request->session()->get('shahrestan')) {
                $users = $users->where('shahrestan_id', $request->session()->get('shahrestan'));
                $selected['shahrestan'] = $request->session()->get('shahrestan');
            }

            if ($request->session()->get('mosque')) {
                $selected['mosque'] = $request->session()->get('mosque');
                $users = $users->where('mosque_id', $request->session()->get('mosque'));
            }

        }


        if ($login_user->isOstaniAdmin() && $request->session()->get('shahrestan') == null) {
            $users->where('ostan_id', $login_user->ostan_id);
        }

        if ($login_user->isShahrestanAdmin() && $request->session()->get('mosque') == null) {
            $users->where('shahrestan_id', $login_user->shahrestan_id);
        }


//       UserController::$excel_data=$users->get();
        /*$excel_data=$users->get();
        session()->flash('excel',$excel_data);*/
        $excel_data = '';
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

        $current_user = auth()->user();
        if ($current_user->isShahrestanAdmin()) {
            // ostani admin
            $masjeds = Masjed::where('ostan', Ostan::find($current_user->ostan_id)->name)->where('shahrestan', Shahrestan::find($current_user->shahrestan_id)->name)->get();
        }

        $request->session()->keep(['ostan', 'shahrestan', 'mosque']);
        return view('admin.user.index', compact('users', 'ostans', 'shahrestans', 'selected', 'masjeds', 'excel_data'));
    }

    public function smsUsersFilter(Request $request)
    {
        $login_user = auth()->user();
        $selected = [];
        $selected['ostan'] = null;
        $selected['shahrestan'] = null;
        $selected['mosque'] = null;
        $masjeds = null;


        $users = SingleResult::query();

        if ($login_user->isOstaniAdmin()) {
            $users->where('ostan_id', $login_user->ostan_id);
        }

        if ($login_user->isShahrestanAdmin()) {
            $users->where('shahrestan_id', $login_user->shahrestan_id);
        }


        $excel_data = '';
        $users = $users->paginate(10);
        $ostans = Ostan::all();
        if (isset($selected['ostan'])) {
            $shahrestans = Shahrestan::where('ostan', $selected['ostan'])->get();
        } else {
            $shahrestans = Shahrestan::where('ostan', $ostans->first()->id)->get();
        }

        if (isset($selected['shahrestan'])) {
            $shahrestan_name = Shahrestan::where('id', $selected['shahrestan'])->first()->name;
            $masjeds = masjed::where('shahrestan', "LIKE", $shahrestan_name)->get();
        }

        $current_user = auth()->user();
        if ($current_user->isShahrestanAdmin()) {
            // ostani admin
            $masjeds = Masjed::where('ostan', Ostan::find($current_user->ostan_id)->name)->where('shahrestan', Shahrestan::find($current_user->shahrestan_id)->name)->get();
        }

        $request->session()->keep(['ostan', 'shahrestan', 'mosque']);
        return view('admin.user.sms-filter-users', compact('users', 'ostans', 'shahrestans', 'selected', 'masjeds', 'excel_data'));
    }


    public function mosqueUserList()
    {

        $ostans = Ostan::all();
        $shahrestans = Shahrestan::where('ostan', $ostans->first()->id)->get();
        $users = User::where('role', 3)->paginate(10);
        $masjeds = \App\Models\Masjed::all();

        return view('admin.mosqueUser.index', compact('users', 'ostans', 'shahrestans', 'masjeds'));

    }

    public function smsText(Request $request)
    {
//        dd($request->all());

        if ($request->ostan) {
            $users = SingleResult::where('ostan_id', $request->ostan);
            $selected['ostan'] = $request->ostan;
            if ($request->shahrestan) {
                $users = $users->where('shahrestan_id', $request->shahrestan);
                $selected['shahrestan'] = $request->shahrestan;
            }
            if ($request->mosque) {
                $selected['mosque'] = $request->mosque;
                $users = $users->where('mosque_id', $request->mosque);
            }
        } else {
            $users = SingleResult::query();
        }
        $excel_data = $users->get();
        $request->session()->keep(['ostan', 'shahrestan', 'mosque']);

//        dd($selected);
//        return Excel::download(new SingleResultExport($excel_data), 'users.xlsx');
//        return Excel::download($obj->collection(), 'users.xlsx');
    }


    public function uploadManagerFile()
    {
        return view('admin.managerExcel.excel-upload');
    }

    public function saveManagerOstanFile(Request $request)
    {
        Excel::import(new OstaniManagerImport, request()->file('file'));
        return redirect()->back()->with('message', 'مدیران استانی با موفقیت ذخیره شدند');
    }

    public function saveManagerShahrestanFile(Request $request)
    {
        Excel::import(new ShahrestaniManagerImport, request()->file('file2'));
        return redirect()->back()->with('message', 'مدیران شهرستانی با موفقیت ذخیره شدند');
    }


    public function exportExcelByHoze()
    {

        // Submission form
        $filename = "result_" . date('Ymd') . ".csv";
        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        echo "\xEF\xBB\xBF"; // UTF-8 BOM



        //create heading
        $heading = array(
            'ردیف',
            'شهر',
            'شهرستان',
            'تعداد فرم فردی',
            'تعداد فرم گروهی',
            'تعداد فرم خانوادگی'
        );

        echo implode(",", array_values($heading)) . "\n";

        $shahrestans = Masjed::groupBy('shahrestan')->get();

        foreach ($shahrestans as $h) {

            $shahrestans_id = Shahrestan::where('name', $h->shahrestan)->first()->id ?? 0;
            if($shahrestans_id != 0){



            $single_count = SingleResult::where('shahrestan_id', $shahrestans_id)->get()->count() ?? 0;

            $group_count  = GroupResult::where ('shahrestan_id', $shahrestans_id)->get()->count() ?? 0;

            $family_count = FamilyResult::where('shahrestan_id', $shahrestans_id)->get()->count() ?? 0;

            $data1 = $h->id;
            $data3 = $h->ostan;
            $data4 = $h->shahrestan;
            $data5 = $single_count;
            $data6 = $group_count;
            $data7 = $family_count;

            $rows = [
                $data1,
                $data3,
                $data4,
                $data5,
                $data6,
                $data7
            ];
            echo implode(",", array_values($rows)) . "\n";
            }
        }

        mb_convert_encoding($filename, 'UTF-16LE', 'UTF-8');
        exit();
    }


    public function uploadedFiles(Request $request)
    {

        $files = UploadFile::query();
        $selected = [];

        if ($request->get("type") != 0 and $request->get("type") != null ) {
            $files = $files->where("type", $request->get("type"));
            $selected['type'] = $request->get("type");
        }

        if ($request->get("major") != 0 and $request->get("major") != null ) {
            $files = $files->leftJoin('single_result', function($join) {
                $join->on('single_result.id', '=', 'upload_file.single_result_id');
            })->where("single_result.major",$request->get("major"));
            $selected['major'] = $request->get("major");
        }

        if ($request->get("code_meli") != 0 and $request->get("type") != null ) {
            $files = $files->where("single_result.national_code", $request->get("code_meli"));
            $selected['code_meli'] = $request->get("code_meli");
        }

        $files =  $files->paginate(10);

        $majors = Major::whereIn('id',[54,55,56])->get();
         return view('admin.fileUploads.index',compact('files','majors','selected'));
    }

}

