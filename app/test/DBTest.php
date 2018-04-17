<?php
/**
 * Created by PhpStorm.
 * User: Kortez
 * Date: 2018-04-06
 * Time: 20:39
 */

namespace app\test;
include_once(__DIR__.'/../model/DB.php');
include_once (__DIR__.'/../interfaceDB.php');

use app\interfaceDB;
use app\model\DB;
use PHPUnit\Framework\TestCase;

class DBTest extends \PHPUnit\Framework\TestCase
{

    public function testDBConstruct()
    {
        $test= new DB('mysql');
        $this->assertInstanceOf('PDO', $test->get_db());
    }

    public function testGetActionName(){
        $test= new DB('mysql');
        $this->assertEquals('Kontakt', $test->getActionName('kontakt'));
        $this->assertFalse($test->getActionNumber('błędna nazwa'));
    }

    public function testGetActionNumber(){
        $test= new DB('mysql');
        $this->assertEquals('kontakt', $test->getActionNumber('Kontakt'));
        $this->assertFalse($test->getActionNumber('błędny numer akcji'));
    }

    public function testSetActionName(){
        $test= new DB('mysql');
        $this->assertTrue($test->setActionName('action01', 'O_nas'));
        $this->assertTrue($test->setActionName('action02', 'Oferta'));
        $this->assertFalse($test->setActionName('kontakt', 'Kontakt'));
        $this->assertFalse($test->setActionName('błędny numer akcji', 'nazwa akcji'));
    }

    public function testGetActionTitle(){
        $test= new DB('mysql');
        $this->assertStringEndsWith('action05', $test->getActionTitle('action05'));
        $this->assertFalse($test->getActionTitle('action11'));
    }

    public function testSetActionTitle(){

    }

    public function testGetActionMain(){

    }

    public function testSetActionMain(){

    }

    public function testGetActionCSS(){

    }

    public function testSetActionCSS(){
    }

}
