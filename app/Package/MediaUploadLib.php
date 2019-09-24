<?php

namespace App\Package;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Auth;
use Image;
use Config;

class MediaUploadLib
{
    function __construct(){
          
    }
    public function fileUpload($fileInput, $path, $fileName ="", $thumImg = "") {       
        $filesize = $fileInput->getClientSize();        
        $destinationPath = $path; // upload path
        $extension = $fileInput->getClientOriginalExtension(); // getting image extension
        $originalName = $fileInput->getClientOriginalName();
        $originalName = explode("." , $originalName);
        $original_name = str_replace(",","",$originalName[0]);
        $original_name = str_replace(" ","",$original_name);
        if(empty($fileName)){
            $fileName = $original_name . "-" . rand('1', '99') . date('YmdHis') . '.' . $extension; // renameing image
        }
        list($width, $height) = getimagesize($fileInput->getRealPath());
        if($thumImg != ""){
           $img = Image::make($fileInput->getRealPath());
           $img->resize(($width * .5), ($height * .5), function ($constraint) {
               $constraint->aspectRatio();
           })->save($destinationPath . '/thum_' . $fileName);
        }
        $fileInput->move($destinationPath, $fileName); // uploading file to given path
 
        return array($fileName,$filesize);
    }

    public function videoUpload($videoInfo, $upload_path,$fileName ="", $thumnail="", $media_type="video"){ 
        $videosize = $videoInfo['size'];
        $imgtempname = $videoInfo['tmp_name'];
        if(empty($fileName)){
            $img = $videoInfo['name'];
            $ext_array = explode('.',$img);
            $ext =  end($ext_array);
            $rand = rand(0,1000);
            $date_con = date("YmdHis") . $rand;
            $fileName = $date_con.".".$ext;
        }else{            
            $ext_array = explode('.',$fileName);
            $date_con =  !empty($ext_array)?($ext_array[0]):'';
        }       
        if (!file_exists($upload_path)) {
            mkdir($upload_path,Config::get('constants.options.vault_permission'), true);
        }
        $path = $upload_path."/".$fileName;
        if(move_uploaded_file($imgtempname,$path) && $thumnail == 1 && $media_type="video"){
            $thum_img = $date_con . "." . "jpg";
            $thum_path = $upload_path . '/thumbnail/' . $thum_img;
            if (!file_exists($thum_path)) {
                $thumnail =  exec("ffmpeg -i $path -ss 00:00:02.435 -vframes 1 $thum_path");
            }
            $userinfo = User::find(Auth::user()->id);
            $userinfo->storage = $userinfo->storage + $videosize;
            $userinfo->save();
        }else{
            $userinfo = User::find(Auth::user()->id);
            $userinfo->storage = $userinfo->storage + $videosize;
            $userinfo->save();
        }
        return array($fileName,$videosize);
    }

    
}
