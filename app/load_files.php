<?php
/**
 * Created by PhpStorm.
 * User: Kortez
 * Date: 2018-02-18
 * Time: 18:10
 */
class load_files{
    public static function require_files($pattern, $type= "php"){
        foreach (glob($pattern."/*".$type) as $file){
            require_once $file;
        }
    }

    public static function include_files($pattern, $type="php"){
        foreach (glob($pattern."/*".$type) as $file){
            include_once $file;
        }
    }
}