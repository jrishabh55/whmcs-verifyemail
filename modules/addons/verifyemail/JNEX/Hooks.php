<?php

namespace JNEX;

if (!defined("WHMCS")) die("This file cannot be accessed directly");

use HSR\Email;
use Illuminate\Database\Capsule\Manager as Capsule;

class Hooks {

	protected $admin;

    protected $sysurl;

	public function __construct()
	{
		$this->admin = Capsule::table('tbladmins')->first()->username;
        $this->sysurl = JNEX_URL;
	}

	public static function init()
	{
		return new self;
	}

	public function addHooks($hooks)
	{
		if(count($hooks)){
			foreach($hooks as $hook)
			{
				add_hook($hook,1,function($vars) use ($hook) {
					call_user_func([$this,'Hook'.$hook],$vars);
				});
			}
		}
	}

    public function HookClientAdd($vars)
    {
        Email::send($vars['userid']);
    }

    public function HookClientLogin($vars)
    {
        $user = Capsule::table('tblclients')
            ->where('id','=',$vars['userid'])
            ->first();

        if($user->email_verified)
        {
            return;
        }

        unset($_SESSION['uid']);
        unset($_SESSION['cid']);
        unset($_SESSION['upw']);

        header("Location: ".$this->sysurl.'verifyemail.php?status=false');
        exit();
    }

    public function HookClientLogout($vars)
    {
        $client = Capsule::table(JNEX_TABLENAME)
        ->where('client_id','=',$vars['userid'])
        ->where('status','=','0')->first();

        if(!$client)
            return true;

        echo "Please activate your profile before going forward.";
        exit();

    }

}
