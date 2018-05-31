<?php
/**
 * Created by PhpStorm.
 * User: Kortez
 * Date: 2018-03-10
 * Time: 23:19
 */

namespace app\test;
//include(__dir__ . '/../request.php');

use app\request;
use PHPUnit\Framework\TestCase;


class requestTest extends TestCase
{

    public function testParseUrl()
    {
        $request = new request();

        $this->assertEquals('O_nas', $request->parseUrl('http://strona.local/index.php/O_nas'));
        $this->assertEquals('Oferta', $request->parseUrl('kstrona.local/index.php/Oferta'));
        $this->assertEquals('coś_tam', $request->parseUrl('www.strona.local/index.php/coś_tam'));
        $this->assertEquals('cennik', $request->parseUrl('http://WWW.strona.local/index.php/cennik'));

        $this->assertEquals('Index', $request->parseUrl('/'));
        $this->assertEquals('Index', $request->parseUrl('http://strona.local/index.php/'));
        $this->assertEquals('Index', $request->parseUrl('http://strona.local'));
        $this->assertEquals('Index', $request->parseUrl('http://strona.local/'));
        $this->assertEquals('Index', $request->parseUrl('http://www.strona.local/'));
        $this->assertEquals('Index', $request->parseUrl('WWW.strona.local'));
        $this->assertEquals('Index', $request->parseUrl('strona.local/Index'));

    }

    public function testGetController()
    {
        $request = new request();

        $this->assertEquals('showController', $request->getControllerName('http://strona.local/index.php/O_nas'));
        $this->assertEquals('showController', $request->getControllerName('strona.local/index.php/Oferta'));
        $this->assertEquals('showController', $request->getControllerName('www.strona.local/index.php/Coś_tam'));
        $this->assertEquals('showController', $request->getControllerName('http://WWW.strona.local/index.php/cennik'));
        $this->assertEquals('showController', $request->getControllerName('index.php/O_nas'));
        $this->assertEquals('showController', $request->getControllerName('/index.php/Kontakt'));
        $this->assertEquals('showController', $request->getControllerName('http://WWW.strona.local/index.php/costamzle?id=12wer'));
        $this->assertEquals('showController', $request->getControllerName('/'));
        $this->assertEquals('showController', $request->getControllerName('index.php'));
        $this->assertEquals('showController', $request->getControllerName('index.php/'));
        $this->assertEquals('showController', $request->getControllerName('http://strona.local/index.php/'));
        $this->assertEquals('showController', $request->getControllerName('http://strona.local'));
        $this->assertEquals('showController', $request->getControllerName('http://strona.local/'));
        $this->assertEquals('showController', $request->getControllerName('http://www.strona.local/'));
        $this->assertEquals('showController', $request->getControllerName('WWW.strona.local'));
        $this->assertEquals('showController', $request->getControllerName(''));

        $this->assertEquals('updateController', $request->getControllerName('http://strona.local/index.php/update/O_nas'));
        $this->assertEquals('delateController', $request->getControllerName('strona.local/index.php/delate/Oferta'));
        $this->assertEquals('addController', $request->getControllerName('www.strona.local/index.php/add/Cennik'));
        $this->assertEquals('showController', $request->getControllerName('http://WWW.strona.local/index.php/show/index'));
        $this->assertEquals('updateController', $request->getControllerName('index.php/update/Coś_tam'));
        $this->assertEquals('delateController', $request->getControllerName('/index.php/delate/Kontakt'));
        $this->assertEquals('addController', $request->getControllerName('http://WWW.strona.local/index.php/add/costamzle?id=12wer'));

    }

    public function testGetActionName()
    {
        $request = new request();

        $this->assertEquals('O_nas', $request->getActionName('http://strona.local/index.php/O_nas'));
        $this->assertEquals('Oferta', $request->getActionName('strona.local/index.php/Oferta'));
        $this->assertEquals('Cennik', $request->getActionName('www.strona.local/index.php/Cennik'));
        $this->assertEquals('Coś_tam', $request->getActionName('http://WWW.stronaa.local/index.php/Coś_tam'));
        $this->assertEquals('opinie', $request->getActionName('index.php/opinie'));
        $this->assertEquals('Kontakt', $request->getActionName('/index.php/Kontakt'));

        $this->assertEquals('Index', $request->getActionName('/'));
        $this->assertEquals('Index', $request->getActionName('index.php'));
        $this->assertEquals('Index', $request->getActionName('index.php/'));
        $this->assertEquals('Index', $request->getActionName('http://strona.local/index.php/'));
        $this->assertEquals('Index', $request->getActionName('http://strona.local'));
        $this->assertEquals('Index', $request->getActionName('http://strona.local/'));
        $this->assertEquals('Index', $request->getActionName('http://www.strona.local/'));
        $this->assertEquals('Index', $request->getActionName('WWW.strona.local'));
        $this->assertEquals('Index', $request->getActionName(''));
        $this->assertEquals('Index', $request->getActionName('index.php/Index'));
        $this->assertEquals('Index', $request->getActionName('/Index'));
        $this->assertEquals('costam', $request->getActionName('http://WWW.strona.local/index.php/add/costam?id=12wer'));
    }
}