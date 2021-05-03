<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hood extends Model
{
    protected $fillable = [
        'name', 'street', 'municipe_id'
    ];
}
