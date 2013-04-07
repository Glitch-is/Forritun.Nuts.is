<?php

class AdminController extends BaseController {
	public function getIndex(){
		return View::make('forritun.members')
			->with('members',Member::all());
	}

	public function getDelete($id){
		Member::find($id)->delete();
		return Redirect::to('admin/');
	}
}