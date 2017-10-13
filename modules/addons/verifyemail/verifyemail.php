<?php
/**
 * Verify Email
 *
 * @package    Verify Email
 * @author     Rishabh Jain <rishabh@jnexsoft.com>
 * @copyright  Copyright (c) JNEX Software Solutions 2016-2017
 * @license    MIT
 * @version    1.1
 * @link       http://www.jnexsoft.com/
 */

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

require_once __DIR__.'/includes.php';

use Illuminate\Database\Capsule\Manager as Capsule;

function verifyemail_config() {
    return [
    "name" => "Verify Email",
    "description" => "The module is used to block users performing any action without verifying there email.",
    "version" => "1.1",
    "author" => "Rishabh Jain",
    "fields" => [
        "activate" => [
                "FriendlyName" => "activate",
                "Type" => "yesno",
                "Size" => 25,
                "Description" => " Check this to enable the module.",
              ]
            ]
          ];
}

function verifyemail_activate() {
    try {
        // Capsule::schema()->create(
        //     JNEX_TABLENAME,
        //     function ($table) {
        //         $table->increments('id');
        //         $table->integer('client_id')->unique()->index();
        //         $table->string('email')->unique()->index();
        //         $table->enum('status', [0,1]);
        //         $table->text('code')->unique()->index();
        //         $table->date('validity');
        //         $table->timestamps();
        //     }
        // );
        Capsule::table('tbladdonmodules')->insert([
            'setting' => 'activate',
            'module' => 'verifyemail',
            'value' => 'yes',
        ]);

        return array(
            'status'      => 'success',
            'description' => 'This Module can now be used to block users from login without verifying email.',
        );
    } catch (\Exception $e) {
        return array(
            'status'      => 'error',
            //'description' => "Unable to create: {$e->getMessage()}",
            'description' => 'An error occurred during activation. Please try again to activate.',
        );
    }
}

function verifyemail_deactivate() {
    try {
        Capsule::schema()->dropIfExists(JNEX_TABLENAME);
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


// function verifyemail_output()
// {
//     $modulelink = $vars['modulelink'];
//     $LANG = $vars['_lang'];
//     echo '<p>The date & time are currently '.date("Y-m-d H:i:s").'</p>';
// }
