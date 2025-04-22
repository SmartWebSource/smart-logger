<?php

namespace Smartwebsource\RequestLogger\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model
{
    protected $fillable = [
        'user_id',
        'method',
        'url',
        'headers',
        'body',
        'request_type',
    ];

    protected $casts = [
        'headers' => 'array',
        'body' => 'array',
    ];

    public function user()
    {
        $userModel = Auth::getProvider()->getModel();
        return $this->belongsTo($userModel, 'user_id');
    }
}
