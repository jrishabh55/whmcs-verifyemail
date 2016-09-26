<?php
/**
 * HSR Verify Email
 *
 * @package    HSR Verify Email
 * @author     Rishabh Jain <jrishabh55@gmail.com>
 * @copyright  Copyright (c) HSRTECH 2016
 * @license    ------- Yet To Decide -------
 * @version    1.0
 * @link       http://www.hsrtech.com/
 */

if (!defined("WHMCS")) die("This file cannot be accessed directly");

use Illuminate\Database\Capsule\Manager as Capsule;

function hsrverifyemail_config() 
{
    return [
    "name" => "HSR Verify Email",
    "description" => "HSR Panel is used to block users performing any action without performing any action.",
    "version" => "1.0",
    "author" => "Rishabh Jain",
    "fields" => [
        "activate" => [
                "FriendlyName" => "activate", 
          		"Type" => "yesno", 
        		"Size" => 25,
                "Description" => "<br />Activate this to anable the module.", 
            ],
            ]];
}

function hsrverifyemail_activate()
{
    try
    {
        Capsule::schema()->create('hsrverifyemail',function ($table) {
                $table->increments('id');
                $table->integer('client_id');
                $table->string('email');
                $table->enum('status',[0,1]);
                $table->text('code');
                $table->timestamps();
            }
        );
        Capsule::table('tbladdonmodules')->insert([
            'setting' => 'activate',
            'module' => 'hsrverifyemail',
            'value' => 'yes',
        ]);

        return array(
            'status'      => 'success',
            'description' => 'This Module can now be used to manage api from sspanel.',
        );
    }catch(\Exception $e)
    {
        return array(
            'status'      => 'error',
            //'description' => "Unable to create: {$e->getMessage()}",
            'description' => 'An error occurred during activation. Please try again to activate.',
        );
    }
}

function hsrverifyemail_deactivate() 
{ 
    try {
        Capsule::schema()->drop('hsrverifyemail');
        return [
            'status' => 'success',
            'description' => "Module Deactivated.",
        ];
    } catch (\Exception $e) {
        return [
            'status' => 'error',
            'description' => "Uh oh! Module deactivation faiiled. {$e->getMessage()}",
        ];
    }
}


// function hsrverifyemail_output()
// {
//     $modulelink = $vars['modulelink'];
//     $LANG = $vars['_lang'];
//     echo '<p>The date & time are currently '.date("Y-m-d H:i:s").'</p>';
// }