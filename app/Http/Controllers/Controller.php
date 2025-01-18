<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function uploadFile($media,$path){

        if(is_file($media)){
            $media_name = time().'.'.$media->getClientOriginalExtension();
            $media->move(public_path($path), $media_name);
            $media_path = $path.$media_name;
            return $media_path;

        }else{
            return '--';
        }
    }
}
