<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $table = "barangays";

    public $primaryKey = 'barangays_id';

    protected $fillable = [
        'barangays_id',
        'barangays_name',
        'municipalities_id'
    ];

    public $timestamps = false;
}
