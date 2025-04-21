<?php

namespace Smartwebsource\ApiRequestLogger\Models;

use Illuminate\Database\Eloquent\Model;

class ApiRequestLog extends Model
{
    protected $fillable = [
        'method',
        'url',
        'headers',
        'body',
    ];

    protected $casts = [
        'headers' => 'array',
        'body' => 'array',
    ];
}
