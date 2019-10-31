<?php

namespace App\Controller;

use App\Form\ExcelType;
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
 * @Route("/excel", options={"expose"=true})
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

    /**
     * @Route("/get-list", name = "excel_get_list")
     * @return Response
     */
    public function getHtmlFileList()
    {
        $fileList = $this->getExcelService()->getFileList();

        return $this->render('excel/file_list.html.twig', [
            'files' => $fileList,
        ]);
    }

    /**
     * @Route("/get-form", name = "excel_get_form")
     * @return Response
     */
    public function getHtmlForm()
    {
        $excelForm = $this->createForm(ExcelType::class, null, [
            'action' => $this->generateUrl('excel_save_file'),
        ]);

        return $this->render('excel/form.html.twig', [
            'excel_form' => $excelForm->createView(),
        ]);
    }

    /**
     * @Route("/get-data", name="excel_get_data")
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function getDataHtml(Request $request)
    {
        $selectedFile = $request->query->get('selectedFile');
        $data         = $this->getExcelService()->getData($selectedFile);

        $html = $this->render('cadNumber/cad_numbers.html.twig', [
            'cad_numbers' => $data,
        ]);

        return $this->json([
            'status' => 'success',
            'html'   => $html,
            'data'   => $data,
        ]);
    }

    /***************************************************************************************
     *                                Protected methods
     **************************************************************************************/

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