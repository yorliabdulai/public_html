<?php 
include ("../connection/conn.php");

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Writer\Xls;
    use PhpOffice\PhpSpreadsheet\Writer\Csv;

    if (isset($_POST['attendee_submit'])) {
        // code...
        $from = sanitize($_POST['from']);
        $data = sanitize($_POST['data']);
        $type = sanitize($_POST['type']);

        if ($from == 'attendee') {
            // code...
            $FileExtType = $type;
            $fileName = "ABS-23-" . $data . "-Attendee-Sheet";

            $query = "SELECT * FROM abs_registration WHERE registration_reference = '" . $data . "'";
            if ($data == 'All') {
                $query = "SELECT * FROM abs_registration";
                // code...
            }
            $statement = $conn->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            $count_row = $statement->fetchAll();

            if ($count_row > 0) {
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();

                // Header
                $sheet->setCellValue('A1', 'ID');
                $sheet->setCellValue('B1', 'Named');
                $sheet->setCellValue('C1', 'Email');
                $sheet->setCellValue('D1', 'Phone');
                $sheet->setCellValue('E1', 'Region');
                $sheet->setCellValue('F1', 'Reference');
                $sheet->setCellValue('G1', 'Date');

                $rowCount = 2;
                foreach ($rows as $row) {
                    $sheet->setCellValue('A' . $rowCount, $row['registration_identity']);
                    $sheet->setCellValue('B' . $rowCount, ucwords($row['registration_full_name']));
                    $sheet->setCellValue('C' . $rowCount, $row['registration_email']);
                    $sheet->setCellValue('D' . $rowCount, $row['registration_phone']);
                    $sheet->setCellValue('E' . $rowCount, ucwords($row['registration_region']));
                    $sheet->setCellValue('F' . $rowCount, ucwords($row['registration_reference']));
                    $sheet->setCellValue('G' . $rowCount, pretty_date($row['registration_date']));
                    $rowCount++;
                }

                if ($FileExtType == 'xlsx') {
                    $writer = new Xlsx($spreadsheet);
                    $NewFileName = $fileName . '.xlsx';
                } elseif($FileExtType == 'xls') {
                    $writer = new Xls($spreadsheet);
                    $NewFileName = $fileName . '.xls';
                } elseif($FileExtType == 'csv') {
                    $writer = new Csv($spreadsheet);
                    $NewFileName = $fileName . '.csv';
                }

                // $writer->save($NewFileName);
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attactment; filename="' . urlencode($NewFileName) . '"');
                $writer->save('php://output');
                // redirect(PROOT . 'bfca@min/attendees');

            } else {
                $_SESSION['flash_error'] = "No Record Found";
                redirect(PROOT . 'bfca@min/attendees');
            }
        }
    }
    


    
