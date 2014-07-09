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
    
    public function prefecture(){
        return $this->hasOne("prefecture","id");
    }
    
    public function utility(){
        return $this->hasOne('utility','beach_id');
    }
    
    public function images(){
        return $this->hasMany('images','beach_id');
    }
}

?>
