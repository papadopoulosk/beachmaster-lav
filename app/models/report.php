<?php

class report extends Eloquent {
    
    public $table = '';
    protected $legitimateTables = array("reportBeach", "reportReview", "reportImage");
    
    public function __construct($reportedEntity){
        if (in_array($reportedEntity, $this->legitimateTables)){
            $this->table = $reportedEntity;
            //echo "Table: ".$this->table;
        } else {
            return false;
        }
    }
    
}
