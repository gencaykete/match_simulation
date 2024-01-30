<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use App\Models\Standing;
use App\Models\Team;
use Illuminate\Http\Request;

class LeagueController extends Controller
{
    public function advance()
    {
        $teams = Team::all();
        $teamIds = $teams->pluck('id')->shuffle();

        // Bu hafta oynanacak iki maçı belirle
        $matchesForThisWeek = [
            [$teamIds[0], $teamIds[1]],
            [$teamIds[2], $teamIds[3]],
        ];

        foreach ($matchesForThisWeek as $matchPair) {
            $homeTeam = Team::find($matchPair[0]);
            $awayTeam = Team::find($matchPair[1]);

            // Takımların güç değerlerine göre maç sonucunu tahmin et
            $result = $this->simulateMatchResult($homeTeam->strength, $awayTeam->strength);

            // Yeni maçı oluştur ve kaydet
            $match = new Matches([
                'home_team_id' => $homeTeam->id,
                'away_team_id' => $awayTeam->id,
                'home_score' => $result['homeScore'],
                'away_score' => $result['awayScore'],
                'match_date' => now()
            ]);
            $match->save();


        }

        return back()->with('response', [
            'status' => 'success',
            'message' => 'Lig başarıyla ilerletildi.'
        ]);
    }

    private function simulateMatchResult($homeTeamStrength, $awayTeamStrength): array
    {
        $homeTeamScore = 0;
        $awayTeamScore = 0;

        // Her iki takım için 90 dakika boyunca gol şansını hesapla
        for ($i = 0; $i < 90; $i++) {
            if (rand(0, 100) < $homeTeamStrength) {
                $homeTeamScore++;
            }
            if (rand(0, 100) < $awayTeamStrength) {
                $awayTeamScore++;
            }
        }

        return ['homeScore' => $homeTeamScore, 'awayScore' => $awayTeamScore];
    }


}
