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

          if ($value['order']) {
            $stmt = $pdo->prepare(
              "UPDATE orders SET
                idservice = '{$value['idService']}',
                item = '{$value['item']}',
                price = '{$value['price']}',
                discount = '{$value['discount']}',
                obs = '{$value['obs']}'
              WHERE id = {$value['order']}"
            );
          } else {
            $stmt = $pdo->prepare("INSERT INTO orders (idserviceorders, idservice, item,price, discount, obs)
            VALUES($data->id, {$value['idService']}, '{$value['item']}',{$value['price']}, {$value['discount']}, '{$value['obs']}')");
          }

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

        $stmt = $pdo->prepare(" UPDATE tickets SET ticketactive = 'UNAVAILABLE' WHERE id IN (SELECT ticket FROM serviceorders WHERE id = $lastInsertId) ");
        $finaly = $stmt->execute([]);

        if ($finaly) {
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
    if ($data->date) {
      list($start, $end) = explode(' - ', $data->date);

      $start = DateTime::createFromFormat('d/m/Y', $start)->format('Y-m-d');
      $end = DateTime::createFromFormat('d/m/Y', $end)->format('Y-m-d');
    }

    $query = "SELECT 
        s.id,
        s.serviceorder,
        s.ticket,
        s.total,
        s.incoming,
        s.remainder,
        SUM(CASE 
            WHEN s.incoming > 0 THEN s.incoming
            WHEN s.servicestatus = 2 THEN s.total
            ELSE 0
        END) OVER() AS sumInCash,
        SUM(s.total) OVER() AS sumTotal,
        s.servicestatus,
        c.name,
        c.phone,
        so.status,
        so.color
      FROM serviceorders s
      JOIN clients c ON c.id = s.idclient
      JOIN serviceorderstatus so ON so.id = s.servicestatus
      WHERE s.`status` = 1";


    if ($data->client) {
      $query .= " AND c.id = $data->client";
    }

    if ($data->ticket) {
      $query .= " AND s.ticket = $data->ticket";
    }

    if (isset($data->status) && $data->status != 7) {
      $query .= " AND s.servicestatus = $data->status";
    }

    if ($data->period == 1) {
      $query .= " AND s.sevicentry BETWEEN '$start' AND '$end'";
    } else if ($data->period == 2) {
      $query .= " AND s.servicexit BETWEEN '$start' AND '$end'";
    }

    $query .= " ORDER BY CASE
             WHEN s.servicestatus = 5 THEN 0
             ELSE 1
         END,
    s.serviceorder DESC";

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
        'incoming' => $value['incoming'],
        'remainder' => $value['remainder'],
        'sumInCash' => $value['sumInCash'],
        'sumTotal' => $value['sumTotal'],
        'servicestatus' => $value['servicestatus'],
        'name' => $value['name'],
        'phone' => $value['phone'],
        'status' => $value['status'],
        'color' => $value['color'],
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
        o.obs,
        o.issue,
        FORMAT(o.price, 2) AS price,
        FORMAT(o.discount, 2) AS discount,
        (SELECT `name` FROM clients WHERE id = so.idclient) AS 'name',
        s.service,
        c.balance,
        c.debit,
        ss.status,
        ss.button
      FROM serviceorders so
      LEFT JOIN orders o ON o.idserviceorders = so.id
      LEFT JOIN services s ON s.id = o.idservice
      JOIN clients c ON c.id = so.idclient
      JOIN serviceorderstatus ss ON ss.id = so.servicestatus
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
        'button' => $value['button'],
        'status' => $value['status'],
        'issue' => $value['issue'],
      ];
    }

    echo (json_encode($response));
    break;
  case 'load_clients':
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
  case 'load_tickets':
    $query = "SELECT t.id,t.name
      FROM tickets t
      WHERE (t.status = 1
      AND ticketactive = 'AVAILABLE')
    ";

    if ($data->ticketid) {
      $query .= " OR t.id = $data->ticketid";
    }

    $query .= " ORDER BY t.id";

    $stmt = $pdo->prepare($query);
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

  case 'load_all_tickets':
    $query = "SELECT t.id,t.name
      FROM tickets t
      WHERE t.status = 1
      ORDER BY t.id ASC
    ";

    $stmt = $pdo->prepare($query);
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
  case 'set_os_status':
    $message = "";
    $query = "";
    if ($data->statusOs == 2) {
      $message = "Oredem de serviço finalizada com sucesso!";
      $query = "UPDATE serviceorders SET servicestatus = $data->statusOs, remainder = 0.00, incoming = 0.00 WHERE id = $data->id";
      $stmt = $pdo->prepare(" UPDATE tickets SET ticketactive = 'AVAILABLE' WHERE id IN (SELECT ticket FROM serviceorders WHERE id = $data->id) ");
      $update = $stmt->execute();
    } else {
      $message = "Status da Oredem de serviço atualizado";
      $query = "UPDATE serviceorders SET servicestatus = $data->statusOs WHERE id = $data->id";
      $stmt = $pdo->prepare(" UPDATE tickets SET ticketactive = 'UNAVAILABLE' WHERE id IN (SELECT ticket FROM serviceorders WHERE id = $data->id) ");
      $update = $stmt->execute();
    }

    $stmt = $pdo->prepare($query);
    $execute = $stmt->execute();

    if ($execute) {
      $response->class = 'bg-gradient-success';
      $response->message = $message;
      $response->status = $data->statusOs;
    } else {
      $response->class = 'bg-gradient-danger';
      $response->message = "Erro ao finalizar Ordem de Serviço!";
      $response->status = $data->statusOs;
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
  case 'verify_late_services':
    $stmt = $pdo->prepare(" SELECT 
        id,
        servicexit,
        servicestatus
      FROM serviceorders
      WHERE servicexit BETWEEN '$data->entry' AND '$data->out'
      AND servicestatus NOT IN (2,6)
      AND status = 1
    ");

    $stmt->execute() or die("Failed to execute");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC) or die("Failed to fetch");
    $currentDate = new DateTime();

    foreach ($results as $key => $value) {
      $serviceExitDate = new DateTime($value['servicexit']);
      $exitDate = new DateTime($value['servicexit']);
      $exitDate->modify('+1 day');

      if ($currentDate > $exitDate && $value['servicestatus'] == 4) {
        $stmt = $pdo->prepare("UPDATE serviceorders SET servicestatus = 6 WHERE id = :id");
        $stmt->execute([':id' => $value['id']]);
      }

      if ($currentDate > $serviceExitDate && !in_array($value['servicestatus'], [4, 5])) {
        $stmt = $pdo->prepare("UPDATE serviceorders SET servicestatus = 5 WHERE id = :id");
        $stmt->execute([':id' => $value['id']]);
      }
    }
    break;
  case 'notify_late_services':
    $stmt = $pdo->prepare("SELECT
        COUNT(s.`servicestatus`) as count
        FROM serviceorders s
        WHERE s.servicestatus = 5
        AND STATUS = 1
      ");
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
  case 'update_issue':
    $stmt = $pdo->prepare("UPDATE orders SET issue = :issue WHERE id = :id");
    $stmt->bindParam(':issue', $data->issue);
    $stmt->bindParam(':id', $data->id);
    $stmt->execute() or die("Failed to execute");

    if ($stmt->rowCount() > 0) {
      $response->code = 1;
    } else {
      $response->code = 0;
    }

    echo json_encode($response);
    break;

  case 'update_ticket_status':

    $stmt = $pdo->prepare("SELECT so.ticket
      FROM serviceorders so
      INNER JOIN (
          SELECT ticket, MAX(id) AS max_id
          FROM serviceorders
          WHERE ticket BETWEEN 1 AND 49
          GROUP BY ticket
      ) latest ON so.id = latest.max_id
      WHERE so.servicestatus = 2
      ORDER BY so.ticket
    ");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_COLUMN);

    if (!$results) {
      echo ("Nenhum ticket encontrado.");
    }

    $placeholders = rtrim(str_repeat('?,', count($results)), ',');

    print_r($results);

    $stmt = $pdo->prepare(" UPDATE tickets SET ticketactive = 'AVAILABLE' 
      WHERE id IN ($placeholders)
    ");
    $update1 = $stmt->execute($results);

    $stmt = $pdo->prepare(" UPDATE tickets SET ticketactive = 'UNAVAILABLE' 
      WHERE id NOT IN ($placeholders)
      AND id < 80
    ");
    $update2 = $stmt->execute($results);

    if ($update1) {
      echo "</br>Tickets atualizados com sucesso!";
    } else {
      echo "<br>Erro ao atualizar tickets!";
    }
    if ($update2) {
      echo "</br>Tickets Inativados com sucesso!";
    } else {
      echo "<br>Erro ao Inativados tickets!";
    }
    break;
}
