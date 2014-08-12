<?php

class HomeController extends BaseController {
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */

    public function showWelcome() {
        $beachCount = beach::remember(60)->where("approved", "=", 1)->count();
        $reviewCount = review::remember(60)->count();

        $beach = beach::select(
                                'beaches.id', 'beaches.slug', 'beaches.name', 'images.imagePath', 'beaches.created_at', DB::Raw('count(reviews.beachId) AS review_count'), DB::Raw('format(avg(reviews.rate),1) AS avg_rate'))
                        ->leftJoin("images", function($join) {
                            $join->on('beaches.id', '=', 'images.beach_id');
                        })->leftJoin('reviews', function($join) {
                            $join->on('beaches.id', '=', 'reviews.beachId');
                        })
                        ->GroupBy('beaches.id')
                        ->whereRaw('beaches.approved = 1')
                        //->whereRaw('beaches.id = (SELECT CEIL(RAND()*(SELECT MAX(id)FROM beaches)))')
                        ->limit(1)->get()->toArray()[0];

        return View::make('hello')->with("beachCount", $beachCount)->with("reviewCount", $reviewCount)->with('randomBeach', $beach);
    }

}
