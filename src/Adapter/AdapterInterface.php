<?php

namespace Koine\SimpleDb\Adapter;

interface AdapterInterface
{
    /**
     * @return array
     */
    public function read();

    /**
     * @param array $data
     */
    public function write(array $data);
}
