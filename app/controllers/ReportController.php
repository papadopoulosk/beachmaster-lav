<?php

class ReportController extends BaseController {
    
    public $restfull = true;
    
    public function beach(){
        $bid = Input::get("id");
        $report = new report('reportbeach');
        $report->beach_id = $bid;
        $report->text = "Test";
        $report->save();
        return "Beach Reported -- ".$bid;
    }
    
    public function image(){
        $bid = Input::get("id");
        $report = new report('reportimage');
        $report->image_id = $bid;
        $report->text = "Test";
        $report->save();
        return "Image Reported";
        
    }
    
    public function review(){
        $bid = Input::get("id");
        $report = new report('reportreview');
        $report->review_id = $bid;
        $report->text = "Test";
        $report->save();
        return "Review Reported";
    }
    
}
