<?php

class ImageController extends BaseController {
    
     public $restfull = true;
     
public function store(){
            $error = false;
            if (Input::has('bid')){
                $bid = Input::get('bid');
            } else {
                $error = true;
            }
            if (Input::hasFile('imagePath') && Input::file('imagePath')->isValid()) {
                $image = new images;
                $newImage = Input::file('imagePath');
                $path = $image->uploadImage($newImage, $bid);
                if ($path){
                    $image->beach_id = $bid;
                    $image->imagePath = $path;
                    $image->submitted_by = Auth::id();
                    $image->save();
                } else {
                    $error = true;
                }                
            } else {
                $error = true;
            }
            if ($error) {
                return Redirect::to('/')->with('message','Error during image processing.');
            } else {
                return Redirect::to('/beach/'.$bid)->with('message','Image uploaded successfully.');
            }
    }
}
