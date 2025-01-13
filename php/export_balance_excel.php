<?php

set_time_limit(0);
ini_set('mysql.connect_timeout', '0');
ini_set('max_execution_time', '0');
ini_set('default_charset', 'UTF-8');
ini_set('memory_limit', '3072M');
error_reporting(E_ALL);

require_once(__DIR__ . "/../php/_db.php");
require(__DIR__ . '/../vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\style\Alignment;

$data = (object) $_REQUEST;
$incoming = 0;
$remainder = 0;
$total = 0;

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();

$spreadsheet->getDefaultStyle()
  ->getNumberFormat()
  ->setFormatCode(
    PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT
  );

$header = [
  "Nome",
  "Ordem de serviço",
  "Entrada",
  "Em a ver",
  "Total",
  "Data de Entrada",
  "Data de Saida",
];

$row = 1;
$col = 1;

// Loop through the header
foreach ($header as $key => $columnName) {
  // Convert the column index to a letter (A, B, etc.)
  $cell = Coordinate::stringFromColumnIndex($col) . $row;
  // Set the value in the cell
  $sheet->setCellValue($cell, $columnName);
  $col++;
}

// Auto size columns for the range of the header
foreach (range(1, count($header)) as $column) {
  // Use stringFromColumnIndex to get the letter representation
  $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($column))->setAutoSize(true);
}

// Apply bold style to the header range
$sheet->getStyle('A1:' . Coordinate::stringFromColumnIndex(count($header)) . '1')
  ->applyFromArray(
    [
      'font' => [
        'bold' => true
      ]
    ]
  );

$query = "SELECT 
      s.serviceorder,
      s.incoming,
      s.total,
      s.remainder,
      s.sevicentry,
      s.servicexit,
      c.name
    FROM serviceorders s
    JOIN clients c ON c.id = s.idclient
    WHERE s.`status` = 1";

if ($data->client) {
  $query .= " AND c.id = $data->client";
}

if ($data->entry != 0) {
  $entry = date_create($data->entry);
  $entry = date_format($entry, "Y-m-d H:i:s");
  $query .= " AND s.sevicentry >= '$entry'";
}

if ($data->exit != 0) {
  $out = date_create($data->exit);
  $out = date_format($out, "Y-m-d H:i:s");
  $query .= " AND s.servicexit >= '$out'";
}

$query .= " ORDER BY s.id";

$stmt = $pdo->prepare($query);
$stmt->execute() or die("Failed to execute");

$resultData = [];

$row = 2;

if ($stmt->rowCount() > 0) {

  while ($return = $stmt->fetch(PDO::FETCH_OBJ)) {

    $col = 1;

    $resultData = [
      $return->name,
      $return->serviceorder,
      $return->incoming,
      $return->remainder,
      $return->total,
      $return->sevicentry,
      $return->servicexit,
    ];

    foreach ($resultData as $key => $data) {

      $cell = Coordinate::stringFromColumnIndex($col) . $row;
      $sheet->setCellValue($cell, $data);
      $col++;
    }

    $incoming += $return->incoming;
    $remainder += $return->remainder;
    $total += $return->total;

    $row++;
  }
}

// Calculo de cada coluna
$sheet->setCellValue('A' . $row, 'Saldo:');
$sheet->setCellValue('B' . $row, $incoming);
$sheet->setCellValue('C' . $row, 'Em a Ver:');
$sheet->setCellValue('D' . $row, $remainder);
$sheet->setCellValue('E' . $row, 'Total:');
$sheet->setCellValue('F' . $row, $total);
$sheet->getStyle('A' . $row)->getFont()->setBold(true);
$sheet->getStyle('C' . $row)->getFont()->setBold(true);
$sheet->getStyle('E' . $row)->getFont()->setBold(true);

// Estilização
// $sheet->getStyle('D' . $row . ':F' . $row)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
// $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray([
//   'font' => [
//     'bold' => true,
//   ],
//   'alignment' => [
//     'horizontal' => Alignment::HORIZONTAL_RIGHT,
//   ],
// ]);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Balanço.xlsx"');
header('Cache-Control: max-age=0');

$sheet->setTitle("Balanço");
$writer = new Xlsx($spreadsheet);
ob_end_clean();
$writer->save('php://output');
