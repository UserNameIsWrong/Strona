<?php
/**
 * Created by PhpStorm.
 * User: Kortez
 * Date: 2018-04-06
 * Time: 20:39
 */

namespace app\test;
include_once(__DIR__ . '/../constructor/dbConstructor.php');

use app\constructor\dbConstructor;
use PHPUnit\Framework\TestCase;

class dbConstructorTest extends TestCase
{

    public function testDBConstruct()
    {
        $test= new dbConstructor('mysql');
        $this->assertInstanceOf('PDO', $test->get_db());
    }

    public function testGetActionName(){
        $test= new dbConstructor('mysql');
        $this->assertEquals('kontakt', $test->getActionName(26));
        $this->assertFalse($test->getActionName(13323345));
    }


    public function testGetActionTitle(){
        $test= new dbConstructor('mysql');
        $this->assertStringEndsWith('action05', $test->getActionTitle('action05'));
        $this->assertFalse($test->getActionTitle('załanazwa'));
    }

}
