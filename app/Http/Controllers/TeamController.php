<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TeamController extends Controller
{
    public function index()
    {
        return view('team.index');
    }


    public function show($teamId)
    {
        $team = Team::with(['homeMatches', 'awayMatches'])->find($teamId);

        return view('team.show', compact('team'));
    }

    public function datatable()
    {
        $query = Team::latest('strength');

        return DataTables::of($query)
            ->addColumn('action', function ($q) {
                $html = "";

                $html .= create_show_button(route('team.show', $q->id));
                return $html;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
