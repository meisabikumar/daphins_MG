<?php

namespace App\Http\Controllers\ApiController\Football\Sportsmonk;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

use App\Models\ApiModel\football\sportsmonk\sportsmonk_fixture;
use App\Models\ApiModel\football\sportsmonk\sportsmonk_match_teams;
use App\Models\ApiModel\football\sportsmonk\sportsmonk_matchs;

class Sportsmonk_Api_Controller extends Controller
{

    //-- api name : (Fixtures by Date Range)
    public function sportsmonk_get_fixtureByRange()
    {
        // Api token
        $api_token = "CcP4ZFsZBYTETwlUf96ICZwMccTk5NJVXlq2meeTzAI2gD3gOt89moKYy5uD";
        // Date Automatation
        $start_date = date("Y-m-d");
        $date = date_create($start_date);
        date_add($date, date_interval_create_from_date_string("15 days"));
        $end_date = date_format($date, "Y-m-d");
        // Http Clinet Response
        $url = "https://soccer.sportmonks.com/api/v2.0/fixtures/between/" . $start_date . "/" . $end_date . "?api_token=" . $api_token . "&include=localTeam,visitorTeam";

        // Response
        $response = Http::get($url);

        sportsmonk_fixture::truncate();

        foreach ($response['data'] as $value) {

            $league = "https://soccer.sportmonks.com/api/v2.0/leagues/" . $value['league_id'] . "?api_token=" . $api_token;
            $league_response = Http::get($league);

            $data = new sportsmonk_fixture;
            $data->fixture_id = $value['id'];
            $data->league_id = $value['league_id'];

            $data->league_name = $league_response["data"]["name"];
            $data->league_type = $league_response["data"]["type"];
            $data->league_logo = $league_response["data"]["logo_path"];

            $data->season_id = $value['season_id'];
            $data->stage_id = $value['stage_id'];
            $data->round_id = $value['round_id'];
            $data->group_id = $value['group_id'];
            $data->aggregate_id = $value['aggregate_id'];
            $data->venue_id = $value['venue_id'];
            $data->referee_id = $value['referee_id'];
            $data->localteam_id = $value['localteam_id'];
            $data->localteam_data = $value['localTeam']['data'];
            $data->visitorteam_id = $value['visitorteam_id'];
            $data->visitorteam_data = $value['visitorTeam']['data'];
            $data->winner_team_id = $value['winner_team_id'];
            $data->weather_report = $value['weather_report'];
            $data->commentaries = $value['commentaries'];
            $data->attendance = $value['attendance'];
            $data->pitch = $value['pitch'];
            $data->details = $value['details'];
            $data->neutral_venue = $value['neutral_venue'];
            $data->winning_odds_calculated = $value['winning_odds_calculated'];
            $data->formations = $value['formations'];
            $data->scores = $value['scores'];
            $data->coaches = $value['coaches'];
            $data->standings = $value['standings'];
            $data->assistants = $value['assistants'];
            $data->leg = $value['leg'];
            $data->colors = $value['colors'];
            $data->deleted = $value['deleted'];
            $data->status = $value['time']['status'];
            $data->starting_date_time = $value['time']['starting_at']['date_time'];
            $data->starting_date = $value['time']['starting_at']['date'];
            $data->starting_time = $value['time']['starting_at']['time'];
            $data->save();
        }

        return response('Success', 200)->header('Content-Type', 'application/json');

    }

    //-- api name : (Team Squads)
    public function sportsmonk_get_teamsByFixture()
    {

        $api_token = "CcP4ZFsZBYTETwlUf96ICZwMccTk5NJVXlq2meeTzAI2gD3gOt89moKYy5uD";

        $fixtures = sportsmonk_fixture::get();

        sportsmonk_match_teams::truncate();

        foreach ($fixtures as $fixture) {

            $localteam = "https://soccer.sportmonks.com/api/v2.0/teams/".$fixture['localteam_id']."?api_token=".$api_token."&include=squad.player";
            $localteam_res = Http::get($localteam);
            $localteam_data = $localteam_res["data"];

            $localteam_players = array();
            foreach ($localteam_data["squad"]["data"] as $dt) {
                $localteam_players[] = $dt['player']['data'];
            }
            // return $localteam_players;
            $data = new sportsmonk_match_teams;
            $data->team_id = $localteam_data["id"];
            $data->fixture_id = $fixture->fixture_id;
            $data->legacy_id = $localteam_data["legacy_id"];
            $data->name = $localteam_data["name"];
            $data->short_code = $localteam_data["short_code"];
            $data->twitter = $localteam_data["twitter"];
            $data->country_id = $localteam_data["country_id"];
            $data->national_team = $localteam_data["national_team"];
            $data->founded = $localteam_data["founded"];
            $data->logo_path = $localteam_data["logo_path"];
            $data->venue_id = $localteam_data["venue_id"];
            $data->current_season_id = $localteam_data["current_season_id"];
            $data->is_placeholder = $localteam_data["is_placeholder"];
            $data->players = $localteam_players;
            $data->save();

            // ---------------------------------
            $visitorteam = "https://soccer.sportmonks.com/api/v2.0/teams/" . $fixture['visitorteam_id'] . "?api_token=" . $api_token . "&include=squad.player";
            $visitorteam_res = Http::get($visitorteam);
            $visitorteam_data = $visitorteam_res["data"];

            $visitorteam_players = array();
            foreach ($visitorteam_data["squad"]["data"] as $dt) {
                $visitorteam_players[] = $dt['player']['data'];
            }

            $data = new sportsmonk_match_teams;
            $data->team_id = $visitorteam_data["id"];
            $data->fixture_id = $fixture->fixture_id;
            $data->legacy_id = $visitorteam_data["legacy_id"];
            $data->name = $visitorteam_data["name"];
            $data->short_code = $visitorteam_data["short_code"];
            $data->twitter = $visitorteam_data["twitter"];
            $data->country_id = $visitorteam_data["country_id"];
            $data->national_team = $visitorteam_data["national_team"];
            $data->founded = $visitorteam_data["founded"];
            $data->logo_path = $visitorteam_data["logo_path"];
            $data->venue_id = $visitorteam_data["venue_id"];
            $data->current_season_id = $visitorteam_data["current_season_id"];
            $data->is_placeholder = $visitorteam_data["is_placeholder"];
            $data->players = $visitorteam_players;
            $data->save();
        }

        return response('Success', 200)->header('Content-Type', 'application/json');

    }

    public function make_fixture_data_similar_to_other_API()
    {
        $fixtures = sportsmonk_fixture::get();

        // sportsmonk_matchs::truncate();

        foreach ($fixtures as $fixture) {


            $data = new sportsmonk_matchs;

            $data->fixture_id = $fixture['fixture_id'];
            $data->match_key = $fixture['fixture_id'];
            $data->match_home_team = $fixture['localteam_id'];
            $data->match_away_team = $fixture['visitorteam_id'];
            $data->match_name = $fixture['localteam_data']['name'] . " vs " . $fixture['visitorteam_data']['name'];
            $data->match_short_name = $fixture['localteam_data']['short_code'] . " vs " . $fixture['visitorteam_data']['short_code'];
            $data->match_start_date_time = $fixture['starting_date_time'];
            $data->match_start_date = $fixture['starting_date'];
            $data->match_start_time = $fixture['starting_time'];
            $data->match_status = $fixture['status'];

            $data->league_id = $fixture['league_id'];
            $data->tournament_key = $fixture['league_id'];
            $data->tournament_name = $fixture['league_name'];
            $data->tournament_logo = $fixture['league_logo'];
            $data->tournament_type = $fixture['league_type'];
            $data->season_id = $fixture['season_id'];
            $data->stage_id = $fixture['stage_id'];
            $data->round_key = $fixture['round_id'];
            $data->group_id = $fixture['group_id'];

            $data->save();
        }

        return response('Success', 200)->header('Content-Type', 'application/json');

    }

}
