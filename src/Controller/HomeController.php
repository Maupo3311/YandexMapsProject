<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller
 * @Route("/", options={"expose"=true})
 */
class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function showHomePageAction()
    {
        return $this->render('home/index.html.twig');
    }
}