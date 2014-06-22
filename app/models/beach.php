<?php

class beach extends Eloquent {
    
    protected $table = "beaches";
    
    public function review()
    {
        return $this->hasMany('review','beachId');
    }
    
    public function municipality(){
        return $this->hasOne("municipality","id");
    }
}

?>
