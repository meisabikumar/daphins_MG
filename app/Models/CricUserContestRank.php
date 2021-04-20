<?php 
namespace App\Models; 
use Eloquent;
/**
 * EmailAction Model
 */
class CricUserContestRank extends Eloquent {

	
/**
 * The database table used by the model.
 *
 * @var string
 */
	protected $table = 'cric_user_contest_rank';
    public $timestamps = true;
    protected $fillable = [
        'user_id', 'team_id', 'contest_id', 'series_id', 'points', 'rank', 'won_amount', 'created_at', 'updated_at'
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
