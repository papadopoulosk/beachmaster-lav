<?php

class BeachController extends BaseController {

    public $restfull = true;
    protected $layout = 'layout.default';
    
    public function index() {
        $beaches = beach::All();
        
        //return Redirect::to('/about')->withInput();
        
        return View::make('beach.home')->with('beaches',$beaches);
    }
    
    /* Examples
    DB::table('users')
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.id', 'contacts.phone', 'orders.price')
            ->get();
     * 
     * ->select(DB::raw('count(*) as user_count, status'))
    */
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
                'name' =>'required'//,
                //'description' =>'required',
                //'latitude' =>'numeric|required',
                //'longitude' =>'numeric|required',
                //'imagePath' =>'active_url|required'
            );
            
            var_dump($data);
        $validator = Validator::make($data,$rules);
        if($validator->passes()){
            $beach->name = $data['name'];
            $beach->description = $data['description']; 
            $beach->imagePath = $data['imagePath'];
            $beach->latitude = $data['latitude'];
            $beach->longitude = $data['longitude'];
            $beach->rate = 2.5;
            $beach->votes = 0;
            $beach->numReviews = 0;
            
            $beach->save();
            
            return Redirect::to('add')->with('message','Beach submitted for approval');
        } else {
            //return Redirect::to('add')->with('message','Error during processing');
        }

    }
    
    //API call
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
    
    public function neighbors(){
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
            
            
            $data = beach::select("name")->whereRaw('latitude > ? and `latitude` < ? and `longitude` > ? and `longitude` < ?',
                    array($minlat,$maxlat,$minlng,$maxlng))
                    ->get();
            return json_encode($data->toArray());
        }
    }
}

?>
