<?php

namespace App\Controller;

use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     * @Route("/get-data", name="exel_get_data")
     * @return Response
     * @throws Exception
     */
    public function getData()
    {
        /** @var Spreadsheet $phpExcelObject */
        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject('uploads/excel/test.xlsx');

        $cadNumbers = [];
        foreach ($phpExcelObject->getWorksheetIterator() as $worksheet) {
            foreach ($worksheet->getRowIterator() as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
                foreach ($cellIterator as $cell) {
                    if (!is_null($cell)) {
                        $coordinate = $cell->getCoordinate();
                        $value      = $cell->getCalculatedValue();

                        if (preg_match("#B#", $coordinate)) {
                            if (preg_match("#^.+\№(.+)$#", $value)) {
                                $cadNumbers[] = preg_replace("#^.+№(.+)$#",'$1', $value);
                            }
                        }
                    }
                }
            }
        }

        return $this->json($cadNumbers);
    }
}