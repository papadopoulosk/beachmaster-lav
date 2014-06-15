<?php

class BeachController extends BaseController {

    public $restfull = true;
    protected $layout = 'layout.default';
    
    public function index() {
        return View::make('beach.home');
    }
    
    public function details($bId = 0) {
        if (is_null($bId)){
            $bId = Input::get("bid");
        }
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
            $beach->suggestions = 1;
            $beach->approved = 0;
            
            //Save new beach to the database
            $beach->save();
            
            return Redirect::to('add')->with('message','Beach has been submitted for approval');
        } else {
            //Generate error message and forward them to View
            $errors = $validator->messages();
            return Redirect::to('add')->withErrors($errors);
        }

    }
    
    /*API call - Asychronous functions
     * This section includes all functions utilised in order
     * to generate asynchronous content and/or JSON results
     */
    
    //Common error function for all invalid API calls
    private function throwError (){
        return Response::json('Improper parameters', 404);
    }
    
    public function beaches($bid=0){
        //Initial call of beaches for main page.
        //Generate a JSON list for display purposes - API call through AngularJS
            if ($bid!=0){
                $beaches = beach::find($bid);        
            } else {
                //$beaches = beach::where('approved','=','1')->get();
                //Custom Query for join operation
                $beaches = DB::table(DB::raw('beaches as b, reviews as r'))
                        //->leftjoin('b', 'b.id', '=', 'r.beachId')
                        ->select(array('b.id','b.name','b.description','b.imagePath','b.latitude','b.longitude',
                            DB::raw('count(r.id) as review_count'),DB::raw('format(avg(r.rate),1) as avg_rate'))
                                )
                        ->whereRaw('b.id = r.beachId')
                        ->whereRaw('b.approved = 1')
                        ->groupBy('b.id')->get();
            }
            if (!is_null($beaches))
              return json_encode($beaches);
            else 
              return $this->throwError();
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
                return $this->throwError();
            }
        }
    }
    
    public function rateup(){
        $beachId = Input::get("beachId");
        $beach = beach::find($beachId);
        if (!is_null($beach)){
            $newBeach = $this->rate(1, $beach);
            $newBeach->save();
            return $newBeach->rate;
        } else {
            return $this->throwError();
        }
    }
    
    public function ratedown($beachId = null){
        $beachId = Input::get("beachId");
        $beach = beach::find($beachId);
        if (!is_null($beach)){
            $newBeach = $this->rate(-1, $beach);
            $newBeach->save();
            return $newBeach->rate;
        } else {
            return $this->throwError();
        }
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
            if (!is_null($beach)){
                $num = $beach->total_approves + 1;
                if ($num >= $approve_limit){
                    $beach->approved = true;
                    //return "approved";
                } else {
                    //return "pending";
                }
                $beach->total_approves = $num;
                $beach->save();
            } else {
                return $this->throwError();
            }
        } else {
            return $this->throwError();       
        }
    }
}
?>
