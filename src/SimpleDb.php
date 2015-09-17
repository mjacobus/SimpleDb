<?php

namespace Koine\SimpleDb;

use Koine\SimpleDb\Adapter\AdapterInterface;

/**
 * Koine\SimpleDb\SimpleDb
 */
class SimpleDb
{
    /** @var AdapterInterface */
    private $adapter;

    /**
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $data = $this->adapter->read();

        if (isset($data['data'])) {
            return $data['data'];
        }

        return array();
    }
}
