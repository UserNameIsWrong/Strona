<?php
/**
 * Created by PhpStorm.
 * User: Kortez
 * Date: 2018-05-22
 * Time: 22:31
 */

namespace app\constructor;


Abstract class Constructor
{
//metody abstrakcyjne, które mają zawierać potomne clasy constructor. potrzebne do twożenia pobiektu page

   abstract public function getActionName(string $id);

   abstract public function getActionId();

   abstract public function setActionName();

   abstract public function setActionTitle();

   abstract public function getActionMain();

   abstract public function setActionMain();

   abstract public function getActionCSS();

  abstract public function setActionCSS();

  abstract public function getActionJS();

  abstract public function setActionJS();

}