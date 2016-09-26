<?php

namespace HSR;

use HSR\Email;
use Illuminate\Database\Capsule\Manager as Capsule;
class Handel{

    public static function Request($data = [])
    {
        if(count($data) < 1)
            return ;
        if(empty($data['action']) && empty($data['status']) && empty($data['userid']))
            return "This File is not allowed to access.";
        
        if(!empty($data['status'])){
            if($data['status'] == 'false')
                return "Please Activate your account before logging in.";

            if($data['status'] == 'true'){
                if(empty($data['msg']))
                    return "Action Sucessful";
                else 
                    return htmlentities(urldecode($data['msg']));
            }
        }

        if($data['action'] == 'resend')
        {
            if(!empty($data['userid']))
            {
                return self::ReSend(trim($data['userid']));
            }else return "Invalid UserId";
        }else return "Invalid Action";
    }

    public static function ReSend($user)
    {
        // return $user;
        if(filter_var($user,FILTER_VALIDATE_EMAIL) === false)
            return "Invalid Email";        

        $data = Capsule::table('tblclients')->where('email','=',$user)->first();

        if(!$data)
            return "Incorrect Email";
        if($data->email_verified)
        {
            return "Email Already Verified";
        }
        
        $email = (Email::send($data->id));
        if($email['result'] == 'success')
            header("Location: ".$sysurl.'/hsrverifyemail.php?status=true&msg='.urlencode('Email Successfull'));
        else
            return "Somthing Went wrong. Please try again";
    }
}