<?php

namespace App\Http\Controllers;

use App\Models\FamilyResult;
use App\Models\FamilyResultChildren;
use App\Models\GroupResult;
use App\Models\Major;
use App\Models\masjed;
use App\Models\Ostan;
use App\Models\Shahrestan;
use App\Models\SingleResult;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\CalendarUtils;

class UserFormController extends Controller
{
    public function showForm()
    {
        $single = SingleResult::where('user_id', Auth()->user()->id)->get();
        $group = GroupResult::where('user_id', Auth()->user()->id)->get();
        $family = FamilyResult::where('user_id', Auth()->user()->id)->get();

        if (sizeof($single) <= 3 || sizeof($group) == 0 || sizeof($family) == 0) {

            $deactive_item1 = 0;
            $deactive_item2 = 0;
            $deactive_item3 = 0;

            if (sizeof($single) >= 3) $deactive_item1 = 1;
            if (sizeof($group) != 0) $deactive_item2 = 1;
            if (sizeof($family) != 0) $deactive_item3 = 1;

            return view('choose.choose', compact('deactive_item1', 'deactive_item2', 'deactive_item3'));

        } else {

            Auth::logout();
            return view('form.registerBefore');

        }

    }

    public function showFormEdit()
    {

        //get submitted form of user
        $single_forms = SingleResult::where('user_id', auth()->user()->id)->get();
        $group_forms = GroupResult::where('user_id', auth()->user()->id)->get();
        $family_forms = FamilyResult::where('user_id', auth()->user()->id)->get();

        return view('choose.chooseEdit', compact('single_forms', 'group_forms', 'family_forms'));

    }

    public function edit(Request $request)
    {
        $user = User::find($request->user);
        return view('admin.form.updateForm', compact('user'));
    }

    public function checkResponseSingle(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'national_code' => 'required',
            'mobile' => 'required',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
            'ostan_id' => 'required',
            'shahrestan_id' => 'required',
            'mosque' => 'required',
            'major' => 'required',
            'moaref_mobile' => '',
        ]);
        $data['month'] = str_pad($data['month'], 2, '0', STR_PAD_LEFT);
        $data['day'] = str_pad($data['day'], 2, '0', STR_PAD_LEFT);

        $birth_date = $data['year'] . '/' . $data['month'] . '/' . $data['day'];

        $birth_date = CalendarUtils::createDatetimeFromFormat('Y/m/d', $birth_date);


        //check it is or not
        $check = SingleResult::where(
            [
                'name' => $data['name'],
                'national_code' => $data['national_code'],
                'ostan_id' => $data['ostan_id'],
                'shahrestan_id' => $data['shahrestan_id'],
                'birthday' => $birth_date,
                'major' => $data['major'],
                'mosque_id' => $data['mosque'],
                'phone' => $data['mobile'],
                'user_id' => Auth::user()->id,
            ]
        )->first();


        if ($check == null) {

            $single_result = SingleResult::create([
                'name' => $data['name'],
                'national_code' => $data['national_code'],
                'ostan_id' => $data['ostan_id'],
                'shahrestan_id' => $data['shahrestan_id'],
                'birthday' => $birth_date,
                'major' => $data['major'],
                'mosque_id' => $data['mosque'],
                'phone' => $data['mobile'],
                'user_id' => Auth::user()->id,
            ]);

            // add moref if exists
            if ($data['moaref_mobile']) {
                $single_result->moarefs()->create([
                    'moaref_mobile' => $data['moaref_mobile']
                ]);
            }

            // send sms to user
            //API Url
            $major = Major::find($data['major'])->name ?? "";
            $url = 'https://peyk313.ir/API/V1.0.0/Send.ashx';
            $dataArray = array(
                'privateKey' => "67d84858-50c4-4dd1-9ad1-c4f1ae758462",
                'number' => "660005",
                'text' => "ثبت نام شما در بخش فردی و رشته $major ثبت شد برای اطلاعات بیشتر وارد کانال دارالقرآن بسیج در ایتا یا روبیکا شوید.
eitaa.com/quranbsj_ir
rubika.ir/quranbsj_ir",
                'mobiles' => Auth::user()->mobile,
                'clientIDs' => 1,

            );
            $data = http_build_query($dataArray);
            $getUrl = $url . "?" . $data;
            $contents = file_get_contents($getUrl, false);
        }


        return redirect(route('form.complete'));

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
            'type' => 'required',
            'moaref_mobile' => '',
        ]);


        $data['month'] = str_pad($data['month'], 2, '0', STR_PAD_LEFT);
        $data['day'] = str_pad($data['day'], 2, '0', STR_PAD_LEFT);

        $birth_date = $data['year'] . '/' . $data['month'] . '/' . $data['day'];

        $birth_date = CalendarUtils::createDatetimeFromFormat('Y/m/d', $birth_date);


        $check = GroupResult::where(
            [
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
                'type' => $data['type']
            ]
        )->first();


        if ($check == null) {

            $group_result = GroupResult::create([
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
                'type' => $data['type'],
            ]);
            if ($data['moaref_mobile']) {
                $group_result->moarefs()->create([
                    'moaref_mobile' => $data['moaref_mobile']
                ]);
            }
            // send sms to user
            //API Url
            $url = 'https://peyk313.ir/API/V1.0.0/Send.ashx';
            $dataArray = array(
                'privateKey' => "67d84858-50c4-4dd1-9ad1-c4f1ae758462",
                'number' => "660005",
                'text' => "ثبت نام شما در بخش گروهی ثبت شد برای اطلاعات بیشتر وارد کانال دارالقرآن بسیج در ایتا یا روبیکا شوید.
eitaa.com/quranbsj_ir
rubika.ir/quranbsj_ir",
                'mobiles' => Auth::user()->mobile,
                'clientIDs' => 1,

            );
            $data = http_build_query($dataArray);

            $getUrl = $url . "?" . $data;
//                                dd($getUrl);
            $contents = file_get_contents($getUrl, false);
        }
        return redirect(route('form.complete'));

    }

    public function checkResponseFamily(Request $request)
    {
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
            'mosque' => 'required',
            'child_name1' => '',
            'child_name2' => '',
            'child_name3' => '',
            'child_name4' => '',
            'child_day1' => '',
            'child_day2' => '',
            'child_day3' => '',
            'child_day4' => '',
            'child_month1' => '',
            'child_month2' => '',
            'child_month3' => '',
            'child_month4' => '',
            'child_year1' => '',
            'child_year2' => '',
            'child_year3' => '',
            'child_year4' => '',
            'moaref_mobile' => '',
        ]);
//dd($data);
        $data['month'] = str_pad($data['month'], 2, '0', STR_PAD_LEFT);
        $data['day'] = str_pad($data['day'], 2, '0', STR_PAD_LEFT);

        $birth_date = $data['year'] . '/' . $data['month'] . '/' . $data['day'];

        $birth_date = CalendarUtils::createDatetimeFromFormat('Y/m/d', $birth_date);

        $f = FamilyResult::create([
            'name' => $data['family_name'],
            'ostan_id' => $data['ostan_id'],
            'shahrestan_id' => $data['shahrestan_id'],
            'father_name' => $data['father_name'],
            'father_national_code' => $data['father_national_code'],
            'father_phone' => $data['father_phone'],
            'mother_name' => $data['mother_name'],
            'mother_phone' => $data['mother_phone'],
//            'child_count'=>$data['child_count'],
            'birthdate' => $birth_date,
            'mosque_id' => $data['mosque'],
            'user_id' => Auth::user()->id
        ]);

        if ($data['moaref_mobile']) {
            $f->moarefs()->create([
                'moaref_mobile' => $data['moaref_mobile']
            ]);
        }

        // inserting child info
        if ($data['child_name1']) {
            if ($data['child_year1']) {
                $data['child_month1'] = str_pad($data['child_month1'], 2, '0', STR_PAD_LEFT);
                $data['child_day1'] = str_pad($data['child_day1'], 2, '0', STR_PAD_LEFT);

                $birth_date = $data['child_year1'] . '/' . $data['child_month1'] . '/' . $data['child_day1'];

                $child_birth_date1 = CalendarUtils::createDatetimeFromFormat('Y/m/d', $birth_date);
            }
            FamilyResultChildren::create([
                'family_result_id' => $f->id,
                'name' => $data['child_name1'],
                'birthdate' => $child_birth_date1,
            ]);
        }
        if ($data['child_name2']) {
            if ($data['child_year2']) {
                $data['child_month2'] = str_pad($data['child_month2'], 2, '0', STR_PAD_LEFT);
                $data['child_day2'] = str_pad($data['child_day2'], 2, '0', STR_PAD_LEFT);

                $birth_date = $data['child_year2'] . '/' . $data['child_month2'] . '/' . $data['child_day2'];

                $child_birth_date2 = CalendarUtils::createDatetimeFromFormat('Y/m/d', $birth_date);
            }
            FamilyResultChildren::create([
                'family_result_id' => $f->id,
                'name' => $data['child_name2'],
                'birthdate' => $child_birth_date2,
            ]);
        }
        if ($data['child_name3']) {
            if ($data['child_year3']) {
                $data['child_month3'] = str_pad($data['child_month3'], 2, '0', STR_PAD_LEFT);
                $data['child_day3'] = str_pad($data['child_day3'], 2, '0', STR_PAD_LEFT);

                $birth_date = $data['child_year3'] . '/' . $data['child_month3'] . '/' . $data['child_day3'];

                $child_birth_date3 = CalendarUtils::createDatetimeFromFormat('Y/m/d', $birth_date);
            }
            FamilyResultChildren::create([
                'family_result_id' => $f->id,
                'name' => $data['child_name3'],
                'birthdate' => $child_birth_date3,
            ]);
        }
        if ($data['child_name4']) {
            if ($data['child_year4']) {
                $data['child_month4'] = str_pad($data['child_month4'], 2, '0', STR_PAD_LEFT);
                $data['child_day4'] = str_pad($data['child_day4'], 2, '0', STR_PAD_LEFT);

                $birth_date = $data['child_year4'] . '/' . $data['child_month4'] . '/' . $data['child_day4'];

                $child_birth_date4 = CalendarUtils::createDatetimeFromFormat('Y/m/d', $birth_date);
            }
            FamilyResultChildren::create([
                'family_result_id' => $f->id,
                'name' => $data['child_name4'],
                'birthdate' => $child_birth_date4,
            ]);
        }
// send sms to user
        //API Url
        $url = 'https://peyk313.ir/API/V1.0.0/Send.ashx';
        $dataArray = array(
            'privateKey' => "67d84858-50c4-4dd1-9ad1-c4f1ae758462",
            'number' => "660005",
            'text' => "ثبت نام شما در بخش خانوادگی ثبت شد برای اطلاعات بیشتر وارد کانال دارالقرآن بسیج در ایتا یا روبیکا شوید.
eitaa.com/quranbsj_ir
rubika.ir/quranbsj_ir",
            'mobiles' => Auth::user()->mobile,
            'clientIDs' => 1,
        );
        $data = http_build_query($dataArray);

        $getUrl = $url . "?" . $data;
//                                dd($getUrl);
        $contents = file_get_contents($getUrl, false);
        return redirect(route('form.complete'));
//        return view('form.registerComplete');
    }

    public function showFormComplete()
    {
        return view('form.registerComplete');
    }


    //edit forms

    public function singleEdit($id)
    {
        $single_result = SingleResult::find($id);

        $ostans = Ostan::all();
        $shahrestans = Shahrestan::where('ostan', $single_result->ostan_id)->get();
        $majors = Major::all();

        //get single data
        $mosques = masjed::where('ostan', Ostan::find($single_result->ostan_id)->name)->where('shahrestan', Shahrestan::find($single_result->shahrestan_id)->name)->get();

        $date = DateTime::createFromFormat('Y-m-d H:i:s', $single_result->birthday);
        $shamsi_date = CalendarUtils::toJalali($date->format('Y'), $date->format('m'), $date->format('d'));

        $b_day = $shamsi_date[2];
        $b_month = $shamsi_date[1];
        $b_year = $shamsi_date[0];

        return view('editForm.IndividualForm', compact('ostans', 'shahrestans', 'majors', 'single_result', 'b_day', 'b_month', 'b_year', 'mosques'));
    }

    public function groupEdit($id)
    {
        $group_result = GroupResult::find($id);

        $ostans = Ostan::all();
        $shahrestans = Shahrestan::where('ostan', $group_result->ostan_id)->get();

        $mosques = masjed::where('ostan', Ostan::find($group_result->ostan_id)->name)->where('shahrestan', Shahrestan::find($group_result->shahrestan_id)->name)->get();

        $date = DateTime::createFromFormat('Y-m-d H:i:s', $group_result->birthday);
        $shamsi_date = CalendarUtils::toJalali($date->format('Y'), $date->format('m'), $date->format('d'));

        $b_day = $shamsi_date[2];
        $b_month = $shamsi_date[1];
        $b_year = $shamsi_date[0];

        return view('editForm.groupForm', compact('ostans', 'shahrestans', 'group_result', 'mosques', 'b_day', 'b_month', 'b_year'));
    }

    public function familyEdit($id)
    {
        $family_result = FamilyResult::find($id);

        $ostans = Ostan::all();
        $shahrestans = Shahrestan::where('ostan', $family_result->ostan_id)->get();


        $mosques = masjed::where('ostan', Ostan::find($family_result->ostan_id)->name)->where('shahrestan', Shahrestan::find($family_result->shahrestan_id)->name)->get();

        $date = DateTime::createFromFormat('Y-m-d H:i:s', $family_result->birthdate);
        $shamsi_date = CalendarUtils::toJalali($date->format('Y'), $date->format('m'), $date->format('d'));

        $b_day = $shamsi_date[2];
        $b_month = $shamsi_date[1];
        $b_year = $shamsi_date[0];

        // get children
        $children = FamilyResultChildren::where('family_result_id', $id)->get();

        $ch_birthdate_1 = $children[0]->birthdate ?? "";
        $ch_birthdate_2 = $children[1]->birthdate ?? "";
        $ch_birthdate_3 = $children[2]->birthdate ?? "";
        $ch_birthdate_4 = $children[3]->birthdate ?? "";

        $date_1 = DateTime::createFromFormat('Y-m-d H:i:s', $ch_birthdate_1);
        $date_2 = DateTime::createFromFormat('Y-m-d H:i:s', $ch_birthdate_2);
        $date_3 = DateTime::createFromFormat('Y-m-d H:i:s', $ch_birthdate_3);
        $date_4 = DateTime::createFromFormat('Y-m-d H:i:s', $ch_birthdate_4);


        $shamsi_date_1 = array(-1,-1,-1);
        $shamsi_date_2 = array(-1,-1,-1);
        $shamsi_date_3 = array(-1,-1,-1);
        $shamsi_date_4 = array(-1,-1,-1);

        if ($date_1 != null) {
            $shamsi_date_1 = CalendarUtils::toJalali($date_1->format('Y'), $date_1->format('m'), $date_1->format('d'));
        }
        if ($date_2 != null) {
            $shamsi_date_2 = CalendarUtils::toJalali($date_2->format('Y'), $date_2->format('m'), $date_2->format('d'));
        }
        if ($date_3 != null) {
            $shamsi_date_3 = CalendarUtils::toJalali($date_3->format('Y'), $date_3->format('m'), $date_3->format('d'));
        }
        if ($date_4 != null) {
            $shamsi_date_4 = CalendarUtils::toJalali($date_4->format('Y'), $date_4->format('m'), $date_4->format('d'));
        }

        return view('editForm.familyForm', compact('ostans', 'shahrestans', 'mosques', 'b_day', 'b_month', 'b_year', 'family_result', 'children'
            , 'shamsi_date_1', 'shamsi_date_2', 'shamsi_date_3', 'shamsi_date_4'));

    }

    public function checkResponseSingleEdit(Request $request)
    {

        $data = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'national_code' => 'required',
            'mobile' => 'required',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
            'ostan_id' => 'required',
            'shahrestan_id' => 'required',
            'mosque' => 'required',
            'major' => 'required'
        ]);


        $data['month'] = str_pad($data['month'], 2, '0', STR_PAD_LEFT);
        $data['day'] = str_pad($data['day'], 2, '0', STR_PAD_LEFT);
        $birth_date = $data['year'] . '/' . $data['month'] . '/' . $data['day'];

        $birth_date = CalendarUtils::createDatetimeFromFormat('Y/m/d', $birth_date);

        SingleResult::whereId($data["id"])->update([
            'name' => $data['name'],
            'national_code' => $data['national_code'],
            'ostan_id' => $data['ostan_id'],
            'shahrestan_id' => $data['shahrestan_id'],
            'birthday' => $birth_date,
            'major' => $data['major'],
            'mosque_id' => $data['mosque'],
            'phone' => $data['mobile']
        ]);


        // send sms to user
        //API Url
        $major = Major::find($data['major'])->name ?? "";
        $url = 'https://peyk313.ir/API/V1.0.0/Send.ashx';
        $dataArray = array(
            'privateKey' => "67d84858-50c4-4dd1-9ad1-c4f1ae758462",
            'number' => "660005",
            'text' => "ثبت نام شما در بخش فردی و رشته $major به روز رسانی شد برای اطلاعات بیشتر وارد کانال دارالقرآن بسیج در ایتا یا روبیکا شوید.
eitaa.com/quranbsj_ir
rubika.ir/quranbsj_ir",
            'mobiles' => Auth::user()->mobile,
            'clientIDs' => 1,

        );
        $data = http_build_query($dataArray);
        $getUrl = $url . "?" . $data;
        $contents = file_get_contents($getUrl, false);


        return redirect(route('form.complete'));

    }

    public function checkResponseGroupEdit(Request $request)
    {

        $data = $request->validate([
            'id' => 'required',
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
            'type' => 'required'
        ]);


        $data['month'] = str_pad($data['month'], 2, '0', STR_PAD_LEFT);
        $data['day'] = str_pad($data['day'], 2, '0', STR_PAD_LEFT);

        $birth_date = $data['year'] . '/' . $data['month'] . '/' . $data['day'];

        $birth_date = CalendarUtils::createDatetimeFromFormat('Y/m/d', $birth_date);


        $group_result = GroupResult::whereId($data["id"])->update([
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
            'type' => $data['type'],
        ]);

        // send sms to user
        //API Url
        $url = 'https://peyk313.ir/API/V1.0.0/Send.ashx';
        $dataArray = array(
            'privateKey' => "67d84858-50c4-4dd1-9ad1-c4f1ae758462",
            'number' => "660005",
            'text' => "ثبت نام شما در بخش گروهی به روزرسانی شد برای اطلاعات بیشتر وارد کانال دارالقرآن بسیج در ایتا یا روبیکا شوید.
eitaa.com/quranbsj_ir
rubika.ir/quranbsj_ir",
            'mobiles' => Auth::user()->mobile,
            'clientIDs' => 1,

        );
        $data = http_build_query($dataArray);

        $getUrl = $url . "?" . $data;
//                                dd($getUrl);
        $contents = file_get_contents($getUrl, false);

        return redirect(route('form.complete'));

    }

    public function checkResponseFamilyEdit(Request $request)
    {
        $data = $request->validate([
            'id' => 'required',
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
            'mosque' => 'required',
            'child_name1' => '',
            'child_name2' => '',
            'child_name3' => '',
            'child_name4' => '',
            'child_day1' => '',
            'child_day2' => '',
            'child_day3' => '',
            'child_day4' => '',
            'child_month1' => '',
            'child_month2' => '',
            'child_month3' => '',
            'child_month4' => '',
            'child_year1' => '',
            'child_year2' => '',
            'child_year3' => '',
            'child_year4' => ''
        ]);

        $data['month'] = str_pad($data['month'], 2, '0', STR_PAD_LEFT);
        $data['day'] = str_pad($data['day'], 2, '0', STR_PAD_LEFT);

        $birth_date = $data['year'] . '/' . $data['month'] . '/' . $data['day'];

        $birth_date = CalendarUtils::createDatetimeFromFormat('Y/m/d', $birth_date);

        FamilyResult::whereId($data["id"])->update([
            'name' => $data['family_name'],
            'ostan_id' => $data['ostan_id'],
            'shahrestan_id' => $data['shahrestan_id'],
            'father_name' => $data['father_name'],
            'father_national_code' => $data['father_national_code'],
            'father_phone' => $data['father_phone'],
            'mother_name' => $data['mother_name'],
            'mother_phone' => $data['mother_phone'],
//            'child_count'=>$data['child_count'],
            'birthdate' => $birth_date,
            'mosque_id' => $data['mosque'],
            'user_id' => Auth::user()->id
        ]);


        FamilyResultChildren::where('family_result_id', $data['id'])->delete();


        // inserting child info
        if ($data['child_name1']) {
            if ($data['child_year1']) {
                $data['child_month1'] = str_pad($data['child_month1'], 2, '0', STR_PAD_LEFT);
                $data['child_day1'] = str_pad($data['child_day1'], 2, '0', STR_PAD_LEFT);

                $birth_date = $data['child_year1'] . '/' . $data['child_month1'] . '/' . $data['child_day1'];

                $child_birth_date1 = CalendarUtils::createDatetimeFromFormat('Y/m/d', $birth_date);
            }
            FamilyResultChildren::create([
                'family_result_id' => $data["id"],
                'name' => $data['child_name1'],
                'birthdate' => $child_birth_date1,
            ]);
        }
        if ($data['child_name2']) {
            if ($data['child_year2']) {
                $data['child_month2'] = str_pad($data['child_month2'], 2, '0', STR_PAD_LEFT);
                $data['child_day2'] = str_pad($data['child_day2'], 2, '0', STR_PAD_LEFT);

                $birth_date = $data['child_year2'] . '/' . $data['child_month2'] . '/' . $data['child_day2'];

                $child_birth_date2 = CalendarUtils::createDatetimeFromFormat('Y/m/d', $birth_date);
            }
            FamilyResultChildren::create([
                'family_result_id' => $data["id"],
                'name' => $data['child_name2'],
                'birthdate' => $child_birth_date2,
            ]);
        }
        if ($data['child_name3']) {
            if ($data['child_year3']) {
                $data['child_month3'] = str_pad($data['child_month3'], 2, '0', STR_PAD_LEFT);
                $data['child_day3'] = str_pad($data['child_day3'], 2, '0', STR_PAD_LEFT);

                $birth_date = $data['child_year3'] . '/' . $data['child_month3'] . '/' . $data['child_day3'];

                $child_birth_date3 = CalendarUtils::createDatetimeFromFormat('Y/m/d', $birth_date);
            }
            FamilyResultChildren::create([
                'family_result_id' => $data["id"],
                'name' => $data['child_name3'],
                'birthdate' => $child_birth_date3,
            ]);
        }
        if ($data['child_name4']) {
            if ($data['child_year4']) {
                $data['child_month4'] = str_pad($data['child_month4'], 2, '0', STR_PAD_LEFT);
                $data['child_day4'] = str_pad($data['child_day4'], 2, '0', STR_PAD_LEFT);

                $birth_date = $data['child_year4'] . '/' . $data['child_month4'] . '/' . $data['child_day4'];

                $child_birth_date4 = CalendarUtils::createDatetimeFromFormat('Y/m/d', $birth_date);
            }
            FamilyResultChildren::create([
                'family_result_id' => $data["id"],
                'name' => $data['child_name4'],
                'birthdate' => $child_birth_date4,
            ]);
        }

        // send sms to user
        //API Url
        $url = 'https://peyk313.ir/API/V1.0.0/Send.ashx';
        $dataArray = array(
            'privateKey' => "67d84858-50c4-4dd1-9ad1-c4f1ae758462",
            'number' => "660005",
            'text' => "ثبت نام شما در بخش خانوادگی به روزرسانی شد برای اطلاعات بیشتر وارد کانال دارالقرآن بسیج در ایتا یا روبیکا شوید.
eitaa.com/quranbsj_ir
rubika.ir/quranbsj_ir",
            'mobiles' => Auth::user()->mobile,
            'clientIDs' => 1,
        );
        $data = http_build_query($dataArray);

        $getUrl = $url . "?" . $data;

        $contents = file_get_contents($getUrl, false);
        return redirect(route('form.complete'));

    }
}
