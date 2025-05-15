<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $table = "zones";

    public $primaryKey = 'zones_id';

    protected $fillable = [
        'zones_name',
        'barangays_id'
    ];

    public $timestamps = false;
}
