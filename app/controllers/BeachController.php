<?php

class BeachController extends BaseController {

    //public $restfull = true;
    protected $layout = 'layout.default';
    
    public function index() {
        
        $beaches = beach::All();
        return View::make('beach.home')->with('beaches',$beaches);
        
    }
    
    public function details($bId = 0) {
        
        $beach = beach::find($bId);
        if (is_null($beach)){
            return Redirect::to('/')->with('message', "No results returned. Please try again.");  
       } else {
            return View::make('beach.details')->with('beach', $beach);  
       }
    }
}

?>
