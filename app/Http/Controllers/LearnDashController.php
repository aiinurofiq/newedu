<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Topic;
use App\Models\Category;
use App\Models\Knowledge;
use App\Models\Learning;
use App\Models\Reqknowledge;
use Illuminate\Http\Request;

class LearnDashController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $learns = Learning::all();
        $topics = Topic::all();
        $categories = Category::all();
        $reqknows = Reqknowledge::all();
        $user = User::all();

        return view('profile.learndash', compact('learns','topics','categories', 'reqknows', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}