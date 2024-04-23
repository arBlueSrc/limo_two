<?php

namespace App\Http\Controllers;

use App\Models\masjed;
use App\Models\Ostan;
use App\Models\Shahrestan;
use Illuminate\Http\Request;

class MosqueUserController extends Controller
{
    public function create()
    {
        $this->authorize('is_superadmin');
        $ostans = Ostan::all();
        $shahrestans = Shahrestan::where('ostan', $ostans->first()->id)->get();
        $masjeds = masjed::all();
        return view('admin.mosqueUser.create', compact('ostans', 'shahrestans','masjeds'));
    }
}
