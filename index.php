<?php
/**
 * Created by PhpStorm.
 * User: Kortez
 * Date: 2018-02-18
 * Time: 17:22
 */

echo "strona<br/>";

require_once('app/model/DB.php');
$db= new \app\model\DB();
var_dump($db);

$db->insertTestSite();

