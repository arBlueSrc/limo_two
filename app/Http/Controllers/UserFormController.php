<?php

namespace App\Http\Controllers;

use App\Models\FamilyResult;
use App\Models\GroupResult;
use App\Models\SingleResult;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;

class UserFormController extends Controller
{
    public function showForm()
    {

        $single = SingleResult::where('user_id',Auth()->user()->id)->get();
        $group = GroupResult::where('user_id',Auth()->user()->id)->get();
        $family = FamilyResult::where('user_id',Auth()->user()->id)->get();

        if (sizeof($single)==0 && sizeof($group)==0 && sizeof($family)==0){
            return redirect(route('choose'));
        }else{
            Auth::logout();
            return view('form.registerBefore');
        }

    }

    public function edit(Request $request)
    {
        $user = User::find($request->user);
        return view('admin.form.updateForm',compact('user'));
    }

    public function update(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'lname' => 'required',
            'age' => 'required',
            'id' => '',
            'edu' => '',
            'gender' => '',
            'vnumber' => 'required',
            'eita' => '',
            'bale' => '',
            'soroosh' => '',
            'igap' => '',
            'roobika' => '',
            'virasti' => '',
            'other' => '',
            'twitter' => '',
            'telegram' => '',
            'instagram' => '',
            'whatsapp' => '',
            'twitter_account' => '',
            'instagram_account' => ''
        ]);


        if (array_key_exists('twitter',$data) && $data['twitter_account'] == ""){
            return response($data['twitter_account'],405);
        }

        if (array_key_exists('instagram',$data) && $data['instagram_account'] == ""){
            return response($data['instagram_account'],405);
        }

        $internal_social = "";
        if (array_key_exists('eita',$data)){
            $internal_social = $internal_social.'eita'.",";
        }
        if (array_key_exists('bale',$data)){
            $internal_social = $internal_social.'bale'.",";
        }
        if (array_key_exists('soroosh',$data)){
            $internal_social = $internal_social.'soroosh'.",";
        }
        if (array_key_exists('igap',$data)){
            $internal_social = $internal_social.'igap'.",";
        }
        if (array_key_exists('roobika',$data)){
            $internal_social = $internal_social.'roobika'.",";
        }
        if (array_key_exists('virasti',$data)){
            $internal_social = $internal_social.'virasti'.",";
        }
        if (array_key_exists('virasti',$data)){
            $internal_social = $internal_social.'virasti'.",";
        }


        $external_social = "";
        if (array_key_exists('twitter',$data)){
            $external_social = $external_social.'twitter'.",";
        }
        if (array_key_exists('telegram',$data)){
            $external_social = $external_social.'telegram'.",";
        }
        if (array_key_exists('instagram',$data)){
            $external_social = $external_social.'instagram'.",";
        }
        if (array_key_exists('whatsapp',$data)){
            $external_social = $external_social.'whatsapp'.",";
        }

        User::where('id', $request->id)->update([
            'name' => $data['name'] ?? "",
            'lname' => $data['lname'] ?? "",
            'age' => $data['age'] ?? "",
            'edu' => $data['edu'] ?? "",
            'gender' => $data['gender'] ?? "",
            'social_mobile' => $data['vnumber'] ?? "",
            'internal_socials' => $internal_social,
            'external_social' => $external_social,
            'twitter_account' => $data['twitter_account'] ?? "",
            'instagram_account' => $data['instagram_account'] ?? ""
        ]);

        return redirect()->route('user.index');
    }

    public function checkResponseSingle(Request $request)
    {
//        dd(Auth::user()->mobile);
        $data = $request->validate([
            'name' => 'required',
            'national_code' => 'required',
//            'Phone_number' => 'required',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
            'ostan_id' => 'required',
            'shahrestan_id' => 'required',
            'mosque' => 'required',
            'major' => 'required'
        ]);
//        dd($data);
        $data['month'] =  str_pad($data['month'], 2, '0', STR_PAD_LEFT);
        $data['day'] =  str_pad($data['month'], 2, '0', STR_PAD_LEFT);
//        $birth_date=$data['year'].'/'.$data['month'].'/'.$data['day'].' 00:00';
        $birth_date=$data['year'].'/'.$data['month'].'/'.$data['day'];

        $birth_date=CalendarUtils::createDatetimeFromFormat('Y/m/d', $birth_date);


        SingleResult::create([
//            'type' => 1,
            'name' => $data['name'],
            'national_code' => $data['national_code'],
            'ostan_id' => $data['ostan_id'],
            'shahrestan_id' => $data['shahrestan_id'],
            'birthday' => $birth_date,
            'major' => $data['major'],
            'mosque_id' => $data['mosque'],
            'phone' => Auth::user()->mobile,
            'user_id' => Auth::user()->id,
        ]);

        // send sms to user
            //API Url
            $url = 'https://peyk313.ir/API/V1.0.0/Send.ashx';
            $dataArray = array(
                'privateKey' => "67d84858-50c4-4dd1-9ad1-c4f1ae758462",
                'number' => "660005",
                'text' =>"ثبت نام شما ثبت شد برای اطلاعات بیشتر وارد کانال دارالقرآن بسیج در ایتا یا روبیکا شوید.
eitaa.com/quranbsj_ir
rubika.ir/quranbsj_ir",
                'mobiles' => Auth::user()->mobile,
                'clientIDs' => 1,

            );
            $data = http_build_query($dataArray);

            $getUrl = $url."?".$data;
//                                dd($getUrl);
            $contents = file_get_contents($getUrl,false);
        return view('form.registerComplete');


    }

    public function checkResponseGroup(Request $request)
    {
        $data = $request->validate([
            'group_name' => 'required',
            'head_name' => 'required',
            'head_national_code' => 'required',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
            'ostan_id' => 'required',
            'shahrestan_id' => 'required',
            'mosque' => 'required',
            'head_phone' => 'required',
            'second_person_name' => 'required',
            'second_person_phone' => 'required',
            'third_person_name' => 'required',
            'third_persons_phone' => 'required',
        ]);

        $data['month'] =  str_pad($data['month'], 2, '0', STR_PAD_LEFT);
        $data['day'] =  str_pad($data['month'], 2, '0', STR_PAD_LEFT);

        $birth_date=$data['year'].'/'.$data['month'].'/'.$data['day'];

        $birth_date=CalendarUtils::createDatetimeFromFormat('Y/m/d', $birth_date);
//        dd($birth_date);

        GroupResult::create([
            'name_group' => $data['group_name'],
            'ostan_id' => $data['ostan_id'],
            'shahrestan_id' => $data['shahrestan_id'],
            'mosque_id' => $data['mosque'],
            'name_group' => $data['group_name'],
            'head_name' => $data['head_name'],
            'head_national_code' => $data['head_national_code'],
            'head_phone' => $data['head_phone'],
            'second_name' => $data['second_person_name'],
            'second_phone' => $data['second_person_phone'],
            'third_name' => $data['third_person_name'],
            'third_phone' => $data['third_persons_phone'],
            'birthday' => $birth_date,
            'user_id' => Auth::user()->id,

        ]);

        // send sms to user
        //API Url
        $url = 'https://peyk313.ir/API/V1.0.0/Send.ashx';
        $dataArray = array(
            'privateKey' => "67d84858-50c4-4dd1-9ad1-c4f1ae758462",
            'number' => "660005",
            'text' =>"ثبت نام شما ثبت شد برای اطلاعات بیشتر وارد کانال دارالقرآن بسیج در ایتا یا روبیکا شوید.
eitaa.com/quranbsj_ir
rubika.ir/quranbsj_ir",
            'mobiles' => Auth::user()->mobile,
            'clientIDs' => 1,

        );
        $data = http_build_query($dataArray);

        $getUrl = $url."?".$data;
//                                dd($getUrl);
        $contents = file_get_contents($getUrl,false);
        return view('form.registerComplete');

    }

    public function checkResponseFamily(Request $request)
    {
//        dd(Auth::user()->id);
        $data = $request->validate([
            'family_name' => 'required',
            'ostan_id' => 'required',
            'shahrestan_id' => 'required',
            'father_name' => 'required',
            'father_national_code' => 'required',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
            'father_phone' => 'required',
            'mother_name' => 'required',
            'mother_phone' => 'required',
            'child_count' => 'required',
            'mosque' => 'required',
//            'user_id' => Auth::user()->id,
        ]);

        $data['month'] =  str_pad($data['month'], 2, '0', STR_PAD_LEFT);
        $data['day'] =  str_pad($data['month'], 2, '0', STR_PAD_LEFT);

        $birth_date=$data['year'].'/'.$data['month'].'/'.$data['day'];

        $birth_date=CalendarUtils::createDatetimeFromFormat('Y/m/d', $birth_date);

        FamilyResult::create([
            'name'=>$data['family_name'],
            'ostan_id'=>$data['ostan_id'],
            'shahrestan_id'=>$data['shahrestan_id'],
            'father_name'=>$data['father_name'],
            'father_national_code'=>$data['father_national_code'],
            'father_phone'=>$data['father_phone'],
            'mother_name'=>$data['mother_name'],
            'mother_phone'=>$data['mother_phone'],
            'child_count'=>$data['child_count'],
            'birthdate'=>$birth_date,
            'mosque_id'=>$data['mosque'],
            'user_id'=>Auth::user()->id
        ]);
// send sms to user
        //API Url
        $url = 'https://peyk313.ir/API/V1.0.0/Send.ashx';
        $dataArray = array(
            'privateKey' => "67d84858-50c4-4dd1-9ad1-c4f1ae758462",
            'number' => "660005",
            'text' =>"ثبت نام شما ثبت شد برای اطلاعات بیشتر وارد کانال دارالقرآن بسیج در ایتا یا روبیکا شوید.
eitaa.com/quranbsj_ir
rubika.ir/quranbsj_ir",
            'mobiles' => Auth::user()->mobile,
            'clientIDs' => 1,
        );
        $data = http_build_query($dataArray);

        $getUrl = $url."?".$data;
//                                dd($getUrl);
        $contents = file_get_contents($getUrl,false);
        return view('form.registerComplete');
    }
}
