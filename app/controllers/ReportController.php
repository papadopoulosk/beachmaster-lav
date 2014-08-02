<?php

class ReportController extends BaseController {
    
    public function beach($bid){
        if (isset($bid) && is_numeric($bid))
        {
            $report = new report('reportBeach');
            $report->beach_id = $bid;
            $report->text = "Test";
            $report->save();
            return $this->success();
        } else {
            return $this->throwError();
        }
    }
    
    public function image($bid){
        if (isset($bid) && is_numeric($bid))
        {
            $report = new report('reportImage');
            $report->image_id = $bid;
            $report->text = "Test";
            $report->save();
            return $this->success();
        } else {
            return $this->throwError();
        }
    }
    
    public function review($bid){
        if (isset($bid) && is_numeric($bid))
        {
            $report = new report('reportReview');
            $report->review_id = $bid;
            $report->text = "Test";
            $report->save();
            return $this->success();
        } else {
            return $this->throwError();
        }
    }
    
    private function throwError (){
        return Response::json('Processing failed', 400);
    }
    
    private function success(){
        return Response::json('Success', 201);
    }
    
}
