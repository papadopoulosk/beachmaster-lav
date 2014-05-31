<?php

class BeachController extends BaseController {

    public $restfull = true;
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
    
    public function beaches($bid=0){
        
            if ($bid!=0){
                $beaches = beach::find($bid);        
            } else {
                $beaches = beach::All();
            }
            if (!is_null($beaches))
                return json_encode($beaches->toArray());
            else 
                return Response::json('Beach not found', 404);
    }

}

?>
