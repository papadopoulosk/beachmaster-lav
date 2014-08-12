<?php

class ProfileController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $uid = Auth::id();
        $user = user::find($uid); //where('id', '=', $uid);//->get()->toArray()[0];
        $information = $user->getProfileInfo();
        //var_dump($information);
        return View::make("profile.index")->with('user', $user)->with('information', $information);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id = 0) {

        $user = user::findOrFail($id); //where('id', '=', $uid);//->get()->toArray()[0];
        $information = $user->getProfileInfo();
        //var_dump($information);
        return View::make("profile.index")->with('user', $user)->with('information', $information);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
