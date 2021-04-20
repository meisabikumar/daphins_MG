<?php 
namespace App\Models; 
use Eloquent;
/**
 * EmailAction Model
 */
class CricUserContest extends Eloquent {

	
/**
 * The database table used by the model.
 *
 * @var string
 */
	protected $table = 'user_contests';
    

    protected $fillable = [
        "user_id","team_id","contest_id","match_id","game_type","entry_fee","players","created_at","updated_at"
    //    "user_id","team_id","contest_id","created_at","updated_at"

    ];	

    public function user() {
    	return $this->belongsTo('App\Model\User','user_id');
    }

    public function contests() {
    	return $this->belongsTo('App\Model\CricContests','contest_id');
    }

    public function user_team() {
    	return $this->belongsTo('App\Model\CricUserTeams','team_id');
    }





	
}// end EmailAction class
