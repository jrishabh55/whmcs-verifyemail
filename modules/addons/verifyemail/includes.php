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

require_once __DIR__.'/JNEX/Hooks.php';
require_once __DIR__.'/JNEX/Handel.php';
require_once __DIR__.'/JNEX/Email.php';

use Illuminate\Database\Capsule\Manager as Capsule;
$sysurl = Capsule::table('tblconfiguration')->where('setting','=','SystemURL')->first()->value;
define("JNEX_TABLENAME", 'jnexverifyemail');
define("JNEX_FILENAME", 'verifyemail');
define("JNEX_URL", $sysurl);
define("JNEX_SEPERATOR", './@');

if (!function_exists('str_random')) {
    function str_random($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
