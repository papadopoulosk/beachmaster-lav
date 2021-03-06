<?php

class BeachController extends BaseController {

    public $restfull = true;
    protected $layout = 'layout.default';

    public function index() {

        $municipalities = municipality::remember(60)->select("municipalities.id", 'municipalities.name', 'municipalities.prefecture_id')
                        ->leftJoin('beaches', 'municipalities.id', '=', 'beaches.municipality_id')
                        ->where('beaches.approved', '=', '1')
                        ->distinct()->orderBy('name')->get();

//        $prefectures = prefecture::select("prefectures.id",DB::Raw("concat(prefectures.name,' -(',count(beaches.id),')') as name"))
//                ->leftJoin('beaches','prefectures.id','=','beaches.prefecture_id')
//                ->where('beaches.approved','=','1')
//                ->distinct()->orderBy('prefectures.name')->get();

        $prefectures = beach::select("prefectures.id", DB::raw('concat(prefectures.name," - (",count(beaches.id),")") as name'))
                ->leftjoin('prefectures', function($join) {
                    $join->on('prefectures.id', '=', 'beaches.prefecture_id');
                })->groupby('beaches.prefecture_id')
                ->where('beaches.approved', '=', '1')
                ->get();

        return View::make('beach.index')
                        ->with('municipalities', $municipalities->toArray())
                        ->with('prefectures', $prefectures->toArray());
    }

    public function show($bId = 0) {
        if (is_null($bId)) {
            $bId = Input::get("bid");
        }
        if (is_numeric($bId)) {
            $beach = beach::find($bId);
        } elseif (is_string($bId)) {

            $beach = beach::where('slug', $bId)->first();
        }
        //dd($beach->id);
        //bId and ownerid are integer after this point
        $bId = $beach->id;
        $ownerId = $beach->submitted_by;

        $reviews = review::where('beachId', $bId)->get();

        $utility = new utility($bId);
        $utility = $utility->getUtilities(); //utility::where('beach_id',1)->get();

        $images = $beach->images->toArray();
        foreach ($images as $key => $image) {
            $name = user::select('name')->where('id', '=', $image['submitted_by'])->limit(1)->get()->toArray()[0]['name'];
            $images[$key]['owner'] = [ 'userid' => $image['submitted_by'], 'name'=>$name];
        }
        //dd($images);

        $beachOwner = user::select('id', 'name')->where('id', '=', $ownerId)->get()->toArray();

        if (is_null($beach)) {
            return Redirect::to('/')->with('message', "No results returned. Please try again.");
        } else {
            return View::make('beach.details')
                            ->with('beach', $beach->toArray())
                            ->with('reviews', $reviews->toArray())
                            ->with('utility', $utility)
                            ->with('images', $images) //->toArray());  
                            ->with('beachOwner', $beachOwner);
        }
    }

    public function create() {
        return View::make('beach.add');
    }

    public function store() {

        $beach = new beach;

        $data = Input::all();
        $validationResults = $beach->validate($data);
        if ($validationResults === true) {
            $prefecture = prefecture::firstOrNew(array('name' => $data['prefecture']));
            $prefecture->name = $data['prefecture'];
            $prefecture->save();

            $municipality = municipality::firstOrNew(array('name' => $data['municipality']));
            $municipality->prefecture_id = $prefecture->id;
            $municipality->name = $data['municipality'];
            $municipality->save();

            //$file = $data['imagePath'];

            $beach->name = $data['name'];
            $beach->slug = Str::slug($data['name']);
            $beach->description = $data['description'];
            $beach->latitude = $data['latitude'];
            $beach->longitude = $data['longitude'];
            $beach->suggestions = 1;
            $beach->approved = 0;
            $beach->prefecture_id = $prefecture->id;
            $beach->municipality_id = $municipality->id;
            $beach->submitted_by = Auth::id();
            //Save new beach to the database
            $beach->save();

            $image = new images;
            if (Input::hasFile('imagePath')) {
                $newImage = Input::file('imagePath');
                $path = $image->uploadImage($newImage, $beach->id);
                if ($path) {
                    $image->beach_id = $beach->id;
                    $image->imagePath = $path;
                    $image->submitted_by = Auth::id();
                    $image->save();
                } else {
                    $error = true;
                }
            } else {
                return Redirect::to('/beach/create')->with('message', 'Missing image');
//                $image->beach_id = $beach->id;
//                $image->imagePath = $path;
//                $image->save();
            }

            $utility = new utility; //utility::firstOrCreate(array('beach_id'=>$beach->id)); //new utility($beach->id);
            $utility->beach_id = $beach->id;
            $utility->checkData($data);
            $utility->save();

            return Redirect::to('/beach/create')->with('message', 'Beach has been submitted for approval');
        } else {
            //Generate error message and forward them to View
            return Redirect::to('/beach/create')->withErrors($validationResults);
        }
    }

    /* API call - Asychronous functions
     * This section includes all functions utilised in order
     * to generate asynchronous content and/or JSON results
     */

    //Common error function for all invalid API calls
    private function throwError() {
        return Response::json('404 - Improper parameters', 404);
    }

    public function beaches() {
        //Initial call of beaches for main page.
        //Generate a JSON list for display purposes - API call through AngularJS


        $queryA = "";
        $queryB = "";
        if (Input::has('prefecture') && is_numeric(Input::get('prefecture'))) {
            $prefecture = Input::get('prefecture');
            $queryA = ' AND beaches.prefecture_id = ' . $prefecture . ' ';

            $activeMunicipalities = beach::
                    select("beaches.municipality_id as id", DB::raw("count(beaches.id) as countOfBeaches"), DB::RAW("CONCAT(municipalities.name,' - (',count(beaches.id),')') as name"))
                    ->leftjoin('municipalities', function($join) {
                        $join->on('beaches.municipality_id', '=', 'municipalities.id');
                    })
                    ->where("beaches.prefecture_id", '=', $prefecture)
                    ->where('beaches.approved', '=', '1')
                    ->groupBy('beaches.municipality_id')
                    ->get();
        } else {
            $activeMunicipalities = beach::
                    select("beaches.municipality_id as id", DB::raw("count(beaches.id) as countOfBeaches"), DB::RAW("CONCAT(municipalities.name,' - (',count(beaches.id),')') as name"))
                    ->leftjoin('municipalities', function($join) {
                        $join->on('beaches.municipality_id', '=', 'municipalities.id');
                    })
                    //->where("beaches.prefecture_id",'=',$prefecture)
                    ->where('beaches.approved', '=', '1')
                    ->groupBy('beaches.municipality_id')
                    ->get();
        }
        if (Input::has('municipality') && is_numeric(Input::get('municipality'))) {
            $municipality = Input::get('municipality');
            $queryB = ' AND beaches.municipality_id = ' . $municipality . ' ';
        }

        $whereClause = 'beaches.approved = 1' . $queryA . $queryB;

        $beaches = beach::select(
                        'beaches.id', 'beaches.slug', 'beaches.name', 'beaches.description', 'beaches.longitude', 'beaches.latitude', 'beaches.municipality_id', 'beaches.prefecture_id', 'images.imagePath', DB::Raw('count(reviews.beachId) AS review_count'), DB::Raw('format(avg(reviews.rate),1) AS avg_rate'))
                ->leftJoin("images", function($join) {
                    $join->on('beaches.id', '=', 'images.beach_id');
                    //->GroupBy('images.beach_id');
                })->leftJoin('reviews', function($join) {
                    $join->on('beaches.id', '=', 'reviews.beachId');
                })
                ->GroupBy('beaches.id')
                ->whereRaw($whereClause)
                ->remember(5)
                ->paginate(8);
        $b = $beaches->toArray();
        if (isset($activeMunicipalities)) {
            $b['activeMunicipalities'] = $activeMunicipalities->toArray();
        }
        //print_r(JSON_encode($b));
        if (count($beaches) < 1) {
            return $this->throwError();
        } else {
            return json_encode($b);
        }
    }

    public function beach($bid = null) {
        //Custom Query for join operation
        if (!isset($bid))
            return Redirect::to('/api/v1/beach/all');
        if (is_numeric($bid)) {
            $beach = DB::table(DB::raw('beaches as b'))
                            ->leftjoin('reviews as r', 'b.id', '=', 'r.beachId')
                            ->select(array('b.id', 'b.name', 'b.description', 'b.imagePath', 'b.latitude', 'b.longitude',
                                DB::raw('count(r.id) as review_count'), DB::raw('format(avg(r.rate),1) as avg_rate'))
                            )
                            ->whereRaw('b.id = ?', array($bid))
                            ->groupBy('b.id')->get('1');
            return json_encode($beach);
        } else {
            return $this->throwError();
        }
    }

    public function updateDescription() {

        $data = Input::all();
        if (Input::has('description') && Input::has('id') && is_numeric(Input::get('id'))) {
            $description = $data['description'];
            $beachId = $data['id'];
            $beach = beach::find($beachId);
            if (!is_null($beach)) {
                $beach->description = $description;
                $beach->save();
                $lastUpdate = $beach->updated_at->toDateTimeString();
                ;
                return Response::json(array('beachId' => $beachId, 'updated_at' => $lastUpdate));
            } else {
                return $this->throwError();
            }
        } else {
            return $this->throwError();
        }
    }

    public function neighbors() {
        //Generate nearest beaches
        //Utilised during beach submittion process
        $lat = Input::get("lat");
        $lng = Input::get("lng");

        if (!is_null($lat) && !is_null($lng)) {
            //Ratio to estimate nearest beaches
            $ratio = 0.002;
            $maxRatio = 1 + $ratio;
            $minRatio = 1 - $ratio;
            $minlat = $lat * $minRatio;
            $maxlat = $lat * $maxRatio;
            $minlng = $lng * $minRatio;
            $maxlng = $lng * $maxRatio;

            $data = beach::select("beaches.id", "beaches.name", "beaches.description", "images.imagePath")
                    ->whereRaw('latitude > ? and `latitude` < ? and `longitude` > ? and `longitude` < ?', array($minlat, $maxlat, $minlng, $maxlng))
                    ->leftJoin('images', 'images.beach_id', '=', 'beaches.id')
                    ->groupBy('beaches.id')
                    ->get();

            $count = beach::select("name")
                    ->whereRaw('latitude > ? and `latitude` < ? and `longitude` > ? and `longitude` < ?', array($minlat, $maxlat, $minlng, $maxlng))
                    ->count();

            if ($count > 0) {
                return json_encode($data->toArray());
            } else {
                return $this->throwError();
            }
        } else {
            return $this->throwError();
        }
    }

    public function getNames() {
        $beach = new beach;
        $names = $beach->getNames();
        return $names;
    }

    /**
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
     */
    
    public function suggest($bid = null) {
        $approve_limit = 5;
        if (!is_null($bid)) {
            //$beachId = Input::get('beachid');
            $beach = beach::find($bid);
            if (!is_null($beach)) {
                $num = $beach->suggestions + 1;
                if ($num >= $approve_limit)
                    $beach->approved = true;
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
