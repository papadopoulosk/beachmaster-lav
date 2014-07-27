<?php

class BeachController extends BaseController {

    public $restfull = true;
    protected $layout = 'layout.default';
        
    public function index() {
        
        $municipalities = municipality::select("municipalities.id",'municipalities.name','municipalities.prefecture_id')
                ->leftJoin('beaches','municipalities.id','=','beaches.municipality_id')
                ->where('beaches.approved','=','1')
                ->distinct()->orderBy('name')->get();
        
        $prefectures = prefecture::select("prefectures.id",'prefectures.name')
                ->leftJoin('beaches','prefectures.id','=','beaches.prefecture_id')
                ->where('beaches.approved','=','1')
                ->distinct()->orderBy('name')->get();
        
        return View::make('beach.index')
                ->with('municipalities',$municipalities->toArray())
                ->with('prefectures',$prefectures->toArray());
    }
    
    public function show($bId = 0) {
        if (is_null($bId)){
            $bId = Input::get("bid");
        }
        $beach = beach::find($bId);
        $reviews = review::where('beachId', $bId)->get();
        
        $utility = new utility($bId);
        $utility = $utility->getUtilities(); //utility::where('beach_id',1)->get();
        
        $images = $beach->images->toArray();
        
        if (is_null($beach)){
            return Redirect::to('/')->with('message', "No results returned. Please try again.");  
       } else {
           return View::make('beach.details')
                   ->with('beach', $beach->toArray())
                   ->with('reviews',$reviews->toArray())
                   ->with('utility',$utility)
                   ->with('images',$images);//->toArray());  
       }
    }
    
    public function create(){
        return View::make('beach.add');
    }
    
    public function store(){
        
        $beach = new beach;
                
        $data = Input::all();
        
        if($beach->validate($data)){
            $prefecture = prefecture::firstOrNew(array('name'=> $data['prefecture']));
            $prefecture->name = $data['prefecture'];
            $prefecture->save();
            
            $municipality = municipality::firstOrNew(array('name'=>$data['municipality']));
            $municipality->prefecture_id = $prefecture->id;
            $municipality->name = $data['municipality'];
            $municipality->save();
            
            //$file = $data['imagePath'];

            $beach->name = $data['name'];
            $beach->description = $data['description']; 
            $beach->latitude = $data['latitude'];
            $beach->longitude = $data['longitude'];
            $beach->suggestions = 1;
            $beach->approved = 0;
            $beach->prefecture_id = $prefecture->id;
            $beach->municipality_id = $municipality->id;
            //Save new beach to the database
            $beach->save();
            
            $image = new images;
            if (Input::hasFile('imagePath')) {
                $newImage = Input::file('imagePath');
                $path = $image->uploadImage($newImage, $beach->id);
                if ($path){
                    $image->beach_id = $beach->id;
                    $image->imagePath = $path;
                    $image->save();
                } else {
                    $error = true;
                }       
            }
            
            $utility = new utility;//utility::firstOrCreate(array('beach_id'=>$beach->id)); //new utility($beach->id);
            $utility->beach_id = $beach->id;
            $utility->checkData($data);
            $utility->save();
            
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
    
    public function beaches(){
        //Initial call of beaches for main page.
        //Generate a JSON list for display purposes - API call through AngularJS
        
        $queryA = "";
        $queryB = "";
        if(Input::has('prefecture')){
            $prefecture = Input::get('prefecture');
            $queryA = ' AND beaches.prefecture_id = '.$prefecture.' ';
        }
        if(Input::has('municipality')){
            $municipality = Input::get('municipality'); 
            $queryB = ' AND beaches.municipality_id = '.$municipality.' ';
        }
                
        $whereClause = 'beaches.approved = 1'.$queryA.$queryB;

        $beaches = DB::SELECT(
            'SELECT beaches.id,
                beaches.name,
                beaches.description,
                beaches.longitude,
                beaches.latitude,
                beaches.municipality_id,
                beaches.prefecture_id,
                img.imagePath,
               r.review_count,
               r.avg_rate
            FROM beaches
            LEFT JOIN (
                SELECT DISTINCT beach_id, imagePath
                FROM images
                GROUP BY beach_id) img
            ON img.beach_id = beaches.id
            Left JOIN (
                SELECT DISTINCT beachId, count(beachId) AS review_count,format(avg(reviews.rate),1) AS avg_rate
                FROM reviews
                GROUP BY beachId) r
            on beaches.id = r.beachId
            WHERE '.$whereClause.';');

        if (count($beaches)<1){
            return $this->throwError();
        } else {
            return json_encode($beaches);            
        }
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
                        ->whereRaw('b.id = ?',array($bid))
                        ->groupBy('b.id')->get('1');
            return json_encode($beach);
        } else {
            return $this->throwError();
        }
    }
    
    public function updateDescription(){
        $data = Input::all();
        if (Input::has('description') && Input::has('id') && is_numeric(Input::get('id'))){
            $description = $data['description'];
            $beachId = $data['id'];
            $beach = beach::find($beachId);
            if (!is_null($beach)) {
                $beach->description = $description;
                $beach->save();
                $lastUpdate = $beach->updated_at->toDateTimeString();;
               return Response::json(array('beachId' => $beachId, 'updated_at' => $lastUpdate));
            } else {
                return $this->throwError();                
            }
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
            
            $data = beach::select("beaches.id","beaches.name","beaches.description","images.imagePath")
                    ->whereRaw('latitude > ? and `latitude` < ? and `longitude` > ? and `longitude` < ?',
                    array($minlat,$maxlat,$minlng,$maxlng))
                    ->leftJoin('images', 'images.beach_id', '=', 'beaches.id')
                    ->groupBy('beaches.id')
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
        }else {
                return $this->throwError();
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
                if ($num >= $approve_limit)$beach->approved = true;
                $beach->suggestions = $num;
                $beach->save();
                return Response::json('200', 200);
            } else {
                return $this->throwError();
            }
        } else {
            return $this->throwError();       
        }
    }
}
?>
