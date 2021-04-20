<?php 
namespace App\Models; 
use Eloquent;
/**
 * EmailAction Model
 */
class CronRecord extends Eloquent {

	
/**
 * The database table used by the model.
 *
 * @var string
 */
	protected $table = 'cron_records';


    public $timestamps = false;

    protected $fillable = [
         'status', 'date_time', 'error_log'
    ];	




	
}// end EmailAction class
