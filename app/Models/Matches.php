<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Matches
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Matches newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Matches newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Matches query()
 * @property int $id
 * @property int $home_team_id
 * @property int $away_team_id
 * @property int $home_score
 * @property int $away_score
 * @property string $match_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Matches whereAwayScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Matches whereAwayTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Matches whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Matches whereHomeScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Matches whereHomeTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Matches whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Matches whereMatchDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Matches whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Matches extends Model
{
    use HasFactory;

    protected $fillable = ['home_team_id', 'away_team_id', 'home_score', 'away_score', 'match_date'];

    protected $casts = [
        'match_date' => 'datetime'
    ];

    public function homeTeam(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id', 'id');
    }

    public function awayTeam(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id', 'id');
    }
}
