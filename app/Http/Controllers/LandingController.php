<?php

namespace App\Http\Controllers;

use App\Models\Exsum;
use App\Models\Topic;
use App\Models\Jurnal;
use App\Models\Report;
use App\Models\Category;
use App\Models\Knowledge;
use Illuminate\View\View;
use App\Models\Explanation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LandingController extends Controller
{
    public function index(Request $request): View
    {
        $knows = Knowledge::all();
        $topics = Topic::all();
        $categories = Category::all();
        
        return view('welcome', compact('knows','topics','categories'));
    }

    public function show($id){
        $decrypt = decrypt($id);
        $knows = Knowledge::findOrFail($decrypt);
        $categories = Category::all();
        $report = Report::where('knowledge_id', $decrypt)->first();
        $exsum = Exsum::where('knowledge_id', $decrypt)->first();
        $jurnal = Jurnal::where('knowledge_id', $decrypt)->first();
        $explanation = Explanation::where('knowledge_id', $decrypt)->first();

        return view('app-landing.knows-detail', compact('knows', 'categories','report', 'exsum', 'jurnal', 'explanation'));
    }

    public function knowcat(Request $request){

        

    }
}
