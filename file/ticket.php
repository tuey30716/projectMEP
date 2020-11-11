<?php
require_once 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function readticketamount()
{
    $spreadsheet = new Spreadsheet();

    $inputFileType = 'Xlsx';

        $inputFileName = 'excel\ticket_amount.xlsx';

    /**  Create a new Reader of the type defined in $inputFileType  **/
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
    /**  Advise the Reader that we only want to load cell data  **/
    $reader->setReadDataOnly(true);

    $worksheetData = $reader->listWorksheetInfo($inputFileName);

    foreach ($worksheetData as $worksheet) {

    $sheetName = $worksheet['worksheetName'];
    /**  Load $inputFileName to a Spreadsheet Object  **/
    $reader->setLoadSheetsOnly($sheetName);
    $spreadsheet = $reader->load($inputFileName);

    $worksheet = $spreadsheet->getActiveSheet();
    $ticket=$worksheet->toArray();
    
    }
    return $ticket;
}

function showticket()
{
    $ticket=readticketamount();

    echo "
    |---------------------------------------------|
    |                                             |
    |                    Stage                    |
    |                                             |
    |----------------|           |----------------|
    |        A       |           |       A        |
    |----------------|-----------|----------------|
    |                    B                        |
    |---------------------------------------------|
    |                                             |
    |                    C                        |
    |                                             |
    |---------------------------------------------|
    |                                             |
    |                                             |
    |                    D                        |
    |                                             |
    |                                             |
    |---------------------------------------------| \n";

    foreach($ticket as $key=>$val){
        foreach($val as $k=>$v){
            if($val[0]==$v){
                echo str_pad($v, 10, " ", STR_PAD_LEFT);
            }
            elseif($val[1]==$v){
                echo str_pad("Price: ".number_format($v, 2, '.', ','), 17, " ", STR_PAD_LEFT);
            }
            else
            {
                echo "  Ticket quantity:".str_pad($v,5, " ", STR_PAD_LEFT);
            }
           }
           echo "\n";
    }
}

function getticketprice($zone)
{
    $spreadsheet = new Spreadsheet();

    $inputFileType = 'Xlsx';

        $inputFileName = 'excel\ticket_amount.xlsx';

    /**  Create a new Reader of the type defined in $inputFileType  **/
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
    /**  Advise the Reader that we only want to load cell data  **/
    $reader->setReadDataOnly(true);

    $worksheetData = $reader->listWorksheetInfo($inputFileName);

    foreach ($worksheetData as $worksheet) {

    $sheetName = $worksheet['worksheetName'];
    /**  Load $inputFileName to a Spreadsheet Object  **/
    $reader->setLoadSheetsOnly($sheetName);
    $spreadsheet = $reader->load($inputFileName);

    $worksheet = $spreadsheet->getActiveSheet();
    $ticket=$worksheet->toArray();
    
    }
    foreach($ticket as $key=>$val){
        foreach($val as $k=>$v){
            if(strpos($val[0], $zone) !== false){
            $ticketinfo['Zone']=$val[0];
            $ticketinfo['Price']=$val[1];
            $ticketinfo['Qty']=$val[2];
            }
        }
    }
    return $ticketinfo;
}

function configqty($zone,$oldqty,$bookqty){
    $ticket=readticketamount();
    foreach($ticket as $key=>$val){
        if(in_array($zone, $val))
        {
            $getrows= $key+1;
            break;
        }            
}
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $inputFileName = 'excel\ticket_amount.xlsx';
    $spreadsheet = $reader->load($inputFileName);
    $newqty=$oldqty-$bookqty;
    $row='C'.$getrows;
    $spreadsheet->getActiveSheet()->setCellValue($row,$newqty);

    foreach(range('A','C') as $columnID) {
        $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);    
}
    $writer = new Xlsx($spreadsheet);
    $writer->save($inputFileName);
}

?>