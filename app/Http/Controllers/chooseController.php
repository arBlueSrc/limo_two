<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class chooseController extends Controller
{
     public function catgory(){

         return view('choose.Choose')->with('page','choose');


     }
}
