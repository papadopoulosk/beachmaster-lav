<?php

class UtilityController extends BaseController {
    
     public $restfull = true;
     
     public function store(){
        //if (Input::has('data')){
            $bid = Input::get('beach_id');
            $utility = utility::firstOrNew(array('beach_id'=>$bid));;
            $data = Input::all();
            if($utility->checkData($data)) {
                return Redirect::to('/beach/'.$bid)->with('message','Utilities successfully updated!');
            } else {
                return Redirect::to('/beach/'.$bid)->with('message','Error during utilities update.');
            }
            
        //}
     }
}
