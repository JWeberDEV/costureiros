<?php
require_once(__DIR__ . "/_db.php");

$data = (object) $_REQUEST;
$response = (object) [];

switch ($data->action) {
  case 'save_orderservice':
    $entry = date_create($data->entry);
    $entry = date_format($entry, "Y-m-d");
    $out = date_create($data->exit);
    $out = date_format($out, "Y-m-d");

    if ($data->id > 0) {
      
      $stmt = $pdo->prepare(
        "UPDATE serviceorders SET
          idclient = $data->client,
          ticket = $data->ticket,
          incoming = $data->incoming,
          total = $data->total,
          remainder = $data->remainder,
          sevicentry = '$entry',
          servicexit = '$out'
        WHERE id = $data->id"
      );

      $execute = $stmt->execute();

      if ($execute) {
        foreach ($data->data as $key => $value) {

          $stmt = $pdo->prepare(
            "UPDATE orders SET
                idservice = '{$value['idService']}',
                item = '{$value['item']}',
                price = '{$value['price']}',
                discount = '{$value['discount']}',
                obs = '{$value['obs']}'
              WHERE id = {$value['order']}"
          );

          $update = $stmt->execute();
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
          $stmt = $pdo->prepare("INSERT INTO orders (idserviceorders, idservice, item,price, discount, obs)
          VALUES($lastInsertId, {$value['idService']}, '{$value['item']}',{$value['price']}, {$value['discount']}, '{$value['obs']}')");
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
    $entry = date_format($entry, "Y-m-d");
    $out = date_create($data->exit);
    $out = date_format($out, "Y-m-d");

    $query = "SELECT 
        s.id,
        s.serviceorder,
        s.ticket,
        s.total,
        SUM(s.incoming) OVER() AS sumIncoming,
        SUM(s.total) OVER() AS sumTotal,
        s.servicestatus,
        c.name
      FROM serviceorders s
      JOIN clients c ON c.id = s.idclient
      WHERE s.`status` = 1";

    if ($data->client) {
      $query .= " AND c.id = $data->client";
    }

    if (isset($data->status) && $data->status != 2) {
      $query .= " AND s.servicestatus = $data->status";
    }

    if ($data->entry) {
      $query .= " AND s.sevicentry >= '$entry'";
    }

    if ($data->exit) {
      $query .= " AND s.servicexit <= '$out'";
    }

    $query .= " ORDER BY s.serviceorder DESC";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $list = '';
    $total = 0;
    $response = [];
    foreach ($results as $key => $value) {
      $response[] = [
        'id' => $value['id'],
        'serviceorder' => $value['serviceorder'],
        'ticket' => $value['ticket'],
        'total' => $value['total'],
        'sumIncoming' => $value['sumIncoming'],
        'sumTotal' => $value['sumTotal'],
        'servicestatus' => $value['servicestatus'],
        'name' => $value['name'],
      ];
    }

    echo (json_encode($response));
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
        FORMAT(so.incoming, 2) AS incoming,
        FORMAT(so.total, 2) AS total,
        FORMAT(so.remainder, 2) AS remainder,
        so.servicestatus,
        o.id AS 'idorder',
        o.idserviceorders,
        o.idservice,
        o.item,
        FORMAT(o.price, 2) AS price,
        FORMAT(o.discount, 2) AS discount,
        o.obs,
        (SELECT `name` FROM clients WHERE id = so.idclient) AS 'name',
        s.service,
        c.balance,
        c.debit
      FROM serviceorders so
      JOIN orders o ON o.idserviceorders = so.id
      JOIN services s ON s.id = o.idservice
      JOIN clients c ON c.id = so.idclient
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
        'item' => $value['item'],
        'price' => $value['price'],
        'discount' => $value['discount'],
        'obs' => $value['obs'],
        'service' => $value['service'],
        'name' => $value['name'],
        'servicestatus' => $value['servicestatus'],
        'balance' => $value['balance'],
        'debit' => $value['debit'],
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
    $val = "";
    $message = "";
    $query = "";
    if ($data->statusOs == 1) {
      $val = 0;
      $message = "Oredem de serviço Re aberta com sucesso!";
      $query = "UPDATE serviceorders SET servicestatus = $val WHERE id = $data->id";
    } else {
      $val = 1;
      $message = "Oredem de serviço finalizada com sucesso!";
      $query = "UPDATE serviceorders SET servicestatus = $val, remainder = 0 WHERE id = $data->id";
    }

    $stmt = $pdo->prepare($query);
    $execute = $stmt->execute();

    if ($execute) {
      $response->class = 'bg-gradient-success';
      $response->message = $message;
      $response->status = $val;
    } else {
      $response->class = 'bg-gradient-danger';
      $response->message = "Erro ao finalizar Ordem de Serviço!";
      $response->status = $val;
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
