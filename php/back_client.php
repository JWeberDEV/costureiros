<?php
require_once(__DIR__ . "/_db.php");

$data = (object) $_REQUEST;
$response = (object) [];

switch ($data->action) {
  case 'save_client':

    $data->name = ucwords($data->name);
    $arrayData = [
      'name' => "$data->name",
      'phone' => "$data->phone",
      'phoneOption' => "$data->phoneOption",
      'birthDate' => "$data->birthDate",
      'cep' => "$data->cep",
      'city' => "$data->city",
      'neigbouhod' => "$data->neigbouhod",
      'street' => "$data->street",
      'obs' => "$data->obs",
      'number' => "$data->number",
      'balance' => "$data->balance",
      'debit' => "$data->debit",
    ];

    if ($data->id > 0) {
      $arrayData['id'] = $data->id;

      // Preapara a query de fato
      $stmt = $pdo->prepare(
        "UPDATE clients SET
          name = :name,
          phone = :phone,
          phoneOption = :phoneOption,
          birthDate = :birthDate,
          cep = :cep,
          city = :city,
          neigbouhod = :neigbouhod,
          street = :street,
          obs = :obs,
          number = :number,
          balance = :balance,
          debit = :debit
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

      $stmt = $pdo->prepare("INSERT INTO clients (name,phone,phoneOption,birthDate,cep,city,neigbouhod,street,obs,number,balance,debit)
      VALUES (:name, :phone, :phoneOption, :birthDate,:cep, :city, :neigbouhod, :street, :obs, :number, :debit, :debit)");

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
  case 'list_clients':
    $query = "SELECT id,name,phone,street,number,obs FROM clients where status = 1";

    if ($data->client) {
      $query .= " AND `name` LIKE '%$data->client%'";
    }
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $list = '';
    $response = [];
    foreach ($results as $key => $value) {
      $response[] = [
        'id' => $value['id'],
        'name' => $value['name'],
        'phone' => $value['phone'],
        'street' => $value['street'],
        'number' => $value['number'],
        'obs' => $value['obs'],
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
  case 'check_new_births':
    $stmt = $pdo->prepare("SELECT COUNT(id) as count FROM clients WHERE MONTH(birthDate) = MONTH(NOW()) AND DAY(birthDate) = DAY(NOW())");
    $stmt->execute() or die("Failed to execute");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC) or die("Failed to fetch");

    $response = [];
    foreach ($results as $key => $value) {
      $response[] = [
        'count' => $value['count'],
      ];
    }

    echo (json_encode($response));
    break;
  case 'get_name_births':
  $stmt = $pdo->prepare("SELECT name FROM clients WHERE MONTH(birthDate) = MONTH(NOW()) AND DAY(birthDate) = DAY(NOW())");
  $stmt->execute() or die("Failed to execute");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC) or die("Failed to fetch");

  $response = [];
  foreach ($results as $key => $value) {
    $response[] = [
      'name' => $value['name'],
    ];
  }

  echo (json_encode($response));
  break;
}
