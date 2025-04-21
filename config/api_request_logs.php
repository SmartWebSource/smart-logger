<?php

return [
    'capture' => env('API_REQUEST_LOGS_STATUS', true), // active / inactive
    'layout' => env('API_REQUEST_LOGS_LAYOUT', 'api_request_logs::app'), // User can override layout
];
