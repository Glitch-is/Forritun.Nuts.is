<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Entrust\HasRole;

class Member extends ConfideUser {
	use HasRole;
	public static $rules = array(
        'email' => 'required|email',
        'password' => 'required|confirmed',
    );
    public function announcements(){
    	return $this->hasMany('Announcement');
    }
}