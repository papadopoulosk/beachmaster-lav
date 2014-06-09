<?php

class ReviewController extends BaseController {
    
    public $restfull = true;
    
    public function add(){
            $review = new review;
            $data = Input::all();
            
            //Validation Rules
            $rules = array(
                'title' =>'required',
                'text' =>'required',
                'beachId' =>'integer|required',
            );
            
            //Initiate validator
            $validator = Validator::make($data,$rules);
            $beachId = Input::get('beachId');
            if ($validator->passes()){
                //Validator passed successful
                $review->beachId = $beachId;
                $review->title = Input::get('title');
                $review->text = Input::get('text');
            
                $review->save();
                return Redirect::to('/details/'.$beachId)->with('message', "Review submitted!");  
            } else {
                if (Input::has('beachId') && Input::get('beachId')!=null){
                    //Collect error messages
                    $errors = $validator->messages();
                    Input::flash();
                    return Redirect::to('/details/'.$beachId)->withErrors($errors);  
                } else {
                    return Redirect::to('/')->withErrors("Error during processing.");  
                }
            }
    }
}

?>
