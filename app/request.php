<?php
/**
 * Created by PhpStorm.
 * User: Kortez
 * Date: 2018-03-10
 * Time: 23:11
 */

namespace app;


//Obiek request, przechowuje nazwę controlera, akcji i metodę zapytania przegladarki
 class request
{
     /**
      * @param string $url
      * @return string
      * analizuje url, używana przez inne metody
      */
    public function parseUrl(string $url)
    {
        $urlArray = explode('index.php/', $url);
        if (count($urlArray) == 1 || end($urlArray) == '') {
            return 'Index';
        } else {
            return end($urlArray);
        }
    }

     /**
      * @param string $url
      * @return string
      * wyszukuje nazwę kontrolera z url wysłanego przez przegladarkę
      */
    public function getControllerName(string $url)
    {
        $parse = $this->parseUrl($url);
        echo $parse;
        $array = explode('/', $parse);
        if (count($array) == 1) {
            return 'showController';
        } else {
        return $array[0] . 'Controller';
    }}

     /**
      * @param string $url
      * @return string
      * wyszukuje nazwę akcji z url wysłanego przez przegladarkę
      */
    public function getActionName(string $url)
    {
        $parse = $this->parseUrl($url);
        $array = explode('/', $parse);
        $array2 = explode('?', end($array));
        return $array2[0];

    }

}