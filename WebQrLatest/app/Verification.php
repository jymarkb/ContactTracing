<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class verification extends Model
{
    protected $table = "verifications";

    public $primaryKey = 'verifications_id';

    protected $fillable = [
        'verifications_name'
    ];

    public $timestamps = false;
}
