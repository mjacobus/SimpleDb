<?php

namespace KoineTest\SimpleDb\Adapter;

use PHPUnit_Framework_TestCase;
use Koine\SimpleDb\Adapter\JsonFile;

class JsonFileTest extends PHPUnit_Framework_TestCase
{
    /** @var JsonFile */
    protected $adapter;

    public function setUp()
    {
        @unlink('/tmp/posts.json');
        $this->adapter = new JsonFile('/tmp/posts.json');
    }

    /**
     * @test
     */
    public function implementsAdapterInterface()
    {
        $this->assertInstanceOf('Koine\SimpleDb\Adapter\AdapterInterface', $this->adapter);
    }

    /**
     * @test
     */
    public function canReadDataFromJsonFile()
    {
        $content = '{"foo":"bar"}';
        file_put_contents('/tmp/posts.json', $content);

        $expected = array('foo' => 'bar');
        $result = $this->adapter->read();

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @expectedException \RuntimeException
     * @expectedExceptionMessage File "/tmp/posts.json" could not be read
     */
    public function throwsAnExceptionWhenFileCannotBeRead()
    {
        @unlink('/tmp/json.json');
        $this->adapter->read();
    }

    /**
     * @test
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Contents of file "/tmp/posts.json" is not a valid json
     */
    public function throwsAndExceptionWhenDataCannotBeConvertedToArray()
    {
        file_put_contents('/tmp/posts.json', 'invalid json');
        $this->adapter->read();
    }

    /**
     * @test
     */
    public function canSaveDataToJsonFile()
    {
        $data = array('foo' => 'bar');
        $this->adapter->write($data);

        $expected = '{"foo":"bar"}';

        $actual = file_get_contents('/tmp/posts.json');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     * @expectedException RuntimeException
     * @expectedExceptionMessage File "/posts.json" could not be written
     */
    public function throwsExceptionWhenFileCannotBeSaved()
    {
        $this->adapter = new JsonFile('/posts.json');
        $this->adapter->write(array());
    }
}
