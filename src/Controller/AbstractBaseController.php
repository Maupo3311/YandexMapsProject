<?php

namespace App\Controller;

use App\Services\ApiRosreestrService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AbstractBaseController extends Controller
{
    /**
     * @return ApiRosreestrService
     */
    protected function getApiRosreestrService()
    {
        /** @var ApiRosreestrService $service */
        $service = $this->get('app.api_rosreestr_service');

        return $service;
    }
}