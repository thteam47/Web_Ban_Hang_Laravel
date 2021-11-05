<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buycart extends Model
{
    use HasFactory;
    protected $table = 'buycarts';
    protected $guarded = [''];

     public function products(){
        return $this->belongsToMany('App\Models\Models\Product');
    }
}
