<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller
 * @Route("/")
 */
class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage", methods={"POST"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showHomePageAction()
    {
        return $this->render('home/index.html.twig');
    }
}