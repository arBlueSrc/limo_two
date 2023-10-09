<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Azmoon;
use App\Models\Question;
use App\Models\Result;
use Illuminate\Http\Request;
use Morilog\Jalali\CalendarUtils;

class AzmoonController extends Controller
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
        return view('admin.azmoon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $valid_data = $request->validate([
            'name' => 'required',
            'negative_point' => 'required',
            'randomic' => 'required',
            'date' => 'required',
            'start' => 'required',
            'end' => 'required',
            'duration_h' => 'required',
            'duration_m' => 'required',
        ]);

        $values = explode('/', $valid_data['date']);
        $start_day =  str_pad($values[2], 2, '0', STR_PAD_LEFT);
        $start_month =  str_pad($values[1], 2, '0', STR_PAD_LEFT);
        $start_year = $values[0];
        $final_date = $start_year."/".$start_month."/".$start_day;

        $start_time = $final_date. " " . $valid_data['start'];
        $end_time = $final_date . " " . $valid_data['end'];
        $start_datetime = CalendarUtils::createDatetimeFromFormat('Y/m/d H:i', $start_time);
        $end_datetime = CalendarUtils::createDatetimeFromFormat('Y/m/d H:i', $end_time);

        Azmoon::create([
            'name' => $valid_data['name'],
            'negative_point' => $valid_data['negative_point'],
            'randomic' => $valid_data['randomic'],
            'start_time' => $start_datetime,
            'end_time' => $end_datetime,
            'shamsi' => $final_date,
            'start_hour' => $valid_data['start'],
            'end_hour' => $valid_data['end'],
            'duration' => str_pad($valid_data['duration_h'], 2, '0', STR_PAD_LEFT) . ":" . str_pad($valid_data['duration_m'], 2, '0', STR_PAD_LEFT),
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        Azmoon::destroy($request->input('delete_id'));
        Answer::where('azmoon_id',$request->input('delete_id'))->delete();
        Question::where('parent_azmoon', $request->input('delete_id'))->delete();
        Result::where('azmoon_id', $request->input('delete_id'))->delete();
        return back();
    }

    public function updateTitle(Request $request){

        Azmoon::where('id', $request->input('id'))->update([
            'name' => $request->input('name')
        ]);

        return back();

    }

    public function updateRandomicNumber(Request $request){

        Azmoon::where('id', $request->input('id'))->update([
            'randomic_number' => $request->input('questionNumber')
        ]);

        return back();

    }

    public function updateTime(Request $request){

        $valid_data = $request->validate([
            'id_update' => 'required',
            'name_update' => 'required',
            'negative_point_update' => 'required',
            'randomic_update' => 'required',
            'date_update' => 'required',
            'start_update' => 'required',
            'end_update' => 'required',
            'duration_h_update' => 'required',
            'duration_m_update' => 'required'
        ]);

//        dd($valid_data['date_update']);


        $start_time = $valid_data['date_update']. " " . $valid_data['start_update'];
        $end_time = $valid_data['date_update'] . " " . $valid_data['end_update'];



        $values = explode('/', $valid_data['date_update']);
        $start_day =  str_pad($values[2], 2, '0', STR_PAD_LEFT);
        $start_month =  str_pad($values[1], 2, '0', STR_PAD_LEFT);
        $start_year = $values[0];
        $final_date = $start_year."/".$start_month."/".$start_day;

        $start_time = $final_date. " " . $valid_data['start_update'];
        $end_time = $final_date . " " . $valid_data['end_update'];


        $start_datetime = CalendarUtils::createDatetimeFromFormat('Y/m/d H:i', $start_time);
        $end_datetime = CalendarUtils::createDatetimeFromFormat('Y/m/d H:i', $end_time);


        Azmoon::where('id', $valid_data['id_update'])->update([
            'name' => $valid_data['name_update'],
            'negative_point' => $valid_data['negative_point_update'],
            'randomic' => $valid_data['randomic_update'],
            'start_time' => $start_datetime,
            'end_time' => $end_datetime,
            'shamsi' => $valid_data['date_update'],
            'start_hour' => $valid_data['start_update'],
            'end_hour' => $valid_data['end_update'],
            'duration' => str_pad($valid_data['duration_h_update'], 2, '0', STR_PAD_LEFT) . ":" . str_pad($valid_data['duration_m_update'], 2, '0', STR_PAD_LEFT),
        ]);

        return back();
    }
}
