<?php

use Layer\Connector\ConnectorClass;

class ConnectorClassTest extends \PHPUnit_Framework_TestCase
{
    public function testConnect()
    {
        $mock = $this->getMockBuilder('ConnectorClass')
          ->disableOriginalConstructor()
          ->getMock();

        $mock->expects($this->any())
          ->method('connect')
          ->will($this->returnValue('foo'));

        $conn = new ConnectorClass('','root','');

        $this->assertNotEmpty($conn->connect());
        $this->assertNotNull($conn->connect());
    }

    public function testConnectClose()
    {
        $observer = $this->getMockBuilder('ConnectorClass', array('connectClose'))
          ->disableOriginalConstructor()
          ->getMock();

        $subject = new ConnectorClass('','root','');

        $this->assertNull($subject->connectClose());
    }

}