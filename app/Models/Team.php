<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Team
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Matches> $awayMatches
 * @property-read int|null $away_matches_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Matches> $homeMatches
 * @property-read int|null $home_matches_count
 * @property-read \App\Models\Matches|null $standing
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @property int $id
 * @property string $name
 * @property int $strength
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Matches> $awayMatches
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Matches> $homeMatches
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereStrength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Team extends Model
{
    use HasFactory;

    public function homeMatches(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Matches::class, 'home_team_id', 'id');
    }

    public function awayMatches(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Matches::class, 'away_team_id', 'id');
    }

    public function getTotalMatchesPlayed(): int
    {
        return $this->homeMatches()->count() + $this->awayMatches()->count();
    }

    public function standing(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Standing::class, 'team_id', 'id');
    }

    public function getLeaguePosition()
    {
        $standings = Standing::orderBy('points', 'desc')->get();

        foreach ($standings as $index => $standing) {
            if ($standing->team_id == $this->id) {
                return $index + 1;
            }
        }

        return "Sıralama Belirsiz";
    }

    public function calculateChampionshipProbabilities()
    {
        // Kalan maç sayısını
        $remaining_matches = 6 - Standing::getCurrentWeek();
        $teams = Team::all();
        // Kalan maç sayısına göre tüm takımların alabileceği puanı hesapladık
        $totalPointsAvailable = $this->calculateTotalPointsAvailable($teams, $remaining_matches);

        $championshipProbabilities = [];
        foreach ($teams as $team) {
            // Oynadığı her maçı kazanma ihtimalini düşündüm
            $maxPossiblePoints = $team->standing->points + ($remaining_matches * 3);
            // Maksimumum alabileceği puanın kazanaılabilecek tüm puanına göre oranını aldım
            $championshipProbabilities[$team->id] = $maxPossiblePoints / $totalPointsAvailable * 100;
        }

        return floor($championshipProbabilities[$this->id]);
    }

    private function calculateTotalPointsAvailable($teams, $remaining_matches)
    {
        $totalPoints = 0;
        foreach ($teams as $team) {
            $totalPoints += $team->standing->points + ($remaining_matches * 3);
        }
        return $totalPoints;
    }
}
