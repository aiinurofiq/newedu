<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Explanation;
use App\Models\Exsum;
use App\Models\Jurnal;
use App\Models\Knowledge;
use App\Models\Report;
use App\Models\Reqknowledge;
use App\Models\Topic;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;

class AccdashController extends Controller
{
    public function index()
    {
        $knows = Knowledge::all();
        $topics = Topic::all();
        $categories = Category::all();
        $reqknows = Reqknowledge::all();
        $user = User::all();
        
        return view('profile.dashboard', compact('knows','topics','categories', 'reqknows', 'user'));
    }


    
}
