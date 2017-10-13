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

namespace JNEX;

use Illuminate\Database\Capsule\Manager as Capsule;

class Email
{


    public static function send($cid)
    {
		    $adminuser = Capsule::table('tbladmins')->first()->username;

        $link = Capsule::table('tbltransientdata')->where('name','=',$cid.':emailVerificationClientKey')->first()->data;

        $command = "sendemail";
        $values["messagename"] = "Client Email Address Verification";
        $id = JNEX_SEPERATOR.$cid;
        $values['customvars'] = ['client_email_verification_link' => JNEX_URL.'verifyemail.php?verificationId='.$link.$id];
        $values["id"] = $cid;
        return localAPI($command, $values, $adminuser);
    }
}
