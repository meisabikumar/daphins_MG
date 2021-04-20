<?php 
namespace App\Model; 
use Eloquent;
/**
 * EmailAction Model
 */
class UserWalets extends Eloquent {

	
/**
 * The database table used by the model.
 *
 * @var string
 */
	protected $table = 'user_walets';


    protected $fillable = [
        'user_id', 'transation_id', 'amount',
    ];
	

    public function user() {
    	return $this->belongsTo('App\Model\User','user_id');
    }

    public function contests() {
        return $this->belongsTo('App\Model\Contests','contest_id');
    }


	
}// end EmailAction class
