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

if (!defined("WHMCS")) die("This file cannot be accessed directly");

require_once __DIR__.'/includes.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use JNEX\Hooks;

$setting = Capsule::table('tbladdonmodules')
                ->where('module','=','verifyemail')
                ->where('setting','=','activate')
                ->first();

if($setting->value == 'on')
{

    Hooks::init()->addHooks([
        'ClientAdd',
        'ClientLogin',
    ]);
}
