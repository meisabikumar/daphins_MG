<?php 
namespace App\Model; 
use Eloquent;
/**
 * EmailAction Model
 */
class CricPlayerPrice extends Eloquent {

	
/**
 * The database table used by the model.
 *
 * @var string
 */
	protected $table = 'cric_player_price';


    public $timestamps = true;

    protected $fillable = [
        'match_id', 'player_id', 'price','type', 'team', 'created_at', 'updated_at'
    ];	


					


	
}// end EmailAction class
