<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$folder="upload/";
if($_GET['q']==1)
{
    $f=rand(1000,9999).rand(1000,9999).rand(1000,9999).".xml";
    try{

        // upload file
        move_uploaded_file($_FILES['file1']['tmp_name'],$folder.$f);

        

            // Load XML file
            $xml = simplexml_load_file($folder.$f);

            // New excel object
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

           // find elemets
            if ($xml->count() > 0) {
               
                $firstElement = $xml->children()[0];
                $column = 'A';
                $headers = [];

                // set headers
                foreach ($firstElement->children() as $key => $value) {
                    $sheet->setCellValue($column . '1', $key);
                    $headers[$key] = $column;
                    $column++;
                }

               // create rows
                $row = 2;
                foreach ($xml->children() as $element) {
                    foreach ($headers as $key => $column) {
                        $sheet->setCellValue($column . $row, (string)$element->$key);
                    }
                    $row++;
                }

                //save excel file
                $writer = new Xlsx($spreadsheet);
                $writer->save($folder.$f.".xlsx");
                unlink($folder.$f);
                echo $folder.$f.".xlsx";
            } else {
                echo 0;
            }


       
    }
    catch(Exception $e)
    {
        echo 0;
    }


}

