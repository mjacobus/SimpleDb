<?php

namespace KoineTest\SimpleDb\Adapter;

use Koine\SimpleDb\Adapter\AdapterInterface;
use Koine\SimpleDb\Adapter\JsonFile;
use PHPUnit_Framework_TestCase;

/**
 * @author Marcelo Jacobus <marcelo.jacobus@gmail.com>
 */
class JsonFileTest extends PHPUnit_Framework_TestCase
{
    protected $object;

    public function setUp()
    {
        $this->object = new JsonFile('/tmp/data.json');
    }

    /**
     * @test
     */
    public function implementsAdapterInterface()
    {
        $this->assertInstanceOf(AdapterInterface::class, $this->object);
    }

    /**
     * @test
     */
    public function canReadJsonData()
    {
        $jsonData = '{"foo":"bar"}';
        file_put_contents('/tmp/data.json', $jsonData);


        $data = $this->object->read();
        $expected = array('foo' => 'bar');
        $this->assertEquals($expected, $data);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function throwsAnExceptionWhenFileDoNotExist()
    {
        $this->object = new JsonFile('/tmp/nonexistingfile');
    }
}
