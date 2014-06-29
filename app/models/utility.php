<?php

class utility extends eloquent {
    
    protected $fillable = array('*');
    protected $table = 'utilities';

    function beach(){
        return $this->belongsTo('beach');
    }
}

?>
