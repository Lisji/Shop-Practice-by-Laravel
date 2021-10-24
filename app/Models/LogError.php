<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogError extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [''];
    protected $casts = [
        'trace' => 'array',
        'params' => 'array',
        'header' => 'array',
        ];

}
