<?php

namespace App\Services\Games\Traits;

use App\Models\Competition;
use App\Models\CompetitionAbbreviation;
use App\Models\Team;
use App\Repositories\EloquentRepository;
use App\Services\Common;
use App\Services\Odds;
use Exception;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

trait DBActions
{
    private function saveGame(mixed...$args)
    {
        [$date_time, $home_team_url, $home_team, $ft_results, $ht_results, $away_team_url, $away_team, $url, $competition_abbreviation] = $args;

        $table = Carbon::parse($date_time)->format('Y') . '_games';

        $this->createTable($table);

        $year = Carbon::parse($date_time)->format('Y');
        $date = Carbon::parse($date_time)->format('Y-m-d');
        $time = Carbon::parse($date_time)->format('H:i:s');

        $home_team_init = $home_team;
        $away_team_init = $away_team;

        $home_team = $this->repo->model->where('url', $home_team_url)->first();
        $away_team = $this->repo->model->where('url', $away_team_url)->first();

        if ($home_team && $away_team) {


            $games = autoModel($table);
            $exists = $games->where([['competition_abbreviation', $competition_abbreviation], ['home_team_id', $home_team->id], ['away_team_id', $away_team->id]])->where('date', $date)->first();

            // common columns during create and update
            $arr = [
                'date_time' => $date_time,
                'year' => $year,
                'date' => $date,
                'time' => $time,
                'ht_results' => $ht_results,
                'ft_results' => $ft_results,
            ];


            try {
                DB::beginTransaction();

                $msg = '';
                if (!$exists) {

                    $arr = array_merge($arr, [
                        'home_team_id' => $home_team->id,
                        'away_team_id' => $away_team->id,
                        'competition_abbreviation' => $competition_abbreviation,
                        'url' => $url,
                    ]);

                    $games->create($arr);

                    $competition_abbreviation = Common::saveCompetitionAbbreviation($competition_abbreviation);

                    $msg = 'Game saved';

                    if ($competition_abbreviation->created)
                        $msg = 'Game saved -- ' . $competition_abbreviation . ' abbrv saved';

                } else {

                    if (Carbon::now()->diffInDays($date_time) <= 7) {
                        $exists->update($arr);
                        $msg = 'Game updated';
                    } else
                        $msg = 'Game stale, no update';
                }

                DB::commit();
                return $msg;
            } catch (Exception $e) {
                DB::rollBack();
                Log::info('Game save failed:', ['err' => $e->getMessage()]);
            }


        } elseif ($home_team) {
            return 'Away team not found, (' . $away_team_init . ')';
        } elseif ($away_team) {
            return 'Home team not found, (' . $home_team_init . ')';
        } else {
            return 'Both teams not found, (' . $home_team_init . ' & ' . $away_team_init . ')';
        }
    }

    private function updateGame($data)
    {

        Common::saveTeamLogo($this->game['home_team_id'], $data['home_team_logo']);
        Common::saveTeamLogo($this->game['away_team_id'], $data['away_team_logo']);
        $stadium = Common::saveStadium($data['stadium']);
        $weather_condition = Common::saveWeatherCondition($data['weather_condition']);

        if ($this->existing_competition && $this->game['competition_id'] == $this->existing_competition->id)
            $competition = $this->existing_competition;
        else
            $competition = Common::saveCompetition($data['competition_url'], $data['competition']);

        $table = Carbon::parse($data['date_time'])->format('Y') . '_games';
        $this->createTable($table);

        $year = Carbon::parse($data['date_time'])->format('Y');
        $date = Carbon::parse($data['date_time'])->format('Y-m-d');
        $time = Carbon::parse($data['date_time'])->format('H:i:s');

        $games = autoModel($table);

        $exists = $games->find($this->game['id']);

        if ($exists) {
            // common columns during create and update
            $arr = [
                'date_time' => $data['date_time'],
                'year' => $year,
                'date' => $date,
                'time' => $time,
                'has_time' => $data['has_time'],
                'ht_results' => $data['ht_results'],
                'ft_results' => $data['ft_results'],
                'results_status' => 1,
                'temperature' => $data['temperature'],
            ];

            if ($stadium)
                $arr['stadium_id'] = $stadium->id;

            if ($weather_condition)
                $arr['weather_condition_id'] = $weather_condition->id;

            $msg = 'Fixture updated';

            if ($competition) {
                $arr['competition_id'] = $competition->id;

                $repo = new EloquentRepository(CompetitionAbbreviation::class);
                $abbrv = $repo->model->where('name', $this->game['competition_abbreviation'])->wherenull('competition_id');
                if ($abbrv->count() === 1) {
                    $abbrv->update(['competition_id' => $competition->id]);
                    $repo = new EloquentRepository(Competition::class);
                    $repo->model->find($competition->id)->update(['abbreviation' => $this->game['competition_abbreviation']]);

                    $msg = 'Fixture updated -- ' . $this->game['competition_abbreviation'] . ' abbrv tagged';
                }
            }

            $exists->update($arr);

            // this is possible that no home_team string
            if (!isset($this->game['home_team'])) {
                $this->game['home_team'] = Team::find($this->game['home_team_id'])->name;
                $this->game['away_team'] = Team::find($this->game['away_team_id'])->name;
            }

            Odds::save([
                'date_time' => $data['date_time'],
                'year' => $year,
                'date' => $date,
                'time' => $time,
                'has_time' => $data['has_time'],
                'home_team' => $this->game['home_team'],
                'away_team' => $this->game['away_team'],
                'one_x_two' => $data['one_x_two'],
                'over_under' => $data['over_under'],
                'gg_ng' => $data['gg_ng'],
                'game_id' => $this->game['id'],
                'competition_id' => $competition->id ?? null,
                'source' => 'Source1',
            ]);

            return $msg;
        } else {
            // delete fixture, date changed
            DB::table($this->game['table'])->where('id', $this->game['id'])->delete();
            Odds::whereGame($this->game['table'])->delete();

            Log::critical('Deleted fixture:', ['data' => $this->game]);

            return 'Fixture deleted';
        }
    }

    function getGames($id, $include_recently_fetched_games = false)
    {
        // Detailed fixture for existing games, so let's get this year's table
        $table = Carbon::now()->year . '_games';

        $game = autoModel($table);

        $games = $this->commonQuery(
            $game
                ->where('results_status', 0),
            $id,
            $table
        );

        $recently_fetched_games = [];
        if ($include_recently_fetched_games === true)
            $recently_fetched_games = $this->commonQuery(
                $game
                    ->where('results_status', '>', 0),
                $id,
                $table
            );

        $res = ['games' => $games, 'recentlyFetchedGames' => $recently_fetched_games];

        return $res;
    }

    function commonQuery($q, $id, $table)
    {
        return $q
            ->where(fn($q) => $q->where('home_team_id', $id)->orwhere('away_team_id', $id))
            ->join('teams as hometeam', $table . '.home_team_id', 'hometeam.id')
            ->join('teams as awayteam', $table . '.away_team_id', 'awayteam.id')
            ->leftjoin('competitions', $table . '.competition_id', 'competitions.id')
            ->select(
                $table . '.*',
                'hometeam.name as home_team',
                'awayteam.name as away_team',
                'competitions.name as competition',
            )
            ->get()->toArray();
    }

    private function createTable($table)
    {
        if (!Schema::hasTable($table)) {
            Schema::create($table, function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->dateTime('date_time');
                $table->year('year');
                $table->date('date');
                $table->time('time')->nullable();
                $table->boolean('has_time')->default(0);
                $table->uuid('home_team_id');
                $table->uuid('away_team_id');
                $table->string('ht_results')->nullable();
                $table->string('ft_results')->nullable();
                $table->string('competition_abbreviation')->nullable();
                $table->uuid('competition_id')->nullable();
                $table->tinyInteger('results_status')->default(0);
                $table->tinyInteger('update_failed_attempts')->default(0);
                $table->string('url')->nullable();
                $table->uuid('stadium_id')->nullable();
                $table->string('temperature')->nullable();
                $table->uuid('weather_condition_id')->nullable();
                $table->uuid('user_id');
                $table->boolean('status')->default(1);
                $table->timestamps();
            });
        }
    }
}