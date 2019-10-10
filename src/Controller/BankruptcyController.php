<?php

namespace App\Controller;

use App\Form\ReadExcelType;
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
        $excelForm = $this->createForm(ReadExcelType::class, null, [
            'action' => $this->generateUrl('excel_get_data'),
        ]);

        return $this->render('bankruptcy/index.html.twig', [
            'excel_form' => $excelForm->createView(),
        ]);
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

    /**
     * @Route("/create-file-for-yandex-map", name="bankruptcy_create_file_for_yandex_map")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function createJsonFile(Request $request)
    {
        $json = $request->request->get('json');
        $file = fopen('test-file.geojson', 'w');
        fwrite($file, $json);

        return $this->json('success');
    }
}