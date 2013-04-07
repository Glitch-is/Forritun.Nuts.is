<?php

class Announcement extends Eloquent {
	public function member(){
		return $this->belongsTo('Member');
	}
}