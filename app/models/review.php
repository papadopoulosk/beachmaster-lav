<?php

class review extends Eloquent {

    protected $fillable = array('*');
    protected $table = 'reviews';

    public function owner() {
        return $this->hasOne('user', 'id', 'submitted_by')->select(array('id','name'));
    }

}

?>
