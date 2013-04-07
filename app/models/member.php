<?php

use Zizaco\Confide\ConfideUser;

class Member extends ConfideUser {
	public static $rules = array(
        'email' => 'required|email',
        'password' => 'required',
    );
    public function announcements(){
    	return $this->hasMany('Announcement');
    }
}