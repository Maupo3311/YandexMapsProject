<?php

namespace App\Controller;

use App\Services\GoogleMapsService;
use Geocoder\Provider\GoogleMaps\Model\GoogleAddress;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Geocoder\Exception\Exception;

/**
 * Class ImportController
 * @package App\Controller
 * @Route("/import", options={"expose"=true})
 */
class ImportController extends Controller
{
    /**
     * @Route("/geoJson", name="import_geoJson")
     * @param Request $request Request.
     * @return JsonResponse
     * @throws Exception If Error.
     */
    public function geoJson(Request $request)
    {
        /** @var GoogleMapsService $googleMapsService */
        $googleMapsService = $this->get('app.google_maps_service');

        $address = 'пр. Академика Коптюга, 3, Новосибирск';
        /** @var GoogleAddress $location */
        $location = $googleMapsService->getLocation($address);

        return $this->json([
            'status' => 'success',
            'code'   => 200,
            'lat'    => $location->getCoordinates()->getLatitude(),
            'lon'    => $location->getCoordinates()->getLongitude(),
        ]);
    }
}