<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Matches;
use App\Models\Standing;
use App\Models\Team;
use Illuminate\Http\Request;

class StandingController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        $currentWeek = Standing::getCurrentWeek();
        $totalMatch = Matches::count();
        $standings = Standing::with('team')
            ->orderBy('points', 'desc')
            ->orderBy('goals_for', 'desc')
            ->get();


        return view('home',compact('teams','currentWeek','totalMatch','standings'));
    }


}
