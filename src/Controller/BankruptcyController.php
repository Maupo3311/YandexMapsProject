<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BankruptcyController
 * @package App\Controller
 * @Route("/bankruptcy")
 */
class BankruptcyController extends Controller
{
    /**
     * @Route("/", name="bankruptcy")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('bankruptcy/index.html.twig');
    }

    /**
     * @Route("/create-object-on-yandex-map", name="bankruptcy_create_object_on_yandex_map")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function createObject(Request $request)
    {
        $cadNumber = $request->request->get('cadNumber');
        $response  = file_get_contents('');

        return $this->json('test-data', 200);
    }
}