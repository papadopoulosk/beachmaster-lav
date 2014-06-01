<?php

class BeachController extends BaseController {

    public $restfull = true;
    protected $layout = 'layout.default';
    
    public function index() {
        $beaches = beach::All();
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
    
    public function addReview($review){
        if(!is_null($review)){
            
        }
    }
}

?>
