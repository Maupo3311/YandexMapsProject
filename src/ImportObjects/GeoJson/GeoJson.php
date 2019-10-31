<?php

namespace App\ImportObjects\GeoJson;

class GeoJson
{
    /**
     * @var string Type for constructor.
     */
    protected $type;

    /**
     * @var MetaData Data about maps.
     */
    protected $metaData;

    /**
     * @var array Features on map.
     */
    protected $features;

    /**
     * GeoJson constructor.
     */
    public function __construct()
    {
        $this->type = 'FeatureCollection';
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type Type for constructor.
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return MetaData
     */
    public function getMetaData()
    {
        return $this->metaData;
    }

    /**
     * @param MetaData $metaData Data about map.
     * @return $this
     */
    public function setMetaData(MetaData $metaData): self
    {
        $this->metaData = $metaData;

        return $this;
    }

    /**
     * @return array
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * @param array $features Features on map.
     * @return $this
     */
    public function setFeatures(array $features): self
    {
        $this->features = $features;

        return $this;
    }
}
