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
        $this->adapter = $this->getMock(AdapterInterface::class);
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
            ->will($this->returnValue([]));

        $data = $this->db->findAll();
        $this->assertEquals([], $data);
    }

    /**
     * @test
     */
    public function findAllReturnsCollectionFromTheAdapter()
    {
        $adapterData = [
            'data' => [
                ['foo' => 'bar'],
            ],
        ];

        $this->adapter->expects($this->once())
            ->method('read')
            ->willReturn($adapterData);

        $expected = [
            ['foo' => 'bar'],
        ];

        $data = $this->db->findAll();
        $this->assertEquals($expected, $data);
    }
}
