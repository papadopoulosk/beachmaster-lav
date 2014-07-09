<?php

class report extends Eloquent {
    
    public $table = '';
    protected $legitimateTables = array("reportbeach", "reportreview", "reportimage");
    
    public function __construct($reportedEntity){
        if (in_array($reportedEntity, $this->legitimateTables)){
            $this->table = $reportedEntity;
            echo "Table: ".$this->table;
        } else {
            echo "Error ;";
            return false;
        }
    }
    
}
