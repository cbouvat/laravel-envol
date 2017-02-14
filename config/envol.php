<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Security Key 
    |--------------------------------------------------------------------------
    |
    | Key for security. Generate key with with Laravel helper str_random or 
    | other tools.
    |
     */

    'key' => '',


    /*
    |--------------------------------------------------------------------------
    | Git hosting
    |--------------------------------------------------------------------------
    |
    | Define git hosting of your project
    |
    | Supported: "github", "bitbucket"
    |
     */

    'hosting' => '',

    /*
    |--------------------------------------------------------------------------
    | Email recipients
    |--------------------------------------------------------------------------
    |
    | Email address for email notification emails
    |
    */
   
    'mail' => '',

    /*
    |--------------------------------------------------------------------------
    | Remote branch
    |--------------------------------------------------------------------------
    |
    | Name of the remote branch repository to pull
    |
    */
    
    'branch' => 'master',
    'remote' => 'origin',


];
