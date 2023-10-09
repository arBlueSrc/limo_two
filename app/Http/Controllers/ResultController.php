<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Azmoon;
use App\Models\ClassPack;
use App\Models\ClassSession;
use App\Models\Lesson;
use App\Models\NormalRepresentative;
use App\Models\Question;
use App\Models\Representative;
use App\Models\Result;
use App\Models\Room;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use App\MyClasses\SpreadsheetReader;

class ResultController extends Controller
{
    public function index(Request $request)
    {

        $filter = $request->input('filter');
        $filter_type = $request->input('filter_type');

        if ($filter!=null){
            if ($filter_type=='name'){
                $results = Result::whereHas('name', function ($query) use ($filter){
                    $query->where('name', 'like', '%'.$filter.'%');
                })->paginate(15);
            }else{

                $results = Result::whereHas('azmoon', function ($query) use ($filter){
                    $query->where('name', 'like', '%'.$filter.'%');
                })->paginate(15);
            }
        }else{
            $results = Result::paginate(15);
        }
        return view('admin.result.index', compact('results','filter','filter_type'));
    }

    public function exportExcel(Request $request)
    {

        if ($request->input('filter_para')!=null){
            if ($request->input('filter_type_para')=='name'){
                $results = Result::whereHas('name', function ($query) use ($request){
                    $query->where('name', 'like', '%'.$request->input('filter_para').'%');
                })->get();
            }else{
                $results = Result::whereHas('azmoon', function ($query) use ($request){
                    $query->where('name', 'like', '%'.$request->input('filter_para').'%');
                })->get();
            }
        }else{
            $results = Result::get();
        }

        // Submission from
        $filename = "result_" . date('Ymd') . ".csv";
        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        echo "\xEF\xBB\xBF"; // UTF-8 BOM


        //create heading
        $heading = array(
            'ردیف',
            'نام',
            'شماره همراه',
            'شماره آزمون',
            'تعداد درست',
            'تعداد غلط',
            'تعداد نزده',
            'امتیاز'
        );

        echo implode(",", array_values($heading)) . "\n";


        foreach ($results as $result) {

           $data1 = $result->id;
           $data2 = $result->name->name;
           $data3 = $result->name->mobile;
           $data4 = $result->azmoon_id;
           $data5 = $result->true_answer;
           $data6 = $result->wrong_answer;
           $data7 = $result->empty_answer;
           $data8 = $result->percent;


            $rows = [
                $data1,
                $data2,
                $data3,
                $data4,
                $data5,
                $data6,
                $data7,
                $data8
            ];

            echo implode(",", array_values($rows)) . "\n";

        }

        mb_convert_encoding($filename, 'UTF-16LE', 'UTF-8');
        exit();
    }


    public function reCreateResults(){

        set_time_limit(1500);

        $azmoon_id = 10;



        $users = User::all();


        foreach ($users as $user){

            $true_answers = 0;
            $wrong_answers = 0;
            $empty_answers = 0;

            $azmoon = Azmoon::find($azmoon_id)->negative_point;

            $questions = Question::where('parent_azmoon', $azmoon_id)->get();

            foreach ($questions as $question) {
                $true_answer = $question->answer;
                $user_answer = Answer::where('question_id', $question->id)
                    ->where('user_id', $user->id)
                    ->first()->user_answer ?? -1;
                if ($true_answer == $user_answer) {
                    $true_answers++;
                } elseif ($user_answer == -1) {
                    $empty_answers++;
                } else {
                    $wrong_answers++;
                }
            }
            if ($azmoon) {
                $percent = ((($true_answers * 3) - $wrong_answers) / ($questions->count() * 3)) * 100;
            } else {
                $percent = ($true_answers * 100) / $questions->count();
            }

            // karnameh
            Result::create([
                'user_id' => $user->id,
                'azmoon_id' => $azmoon_id,
                'true_answer' => $true_answers,
                'wrong_answer' => $wrong_answers,
                'empty_answer' => $empty_answers,
                'percent' => $percent,
            ]);


        }

        echo 'done babe';

    }



}
