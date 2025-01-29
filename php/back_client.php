<?php
require_once(__DIR__ . "/_db.php");

$data = (object) $_REQUEST;
$response = (object) [];

switch ($data->action) {
  case 'save_client':
    if ($data->id > 0) {

      // Decalara os Valores para usar o prepare
      $arrayData = [
        'id' => $data->id,
        'name' => "$data->name",
        'phone' => "$data->phone",
        'phoneOption' => "$data->phoneOption",
        'cep' => "$data->cep",
        'city' => "$data->city",
        'neigbouhod' => "$data->neigbouhod",
        'street' => "$data->street",
        'obs' => "$data->obs",
        'number' => "$data->number",
      ];

      // Preapara a query de fato
      $stmt = $pdo->prepare(
        "UPDATE clients SET
          name = :name,
          phone = :phone,
          phoneOption = :phoneOption,
          cep = :cep,
          city = :city,
          neigbouhod = :neigbouhod,
          street = :street,
          obs = :obs,
          number = :number
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
        'name' => "$data->name",
        'phone' => "$data->phone",
        'phoneOption' => "$data->phoneOption",
        'cep' => $data->cep,
        'city' => "$data->city",
        'neigbouhod' => "$data->neigbouhod",
        'street' => "$data->street",
        'obs' => "$data->obs",
        'number' => "$data->number",
      ];

      $stmt = $pdo->prepare("INSERT INTO clients (name,phone,phoneOption,cep,city,neigbouhod,street,obs,number)
      VALUES (:name, :phone, :phoneOption,:cep, :city, :neigbouhod, :street, :obs, :number)");

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
  case 'list_user_id':

    $stmt = $pdo->prepare("SELECT * FROM clients WHERE id = $data->id");
    $stmt->execute();
    $results = $stmt->fetch();

    print_r(json_encode($results));
    break;
}
