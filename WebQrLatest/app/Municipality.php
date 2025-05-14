<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{

    protected $table = 'municipalities';

    public $primaryKey = 'municipalities_id';

    protected $fillable = [
        'municipalities_id ',
        'municipalities_name',
        'province_id'
    ];

    public $timestamps = false;

    public function province(){
        return $this->belongsTo('App\Province');
    }
}
