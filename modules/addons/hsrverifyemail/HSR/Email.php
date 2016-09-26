<?php

namespace HSR;

use Illuminate\Database\Capsule\Manager as Capsule;

class Email
{


    public static function send($cid)
    {
		$adminuser = Capsule::table('tbladmins')->first()->username;
        
        $link = Capsule::table('tbltransientdata')->where('name','=',$cid.':emailVerificationClientKey')->first()->data;
        $command = "sendemail";
        $values["messagename"] = "Client Email Address Verification";
        $values['customvars'] = ['client_email_verification_link' => 'https://vezel.thestack.net/clientarea.php?verificationId='.$link];
        $values["id"] = $cid;
        return localAPI($command, $values, $adminuser); 
    }
}