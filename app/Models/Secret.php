<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Secret extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'secret_content'
    ];
}
