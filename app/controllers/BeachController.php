<?php

class BeachController extends BaseController {

    //public $restfull = true;
    protected $layout = 'layout.default';
    
    public function index() {
        
        $beaches = beach::All();
        return View::make('beach.home')->with('beaches',$beaches);
        
    }
}

?>
