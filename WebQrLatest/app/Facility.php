<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table = "facilities";

    public $primaryKey = 'facilities_id';

    protected $fillable = [
        'facilities_desc',
    ];
    public $timestamps = false;
}
