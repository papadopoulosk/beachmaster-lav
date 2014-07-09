<?php

class images extends Eloquent {
    
    protected $table            = "images";
    protected $destinationPath  = '/images/uploads/';
    protected $filename         = '';
            
    /*Arguments:
     * $image: Input::get('ImagePath') parameter
     * $bid: beach ID
     * 
     * Returns file path on successful upload or false on failure
     */
    public function uploadImage($image,$bid){
        $valid = $this->applyImageRestrictions($image);
        if ($valid){
            $file = $image;
            $this->filename = $bid."_".str_random(12);
            $uploadSuccess   = $file->move(public_path().$this->destinationPath, $this->filename);
            $img = Image::make(public_path().$this->destinationPath.$this->filename);
            $img->fit(900, 500);
            $img->save();
            return $this->destinationPath.$this->filename;
        } else {
            return false;
        }
    }
    
    private function applyImageRestrictions($image){
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $extension = $image->guessExtension();
        $type = $image->getMimeType();
        $size = $image->getClientSize();
        
        if ((($type == "image/gif")
            || ($type == "image/jpeg")
            || ($type == "image/jpg")
            || ($type == "image/pjpeg")
            || ($type == "image/x-png")
            || ($type == "image/png"))
            && ($size < 2000000) //3MB
            && in_array($extension, $allowedExts)) {
            if ($image->getError() > 0) {
                //echo $image->getError();
                return false;
            } else {
                    return true;
            }
        } else {
          return false;
        }
    }
}
