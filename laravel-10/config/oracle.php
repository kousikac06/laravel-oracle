<?php

return [
    'oracle' => [
        'driver' => 'oracle',
        'tns' => env('DB_ORACLE_TNS', ''),
        'host' => env('DB_ORACLE_HOST', ''),
        'port' => env('DB_ORACLE_PORT', '1521'),
        'database' => env('DB_ORACLE_DATABASE', ''),
        'service_name' => env('DB_ORACLE_SERVICE_NAME', 'ORCLPDB1'),
        'username' => env('DB_ORACLE_USERNAME', ''),
        'password' => env('DB_ORACLE_PASSWORD', ''),
        'charset' => env('DB_ORACLE_CHARSET', 'AL32UTF8'),
        'prefix' => env('DB_ORACLE_PREFIX', ''),
        'prefix_schema' => env('DB_ORACLE_SCHEMA_PREFIX', ''),
        'edition' => env('DB_ORACLE_EDITION', 'ora$base'),
        'server_version' => env('DB_ORACLE_SERVER_VERSION', ''),
        'load_balance' => env('DB_ORACLE_LOAD_BALANCE', 'yes'),
        'max_name_len' => env('ORA_MAX_NAME_LEN', 30),
        'dynamic' => [],
        'sessionVars' => [
            'NLS_TIME_FORMAT' => 'HH24:MI:SS',
            'NLS_DATE_FORMAT' => 'YYYY-MM-DD HH24:MI:SS',
            'NLS_TIMESTAMP_FORMAT' => 'YYYY-MM-DD HH24:MI:SS',
            'NLS_TIMESTAMP_TZ_FORMAT' => 'YYYY-MM-DD HH24:MI:SS TZH:TZM',
            'NLS_NUMERIC_CHARACTERS' => '.,',
        ],
    ],
];
