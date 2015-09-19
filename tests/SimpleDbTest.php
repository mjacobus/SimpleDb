<?php

namespace KoineTest\SimpleDb;

use PHPUnit_Framework_TestCase;
use Koine\SimpleDb\SimpleDb;
use Koine\SimpleDb\Adapter\AdapterInterface;

/**
 * KoineTest\SimpleDb\SimpleDbTest
 */
class SimpleDbTest extends PHPUnit_Framework_TestCase
{
    /** @var SimpleDb */
    protected $db;

    /** @var AdapterInterface */
    protected $adapter;

    public function setUp()
    {
        $this->adapter = $this->getMock(AdapterInterface::class);
        $this->db = new SimpleDb($this->adapter);
    }

    /**
     * @test
     */
    public function returnsEmptyArrayWhenNoRecordExists()
    {
        $this->adapter->expects($this->once())
            ->method('read')
            ->will($this->returnValue([]));

        $returnValue = $this->db->findAll();
        $this->assertEquals([], $returnValue);
    }

    /**
     * @test
     */
    public function retunrsWhateverDataTheAdapterProvides()
    {
        $data = array('foo');

        $this->adapter->expects($this->once())
            ->method('read')
            ->will($this->returnValue($data));

        $returnValue = $this->db->findAll();
        $this->assertEquals($data, $returnValue);
    }

    /**
     * @test
     */
    public function findAllCanFilterBasedOnInputCriterias()
    {
        $data = array(
            array(
                'foo' => 'bar',
            ),
            array(
                'foo' => 'baz',
            ),
        );

        $this->adapter->expects($this->once())
            ->method('read')
            ->will($this->returnValue($data));

        $returnValue = $this->db->findAll(array('foo' => 'bar'));

        $expected = array(
            array(
                'foo' => 'bar',
            )
        );

        $this->assertEquals($expected, $returnValue);
    }
}
