<?php

if (!function_exists('md')) {
    function md()
    {
        $database = new \Medoo\Medoo([
            'database_type' => config('db_type'),
            'database_name' => config('db_name'),
            'server' => config('db_server'),
            'username' => config('db_username'),
            'password' => config('db_password'),
        ]);

        return $database;
    }
}
