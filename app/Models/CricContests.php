<?php 
namespace App\Models; 
use Eloquent;
/**
 * EmailAction Model
 */
class CricContests extends Eloquent {

	
/**
 * The database table used by the model.
 *
 * @var string
 */
	protected $table = 'cricket_contests';
    public $timestamps = false;

    protected $fillable = [
        'name', 'tournament_id', 'game_type', 'contest_category', 'match_id', 'entry_fee', 'min_entry', 'max_entry', 'admin_per', 'admin_amt', 'winning_amt', 'is_private', 'private_password', 'multi_tournament_type', 'is_free', 'is_featured', 'entry_per_user', 'amt_type', 'admin_fix', 'prize_type', 'breakdown_amt', 'created_at', 'updated_at'
    ];

 
	
}