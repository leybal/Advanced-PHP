<?php

namespace Layer\Manager;

class UserManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider backString
     * @param $str
     */
    public function testInsert($str)
    {
        $stub = $this->getMockBuilder('Layer\Manager\UserManager', array('insert'))
          ->disableOriginalConstructor()
          ->getMock();

        $stub->method('insert')->will($this->returnValue($str));

        $this->assertStringMatchesFormat('%s',$stub->insert(array('name', 'email')));
    }

    public function backString()
    {
        return [
          ['Some SQL insert.'],
        ];
    }

    public function testFind()
    {
        $stub = $this->getMockBuilder('Layer\Manager\UserManager', array('find'))
          ->disableOriginalConstructor()
          ->getMock();

        $arr = array('id'=>1, 'name'=>'Name', 'email'=>'Email');
        $stub->method('find')
          ->will($this->returnValue($arr));

        $this->assertArrayHasKey('id',$stub->find('entityName', 1));
    }

    public function testFindBy()
    {
        $stub = $this->getMockBuilder('Layer\Manager\UserManager', array('findBy'))
          ->disableOriginalConstructor()
          ->getMock();

        $arrArr = [
          0 => [1, 'name', 'email']
        ];
        $stub->method('findBy')
          ->will($this->returnValue($arrArr));

        $this->assertArraySubset([0 => [1, 'name', 'email']],
          $stub->findBy('entityName', array('name', 'email')));
    }
}
