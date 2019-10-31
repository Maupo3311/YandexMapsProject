<?php

namespace App\Controller;

use App\Form\ReadExcelType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BankruptcyController
 * @package App\Controller
 * @Route("/cad-nubmer", options={"expose"=true})
 */
class CadNumberController extends AbstractBaseController
{
    /**
     * @Route("/", name="cad_number_index")
     * @return Response
     */
    public function indexAction()
    {
        $excelForm = $this->createForm(ReadExcelType::class, null, [
            'action' => $this->generateUrl('excel_get_data'),
        ]);

        return $this->render('cadNumber/index.html.twig', [
            'excel_form' => $excelForm->createView(),
        ]);
    }

    /**
     * @Route("/get-data-by-cad-numbers", name="get_data_by_cad_numbers")
     * @param Request $request Request.
     * @return JsonResponse
     */
    public function getAddressByCadNumbers(Request $request)
    {
        $cadNumbers = json_decode($request->get('cadNumbers'));
        $data  = $this->getApiRosreestrService()->getDataByCadNumbers($cadNumbers);

        return $this->json([
            'status' => 'success',
            'data'   => $data,
        ]);
    }
}
