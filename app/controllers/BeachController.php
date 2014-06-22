<?php

class BeachController extends BaseController {

    public $restfull = true;
    protected $layout = 'layout.default';
    
    public function index() {
        
        $municipalities = municipality::select("municipalities.id",'municipalities.prefecture','municipalities.municipality')->leftJoin('beaches','municipalities.id','=','beaches.municipality_id')->where('beaches.approved','=','1')->distinct()->get();//select('id','prefecture')->groupby('prefecture')->get();
        
        return View::make('beach.index')->with('municipalities',$municipalities->toArray());
    }
    
    public function show($bId = 0) {
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
    
    public function create(){
        return View::make('beach.add');
    }
    
    public function store(){
        
        $beach = new beach;
        $municipality =  new municipality;
        
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
            
            return Redirect::to('/beach/create')->with('message','Beach has been submitted for approval');
        } else {
            //Generate error message and forward them to View
            $errors = $validator->messages();
            return Redirect::to('/beach/create')->withErrors($errors);
        }

    }
    
    /*API call - Asychronous functions
     * This section includes all functions utilised in order
     * to generate asynchronous content and/or JSON results
     */
    
    //Common error function for all invalid API calls
    private function throwError (){
        return Response::json('404 - Improper parameters', 404);
    }
    
    public function beaches($area=0){
        
        //Initial call of beaches for main page.
        //Generate a JSON list for display purposes - API call through AngularJS
           
                if ($area!=0) 
                    $whereClause = 'b.approved = 1 AND b.municipality_id = '.$area.' ';
                else 
                    $whereClause = 'b.approved = 1';
                
                //Custom Query for join operation
                $beaches = DB::table(DB::raw('beaches as b'))
                        ->leftjoin('reviews as r', 'b.id', '=', 'r.beachId')
                        ->select(array('b.id','b.name','b.description','b.imagePath','b.latitude','b.longitude',
                            DB::raw('count(r.id) as review_count'),DB::raw('format(avg(r.rate),1) as avg_rate'))
                                )
                        ->whereRaw($whereClause)
                        ->groupBy('b.id')->get();
            return $beaches;
      }
      
    public function beach($bid=null){
               //Custom Query for join operation
        if (!isset($bid)) return Redirect::to('/api/v1/beach/all');
        if (is_numeric($bid)){
                $beach = DB::table(DB::raw('beaches as b'))
                        ->leftjoin('reviews as r', 'b.id', '=', 'r.beachId')
                        ->select(array('b.id','b.name','b.description','b.imagePath','b.latitude','b.longitude',
                            DB::raw('count(r.id) as review_count'),DB::raw('format(avg(r.rate),1) as avg_rate'))
                                )
                        ->whereRaw('b.id = '.$bid)
                        ->groupBy('b.id')->get('1');
            return json_encode($beach);
        } else {
            return $this->throwError();
        }
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
                $num = $beach->suggestions + 1;
                if ($num >= $approve_limit){
                    $beach->approved = true;
                    //return "approved";
                } else {
                    //return "pending";
                }
                $beach->suggestions = $num;
                $beach->save();
                return Redirect::to('/')->with('message','Your suggestion has been documented and the beach will be approved soon!');
            } else {
                return $this->throwError();
            }
        } else {
            return $this->throwError();       
        }
    }
}
?>
