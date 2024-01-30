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
}
