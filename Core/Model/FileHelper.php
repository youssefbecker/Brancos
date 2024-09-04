<?php
/**
 * Created by PhpStorm.
 * User: Ndjeunou
 * Date: 23/01/2017
 * Time: 08:59
 */

namespace Projet\Model;


class FileHelper{

    public static function url($path){
        $root = (strpos($path,"http") !== false)?"":ROOT_SITE;
        return $root.$path;
    }

    public static function deleteImage($path){
        $src = strpos($path,"http") !== false?$path:PATH_FILE.'\\'.str_replace('/','\\',$path);
        if(file_exists($src)){
            try{
                unlink($src);
            }catch (\Exception $e){}
        }
    }

    public static function moveImage($tmp_name,$folder,$extension="",$name="",$isAbsolute=false){
        $extension = (empty($extension))?pathinfo($name, PATHINFO_EXTENSION):$extension;
        $name = md5(uniqid(rand(), true)).'.'.$extension;
        $path = PATH_FILE;
        $path.= '/Public/'.$folder.'/'.str_replace('\\','/',$name);
        $root = $isAbsolute?ROOT_SITE.$folder.'/'.$name:$folder.'/'.$name;
        return move_uploaded_file($tmp_name, $path)?$root:false;
    }

}