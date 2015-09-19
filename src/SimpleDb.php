<?php

namespace Koine\SimpleDb;

use Koine\SimpleDb\Adapter\AdapterInterface;

/**
 * Koine\SimpleDb\SimpleDb
 */
class SimpleDb
{
    /** @var array */
    private $adapter;
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function findAll(array $criterias = array())
    {
        $filteredData = array();
        $rawData =  $this->adapter->read();

        if (!$criterias) {
            return $rawData;
        }

        foreach ($rawData as $record) {
            foreach ($criterias as $field  => $value) {
                if ($record[$field] == $value) {
                    $filteredData[] = $record;
                }
            }
        }

        return $filteredData;
    }
}
