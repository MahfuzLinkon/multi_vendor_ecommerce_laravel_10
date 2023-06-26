<?php

namespace App\Helper;

use Intervention\Image\Facades\Image;

class Helper
{
    public static function uploadImage($imageObject, $imageDirectory, $existingUrl = null, $width = null ,$height = null): string
    {
        if ($imageObject){
            if ($existingUrl){
                if (file_exists($existingUrl)){
                    unlink($existingUrl);
                }
            }
            $imageName = time().'-'.rand(111, 9999).'.'.$imageObject->getClientOriginalExtension();
            $imagePath = $imageDirectory.$imageName;
            if ($height || $width ){
                Image::make($imageObject)->resize($width, $height)->save($imagePath);
            }else{
                Image::make($imageObject)->save($imagePath);
            }
        }else{
            if ($existingUrl){
                $imagePath = $existingUrl;
            }else{
                $imagePath = null;
            }
        }
        return $imagePath;
    }








}
