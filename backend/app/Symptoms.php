<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Symptoms extends Model
{
    protected $table = 'symptoms';

    public $primaryKey = 'symptoms_id';

    protected $fillable = [
        'symptoms_description'
    ];

    public $timestamps = false;
}
