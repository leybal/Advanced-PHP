<?php

use Layer\Connector\ConnectorClass;

class ConnectorClassTest extends \PHPUnit_Framework_TestCase
{
    public function testConnect()
    {
        $stub = $this->getMockBuilder('Layer\Connector\ConnectorClass', array('connect'))
          ->disableOriginalConstructor()
          ->getMock();

        $stub->method('connect')
          ->willReturn('foo');

        $this->assertNotEmpty($stub->connect());
        $this->assertNotNull($stub->connect());
        $this->assertEquals('foo', $stub->connect());
    }

    public function testConnectClose()
    {
        $stub = $this->getMockBuilder('Layer\Connector\ConnectorClass', array('connectClose'))
          ->disableOriginalConstructor()
          ->getMock();

        $this->assertNull($stub->connectClose());
    }

}