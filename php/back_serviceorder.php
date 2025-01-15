<?php
require_once(__DIR__ . "/_db.php");

$data = (object) $_REQUEST;
$response = (object) [];

switch ($data->action) {
  case 'save_orderservice':
    $entry = date_create($data->entry);
    $entry = date_format($entry, "Y-m-d H:i:s");
    $out = date_create($data->exit);
    $out = date_format($out, "Y-m-d H:i:s");

    if ($data->id > 0) {

      // Decalara os Valores para usar o prepare
      $arrayData = [
        'id' => $data->id,
        'idclient' => $data->client,
        'incoming' => "$data->incoming",
        'total' => "$data->total",
        'remainder' => $data->remainder,
        'sevicentry' => $entry,
        'servicexit' => $out,
      ];

      $stmt = $pdo->prepare(
        "UPDATE serviceorders SET
          idclient = :idclient,
          incoming = :incoming,
          total = :total,
          remainder = :remainder,
          sevicentry = :sevicentry,
          servicexit = :servicexit
        WHERE id = :id"
      );

      $execute = $stmt->execute($arrayData);

      if ($execute) {
        foreach ($data->data as $key => $value) {

          $stmt = $pdo->prepare(
            "UPDATE orders SET
                idservice = '{$value['idService']}',
                price = '{$value['price']}',
                discount = '{$value['discount']}',
                obs = '{$value['obs']}'
              WHERE id = {$value['order']}"
          );

          $update = $stmt->execute($arrayData);
        }


        if ($update) {
          $response->class = 'bg-gradient-success';
          $response->message = "Registro editado com sucesso!";
        } else {
          $response->class = 'bg-gradient-danger';
          $response->message = "Erro ao editar o registro!";
        }
      }
    } else {

      $stmt = $pdo->prepare("INSERT INTO serviceorders (serviceorder,idclient,ticket,incoming,total,remainder,sevicentry,servicexit)
      SELECT IFNULL(MAX(serviceorder), 0) + 1, $data->client, $data->ticket, $data->incoming, $data->total, $data->remainder, '$entry', '$out' FROM serviceorders WHERE `status` = 1");

      $execute = $stmt->execute();
      $lastInsertId = $pdo->lastInsertId();

      if ($execute) {
        $services = "";

        foreach ($data->data as $key => $value) {
          $stmt = $pdo->prepare("INSERT INTO orders (idserviceorders, idservice, price, discount, obs)
          VALUES($lastInsertId, {$value['idservice']}, {$value['price']}, {$value['discount']}, '{$value['obs']}')");

          $services = $stmt->execute([]);
        }

        if ($services) {
          $response->class = 'bg-gradient-success';
          $response->message = "Ordem de Serviço criado com sucesso!";
        }
      } else {
        $response->class = 'bg-gradient-danger';
        $response->message = "Erro ao criar a Ordem de Serviço!";
      }
    }

    echo (json_encode($response));
    break;
  case 'list_serviceorders':
    $entry = date_create($data->entry);
    $entry = date_format($entry, "Y-m-d H:i:s");
    $out = date_create($data->exit);
    $out = date_format($out, "Y-m-d H:i:s");

    $query = "SELECT 
        s.id,
        s.serviceorder,
        s.ticket,
        s.total,
        s.servicestatus,
        c.name
      FROM serviceorders s
      JOIN clients c ON c.id = s.idclient
      WHERE s.`status` = 1";

    if ($data->client) {
      $query .= " AND c.id = $data->client";
    }

    if ($data->entry) {
      $query .= " AND s.sevicentry >= '$entry'";
    }

    if ($data->exit) {
      $query .= " AND s.servicexit <= '$out'";
    }

    $query .= " ORDER BY s.id";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $list = '';
    $total = 0;
    foreach ($results as $key => $value) {
      if ($value) {
        $list .= "<tr>
            <td class='ps-4' style='width: 10px'>
              <i class='fa-solid fa-circle " . ($value['servicestatus'] == 1 ? 'text-success' : 'text-warning') . "' data-bs-toggle='tooltip' data-bs-placement='bottom' title='" . ($value['servicestatus'] == 1 ? 'OS Encerrada' : 'OS Em andamento') . "'></i>
            </td>
            <td class='ps-3'>
              <div class='d-flex px-2 py-1'>
                <div class='d-flex flex-column justify-content-center'>
                  <h6 class='mb-0 text-sm'>" . $value['serviceorder'] . "</h6>
                </div>
              </div>
            </td>
            <td class='ps-0'>
              <div class='d-flex px-2 py-1'>
                <div class='d-flex flex-column justify-content-center'>
                  <h6 class='mb-0 text-sm'>" . $value['name'] . "</h6>
                </div>
              </div>
            </td>
            <td cclass='ps-3'>
              <div class='d-flex px-2 py-1'>
                <div class='d-flex flex-column justify-content-center'>
                  <h6 class='mb-0 text-sm'>" . $value['ticket'] . "</h6>
                </div>
              </div>
            </td>
            <td class='text-end'>
              <a type='button' class='btn bg-gradient-warning m-0' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Editar' href=\"../pages/newserviceorder.php?id='" . $value['id'] . "'\">
                <i class='material-symbols-rounded opacity-5'>edit</i>
              </a>
              <button type='button' class='btn bg-gradient-danger m-0' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Excluir' onclick=\"deleteServiceOrder('" . $value['id'] . "')\">
                <i class='material-symbols-rounded opacity-5'>delete</i>
              </button>
            </td>
          </tr>
        ";
        $total += $value['total'];
      }

      if (empty($results)) {
        $list = "
            <tr>
                <td style='padding:10px;' colspan='8'>
                    <a href='#' style='color:#ED6663;font-style:italic;'><i class='fas fa-info-circle'></i> Nenhum registro encontrado!</a>
                </td>
            </tr>
        ";
      }
    }

    echo "<input type='hidden' id='sumTotal' value='" . $total . "'>";
    echo $list;
    break;
  case 'delete_serviceorder':
    $arrayData = [
      'id' => "$data->id"
    ];

    $stmt = $pdo->prepare("UPDATE serviceorders SET status = 0 WHERE id = :id");
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
  case 'list_serviceorder_id':
    $stmt = $pdo->prepare(
      "SELECT 
        so.serviceorder,
        so.ticket,
        so.idclient,
        so.sevicentry,
	      so.servicexit,
        so.incoming,
        so.total,
        so.remainder,
        so.servicestatus,
        o.id AS 'idorder',
        o.idserviceorders,
        o.idservice,
        o.price,
        o.discount,
        o.obs,
        (SELECT `name`FROM clients WHERE id = so.idclient) AS 'name',
        s.service
      FROM serviceorders so
      JOIN orders o ON o.idserviceorders = so.id
      JOIN services s ON s.id = o.idservice
      WHERE so.id = $data->id"
    );

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC) or die("Failed to fetch");

    $response = [];
    foreach ($results as $key => $value) {
      $response[] = [
        'serviceorder' => (int) $value['serviceorder'],
        'ticket' => (int) $value['ticket'],
        'idclient' => (int) $value['idclient'],
        'sevicentry' => $value['sevicentry'],
        'servicexit' => $value['servicexit'],
        'incoming' => $value['incoming'],
        'total' => $value['total'],
        'remainder' => $value['remainder'],
        'idorder' => (int) $value['idorder'],
        'idserviceorders' => (int) $value['idserviceorders'],
        'idservice' => (int) $value['idservice'],
        'price' => (int) $value['price'],
        'discount' => (int) $value['discount'],
        'obs' => $value['obs'],
        'service' => $value['service'],
        'name' => $value['name'],
        'servicestatus' => $value['servicestatus'],
      ];
    }

    echo (json_encode($response));
    break;
  case 'load_clients':
    // prepara a query que lista os eventos que são vinculados pelo usuário
    $stmt = $pdo->prepare("SELECT c.id, c.name
      FROM clients c
      WHERE c.status = 1
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
        WHERE s.status = 1
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
  case 'set_os_status':
    $stmt = $pdo->prepare("UPDATE serviceorders SET servicestatus = 1 WHERE id = $data->id");
    $execute = $stmt->execute();

    if ($execute) {
      $response->class = 'bg-gradient-success';
      $response->message = "Oredem de serviço finalizada com sucesso!";
    } else {
      $response->class = 'bg-gradient-danger';
      $response->message = "Erro ao finalizar Ordem de Serviço!";
    }

    echo json_encode($response);
    break;
  case 'delete_service':
    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = $data->idOrder");
    $execute = $stmt->execute();

    if ($execute) {
      $response->code = 1;
    } else {
      $response->code = 0;
    }

    echo json_encode($response);
    break;
}
