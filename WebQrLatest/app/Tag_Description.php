<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag_Description extends Model
{
    protected $table = 'tag_description';

    public $primaryKey = 'tag_desc_id';

    protected $fillable = [
        'tag_desc_name', 
    ];

    public $timestamps = false;
}
