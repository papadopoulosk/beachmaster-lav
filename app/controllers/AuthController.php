<?php

class AuthController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make("auth.index");
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//Aunticate User
                $username = Input::has('username') ? Input::get('username') : "";
                $password = Input::has('password') ? Input::get('password') : "";
                $auth = Auth::attempt(array('username' => $username, 'password' => $password));
                echo "Auth: ".$auth.'<br>';
                if ($auth)
                {
                    return Redirect::intended('/admin')->with('message','You have successfully logged in');
                } else {
                    return Redirect::back()->with('message','Invalid login credentials')->withInput();
                }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		Auth::logout();
                Return Redirect::to('/')->with('message','Successfully logged out');
	}


}
