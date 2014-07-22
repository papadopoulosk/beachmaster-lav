<?php

class ReportController extends BaseController {
    
    public function beach($bid){
        if (isset($bid) && is_numeric($bid))
        {
//            $bid = Input::get("id");
            $report = new report('reportbeach');
            $report->beach_id = $bid;
            $report->text = "Test";
            $report->save();
            return 1;
        } else {
            return 0;
        }
    }
    
    public function image($bid){
        if (isset($bid) && is_numeric($bid))
        {
//          $bid = Input::get("id");
            $report = new report('reportimage');
            $report->image_id = $bid;
            $report->text = "Test";
            $report->save();
            return 1;
        } else {
            return 0;
        }
    }
    
    public function review($bid){
        if (isset($bid) && is_numeric($bid))
        {
//            $bid = Input::get("id");
            $report = new report('reportreview');
            $report->review_id = $bid;
            $report->text = "Test";
            $report->save();
            return 1;
        } else {
            return 0;
        }
    }
    
}
