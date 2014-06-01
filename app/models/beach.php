<?php


class beach extends Eloquent {
    
    protected $table = "beaches";
    
    public function review()
    {
        return $this->hasMany('review','beachId');
    }
}

?>
