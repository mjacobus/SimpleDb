<?php

namespace KoineTest\SimpleDb;

use Koine\SimpleDb\Adapter\AdapterInterface;
use Koine\SimpleDb\SimpleDb;
use PHPUnit_Framework_TestCase;

/**
 * KoineTest\SimpleDb\SimpleDbTest
 */
class SimpleDbTest extends PHPUnit_Framework_TestCase
{
    /** @var SimpleDb */
    protected $db;

    /** @var AdapterInterface */
    private $adapter;

    public function setUp()
    {
        $this->adapter = $this->getMock('Koine\SimpleDb\Adapter\AdapterInterface');
        $this->db = new SimpleDb($this->adapter);
    }

    /**
     * @test
     */
    public function findAllReturnsEmptyWhenNoRecordsExist()
    {
        $this->adapter
            ->expects($this->once())
            ->method('read')
            ->will($this->returnValue(array()));

        $data = $this->db->findAll();
        $this->assertEquals(array(), $data);
    }

    /**
     * @test
     */
    public function findAllReturnsCollectionFromTheAdapter()
    {
        $adapterData = array(
            'data' => array(
                array('foo' => 'bar'),
            ),
        );

        $this->adapter->expects($this->once())
            ->method('read')
            ->willReturn($adapterData);

        $expected = array(
            array('foo' => 'bar'),
        );

        $data = $this->db->findAll();
        $this->assertEquals($expected, $data);
    }
}
