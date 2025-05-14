<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitor_Type extends Model
{
    protected $table = "monitor_types";

    public $primaryKey = 'monitor_types_id';

    protected $fillable = [
        'monitor_types_name'
    ];
    public $timestamps = false;
}
