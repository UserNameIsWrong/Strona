<?php
/**
 * Created by PhpStorm.
 * User: Kortez
 * Date: 2018-03-10
 * Time: 23:11
 */

namespace app;


/**
 * Class request
 * @package app
 * zawiera metody obsługujace zapytania przegladarki
 */
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
    public function getController(string $url)
    {
        $pharse = $this->parseUrl($url);
        $array = explode('/', $pharse);
        if (count($array) == 1) {
            return 'showController';
        } else {
        }
        return $array[0] . 'Controller';
    }

     /**
      * @param string $url
      * @return string
      * wyszukuje nazwę akcji z url wysłanego przez przegladarkę
      */
    public function getActionName(string $url)
    {
        $pharse = $this->parseUrl($url);
        $array = explode('/', $pharse);
        $array2 = explode('?', end($array));
        return $array2[0];

    }

    public function getActionNumber(string $actionName)
    {

    }
}