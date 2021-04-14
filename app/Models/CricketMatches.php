<?php 
namespace App\Model; 
use Eloquent;
/**
 * EmailAction Model
 */
class CricMatches extends Eloquent {

	
/**
 * The database table used by the model.
 *
 * @var string
 */
	protected $table = 'cricket_fixtures';


public $timestamps = false;



	protected $fillable = [
        'id', 'team_1', 'team_2', 'type', 'status', 'winner','team1_id','team2_id','season_id', 'league_id'
    ];


	
}// end EmailAction class
