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

use JNEX\Email;
use Illuminate\Database\Capsule\Manager as Capsule;

class Handel
{
    public static function Request($data = []) {
        if (count($data) < 1) {
            return ;
        }
        if (empty($data['action']) && empty($data['status']) && empty($data['userid']) && empty($data['verificationId'])) {
            return "This File is not allowed to access.";
        }

        if (!empty($data['verificationId'])) {
            $action = self::handleVerification($data['verificationId']);
            if ( $action === true ) {
                $_GET['status'] = true;
                return true;
            } else if ( $action === -1 ) {
                $_GET['status'] = true;
                return "Email already verified.";
            } else {
                $_GET['status'] = false;
                return "Email Validation failed";
            }
        }

        if (!empty($data['status'])) {
            if ($data['status'] == 'false') {
                return "Please Activate your account before logging in.";
            }

            if ($data['status'] == 'true') {
                if (empty($data['msg'])) {
                    return "Action Sucessful";
                } else {
                    return htmlentities(urldecode($data['msg']));
                }
            }
        }

        if ($data['action'] == 'resend') {
            if (!empty($data['userid'])) {
                return self::ReSend(trim($data['userid']));
            } else {
                return "Invalid UserId";
            }
        } else {
            return "Invalid Action";
        }
    }

    public static function ReSend($user) {
        // return $user;
        if (filter_var($user, FILTER_VALIDATE_EMAIL) === false) {
            return "Invalid Email";
        }

        $data = Capsule::table('tblclients')->where('email', $user)->first();

        if (!$data) {
            return "Incorrect Email";
        }
        if ($data->email_verified) {
            return "Email Already Verified";
        }

        $email = (Email::send($data->id));
        if ($email['result'] == 'success') {
            header("Location: ".JNEX_URL.'verifyemail.php?status=true&msg='.urlencode('Email Successfull'));
        } else {
            return "Somthing Went wrong. Please try again";
        }
    }

    public static function handleVerification($verificationString = '') {
        $verification = explode(JNEX_SEPERATOR, $verificationString);
        if (count($verification) !== 2) {
            return false;
        }
        $string = $verification[0];
        $cid = $verification[1];

        $data = Capsule::table('tblclients')->where('id', $cid);
        if ($data->first()->email_verified) {
          return -1;
        }

        $link = Capsule::table('tbltransientdata')->where('name', '=', $cid.':emailVerificationClientKey')->first()->data;

        if ($link !== $string) {
            return false;
        }

        $data->update([
            'email_verified' => true
        ]);
        return true;
    }
}
