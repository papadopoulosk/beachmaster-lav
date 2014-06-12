<?php

class BeachController extends BaseController {

    public $restfull = true;
    protected $layout = 'layout.default';
    
    public function index() {
        $beaches = beach::All();
        //return Redirect::to('/about')->withInput();
        return View::make('beach.home')->with('beaches',$beaches);
    }
    
    public function details($bId = 0) {
        $beach = beach::find($bId);
        $reviews = review::where('beachId', $bId)->get();
        
        if (is_null($beach)){
            return Redirect::to('/')->with('message', "No results returned. Please try again.");  
       } else {
            return View::make('beach.details')->with('beach', $beach->toArray())->with('reviews',$reviews->toArray());  
       }
    }
    
    public function add(){
        return View::make('beach.add');
    }
    
    public function addBeach(){
        
        $beach = new beach;
        $data = Input::all();
        
            //Validation Rules
            $rules = array(
                'name' =>'required',
                'description' =>'required',
                'latitude' =>'required',
                'longitude' =>'required',
                'imagePath' =>'required'
            );
            
        $validator = Validator::make($data,$rules);
        if($validator->passes()){
            $beach->name = $data['name'];
            $beach->description = $data['description']; 
            $beach->imagePath = $data['imagePath'];
            $beach->latitude = $data['latitude'];
            $beach->longitude = $data['longitude'];
            $beach->rate = 2.5; //Default initial value
            $beach->approved = 0;
            $beach->votes = 0;
            $beach->numReviews = 0;
            //Save new beach to the database
            $beach->save();
            
            return Redirect::to('add')->with('message','Beach submitted for approval');
        } else {
            //Generate error message and forward them to View
            $errors = $validator->messages();
            return Redirect::to('add')->withErrors($errors);
        }

    }
    
    //API call - Asychronous functions
    public function beaches($bid=0){
        //Initial call of beaches for main page.
        // Generate a JSON list for display purposes - API call through AngularJS
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
    
    public function neighbors(){
        //Generate nearest beaches
        //Utilised during beach submittion process
        $lat = Input::get("lat"); 
        $lng = Input::get("lng");
        if (!is_null($lat) && !is_null($lng)){
            //Ratio to estimate nearest beaches
            $ratio = 0.002;
            $maxRatio = 1 + $ratio;
            $minRatio = 1 - $ratio;
            $minlat = $lat * $minRatio;
            $maxlat = $lat * $maxRatio;
            $minlng = $lng * $minRatio;
            $maxlng = $lng * $maxRatio;            
            
            
            $data = beach::select("id","name","description","imagePath")
                    ->whereRaw('latitude > ? and `latitude` < ? and `longitude` > ? and `longitude` < ?',
                    array($minlat,$maxlat,$minlng,$maxlng))
                    ->get();
            
            $count = beach::select("name")
                    ->whereRaw('latitude > ? and `latitude` < ? and `longitude` > ? and `longitude` < ?',
                    array($minlat,$maxlat,$minlng,$maxlng))
                    ->count();
            
            if ($count > 0){
                return json_encode($data->toArray());
            } else {
                return false;
            }
        }
    }
    
    public function rateup(){
        return "Hello";
        $beachId = Input::get("beachId");
        return $beachId;
        $beach = beach::find($beachId);
        $newBeach = $this->rate(1, $beach);
        $newBeach->save();
        return $newBeach->rate;
    }
    
    public function ratedown($beachId = null){
        $beach = beach::find($beachId);
        $newBeach = $this->rate(-1, $beach);
        $newBeach->save();
        return $newBeach->rate;
    }
    
    private function rate($rate,$beach){
            $tempRate = $beach->rate;
            $tempTotalRates = $beach->votes;
            
            $newRate = (($tempTotalRates * $tempRate) + $rate) / ($tempTotalRates +1);
            $newTotalRates = $tempTotalRates + 1;
            
            $beach->rate = $newRate;
            $beach->votes = $newTotalRates; //votes = rates at this point
            
            return $beach;
    }
    
    public function suggest($bid = null){
        
        $approve_limit = 5;
        if (!is_null($bid)){
            //$beachId = Input::get('beachid');
            
            $beach = beach::find($bid);
            $num = $beach->total_approves + 1;
            echo $num;
            if ($num >= $approve_limit){
                $beach->approved = true;
                //return "approved";
            } else {
                //return "pending";
            }
            $beach->total_approves = $num;
            $beach->save();
        }
    }
}
?>
