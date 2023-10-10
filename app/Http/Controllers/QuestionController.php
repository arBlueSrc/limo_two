<?php

namespace App\Http\Controllers;

use App\Models\Azmoon;
use App\Models\Question;
use App\MyClasses\SpreadsheetReader;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $azmoons = Azmoon::paginate(15);
        return view('admin.azmoon.index',compact('azmoons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function store(Request $request)
    {

        $valid_data = $request->validate([
            'question' => 'required',
            'option_1' => 'required',
            'option_2' => 'required',
            'option_3' => 'required',
            'option_4' => 'required',
            'answer' => 'required',
            'azmoon_id' => 'required',
        ]);


        $question = Question::create([
            'question' => $valid_data['question'],
            'option_1' => $valid_data['option_1'],
            'option_2' => $valid_data['option_2'],
            'option_3' => $valid_data['option_3'],
            'option_4' => $valid_data['option_4'],
            'answer' => $valid_data['answer'],
            'parent_azmoon' => $valid_data['azmoon_id']
        ]);

        return back();
    }

    public function tashrihi_question_store(Request $request)
    {
        $valid_data=$request->validate([
           'question'=>'required',
           'true_answer'=>'',
           'azmoon_id'=>'required',
        ]);
        Question::create([
           'question'=>$valid_data['question'],
           'type'=>1,
           'tashrihi_answer'=>$valid_data['true_answer'],
           'parent_azmoon'=>$valid_data['azmoon_id'],
        ]);
        return back();
    }
    public function tashrihi_question_update(Request $request){
        $valid_data=$request->validate([
            'tashrihi_question_update'=>'',
            'tashrihi_true_answer_update'=>'',
            'tashrihi_question_id'=>''
        ]);

        Question::find($valid_data['tashrihi_question_id'])->update([
           'question'=>$valid_data['tashrihi_question_update'],
           'tashrihi_answer'=>$valid_data['tashrihi_true_answer_update'],
        ]);
        return back();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $azmoon = Azmoon::find($id);
        $questions = Question::where('parent_azmoon',$azmoon->id)->get();
        return view('admin.azmoon.show', compact('azmoon','questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        dd($request->input('question_id'));
        $valid_data = $request->validate([
            'question_update' => 'required',
            'option_1_update' => 'required',
            'option_2_update' => 'required',
            'option_3_update' => 'required',
            'option_4_update' => 'required',
            'answer_update' => 'required',
            'question_id' => ''
        ]);

        Question::find($valid_data['question_id'])->update([
            'question' => $valid_data['question_update'],
            'option_1' => $valid_data['option_1_update'],
            'option_2' => $valid_data['option_2_update'],
            'option_3' => $valid_data['option_3_update'],
            'option_4' => $valid_data['option_4_update'],
            'answer' => $valid_data['answer_update']
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Question::destroy($request->input('question_id'));
        return back();
    }



    public function uploadExcel(Request $request)
    {
        //upload excel
        $file = $request->file('file');
        $fileName = auth()->id() . '_' . time() . '.'. $file->extension();

        //Move Uploaded File
        $destinationPath = 'uploads';
        $file->move($destinationPath,$fileName);

        //read excel
        header('Content-Type: text/plain');
        $Filepath = public_path('uploads/'.$fileName);


        $azmoon_id = $request->input('azmoon_id');


        // Excel reader from http://code.google.com/p/php-excel-reader/

        date_default_timezone_set('UTC');

        $StartMem = memory_get_usage();

        try {
            $Spreadsheet = new SpreadsheetReader($Filepath);
            $BaseMem = memory_get_usage();

            $Sheets = $Spreadsheet->Sheets();

            foreach ($Sheets as $Index => $Name) {

                $Time = microtime(true);

                $Spreadsheet->ChangeSheet($Index);

                $counter = -1;

                foreach ($Spreadsheet as $Key => $Row) {
                    $counter++;



                        /*
                                [0] => سوال
                                [1] => نوع
                                [2] => گزینه 1
                                [3] => گزینه 2
                                [4] => گزینه 3
                                [5] => گزینه 4
                                [6] => پاسخ
                         */


                    $CurrentMem = memory_get_usage();

                    // echo 'Memory: ' . ($CurrentMem - $BaseMem) . ' current, ' . $CurrentMem . ' base' . PHP_EOL;

                    if ($counter > 0 && $Row[0] != "") {

                        $type = 0;
                        if ($Row[1] == "تشریحی"){
                            $type = 1;
                        }

                        Question::create([
                            'question' => $Row[0] ,
                            'type' => $type ,
                            'option_1' => $Row[2] ,
                            'option_2' => $Row[3] ,
                            'option_3' => $Row[4] ,
                            'option_4' => $Row[5] ,
                            'answer' => $Row[6] ,
                            'parent_azmoon' => $azmoon_id ,
                        ]);

                    }

                }

            }

        } catch (Exception $E) {
            echo $E->getMessage();
        }

        return back();


    }

}
