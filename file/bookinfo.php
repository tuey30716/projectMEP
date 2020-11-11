<?php 
require_once 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function getbookinfo($bookid)
{
    $spreadsheet = new Spreadsheet();

    $inputFileType = 'Xlsx';

        $inputFileName = 'excel\bookinfo.xlsx';

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
    if($bookid!=0){
    foreach($ticket as $key=>$val){

            if($val[0]==$bookid){
                echo "\n\tBooking Number :".$val[0];
                echo "\n\tTicket Zone    :".$val[1];
                echo "\n\tTicket amount  :".$val[2];
                echo "\n\tName Lastname  :".$val[3];
                echo "\n\tEmail address  :".$val[4];
                echo "\n\tPhone Number   :".$val[5];
                echo "\n\tTotal Price    :".number_format((float)$val[6], 2, '.', ',');
            break;
            }
      
    }}
    elseif($bookid==0){
        foreach($ticket as $key=>$val){
                if($key!=0){
                echo "\n\tBooking Number :".$val[0];
                echo "\n\tTicket Zone    :".$val[1];
                echo "\n\tTicket amount  :".$val[2];
                echo "\n\tName Lastname  :".$val[3];
                echo "\n\tEmail address  :".$val[4];
                echo "\n\tPhone Number   :".$val[5];
                echo "\n\tTotal Price    :".number_format((float)$val[6], 2, '.', ',');
                echo "\n";
                }
    }
    }
    
    

}

function writebookinfo($bookingnumber,$bookname,$zone,$ticketnum,$email,$phonenum,$totalprice)
{
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $inputFileName = 'excel\bookinfo.xlsx';
    $spreadsheet = $reader->load($inputFileName);

    $sheet = $spreadsheet->getActiveSheet();
    $row = $sheet->getHighestRow()+1;
    $sheet->insertNewRowBefore($row);
    $sheet->setCellValue('A'.$row, $bookingnumber);
    $sheet->setCellValue('B'.$row, $bookname);
    $sheet->setCellValue('C'.$row, $zone);
    $sheet->setCellValue('D'.$row, $ticketnum);
    $sheet->setCellValue('E'.$row, $email);
    $sheet->setCellValue('F'.$row, $phonenum);
    $sheet->setCellValue('G'.$row, $totalprice);
    foreach(range('A','G') as $columnID) {
        $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);    
    }
    $writer = new Xlsx($spreadsheet);
    $writer->save($inputFileName);
}
?>