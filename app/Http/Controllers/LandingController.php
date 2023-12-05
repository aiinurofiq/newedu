<?php

namespace App\Http\Controllers;

use App\Models\Exsum;
use App\Models\Section;
use App\Models\Topic;
use App\Models\Jurnal;
use App\Models\Report;
use App\Models\Category;
use App\Models\Knowledge;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Explanation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Learning;
use App\Models\Lpayment;
use App\Models\LTransaction;
use App\Models\Reqknowledge;
use App\Models\Reqknowstat;

class LandingController extends Controller
{
    public function index(Request $request): View
    {
        $knows = Knowledge::all();
        $learns = Learning::all();
        $topics = Topic::all();
        $categories = Category::all();

        return view('welcome', compact('knows', 'topics', 'categories', 'learns'));
    }

    public function show($id)
    {
        $total = 0;
        $decrypt = decrypt($id);
        $request = Reqknowstat::where('reqknowledge_id',$decrypt)->where('user_id',Auth::user()->id)->get();
        $check = Reqknowstat::where('reqknowledge_id',$decrypt)->where('user_id', Auth::user()->id)->where('end_date', '>=', date('Y-m-d H:i:s'))->first();
        $checkreject = Reqknowstat::where('reqknowledge_id',$decrypt)->where('user_id', Auth::user()->id)->latest()->first();
        $approve =  $check ? $check : false;
        $knows = Knowledge::findOrFail($decrypt);
        $categories = Category::all();
        // $section = Section::where('knowledge_id', $learns->id)->get();
        $report = Report::where('knowledge_id', $decrypt)->get();
        $exsum = Exsum::where('knowledge_id', $decrypt)->get();
        $jurnal = Jurnal::where('knowledge_id', $decrypt)->get();
        $explanation = Explanation::where('knowledge_id', $decrypt)->get();
        if ($report) $total += $report->count();
        if ($exsum) $total += $exsum->count();
        if ($jurnal) $total += $jurnal->count();
        if ($explanation) $total += $explanation->count();
        // $request = Reqknowledge::where('knowledge_id', $decrypt)->get();

        return view('app-landing.knows-detail', compact('knows', 'categories', 'report', 'exsum', 'jurnal', 'explanation', 'total', 'request', 'approve', 'checkreject'));
        // return view('app-landing.requestknowledge', compact('knows', 'categories', 'report', 'exsum', 'jurnal', 'explanation', 'total'));
    }
    public function showlearn($id)
    {
        $decrypt = decrypt($id);
        $learns = Learning::findOrFail($decrypt);
        $categories = Category::all();
        $lpayment = Lpayment::all();
        $section = Section::where('learning_id', $learns->id)->get();
        $ltransaction = LTransaction::where('user_id', Auth::user()->id)->where('learning_id', $learns->id)->first();
        if ($ltransaction) {
            if ($ltransaction->status == 0) {
                return view('app-landing.requestlearning', compact('learns', 'categories', 'section', 'ltransaction'));
            } else {
                return view('app-landing.learns-detail', compact('learns', 'categories', 'section'));
            }
        } else {
            return view('app-landing.requestlearning', compact('learns', 'categories', 'section'));
            // return view('app-landing.checkout', compact('learns', 'categories', 'section','lpayment'));
        }
    }

    public function checkout($id)
    {
        $decrypt = decrypt($id);
        $learns = Learning::findOrFail($decrypt);
        $categories = Category::all();
        $lpayment = Lpayment::all();
        $section = Section::where('learning_id', $learns->id)->get();
        $ltransaction = LTransaction::where('user_id', Auth::user()->id)->where('learning_id', $learns->id)->first();
        return view('app-landing.checkout', compact('learns', 'categories', 'section', 'lpayment'));
    }

    public function knowcat(Request $request)
    {
    }

    public function view($id)
    {
        $total = 0;
        $decrypt = decrypt($id);
        $knows = Knowledge::findOrFail($decrypt);
        $categories = Category::all();
        // $section = Section::where('knowledge_id', $learns->id)->get();
        $report = Report::where('knowledge_id', $decrypt)->get();
        $exsum = Exsum::where('knowledge_id', $decrypt)->get();
        $jurnal = Jurnal::where('knowledge_id', $decrypt)->get();
        $explanation = Explanation::where('knowledge_id', $decrypt)->get();
        if ($report) $total += $report->count();
        if ($exsum) $total += $exsum->count();
        if ($jurnal) $total += $jurnal->count();
        if ($explanation) $total += $explanation->count();
        // $request = Reqknowledge::where('knowledge_id', $decrypt)->get();

        if (Auth::user()->id == $knows->user->id || Auth::user()->hasRole('super-admin')) {
            return view('app-landing.knows-detail', compact('knows', 'categories', 'report', 'exsum', 'jurnal', 'explanation', 'total'));
        } else {
            return redirect('/home');
        }
        // return view('app-landing.requestknowledge', compact('knows', 'categories', 'report', 'exsum', 'jurnal', 'explanation', 'total'));
    }
    public function requestlanding(Request $request)
    {
        Reqknowstat::create([
            'description' => $request->requestknow,
            'reqknowledge_id' => $request->idknow,
            'user_id' => Auth::user()->id,
        ]);
        return redirect('knowledge/'. encrypt($request->idknow));
    }
}
