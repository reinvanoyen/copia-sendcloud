<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Sendcloud Base URL
    |--------------------------------------------------------------------------
    |
    | The base url of the API endpoint
    |
    */
    'sendcloud_base_url' => env('SENDCLOUD_BASE_URL', 'https://panel.sendcloud.sc/api/v2/'),

    /*
    |--------------------------------------------------------------------------
    | Sendcloud public key
    |--------------------------------------------------------------------------
    |
    | The public API key, found in your Sendcloud dashboard
    |
    */
    'sendcloud_public_key' => env('SENDCLOUD_PUBLIC_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Sendcloud secret key
    |--------------------------------------------------------------------------
    |
    | The secret API key, found in your Sendcloud dashboard
    |
    */
    'sendcloud_secret_key' => env('SENDCLOUD_SECRET_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Automatically request a label
    |--------------------------------------------------------------------------
    |
    | Whether we should automatically request a label from Sendcloud
    | upon creation of a parcel.
    |
    */
    'auto_request_label' => false,
];
