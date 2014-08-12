<?php

class ReviewController extends BaseController {

    public $restfull = true;

    public function store() {
        $review = new review;
        $data = Input::all();

        //Validation Rules
        $rules = array(
            'text' => 'required',
            'beachId' => 'integer|required',
            'rate' => 'integer|required|in:1,2,3,4,5'
        );

        //Initiate validator
        $validator = Validator::make($data, $rules);
        $beachId = Input::get('beachId');
        if ($validator->passes()) {
            //Validator passed successful
            $review->beachId = $beachId;
            $review->submitted_by = Auth::id();
            $review->text = Input::get('text');
            $review->rate = Input::get('rate');

            $review->save();
            return Redirect::to('/beach/' . $beachId)->with('message', "Review submitted!");
        } else {
            if (Input::has('beachId') && Input::get('beachId') != null) {
                //Collect error messages
                $errors = $validator->messages();
                Input::flash();
                return Redirect::to('/beach/' . $beachId)->withErrors($errors);
            } else {
                return Redirect::to('/')->withErrors("Error during processing.");
            }
        }
    }

    public function show($bId = null) {
        //$bId = Input::get('bid');
        if (!is_null($bId)) {

            if (!is_numeric($bId)) {
                $bId = $beach = beach::where('slug', $bId)->first()->id;
            }
            $review = new review;
            $reviews = $review::where('beachId', '=', $bId)->get()->toArray();//all();//->first();
            //dd($reviews);
            foreach ($reviews as $key => $review){
                $owner = user::select('id','name')->limit(1)->find(($review['submitted_by']))->toArray();
                $reviews[$key]['owner'] = $owner;
            }
//            dd($reviews);
            //$reviews['owner'] = $reviews->owner;
            //dd($reviews->toArray());
            return json_encode($reviews);
        } else {
            return "error"; //Response::json('Improper parameters', 404);
        }
    }

}

?>
