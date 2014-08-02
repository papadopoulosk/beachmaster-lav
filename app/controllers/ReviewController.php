<?php

class ReviewController extends BaseController {
    
    public $restfull = true;
    
    public function store(){
            $review = new review;
            $data = Input::all();
            
            //Validation Rules
            $rules = array(
                'title' =>'required',
                'text' =>'required',
                'beachId' =>'integer|required',
                'rate'=>'integer|required|in:1,2,3,4,5'
            );
            
            //Initiate validator
            $validator = Validator::make($data,$rules);
            $beachId = Input::get('beachId');
            if ($validator->passes()){
                //Validator passed successful
                $review->beachId = $beachId;
                $review->title = Input::get('title');
                $review->text = Input::get('text');
                $review->rate = Input::get('rate');
            
                $review->save();
                return Redirect::to('/beach/'.$beachId)->with('message', "Review submitted!");  
            } else {
                if (Input::has('beachId') && Input::get('beachId')!=null){
                    //Collect error messages
                    $errors = $validator->messages();
                    Input::flash();
                    return Redirect::to('/beach/'.$beachId)->withErrors($errors);  
                } else {
                    return Redirect::to('/')->withErrors("Error during processing.");  
                }
            }
    }
    
    public function show($bId = null){
        //$bId = Input::get('bid');
        if (!is_null($bId)){
            $reviews = review::where('beachId', '=',$bId)->get();
            return $reviews->toJson();    
        } else {
            return "error";//Response::json('Improper parameters', 404);
        }
    }
}

?>
