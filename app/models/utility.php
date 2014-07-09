<?php

class utility extends Eloquent {
    
    protected $fillable = array('*');
    protected $table = 'utilities';
    
    private $bid = null;


    function beach(){
        return $this->belongsTo('beach');
    }
    
    public function __construct($bid=null) {
        $this->bid = $bid;
    }
    
    public function getUtilities(){
        if ($this->bid!=null){
            return $this::Where('beach_id','=',$this->bid)->get()->toArray();
        }
    }
    
    public function updateUtility($data){
        $this->hasWifi = $data['hasWifi'];
        $this->save();
    }
    
    //Data validation even if no attribute is undefined
    public function checkData($data){
            $this->hasBeachBar = isset($data['hasBeachBar']) ? $data['hasBeachBar'] : 0; 
            $this->hasShade = isset($data['hasShade']) ? $data['hasShade'] : 0 ;
            $this->hasFreeParking = isset($data['hasFreeParking']) ? $data['hasFreeParking'] : 0;
            $this->hasPaidParking = isset($data['hasPaidParking']) ? $data['hasPaidParking'] : 0; 
            $this->hasRoadAccess = isset($data['hasRoadAccess'])? $data['hasRoadAccess'] : 0;
            $this->hasWifi = isset($data['hasWifi']) ? $data['hasWifi'] : 0;
            $this->hasSand = isset($data['hasSand'])? $data['hasSand'] : 0;
            $this->hasFreeSunbed = isset($data['hasFreeSunbed']) ? $data['hasFreeSunbed'] : 0;
            $this->hasPaidSunbed = isset($data['hasPaidSunbed']) ? $data['hasPaidSunbed'] : 0;
            $this->hasFreeUmbrella = isset($data['hasFreeUmbrella']) ? $data['hasFreeUmbrella'] : 0;
            $this->hasPaidUmbrella = isset($data['hasPaidUmbrella']) ? $data['hasPaidUmbrella'] : 0;
            $result = $this->save();
            echo $result;
            if($result){
                return true;
            } else {
                return false;
            }
            
    }
}

?>
