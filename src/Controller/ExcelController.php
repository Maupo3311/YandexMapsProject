<?php

namespace App\Controller;

use App\Services\ExcelService;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ExcelController
 * @package App\Controller
 * @Route("/excel")
 */
class ExcelController extends Controller
{
    /**
     * @Route("/save-file", name="excel_save_file")
     * @param Request $request
     * @return JsonResponse
     */
    public function saveFile(Request $request)
    {
        $filename = $request->request->get('excel')['filename'];
        $file     = $request->files->get('excel')['file'];
        $this->getExcelService()->saveFile($file, $filename);

        return $this->json([
            'type'    => 'success',
            'message' => "File with name {$filename} successful saved!",
        ]);
    }

//    /**
//     * @Route("/get-data", name="excel_get_data")
//     * @return Response
//     * @throws Exception If error.
//     */
//    public function getData()
//    {
//    }

    /************************************************************************************************
     *                                Protected methods
     ************************************************************************************************/

    /**
     * @return ExcelService
     */
    protected function getExcelService()
    {
        /** @var ExcelService $service */
        $service = $this->get('app.excel_service');

        return $service;
    }
}