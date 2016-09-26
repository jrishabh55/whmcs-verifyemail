<?php
require_once __DIR__.'/HSR/Hooks.php';
require_once __DIR__.'/HSR/Handel.php';
require_once __DIR__.'/HSR/Email.php';

if(!function_exists('str_random'))
{
    function str_random($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) 
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
