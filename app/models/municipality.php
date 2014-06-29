<?php

class municipality extends Eloquent {
    
    protected $table ="municipalities";
    protected $fillable = array('*');
    
    public function beach(){
        return $this->hasMany("beach","municipality_id");
    }
}

?>
