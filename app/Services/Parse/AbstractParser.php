<?php


namespace App\Services\Parse;


abstract class AbstractParser
{
    private $sourceId = null;

    /**
     * @return string
     */
    abstract public function getAttributes();

    /**
     * @param string $source
     */
    abstract public function setSource(string $source);
}
