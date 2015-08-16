<?php

namespace Koine\SimpleDb\Adapter;

class JsonFile implements AdapterInterface
{
    /** @var string */
    private $file;

    /**
     * @param string $file
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \RuntimeException
     */
    public function read()
    {
        $contents = @file_get_contents($this->file);

        if ($contents === false) {
            throw new \RuntimeException(
                sprintf('File "%s" could not be read', $this->file)
            );
        }

        $data = json_decode($contents, true);

        if (!is_array($data)) {
            throw new \RuntimeException(
                sprintf('Contents of file "%s" is not a valid json', $this->file)
            );
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     *
     * @throws RuntimeException
     */
    public function write(array $data)
    {
        $result = @file_put_contents($this->file, json_encode($data));

        if ($result === false) {
            throw new \RuntimeException(
                sprintf('File "%s" could not be written', $this->file)
            );
        }
    }
}
