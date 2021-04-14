<?php
namespace App\Model; 
use Eloquent;
class CricMatchStatus extends Eloquent
{

	protected $table = 'cric_match_status';
	/**
	* Function for get country list
	*
	* @param null 
	*
	* return query
	*/
	public $timestamps=false;
	protected $fillable = [
      'match_id', 'status', 'bonus_evaluation_done'
    ];


}
