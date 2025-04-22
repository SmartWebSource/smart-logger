<?php

return [
    'layout' => env('REQUEST_LOGS_LAYOUT', 'request_logs::app'), 
    'capture' => env('REQUEST_LOGS_CAPTURE_API', true),
    'capture_web' => env('REQUEST_LOGS_CAPTURE_WEB', false),
    'request_method' => env('REQUEST_LOGS_API_METHOD', 'GET,POST,PUT,DELETE,PATCH'),
    'web_request_method' => env('REQUEST_LOGS_WEB_METHOD', 'GET,POST,PUT,DELETE,PATCH'),
];
