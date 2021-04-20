<?php 
namespace App\Models; 
use Eloquent;
/**
 * EmailAction Model
 */
class CricPlayerPoints extends Eloquent {

	
/**
 * The database table used by the model.
 *
 * @var string
 */
	protected $table = 'cric_player_match_points';


    public $timestamps = true;

    protected $fillable = [
        'series_id', 'player_id', 'match_id', 'match_order', 'points', 'created_at', 'updated_at', 'points_detail', 'is_announced'
    ];	



	
}// end EmailAction class
