<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MatchController extends Controller
{
    public function index()
    {
        return view('match.index');
    }

    public function datatable()
    {
        $query = Matches::with('homeTeam', 'awayTeam')->latest();

        return DataTables::of($query)
            ->addColumn('match_date', function ($q) {
                return $q->match_date->format('d.m.Y H:i');
            })
            ->addColumn('score', function ($q) {
                return $q->home_score . ' - ' . $q->away_score;
            })
            ->addColumn('homeTeam', function ($q) {
                return $q->homeTeam->name;
            })
            ->addColumn('awayTeam', function ($q) {
                return $q->awayTeam->name;
            })
            ->addColumn('result', function ($q) {
                if ($q->home_score > $q->away_score) {
                    return $q->homeTeam->name . ' Kazandı';
                } elseif ($q->away_score > $q->home_score) {
                    return $q->awayTeam->name . ' Kazandı';
                } else {
                    return "Beraberlik";
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
