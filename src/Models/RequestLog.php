<?php

namespace Smartwebsource\RequestLogger\Models;

use App\User;
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

    public function user(){
        return $this->belongsTo(User::class);
    }
}
