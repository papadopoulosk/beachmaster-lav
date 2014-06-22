<?php

class municipality extends Eloquent {
    
    protected $table ="municipalities";
    
    public function beach(){
        return $this->hasMany("beach","municipality_id");
    }
}

?>
