<?php

namespace Koine\SimpleDb\Adapter;

/**
 * AdapterKoine\SimpleDb\Adapter\JsonFile
 */
class JsonFile implements AdapterInterface
{
    /** @var string */
    private $file;

    public function __construct($file)
    {
        if (!file_exists($file)) {
            throw new \InvalidArgumentException('File does not exist');
        }

        $this->file = $file;
    }

    public function read()
    {
        $contents = file_get_contents($this->file);

        return json_decode($contents, true);
    }

    public function write(array $data)
    {
    }
}
