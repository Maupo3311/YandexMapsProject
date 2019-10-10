<?php

namespace App\Services;

use Onurb\Bundle\ExcelBundle\Factory\CompatibilityFactory;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ExcelService
{
    /**
     * @var string
     */
    protected $excelDir;

    /**
     * @var CompatibilityFactory
     */
    protected $factory;

    /**
     * ExcelService constructor.
     * @param string      $excelDir
     * @param CompatibilityFactory $factory
     */
    public function __construct(string $excelDir, CompatibilityFactory $factory)
    {
        $this->excelDir = $excelDir;
        $this->factory  = $factory;

//        /** @var Spreadsheet $phpExcelObject */
//        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject('uploads/excel/test.xlsx');
    }

    /**
     * @param UploadedFile $file
     * @param string       $filename
     * @return $this
     */
    public function saveFile(UploadedFile $file, string $filename)
    {
        copy($file->getPathname(), "{$this->excelDir}/{$filename}.xlsx");

        return $this;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getData()
    {
        $cadNumbers = [];
        foreach ($this->spreadsheet->getWorksheetIterator() as $worksheet) {
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

        return $cadNumbers;
    }
}