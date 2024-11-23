<?php

namespace App\Http\Controllers;

use App\Models\FamilyResult;
use App\Models\GroupResult;
use App\Models\Message;
use App\Models\Moaref;
use App\Models\SingleResult;
use Illuminate\Http\Request;
use PHPUnit\TextUI\XmlConfiguration\Group;

class ParticipateController extends Controller
{
    public function index()
    {
        $single_forms = SingleResult::where('user_id', auth()->user()->id)->get();
        $family_forms = FamilyResult::where('user_id', auth()->user()->id)->get();
        $group_forms = GroupResult::where('user_id', auth()->user()->id)->get();

        //calculate form count
        $single_count = SingleResult::where('user_id', auth()->user()->id)->count();
        $family_count = FamilyResult::where('user_id', auth()->user()->id)->count();
        $group_count = GroupResult::where('user_id', auth()->user()->id)->count();

        //moaref count
        $moaref_count = Moaref::where('moaref_mobile', auth()->user()->mobile)->count();

        //get messages
        $messages = Message::where('receiver_id', null)->orWhere('receiver_id', auth()->user()->id)->get();

        //get name
        $name = "";
        if ($single_count != 0){
            $name = SingleResult::where('user_id', auth()->user()->id)->first()->name;
        }else if($family_count != 0){
            $name = FamilyResult::where('user_id', auth()->user()->id)->first()->name;
        }else if($group_count != 0){
            $name = GroupResult::where('user_id', auth()->user()->id)->first()->name_group;
        }

        $single_results=SingleResult::where('phone',auth()->user()->mobile)->get();
         return view('participate.index', compact('single_count','family_count','group_count','moaref_count','messages','name',
        'single_forms', 'family_forms', 'group_forms','single_results'));
    }
    public function printLoh(Request $request)
    {
        $name=$request->name;
        $identifier=$request->identifier;
        $identifier=convertToPersianNumber($identifier);
//        $single_result=$request->single_result;
//        dd($request->single_result);
//        $user=auth()->user()->mobile;
//        single_results=SingleResult::where('mobile',)
        return view('participate.loh', compact('name','identifier'));
    }
}
