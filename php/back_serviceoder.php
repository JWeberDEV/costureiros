<?php
require_once(__DIR__ . "/_db.php");

$data = (object) $_REQUEST;
$response = (object) [];

switch ($data->action) {
  case 'save_orderservice':
    if ($data->id > 0) {

      // Decalara os Valores para usar o prepare
      $arrayData = [
        'ticket' => $data->ticket,
        'entry' => "$data->entry",
        'out' => "$data->out",
        'client' => "$data->client",
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
      $entry = date_create($string);
      $entry = date_format($entry, "Y/m/d H:i:s");
      $out = date_create($string);
      $out = date_format($out, "Y/m/d H:i:s");
      
      $arrayData = [
        'client' => $data->client,
        'ticket' => $data->ticket,
        'entry' => "$entry",
        'out' => "$out",
      ];

      $stmt = $pdo->prepare("INSERT INTO serviceorders (idclient,ticket,entry,out)
      VALUES (:client, :ticket, :entry, :out)");

      $execute = $stmt->execute($arrayData);
      $lastInsertId = $pdo->lastInsertId();

      if ($execute) {
        $services = "";

        foreach ($data->data as $key => $value) {
          $stmt = "INSERT INTO orders (idserviceorders,idservice,price,discount,obs)
          VALUES ($lastInsertId,$value[service],$value[price],$value[price],$value[discount],$value[obs],)";

          $services = $stmt->execute($arrayData);
        }

        if ($services) {
          $response->class = 'bg-gradient-success';
          $response->message = "Registro criado com sucesso!";
        }
      } else {
        $response->class = 'bg-gradient-danger';
        $response->message = "Erro ao criar o registro!";
      }
    }

    echo (json_encode($response));
    break;
  case 'list_clients':
    $stmt = $pdo->prepare("SELECT id,service,price FROM services where status = 1");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $list = '';
    foreach ($results as $key => $value) {
      print_r($value);
      if ($value) {
        $list .= "<tr>
            <td>
              <div class='d-flex px-2 py-1'>
                <div class='d-flex flex-column justify-content-center'>
                  <h6 class='mb-0 text-sm'>" . $value['service'] . "</h6>
                </div>
              </div>
            </td>
            <td class='align-middle text-center'>
              <div class='d-flex px-2 py-1'>
                <div class='d-flex flex-column justify-content-center'>
                  <h6 class='mb-0 text-sm'>" . $value['price'] . "</h6>
                </div>
              </div>
            </td>
            <td class='text-end'>
              <a type='button' class='btn bg-gradient-warning m-0' data-toggle='tooltip' title='Editar' href=\"../pages/newservice.php?id='" . $value['id'] . "'\">
                <i class='material-symbols-rounded opacity-5'>edit</i>
              </a>
              <button type='button' class='btn bg-gradient-danger m-0' data-toggle='tooltip' data-placement='top' title='Excluir' onclick=\"deleteService('" . $value['id'] . "')\">
                <i class='material-symbols-rounded opacity-5'>delete</i>
              </button>
            </td>
          </tr>
        ";
      } else {
        $list =
          "<tr>
            <td style='padding:10px;' colspan='8'>
              <a href='#' style='color:#ED6663;font-style:italic;'><i class='fas fa-info-circle'></i> Nenhum registro encontrado!</a>
            </td>
          </tr>
        ";
      }
    }

    echo $list;
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
  case 'load_clients':
    // prepara a query que lista os eventos que são vinculados pelo usuário
    $stmt = $pdo->prepare("SELECT c.id, c.name
      FROM clients c
      ORDER BY c.name
    ");
    // executa a query
    $stmt->execute() or die("Failed to execute");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC) or die("Failed to fetch");

    $response = [];
    foreach ($results as $key => $value) {
      $response[] = [
        'id' => $value['id'],
        'name' => $value['name'],
      ];
    }

    echo (json_encode($response));
    break;
  case 'load_services':
    // prepara a query que lista os eventos que são vinculados pelo usuário
    $stmt = $pdo->prepare("SELECT s.id, s.service, s.price
        FROM services s
        ORDER BY s.service
      ");
    // executa a query
    $stmt->execute() or die("Failed to execute");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC) or die("Failed to fetch");

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
}
