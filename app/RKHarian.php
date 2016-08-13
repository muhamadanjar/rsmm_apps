<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class RKHarian extends Model {

	protected $table = 'rk_harian';
	protected $primaryKey = 'id';

	protected $hidden = ['created_at','updated_at'];

}
