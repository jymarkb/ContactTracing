<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'types';

    public $primaryKey = 'types_id';

    protected $fillable = [
        'types_description'
    ];

    public $timestamps = false;

    public function users() {
        return $this->HasMany(User::class);
    }
}
