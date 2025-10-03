<?php
require_once(__DIR__ . "/_db.php");

$data = (object) $_REQUEST;
$response = (object) [];

switch ($data->action) {
  case 'save_payment':

    $data->name = ucwords($data->name);
    $arrayData = [
      'payment' => "$data->payment",
    ];

    if ($data->id > 0) {
      $arrayData['id'] = $data->id;

      // Preapara a query de fato
      $stmt = $pdo->prepare(
        "UPDATE payments SET
          payment = :payment
        WHERE id = :id"
      );

      $execute = $stmt->execute($arrayData);

      if ($execute) {
        $response->class = 'bg-gradient-success';
        $response->message = "Registro editado com sucesso!";
      } else {
        $response->class = 'bg-gradient-danger';
        $response->message = "Erro ao editar o registro!";
      }
    } else {

      $stmt = $pdo->prepare("INSERT INTO payments (payment)
      VALUES (:payment)");

      $execute = $stmt->execute($arrayData);

      if ($execute) {
        $response->class = 'bg-gradient-success';
        $response->message = "Registro criado com sucesso!";
      } else {
        $response->class = 'bg-gradient-danger';
        $response->message = "Erro ao criar o registro!";
      }
    }

    echo (json_encode($response));
    break;
  case 'list_payments':
    $query = "SELECT id, payment, status FROM payments where status = 1";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $response = [];
    foreach ($results as $key => $value) {
      $response[] = [
        'id' => $value['id'],
        'payment' => $value['payment'],
        'status' => $value['status'],
      ];
    }

    echo (json_encode($response));
    break;
  case 'delete_client':
    $arrayData = [
      'id' => "$data->id"
    ];

    $stmt = $pdo->prepare("UPDATE clients SET status = 0 WHERE id = :id");
    $execute = $stmt->execute($arrayData);

    if ($execute) {
      $response->class = 'bg-gradient-success';
      $response->message = "Registro Deletado com sucesso!";
    } else {
      $response->class = 'bg-gradient-danger';
      $response->message = "Erro ao Deletar o registro!";
    }

    echo json_encode($response);
    break;
  case 'list_client_id':

    $stmt = $pdo->prepare("SELECT * FROM clients WHERE id = $data->id");
    $stmt->execute();
    $results = $stmt->fetch();

    print_r(json_encode($results));
    break;
}
