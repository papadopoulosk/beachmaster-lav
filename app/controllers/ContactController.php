<?php

class ContactController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
             return View::make('contact.index');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            $message = new message();
            $data = Input::all();
            $message->setMessage($data);
            if ($message->validate()){
                return Redirect::to('/contact')->with('message','Message successfully sent!');
            } else {
                return Redirect::to('/contact')->with('message','Message not sent. :(');
            }
            
            
	}


}
