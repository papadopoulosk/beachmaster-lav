<?php

class prefecture extends Eloquent {
    
    protected $table ="prefectures";
    protected $fillable = array('*');
    
    public function prefecture(){
        return $this->hasMany("municipality","id");
    }
}

?>
