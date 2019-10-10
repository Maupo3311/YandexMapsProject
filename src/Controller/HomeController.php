<?php

namespace App\Controller;

use App\Form\ExcelType;
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
     * @Route("/", name="homepage")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showHomePageAction()
    {
        return $this->render('home/index.html.twig');
    }

//    /**
//     * @Route("/test", name="test")
//     */
//    public function testAction()
//    {
//         $array[$key]
//         echo($контент)
//         for (переменная = чему то; условие; действие после повторения цикла) {}
//         if (true) { action }
//         1 > 0 === true
//         0 > 1 === false
//         $string[$numberChar]
//         $name[0][0];
//         $var += $amount
//         15 += 5 === 20
//
//
//
//        $numbers = [15, 29, 1234, 566, 234, 123456];
//        $amount = 1;
//        for ($x = 0; $x < count($numbers); ++$x) {
//            $amount *= $numbers[$x];
//        }
//        echo ($amount);
//
//
//        die();
//    }
}