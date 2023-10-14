<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Azmoon;
use App\Models\LogAzmoon;
use App\Models\Question;
use App\Models\Result;
use App\Models\SingleResult;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use stdClass;

class UserAzmoonController extends Controller
{
    public function index()
    {
        $azmoons = Azmoon::all();
        $user=SingleResult::where('phone',auth()->user()->mobile)->get();
        $user_majors=$user->pluck('major');
//        dd($user_majors);
//        dd($user_majors->contains('144'));
//        dd($user->pluck('major'));
        $index = 0;
        foreach ($azmoons as $azmoon){
            $now = Carbon::now();
//            if ($now->isBefore($azmoon->start_time) || $now->isAfter($azmoon->end_time) || !$user_majors->contains($azmoon->major_id)) {
//            if ($now->isAfter($azmoon->end_time) || !$user_majors->contains($azmoon->major_id)) {
            if (!$user_majors->contains($azmoon->major_id)) {
                $azmoons->forget($index);
            }
            $index++;
        }
        return view('azmoon.index', compact('azmoons'));
    }
    public function questions(Azmoon $azmoon)
    {
        $request=request();
//        dd($request->get('page'));

        $user_id = auth()->user()->id;

        $now = Carbon::now();

        $startTime = Carbon::parse($azmoon->start_time);
        $finishTime = Carbon::parse($azmoon->end_time);


        $user_logined=SingleResult::where('phone',auth()->user()->mobile)->get();
        $user_majors=$user_logined->pluck('major');

        if (!$user_majors->contains($azmoon->major_id)){
            return redirect()->back()->with('message','شما در این آزمون ثبت نام نکرده اید.امکان شرکت در این آزمون برای شما وجود ندارد.');
        }


        //check azmoon time
        if ($now->isBefore($azmoon->start_time)) {
            //it is not exam time
            return redirect()->back()->with('message', 'هنوز آزمون شروع نشده است.لطفا در زمان برگزاری آزمون امتحان کنید');
        } else if ($now->isAfter($azmoon->end_time)) {
            //exam time is over
            return redirect()->back()->with('message', 'زمان برگزاری آزمون تمام شده است');
        }

        //check user do exam

        $user = auth()->user();
        $user=SingleResult::where('phone',auth()->user()->mobile)->first();

            if (Result::where('user_id',$user->id)->where('azmoon_id',$azmoon->id)->count()) {
                return redirect()->back()->with('message', 'شما قبلا در این آزمون شرکت کرده اید.');
            }
            else{
                /*if (Answer::where('azmoon_id', $azmoon->id)->where('user_id', $user->id)->count()) {
                    //user already did this exam
                    return redirect()->back()->with('message', 'شما قبلا در این آزمون شرکت کرده اید.');
                }*/
            }


        //check user start time
        $now = Carbon::now();
        $log_azmoon = LogAzmoon::where('azmoon_id',$azmoon->id)->where('user_id',$user->id)->first();
        if ($log_azmoon == null){
            $log_azmoon = LogAzmoon::create([
                'user_id' => $user->id,
                'azmoon_id' => $azmoon->id,
                'start_time' => $now
            ]);
        }
        $duration = $azmoon->duration;
        $values = explode(':', $duration);
        $hour = $values[0];
        $min = $values[1];

        $end_user_time = Carbon::parse($log_azmoon->start_time)->add($hour,'hours')->add($min,'minutes');

        if ($end_user_time->isAfter($azmoon->end_time)){
            $end_user_time = Carbon::parse($azmoon->end_time);
        }

        $time_remain = $end_user_time->diffInSeconds($now);

        if ($now->isAfter($end_user_time)){
            return redirect()->back()->with('message', 'زمان شما برای شرکت در این آزمون به پایان رسیده است.');
        }
//        $questions = Question::where('parent_azmoon', $azmoon->id)->get()->shuffle($user->id)->pluck('id');
//        $questions = Question::where('parent_azmoon', $azmoon->id)->get();

        $questions = Question::where('parent_azmoon', $azmoon->id)->paginate(1);

//        dd($questions);
//        dd($questions);
        /*if ($azmoon->randomic){
            srand($user->id.$azmoon->id);
            $random_number_range = range(1, $questions->count());

            shuffle($random_number_range );
            $ex=$random_number_range;
//            dd($ex);
//            dd($random_number_range);
            $random_number_array_generated=$random_number_range;
            $random_number_array_generated = array_slice($random_number_range ,1
                ,$questions->count()-$azmoon->randomic_number);
//            dd($random_number_array_generated);
            foreach ($random_number_array_generated as $value){
                $questions->forget($value);
            }
            dd($questions);
        }*/
        $login_user=SingleResult::where('phone',auth()->user()->mobile)->first();
        $azmoon_question_count = Question::where('parent_azmoon', $azmoon->id)->count();
        return view('azmoon.questions', compact('end_user_time','questions', 'azmoon', 'azmoon_question_count', 'time_remain','login_user'));
    }

    public function answerHnadler(Request $request)
    {
        $now = Carbon::now();
        $now2 = $now->subMinutes(2);
        $azmoon = Azmoon::find($request->azmoon_id);
        if ($now->isBefore($azmoon->start_time)) {
            //it is not exam time
            return redirect(route('azmoons.index'))->with('message', 'هنوز آزمون شروع نشده است.لطفا در زمان برگزاری آزمون امتحان کنید');
        } else if ($now2->isAfter($azmoon->end_time)) {
            //exam time is over
            return redirect(route('azmoons.index'))->with('message', 'زمان برگزاری آزمون تمام شده است');
        }
//        dd($request->azmoon_id);

//        $user_id = auth()->user()->id;
        $user_id=SingleResult::where('phone',auth()->user()->mobile)->first()->id;
//        dd($user_id);
//        if ( Result::where('user_id',$user_id)->where('azmoon_id',$azmoon->id)->count() || Answer::where('azmoon_id', $request->azmoon_id)->where('user_id', $user_id)->count()) {
        if ( Result::where('user_id',$user_id)->where('azmoon_id',$azmoon->id)->count()  ) {
            //user already did this exam
            return redirect(route('azmoons.index'))->with('message', 'شما قبلا در این آزمون شرکت کرده اید.');
        }
        $question_ids = $request->input('question_id');
        $text_question_ids=$request->input('text_question_id') ?? [];
//        dd($text_question_ids);
//        dd($question_ids);

        foreach ($question_ids as $q) {
            /*if ($request->input('q' . $q).length > 3){
                dd($request->input('q' . $q));
        }*/
//            echo $q;
            if ($request->input('q' . $q) != null) {

                if (!in_array($q,$text_question_ids)) {
                    Answer::create([
                        'user_id' => $user_id,
                        'azmoon_id' => $request->azmoon_id,
                        'question_id' => $q,
                        'user_answer' => $request->input('q' . $q)
                    ]);
                            }
                else{
                    Answer::create([
                        'user_id' => $user_id,
                        'azmoon_id' => $request->azmoon_id,
                        'question_id' => $q,
                        'user_answer' => $request->input('q' . $q)
                    ]);
                    }
            }
        }

        $true_answers = 0;
        $wrong_answers = 0;
        $empty_answers = 0;


        $azmoon_has_negative_point = Azmoon::find($request->azmoon_id)->negative_point;

        $questions = Question::where('parent_azmoon', $request->azmoon_id)->get();
        foreach ($questions as $question) {
        if ($question->is_testi_question()) {
            $true_answer = $question->answer;
            $user_answer = Answer::where('question_id', $question->id)->where('user_id', $user_id)->first()->user_answer ?? -1;
            if ($true_answer == $user_answer) {
                $true_answers++;
            } elseif ($user_answer == -1) {
                $empty_answers++;
            } else {
                $wrong_answers++;
            }
        }
        else{
            //tashrihi question
        }
        }
        if ($azmoon_has_negative_point) {
//            $percent = ((($true_answers * 3) - $wrong_answers) / ($questions->count() * 3)) * 100;
            $percent = ((($true_answers * 4) - $wrong_answers) / ($questions->count() * 4)) * 100;
        } else {
            $percent = ($true_answers * 100) / $questions->count();
        }

        // karnameh
        Result::create([
            'user_id' => $user_id,
            'azmoon_id' => $request->azmoon_id,
            'true_answer' => $true_answers,
            'wrong_answer' => $wrong_answers,
            'empty_answer' => $empty_answers,
            'percent' => $percent,
        ]);
        //return redirect(route('user.azmoon.result', ['azmoon_id' => $request->azmoon_id]));
//        $azmoons = Azmoon::all();
        return redirect()->route('azmoons.index');
        return view('azmoon.index', compact('azmoons'));
    }
    public function userResult($result)
    {
        $user_id = auth()->user()->id;
        $result = Result::where('azmoon_id', $result)->where('user_id', $user_id)->get()->last();
        $azmoon = Azmoon::find($result->azmoon_id);
        $azmoon_question_count = Question::where('parent_azmoon', $azmoon->id)->count();
        return view('azmoon.result', compact('result', 'azmoon', 'azmoon_question_count'));
    }
    public function userResults()
    {
        $user=SingleResult::where('phone',auth()->user()->mobile)->first();
        $results = Result::where('user_id', $user->id)->get();
//        dd($results);

        $azmoon = 1;
        return view('azmoon.user-results', compact('results', 'azmoon','user'));
    }

    public function ajaxAnswerUpdate(Request $request)
    {
//        return $request->input('question_id')."/".$request->input('answer');
        $user=SingleResult::where('phone',auth()->user()->mobile)->first();
        $question_id=$request->input('question_id');
        $answer=$request->input('answer');

//        return $answer;

        $azmoon_id=$request->input('azmoon_id');
//        return $azmoon_id;
//        return $answer;

        $last_answer=Answer::where('user_id',$user->id)->where('azmoon_id',$azmoon_id)->where('question_id',$question_id)->first();

        if (!$answer && $last_answer){
            $last_answer->delete();
        }
        elseif($answer) {
            if ($last_answer) {
                $last_answer->update([
                    'user_answer' => $answer
                ]);
            } else {
                Answer::create([
                    'user_id' => $user->id,
                    'azmoon_id' => $azmoon_id,
                    'question_id' => $question_id,
                    'user_answer' => $answer,
                ]);
            }
        }
    }
}
