<?php

class message extends Eloquent {
    
    protected $table = "messages";
    private $rules;
    private $message = null;
    
    public function __construct() {
        $this->rules = array(
                'name' =>'required',
                'email' =>'required|email',
                'description' =>'required'
        );
    }
    
    public function setMessage($message){
        $this->message = $message;
    }
    
    public function validate(){
        if (!is_null($this->message)){
            $validator = Validator::make($this->message,$this->rules);
            if ($validator->passes()){
                $this->name = $this->message['name'];
                $this->email = $this->message['email'];
                $this->description = $this->message['description'];
                $this->save();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

?>