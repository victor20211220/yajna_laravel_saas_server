<?php

return [
    /*
    |--------------------------------------------------------------------------
    | CoinGate API Key
    |--------------------------------------------------------------------------
    |
    | This is the API key you receive after creating a CoinGate account.
    |
    */
    'api_key' => env('COINGATE_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Environment
    |--------------------------------------------------------------------------
    |
    | Set the environment to either 'sandbox' for testing or 'live' for production.
    |
    */
    'environment' => env('COINGATE_ENVIRONMENT', 'sandbox'),

    /*
    |--------------------------------------------------------------------------
    | Receive Currency
    |--------------------------------------------------------------------------
    |
    | This is the currency you want to receive the payment in (BTC, EUR, USD, etc.).
    |
    */
    'receive_currency' => env('COINGATE_RECEIVE_CURRENCY', 'BTC'),
];
