<?php
require_once(__DIR__ . "/_db.php");

$data = (object) $_REQUEST;
$response = (object) [];

switch ($data->action) {
  case 'save_service':
    if ($data->id > 0) {

      // Decalara os Valores para usar o prepare
      $arrayData = [
        'id' => $data->id,
        'service' => "$data->service",
        'price' => "$data->price",
      ];

      // Preapara a query de fato
      $stmt = $pdo->prepare(
        "UPDATE services SET
          service = :service,
          price = :price
        WHERE id = :id"
      );

      // executa a query
      $execute = $stmt->execute($arrayData);

      if ($execute) {
        $response->class = 'bg-gradient-success';
        $response->message = "Registro editado com sucesso!";
      } else {
        $response->class = 'bg-gradient-danger';
        $response->message = "Erro ao editar o registro!";
      }
    } else {

      $arrayData = [
        'service' => "$data->service",
        'price' => "$data->price",
      ];

      $stmt = $pdo->prepare("INSERT INTO services (service,price)
      VALUES (:service, :price)");

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
  case 'list_services':
    $query = "SELECT id,service,price FROM services where status = 1";

    if ($data->service) {
      $query .= " AND service LIKE '%$data->service%'";
    }

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $list = '';

    $response = [];
    foreach ($results as $key => $value) {
      $response[] = [
        'id' => $value['id'],
        'service' => $value['service'],
        'price' => $value['price'],
      ];
    }

    echo (json_encode($response));
    break;
  case 'delete_client':
    $arrayData = [
      'id' => "$data->id"
    ];

    $stmt = $pdo->prepare("UPDATE services SET status = 0 WHERE id = :id");
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
  case 'list_user_id':

    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = $data->id");
    $stmt->execute();
    $results = $stmt->fetch();

    print_r(json_encode($results));
    break;
}
