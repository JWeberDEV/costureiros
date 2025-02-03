<?php
require_once(__DIR__ . '/../assets/libs/tecnickcom/tcpdf/tcpdf.php');
require_once(__DIR__ . "/_db.php");

$data = (object) $_REQUEST;
$data->entry = date_format(new DateTime($data->entry), 'd/m/Y');
$data->exit = date_format(new DateTime($data->exit), 'd/m/Y');
$pdf = new TCPDF();

$pdf->SetCreator('Vitor');
$pdf->SetAuthor('Vitor');
$pdf->SetTitle('Ordem de serviço');
$pdf->AddPage();

$pdf->Ln(20);

$pdf->Cell(0, 10, "Cliente: $data->name  Entrada: $data->entry Saida: $data->exit", 0, 1, 'C');
$pdf->SetFont('helvetica', '', 10);
$top = __DIR__ . '/../assets/img/walpaper.png';
$bottom = __DIR__ . '/../assets/img/chave.jpg';

// Position at (X = 15mm, Y = 140mm), width = 50mm, height = auto
$pdf->Image($top, 10, 11, 25, 0, 'PNG', '', '', false, 300, '', false, false, 0, false, false, false);
$pdf->Image($bottom, 10, 150, 35, 0, 'JPG', '', '', false, 300, '', false, false, 0, false, false, false);

$table = '
  <table border="0" cellpadding="1" cellspacing="0" style="width: 100%; border-collapse: collapse;">
    <thead>
      <tr style="background-color:#aeabab; font-weight: bold;">
        <th style="padding: 8px;">OS</th>
        <th style="padding: 8px;">Item</th>
        <th style="padding: 8px;">Serviço</th>
        <th style="padding: 8px;">Observação</th>
        <th style="padding: 8px; text-align: right;">Preço</th>
        <th style="padding: 8px; text-align: right;">Desconto</th>
      </tr>
    </thead>
  <tbody>';

$query = "SELECT
  so.serviceorder,
  so.incoming,
  so.total,
  so.remainder,
  s.service,
  o.item,
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
      $row['item'],
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
  $backgroundColor = ($rowIndex % 2 === 0) ? '#ffffff' : '#e5e5e5';

  $table .= '<tr style="background-color: ' . $backgroundColor . ';">';

  foreach ($row as $key => $cell) {
    if ($key > 5) {
      continue;
    }

    if ($key > 3) {
      $table .= '<td style="padding: 2px; text-align: right;">R$: ' . htmlspecialchars($cell) . '</td>';
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
  <tr style="background-color:#aeabab;"> 
    <td style="padding: 8px;"><strong>Entrada:</strong> <strong> R$: ' . number_format($incoming, 2, '.', ',') . '</strong></td>
    <td style="padding: 8px;"><strong>Em a ver:</strong> <strong> R$: ' . number_format($remainder, 2, '.', ',') . '</strong></td>
    <td style="padding: 8px;"></td>
    <td style="padding: 8px;"></td>
    <td style="padding: 8px;"></td>
    <td style="padding: 8px; text-align: right;"><strong>Total</strong><strong> R$: ' . number_format($total, 2, '.', ',') . '</strong></td>
  </tr>
';
// Roupas não retiradas até 60 dias após as data de entrega, serão encaminhadas para doação.
$table .= '</tbody></table>
  <br>
  <div style="background-color:#2e2d2d;">
    <p><strong style="color:#fff; font-size:20px; text-align: center;">Roupas não retiradas até 60 dias 
      após a data de entrega, serão encaminhadas para doação.
    </strong></p>
  </div>
  <br>
  <div style="margin-top:0px;">
    <p><strong style=" font-size:20px; text-align: center;">
      Email: costureiros.nh@gmail.com
    </strong></p>
  </div>
';

$pdf->writeHTML($table);

$pdf->Output('Ordem de Serviço.pdf', 'I');
