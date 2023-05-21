<?php

namespace App\Http\Controllers;

use App\Models\masjed;
use App\Models\Ostan;
use App\Models\Shahrestan;
use App\Models\SingleResult;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users=SingleResult::paginate(10);
        $ostans=Ostan::all();
        $shahrestans=Shahrestan::where('ostan',$ostans->first()->id)->get();
//        dd($shahrestans);
//        $users = User::paginate(15);
        return view('admin.user.index',compact('users','ostans','shahrestans'));
    }
    public function show(SingleResult $user){
        return view('admin.user.show', compact('user'));
    }
    public function destroy($id, Request $request)
    {
        User::destroy($request->input('delete_id'));
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
            if ($result->gender == 0){
                $gender = "زن";
            }
            $edu = "";
            switch ($result->edu){
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
            $data9 = str_replace(",","-",$result->internal_socials);
            $data10 = str_replace(",","-",$result->external_social);;
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
        $selected=[];
        $masjeds=null;
//        dd($request->all());
        if ($request->ostan){
            $users=SingleResult::where('ostan_id',$request->ostan);
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
            $users=SingleResult::query();
        }
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
       return view('admin.user.index',compact('users','ostans','shahrestans','selected','masjeds'));
    }
    /*public function filterUsersShow(){
        return view('admin.user.index',compact('users','ostans','shahrestans'));
    }*/
}
