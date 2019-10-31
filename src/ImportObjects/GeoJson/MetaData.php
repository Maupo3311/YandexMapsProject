<?php

namespace App\ImportObjects\GeoJson;

/**
 * Class MetaData
 * @package App\ImportObjects\GeoJson
 */
class MetaData
{
    /**
     * @var string Map name.
     */
    public $name;

    /**
     * @var string Map creator.
     */
    public $creator;

    /**
     * MetaData constructor.
     * @param string $name    Map name.
     * @param string $creator Map creator.
     */
    public function __construct(string $name, string $creator)
    {
        $this->name    = $name;
        $this->creator = $creator;
    }
}