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

        //calculate form count
        $single_count = SingleResult::where('user_id', auth()->user()->id)->count();
        $family_count = FamilyResult::where('user_id', auth()->user()->id)->count();
        $group_count = GroupResult::where('user_id', auth()->user()->id)->count();

        //moaref count
        $moaref_count = Moaref::where('moaref_mobile', auth()->user()->mobile)->count();

        //get messages
        $messages = Message::where('receiver_id', null)->orWhere('receiver_id', auth()->user()->id)->get();

        return view('participate.index', compact('single_count','family_count','group_count','moaref_count','messages'));
    }
}
