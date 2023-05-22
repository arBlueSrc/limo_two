<?php

namespace App\Http\Controllers;

use App\Models\GroupResult;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $users=GroupResult::all();

    }
}
