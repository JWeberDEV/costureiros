<?php
require_once(__DIR__ . '/../assets/libs/tecnickcom/tcpdf/tcpdf.php');
require_once(__DIR__ . "/_db.php");

$data = (object) $_REQUEST;

$pdf = new TCPDF();

$pdf->SetCreator('Vitor');
$pdf->SetAuthor('Vitor');
$pdf->SetTitle('Ordem de serviço');
$pdf->AddPage();

$pdf->Ln(20);

$pdf->Cell(0, 10, "Cliente: $data->name  Entrada: $data->entry Saida: $data->exit", 0, 1, 'C');

$pdf->SetFont('helvetica', '', 10);
$table = '<table border="0" cellpadding="1" cellspacing="0" style="width: 100%; border-collapse: collapse;">
  <thead>
    <tr style="background-color:rgb(221, 238, 124); font-weight: bold;">
      <th style="padding: 8px;">OS</th>
      <th style="padding: 8px;">serviço</th>
      <th style="padding: 8px;">observação</th>
      <th style="padding: 8px; text-align: right;">preço</th>
      <th style="padding: 8px; text-align: right;">desconto</th>
    </tr>
  </thead>
  <tbody>';

$query = "SELECT
  so.serviceorder,
  so.incoming,
  so.total,
  so.remainder,
  s.service,
  o.obs,
  o.price,
  o.discount
  FROM serviceorders so
  JOIN orders o ON o.idserviceorders = so.id
  JOIN services s ON s.id = o.idservice
  WHERE so.id = $data->id
";

$stmt = $pdo->prepare($query);
$stmt->execute() or die("Failed to execute");

$data = [];

if ($stmt->rowCount() > 0) {
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $data[] = [
      $row['serviceorder'],
      $row['service'],
      $row['obs'],
      (float)$row['price'],
      (float)$row['discount'],
      $row['incoming'],
      $row['total'],
      $row['remainder'],
    ];
  }
}

$rowIndex = 0;
$incoming = 0;
$total = 0;
$remainder = 0;

foreach ($data as $row) {
  $backgroundColor = ($rowIndex % 2 === 0) ? '#ffffff' : '#eff2d6';

  $table .= '<tr style="background-color: ' . $backgroundColor . ';">';

  foreach ($row as $key => $cell) {
    if ($key > 4) {
      continue;
    }

    if ($key > 2) {
      $table .= '<td style="padding: 2px; text-align: right;">' . htmlspecialchars($cell) . '</td>';
    } else {
      $table .= '<td style="padding: 2px;">' . htmlspecialchars($cell) . '</td>';
    }

  }
  
  $table .= '</tr>';
  $rowIndex++;
  $incoming = $row[5];
  $total = $row[6];
  $remainder = $row[7];
}

$table .= '
  <tr style="background-color:#e5e5e5;">
    <td style="padding: 8px;"><strong>Entrada:</strong> <strong> R$: ' . number_format($incoming, 2, '.', ',') . '</strong></td>
    <td style="padding: 8px;"><strong>Em a ver:</strong> <strong> R$: ' . number_format($remainder, 2, '.', ',') . '</strong></td>
    <td style="padding: 8px;"></td>
    <td style="padding: 8px;"></td>
    <td style="padding: 8px; text-align: right;"><strong>Total</strong><strong> R$: ' . number_format($total, 2, '.', ',') . '</strong></td>
  </tr>
';

$table .= '</tbody></table>';

$pdf->writeHTML($table);

$pdf->Output('Relatorio.pdf', 'I');
