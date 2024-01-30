<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Standings
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Standing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Standing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Standing query()
 * @property int $id
 * @property int $team_id
 * @property int $wins
 * @property int $draws
 * @property int $losses
 * @property int $goals_for
 * @property int $goals_against
 * @property int $points
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Standing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Standing whereDraws($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Standing whereGoalsAgainst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Standing whereGoalsFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Standing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Standing whereLosses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Standing wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Standing whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Standing whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Standing whereWins($value)
 * @mixin \Eloquent
 */
class Standing extends Model
{
    use HasFactory;

    protected $fillable = ['team_id'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public static function getCurrentWeek(): float
    {
        $totalMatchesPlayed = Matches::count();

        $matchesPerWeek = 2;

        return ceil($totalMatchesPlayed / $matchesPerWeek);
    }
}
