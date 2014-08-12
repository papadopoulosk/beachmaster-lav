<?php

class AuthController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return View::make("auth.index");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //Aunticate User
        $username = Input::has('username') ? Input::get('username') : "";
        $password = Input::has('password') ? Input::get('password') : "";
        $auth = Auth::attempt(array('username' => $username, 'password' => $password));
        //echo "Auth: " . $auth . '<br>';
        if ($auth) {
            return Redirect::intended('/admin')->with('message', 'You have successfully logged in');
        } else {
            return Redirect::back()->with('message', 'Invalid login credentials')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy() {
        Auth::logout();
        Return Redirect::to('/')->with('message', 'Successfully logged out');
    }

    public function googleauth() {
        // get data from input
        $code = Input::get('code');

        // get google service
        $googleService = OAuth::consumer('Google');

        // check if code is valid
        // if code is provided get user data and sign in
        if (!empty($code)) {

            // This was a callback request from google, get the token
            $token = $googleService->requestAccessToken($code);

            // Send a request with it
            $result = json_decode($googleService->request('https://www.googleapis.com/oauth2/v1/userinfo'), true);

            $message = 'Your unique Google user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
            //echo $message . "<br/>";

            $user = user::whereEmail($result['email'])->first(['id']);

            if (empty($user)) {
                $user = new User;
                $user->name = $result['name'];
                $user->email = $result['email'];
                $user->serviceCode = $code;
                $user->password = '123';
                $user->image = $result['picture'];
                $user->remember_token = null;
                $user->save();
            }
                Auth::login($user);
                echo Auth::user()->email;
                //dd(null);
                //Var_dump
                //display whole array().
                //dd($result);
                return Redirect::to('/')->with('message', 'You have successfully logged in as '.$result['name']);
            }
            // if not ask for permission first
            else {
                // get googleService authorization
                $url = $googleService->getAuthorizationUri();

                // return to google login url
                return Redirect::to((string) $url);
            }
        }
    }
    