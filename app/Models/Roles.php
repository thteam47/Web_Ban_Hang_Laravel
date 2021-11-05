<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'name'
    ];
    protected $primaryKey = 'id_roles';
 	protected $table = 'roles';

 	public function user(){
 		return $this->belongsToMany('App\Modules\User');
 	}
 	
}
