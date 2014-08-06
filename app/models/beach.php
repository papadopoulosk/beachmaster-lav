<?php

class beach extends Eloquent {
    
    protected $table = "beaches";
    
    public function review(){
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

    public function validate($data){
        $rules = array(
                'name' =>'required',
                'description' =>'required',
                'latitude' =>'required',
                'longitude' =>'required',
                'imagePath' =>'required',
                'prefecture' =>'required',
                'municipality' => 'required'
        );
        $validator = Validator::make($data,$rules);
        return $validator->passes();
    }
    
    public function getNames(){
        $names = array();
        $temp = $this::select("id","name")->remember(15)->get()->toArray();
        foreach($temp as $key => $value){
            //print_r($value);
            array_push($names, $value);
        }
        //print_r($names);
        return json_encode($names);
    }
}

?>
