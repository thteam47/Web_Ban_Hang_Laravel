<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use HasFactory;
	
    protected $table = 'categories';
    protected $primaryKey = 'c_id';
    protected $guarded = ['']; //các giá trị trong đây sẽ không lấy
    //fillable lấy các thuộc tính có trong đó


    protected $status = [
    	1 => [
    		'name' => 'Public',
    	],
    	0 => [
    		'name' => 'Private',
    	]
    ];
     public function getStatus($value)
    {
    	return array_get($this->status,$value,'[N\A]');
    }
}
