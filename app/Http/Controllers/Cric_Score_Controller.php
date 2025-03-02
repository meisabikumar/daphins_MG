<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class Cric_Score_Controller extends Controller
{
    public function Testing_Score(){

        $api_key = "Vs99FDycm6GHwRj4Cr9x67QC8d1S2ShJVQ7crytfZ7DBhrI4FFM1irajfKv3";
        $api_url  = "https://cricket.sportmonks.com/api/v2.0";
        $api_fetch_fixtures = "$api_url/livescores/?api_token=$api_key&include=batting,bowling,scoreboards";
        // API Call to fetch data and convert to json
        $jsons = file_get_contents($api_fetch_fixtures);
        // $fixtures = json_decode($jsons, true)["data"];
        // $array = json_decode($jsons, true)["data"];
        $data = json_decode($jsons, true)["data"][0];
        $match_id = $data['id'];
        // $match_id = $data['id'];
        $check = DB::table('cric_match_player_point')->where(array('match_id' => $match_id))->get();

        if(count($check) == 0){
            $matches = DB::table('cricket_fixture_teams')->where(array('fixture_id'=>$match_id))->get();
            foreach($matches as $match){

                $players = json_decode($match->players);
                foreach($players as $player){
                        $fixture_id = $match->fixture_id;
                        $player_id = $player->id;
                        $player_role = $player->position->name;
                        DB::insert('insert into cric_match_player_point (match_id, player_id, role) values (?, ?, ?)', [$fixture_id, $player_id, $player_role]);

                }
            }
            DB::table('cric_cron_record')->insert(array('status' => 'Player data inserted'));
            return response()->json(['success' =>"Data Updated Successfully"], 200);
        }
        else{
            DB::table('cric_cron_record')->insert(array('status' => 'Error, record already exists'));
            return response()->json(['error' =>"Entry Already Exists"],400);
        }

    }

    public function score_update(){

        // Starts Here
        // echo "Updating Score";
        $api_key = "Vs99FDycm6GHwRj4Cr9x67QC8d1S2ShJVQ7crytfZ7DBhrI4FFM1irajfKv3";
        $api_url  = "https://cricket.sportmonks.com/api/v2.0";
        $api_fetch_fixtures = "$api_url/livescores/?api_token=$api_key&include=batting,bowling,scoreboards";
        // API Call to fetch data and convert to json
        $jsons = file_get_contents($api_fetch_fixtures);
        // $fixtures = json_decode($jsons, true)["data"];
        // $array = json_decode($jsons, true)["data"];
        $data = json_decode($jsons, true)["data"][0];
        // $data = $array['data'];
        $batting_data = $data['batting'];
        $match_id = $data['id'];
        $match_type = $data['type'];
        // DB::table('cric_match_player_point')->where('match_id', $match_id)->update(array('points' => 0));
        //For T20
        DB::table('cric_match_player_point')->where(array('match_id'=> $match_id))->update(array('catch_points' => 0));

        if($match_type == "T20"){
        //Batting
        //consider points as batting points

        foreach($batting_data as $bat){
            $points = 0;
            $runs = $bat['score'];
            $player_id = $bat['player_id'];
            //points for runs
            $points = $points + $runs;
            $active = $bat['active'];

            //dismissed for duck
            if(!$active && $runs == 0){
                $points = $points - 2;
            }
            //bonus stats
            $fours =  $bat['four_x'];
            $points = $points + $fours;
            $sixes = $bat['six_x'];
            $points = $points + (2 * $sixes);

            //bonus for runs made
            if($runs >= 30 && $runs < 50){
                $points = $points + 5;
            }
            elseif($runs >= 50 && $runs < 100){
                $points = $points + 8;
            }
            elseif($runs > 100){
                $points = $points + 15;
            }

            //runs on strike rate
            $strike_rate = $bat['rate'];
            $balls_faced = $bat['ball'];

            if($balls_faced >= 10){
                if($strike_rate < 50){
                    $points = $points - 6;
                }
                if($strike_rate >= 50 && $strike_rate < 60){
                    $points = $points - 4;
                }
                if($strike_rate >= 60 && $strike_rate < 70){
                    $points = $points - 2;
                }
            }

            DB::table('cric_match_player_point')->where(array('match_id'=> $match_id, 'player_id'=> $player_id))->update(array('batting_points' => $points, 'batting_point_details' => $bat));
            //catch out point
            $out_id = $bat['catch_stump_player_id'];
            if(!empty($out_id)){
                $catch = DB::table('cric_match_player_point')->where(array('match_id'=> $match_id, 'player_id'=> $out_id))->get();
                $catch_point = $catch[0]->catch_points;
                $catch_point = $catch_point + 8;


                DB::table('cric_match_player_point')->where(array('match_id'=> $match_id, 'player_id'=> $out_id))->update(array('catch_points' => $catch_point));
            }
            // return $query;
            // ->where('match_id', $match_id)
        }
        //bowling data
        $bowling_data = $data['bowling'];

        foreach($bowling_data as $bowl){
            $bowling_points = 0;

            $wickets_taken = $bowl['wickets'];
            $bowling_points = $bowling_points + (25 * $wickets_taken);
            //bonus stats

            $maiden_overs = $bowl['medians'];
            $bowling_points = $bowling_points + (7 * $maiden_overs);
            if($wickets_taken == 3){
                $bowling_points = $bowling_points + 8;
            }
            elseif($wickets_taken == 4){
                $bowling_points = $bowling_points + 10;
            }
            elseif($wickets_taken >= 5){
                $bowling_points = $bowling_points + 15;
            }
            //economy rates
            $economy_rate = $bowl['rate'];
            $overs_bowled = $bowl['overs'];

            if($overs_bowled >= 2){
                if($economy_rate < 2.5){
                    $bowling_points = $bowling_points + 10;
                }
                elseif($economy_rate >= 2.5 && $economy_rate < 3.5){
                    $bowling_points = $bowling_points + 8;
                }
                elseif($economy_rate >= 3.5 && $economy_rate < 4){
                    $bowling_points = $bowling_points + 6;
                }
                elseif($economy_rate >= 4 && $economy_rate < 5){
                    $bowling_points = $bowling_points + 5;
                }
                elseif($economy_rate >= 5 && $economy_rate < 6){
                    $bowling_points = $bowling_points + 4;
                }
                elseif($economy_rate >= 9 && $economy_rate < 10){
                    $bowling_points = $bowling_points - 2;
                }

                elseif($economy_rate >= 10 && $economy_rate < 11){
                    $bowling_points = $bowling_points - 4;
                }
                elseif($economy_rate >= 11 && $economy_rate < 12){
                    $bowling_points = $bowling_points - 6;
                }
                elseif($economy_rate >= 12 && $economy_rate < 13){
                    $bowling_points = $bowling_points - 8;
                }
                elseif($economy_rate >= 13){
                    $bowling_points = $bowling_points - 10;
                }

                $bowler_id = $bowl['player_id'];
                DB::table('cric_match_player_point')->where(array('match_id'=> $match_id,'player_id'=> $bowler_id) )->update(array('bowling_points' => $bowling_points, 'bowling_point_details' => $bowling_points));
            }
            }
            // $bowling_points;


        }
        // For ODI
        if($match_type == "ODI"){
            //Batting
            //consider points as batting points

            foreach($batting_data as $bat){
                $points = 0;
                $runs = $bat['score'];
                $player_id = $bat['id'];
                //points for runs
                $points = $points + $runs;
                $active = $bat['active'];
                //dismissed for duck
                if(!$active && $runs == 0){
                    $points = $points - 3;
                }
                //bonus stats
                $fours =  $bat['four_x'];
                $points = $points + $fours;
                $sixes = $bat['six_x'];
                $points = $points + (2 * $sixes);
                //bonus for runs made
                if($runs >= 50 && $runs < 100){
                    $points = $points + 5;
                }
                elseif($runs > 100){
                    $points = $points + 10;
                }
                //runs on strike rate
                $strike_rate = $bat['rate'];
                $balls_faced = $bat['ball'];

                if($balls_faced >= 20){
                    if($strike_rate < 40){
                        $points = $points - 6;
                    }
                    if($strike_rate >= 40 && $strike_rate < 50){
                        $points = $points - 4;
                    }
                    if($strike_rate >= 50 && $strike_rate < 60){
                        $points = $points - 2;
                    }
                }

                //catch out point
                DB::table('cric_match_player_point')->where(array('match_id'=> $match_id, 'player_id'=> $player_id))->update(array('batting_points' => $points, 'batting_point_details' => $bat));
                 //catch out point
                $out_id = $bat['catch_stump_player_id'];
                if(!empty($out_id)){
                    $catch = DB::table('cric_match_player_point')->where(array('match_id'=> $match_id, 'player_id'=> $out_id))->get();
                    $catch_point = $catch[0]->catch_points;
                    $catch_point = $catch_point + 8;


                DB::table('cric_match_player_point')->where(array('match_id'=> $match_id, 'player_id'=> $out_id))->update(array('catch_points' => $catch_point));
            }
            }
            //bowling data
            $bowling_data = $data['bowling'];
            $bowling_points = 0;
            foreach($bowling_data as $bowl){
                //wicket points
                $wickets_taken = $bowl['wickets'];
                $bowling_points = $bowling_points + (25 * $wickets_taken);
                //bonus stats
                $maiden_overs = $bowl['medians'];
                $bowling_points = $bowling_points + (4 * $maiden_overs);
                if($wickets_taken == 3){
                    $bowling_points = $bowling_points + 5;
                }
                elseif($wickets_taken == 4){
                    $bowling_points = $bowling_points + 7;
                }
                elseif($wickets_taken >= 5){
                    $bowling_points = $bowling_points + 10;
                }

                //economy rates
                $economy_rate = $bowl['rate'];
                $overs_bowled = $bowl['overs'];
                if($overs_bowled >= 5){
                    if($economy_rate < 2.5){
                        $bowling_points = $bowling_points + 10;
                    }
                    elseif($economy_rate >= 2.5 && $economy_rate < 3.5){
                        $bowling_points = $bowling_points + 8;
                    }
                    elseif($economy_rate >= 3.5 && $economy_rate < 4){
                        $bowling_points = $bowling_points + 5;
                    }
                    elseif($economy_rate >= 7 && $economy_rate < 8){
                        $bowling_points = $bowling_points - 2;
                    }
                    elseif($economy_rate >= 8 && $economy_rate < 9){
                        $bowling_points = $bowling_points - 3;
                    }
                    elseif($economy_rate >= 9 && $economy_rate < 10){
                        $bowling_points = $bowling_points - 5;
                    }
                    elseif($economy_rate >= 10 && $economy_rate < 11){
                        $bowling_points = $bowling_points - 6;
                    }
                    elseif($economy_rate >= 11 && $economy_rate < 12){
                        $bowling_points = $bowling_points - 8;
                    }
                    elseif($economy_rate >= 12 && $economy_rate < 13){
                        $bowling_points = $bowling_points - 10;
                    }
                    elseif($economy_rate >= 13){
                        $bowling_points = $bowling_points - 12;
                    }
                    $bowler_id = $bowl['player_id'];
                    DB::table('cric_match_player_point')->where(array('match_id'=> $match_id,'player_id'=> $bowler_id) )->update(array('bowling_points' => $bowling_points, 'bowling_point_details' => $bowling_points));
                }
                }
            }

            // For Test matches
        if($match_type == "TEST"){
            //Batting
            //consider points as batting points
            $points = 0;
            foreach($batting_data as $bat){
                $runs = $bat['score'];
                $player_id = $bat['id'];
                //points for runs
                $points = $points + $runs;
                $active = $bat['active'];
                //dismissed for duck
                if(!$active && $runs == 0){
                    $points = $points - 5;
                }
                //bonus stats
                $fours =  $bat['four_x'];
                $points = $points + $fours;
                $sixes = $bat['six_x'];
                $points = $points + (2 * $sixes);
                //bonus for runs made
                if($runs >= 50 && $runs < 100){
                    $points = $points + 5;
                }
                elseif($runs > 100){
                    $points = $points + 10;
                }

                //catch out point
                DB::table('cric_match_player_point')->where(array('match_id'=> $match_id, 'player_id'=> $player_id))->update(array('batting_points' => $points, 'batting_point_details' => $bat));
                 //catch out point
                $out_id = $bat['catch_stump_player_id'];
                if(!empty($out_id)){
                    $catch = DB::table('cric_match_player_point')->where(array('match_id'=> $match_id, 'player_id'=> $out_id))->get();
                    $catch_point = $catch[0]->catch_points;
                    $catch_point = $catch_point + 8;


                DB::table('cric_match_player_point')->where(array('match_id'=> $match_id, 'player_id'=> $out_id))->update(array('catch_points' => $catch_point));
            }
            }
            //bowling data
            $bowling_data = $data['bowling'];
            $bowling_points = 0;
            foreach($bowling_data as $bowl){
                //wicket points
                $wickets_taken = $bowl['wickets'];
                $bowling_points = $bowling_points + (16 * $wickets_taken);
                //bonus stats
                if($wickets_taken == 3){
                    $bowling_points = $bowling_points + 4;
                }
                elseif($wickets_taken == 4){
                    $bowling_points = $bowling_points + 6;
                }
                elseif($wickets_taken >= 5){
                    $bowling_points = $bowling_points + 10;
                }
                    $bowler_id = $bowl['player_id'];
                    DB::table('cric_match_player_point')->where(array('match_id'=> $match_id,'player_id'=> $bowler_id) )->update(array('bowling_points' => $bowling_points, 'bowling_point_details' => $bowling_points));
                }
                }
            //for total points
            $point_data = DB::table('cric_match_player_point')->get();
            foreach($point_data as $p){
                //points for playing

                $id = $p->id;
                $point1 = $p->batting_points;
                $point2 = $p->bowling_points;
                $point3 = $p->catch_points;
                $total_points = $point1 + $point2 + $point3;
                DB::table('cric_match_player_point')->where(array('id'=> $id))->update(array('points'=> $total_points));
            }
            DB::table('cric_cron_record')->insert(array('status' => 'Player given points'));
            return response()->json(['success' =>"Data Updated Successfully"], 200);
            }

        public function user_point_update(){

            $data = DB::table('cricket_player_team')->get();
            foreach($data as $d){
                $id = $d->id;
                $match_id = $d->match_id;
                $player_id = $d->player_id;
                $point_arr = DB::table('cric_match_player_point')->where(array('match_id'=> $match_id, 'player_id'=>$player_id))->get();
                // print_r($point_arr);
                if(count($point_arr) > 1){
                $points = $point_arr[0]->points;
                DB::table('cricket_player_team')->where(array('id'=> $id))->update(array('player_points'=> $points));
                }
            }
            $data2 = DB::table('user_contests')->where(array('game_type' => 'cricket'))->get();
            foreach($data2 as $i){
                $team_id = $i->team_id;
                $count = 0;
                $player_data = DB::table('cricket_player_team')->where(array('team_id' => $team_id))->get();
                foreach($player_data as $j){
                    // return $j;
                    $points = $j->player_points;
                    $count = $count + $points;
                }
                DB::table('user_contests')->where(array('team_id'=>$team_id))->update(array('points'=>$count));
            }
            DB::table('cric_cron_record')->insert(array('status' => 'User team given points'));
            return response()->json(['success' =>"Data Updated Successfully"], 200);
        }
        public function add(){

        $api_fetch_fixtures = "https://cricket.sportmonks.com/api/v2.0/players?api_token=Vs99FDycm6GHwRj4Cr9x67QC8d1S2ShJVQ7crytfZ7DBhrI4FFM1irajfKv3";
        // API Call to fetch data and convert to json
        $jsons = file_get_contents($api_fetch_fixtures);
        // $fixtures = json_decode($jsons, true)["data"];
        // $array = json_decode($jsons, true)["data"];
        $data = json_decode($jsons, true)["data"][0];
        foreach($data as $d){
            $name = $d->fullname;
            $img = $d->display_image;
            $country = $d->country_id;
            $battingstyle = $d->battingstyle;
            $bowlingstyle = $d->bowlingstyle;
            $position = $d->position->name;
            $dob = $d->dateofbirth;
            DB::table('cric_players')->insert(array(
                'name' => $name,
                'display_img' => $img,
                'country_id' => $country,
                'batting_style' => $battingstyle,
                'bowlingstyle' => $bowlingstyle,
                'position' => $position,
                'dob' => $dob

            ));
        }
        }
        public function view($id){

            $contest1 = DB::table('cricket_contests')->where(array('id' => $id))->get();
            $contest = $contest1[0];
            return  View::make('AdminView.cricket.view', ['contest' => $contest]);
        }
        }


