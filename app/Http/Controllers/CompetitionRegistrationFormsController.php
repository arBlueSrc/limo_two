<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Masjed;
use App\Models\Ostan;
use App\Models\Shahrestan;
use App\Models\SingleResult;
use App\Models\UploadFile;
use Illuminate\Http\Request;

class CompetitionRegistrationFormsController extends Controller
{
    public function individualForm()
    {
        $ostans = Ostan::where('id', 8)->get();
        $shahrestans = Shahrestan::where('ostan', $ostans->first()->id)->get();
        $majors = Major::all();
        $masjeds = Masjed::where('ostan', $ostans->get(0)->name)->where('shahrestan', $shahrestans->get(0)->name)->where('gender', "!=", "خواهر")->get();

        return view('form.IndividualForm', compact('ostans', 'shahrestans', 'majors', 'masjeds'));
    }

    public function groupForm()
    {
        $ostans = Ostan::where('id', 8)->get();
//        $ostans = Ostan::where('id',8)->get();
        $shahrestans = Shahrestan::where('ostan', $ostans->first()->id)->get();
        return view('form.groupForm', compact('ostans', 'shahrestans'));
    }

    public function familyForm()
    {
        $ostans = Ostan::where('id', 8)->get();
//        $ostans = Ostan::where('id',8)->get();
        $shahrestans = Shahrestan::where('ostan', $ostans->first()->id)->get();
        return view('form.familyForm', compact('ostans', 'shahrestans'));
    }

    public function getChildShahrestans(Request $request)
    {
        //geting shahrestans by ajax request
        if (!$request->ajax()) {
            return response()->json([
                'status' => 'not ajax request',
            ]);
        }
        $valid_data = $request->validate([
            'ostan_id' => ['required']
        ]);
        $childShahrestans = Shahrestan::where('ostan', $valid_data['ostan_id'])->get();
        return $childShahrestans;
    }

    public function getRelatedMasjeds(Request $request)
    {

        if (!$request->ajax()) {
            return response()->json([
                'status' => 'not ajax request',
            ]);
        }
        $data = $request->validate([
            'shahrestan_id' => 'required',
            'gender' => ''
        ]);

        $shahrestan_name = Shahrestan::where('id', $data['shahrestan_id'])->first()->name;

        if ($request->gender == null) {
            $masjeds = Masjed::where('shahrestan', "LIKE", $shahrestan_name)->get();
        } else {
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
            $masjeds = Masjed::where('shahrestan', "LIKE", $shahrestan_name)->whereIn('gender', [$gender_filter, "مشترک"])->get();
        }

        return $masjeds;

    }


    public function getRelatedMajors(Request $request)
    {

        if (!$request->ajax()) {
            return response()->json([
                'status' => 'not ajax request',
            ]);
        }

        $data = $request->validate([
            'year' => 'required',
            'gender' => 'required'
        ]);

        $majors = Major::where('from_year', "<=", $data['year'])->Where('to_year', ">=", $data['year'])->whereIn('gender', [$data['gender'], 2])->get();

        return $majors;

    }

    public function uploadFile(Request $request)
    {


        $single_forms = SingleResult::where('user_id', $request->get('id'))->get();

        foreach ($single_forms as $index => $item) {

        }
        $request->validate([
            'id' => 'required',
            'meliCard' => 'file|max:102400',
            'madrak' => 'file|max:102400',
            'tarh_dars' => 'file|max:102400',
            'tadrisVideo' => 'file|max:102400',
        ]);

        for ($i = 0; $i < 3; $i++) {
            if ($request->file('meliCard' . $i) != null && $request->file('meliCard' . $i)->isValid()) {
                // Store the file in the 'uploads' directory on the 'public' disk
                $file1 = $request->file('meliCard' . $i);
                $fileName1 = auth()->id() . '_' . time() . rand(10, 100) . '.' . $file1->extension();
                $filePath1 = $request->file('meliCard' . $i)->storeAs('fileUploads', $fileName1, 'public');
                UploadFile::where('single_result_id', $request->get('id'))->where('type', 1)->delete();

                UploadFile::create([
                    'single_result_id' => $request->get('id'),
                    'path' => $filePath1,
                    'type' => 1,
                ]);
            }
        }

        for ($i = 0; $i < 3; $i++) {
            if ($request->file('madrak' . $i) != null && $request->file('madrak' . $i)->isValid()) {
                // Store the file in the 'uploads' directory on the 'public' disk
                $file2 = $request->file('madrak' . $i);
                $fileName2 = auth()->id() . '_' . time() . rand(10, 100) . '.' . $file2->extension();
                $filePath2 = $request->file('madrak' . $i)->storeAs('fileUploads', $fileName2, 'public');
                UploadFile::where('single_result_id', $request->get('id'))->where('type', 2)->delete();

                UploadFile::create([
                    'single_result_id' => $request->get('id'),
                    'path' => $filePath2,
                    'type' => 2,
                ]);
            }
        }

        for ($i = 0; $i < 3; $i++) {
            if ($request->file('tarh_dars' . $i) != null && $request->file('tarh_dars' . $i)->isValid()) {
                // Store the file in the 'uploads' directory on the 'public' disk
                $file3 = $request->file('tarh_dars' . $i);
                $fileName3 = auth()->id() . '_' . time() . rand(10, 100) . '.' . $file3->extension();
                $filePath3 = $request->file('tarh_dars' . $i)->storeAs('fileUploads', $fileName3, 'public');
                UploadFile::where('single_result_id', $request->get('id'))->where('type', 3)->delete();

                UploadFile::create([
                    'single_result_id' => $request->get('id'),
                    'path' => $filePath3,
                    'type' => 3,
                ]);
            }
        }

        for ($i = 0; $i < 3; $i++) {
            if ($request->file('tadrisVideo' . $i) != null && $request->file('tadrisVideo' . $i)->isValid()) {
                // Store the file in the 'uploads' directory on the 'public' disk
                $file4 = $request->file('tadrisVideo' . $i);
                $fileName4 = auth()->id() . '_' . time() . rand(10, 100) . '.' . $file4->extension();
                $filePath4 = $request->file('tadrisVideo' . $i)->storeAs('fileUploads', $fileName4, 'public');
                UploadFile::where('single_result_id', $request->get('id'))->where('type', 4)->delete();

                UploadFile::create([
                    'single_result_id' => $request->get('id'),
                    'path' => $filePath4,
                    'type' => 4,
                ]);
            }
        }

        return redirect()->back();

    }


}
