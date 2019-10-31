<?php

namespace App\Services;

use Geocoder\Collection;
use Geocoder\Location;
use Geocoder\Model\AddressCollection;
use Geocoder\Provider\GoogleMaps\Model\GoogleAddress;
use Geocoder\Query\GeocodeQuery;
use Geocoder\Exception\Exception;

class GoogleMapsService
{
    /**
     * @var string
     */
    protected $apiKey;

    /**
     * GoogleMapsService constructor.
     * @param string $googleMapsApiKey
     */
    public function __construct(string $googleMapsApiKey)
    {
        $this->apiKey = $googleMapsApiKey;
    }

    /**
     * @param string $address
     * @return Location
     * @throws Exception
     */
    public function getLocation(string $address)
    {
        $httpClient = new \Http\Adapter\Guzzle6\Client();
        $provider   = new \Geocoder\Provider\GoogleMaps\GoogleMaps($httpClient, null, $this->apiKey);
        $geoCoder   = new \Geocoder\StatefulGeocoder($provider, 'en');

        return $geoCoder->geocodeQuery(GeocodeQuery::create($address))->get(0);
    }

    /**
     * @param string $address
     * @return array
     * @throws Exception
     */
    public function getCoords(string $address)
    {
        $location = $this->getLocation($address);

        return [
            'lat' => $location->getCoordinates()->getLatitude(),
            'lon' => $location->getCoordinates()->getLongitude(),
        ];
    }
}