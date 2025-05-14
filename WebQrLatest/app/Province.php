<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Citizen;

class Province extends Model
{
    protected $table = 'provinces';

    public $primaryKey = 'province_id';

    protected $fillable = [
        'province_id', 
        'province_name',
    ];

    public $timestamps = false;

    public function municipality(){
        return $this->hasMany('App\Municipality');
    }

}
