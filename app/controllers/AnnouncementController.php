<?php

class AnnouncementController extends BaseController {
	public function getIndex(){
		return View::make('admin.announcements')
			->with('announcements',Announcement::with('member')->paginate(10));
	}

	public function getEdit($id){
		return View::make('admin.announcement')
			->with('announcement',Announcement::find($id))
			->with('id',$id);
	}

	public function postEdit($id)
	{
		$announcement = Announcement::find($id);
		$announcement->title = Input::get('title');
		$announcement->body = Input::get('text');
		$announcement->save();
		return Redirect::to('/admin/announcement/');
	}

	public function getDelete($id)
	{
		$announcement = Announcement::find($id);
		$announcement->delete();
		return Redirect::to('/admin/announcement/');
	}

	public function getNew(){
		return View::make('admin.new_announcement');
	}

	public function postNew(){
		$announcement = new Announcement;
		$announcement->title = Input::get('title');
		$announcement->body = Input::get('text');
		$announcement->member_id = Auth::user()->id;
		$announcement->save();
		return Redirect::to('/admin/announcement/');
	}
}