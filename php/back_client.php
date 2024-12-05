<?php
require_once(__DIR__ . "/_db.php");

$data = (object) $_REQUEST;
$response = (object) [];

switch ($data->action) {
  case 'save_user':
    if (isset($data->id) != '') {

      // Decalara os Valores para usar o prepare
      $arrayData = [
        'id' => "$data->id",
        'name' => "$data->name",
        'phone' => "$data->phone",
        'cep' => "$data->cep",
        'city' => "$data->city",
        'neigbouhod' => "$data->neigbouhod",
        'street' => "$data->street",
        'obs' => "$data->obs",
      ];

      // Preapara a query de fato
      $stmt = $pdo->prepare(
        "UPDATE user SET
          idProfile = :profile,
          name = :name,
          mail = :mail,
          phone = :phone,
          user = :user,
          status = :status,
          editedBy = :editedBy,
          editionDate = NOW()
        WHERE id = :id"
      );

      // executa a query
      $execute = $stmt->execute($arrayData);

      if ($execute) {
        $response->return = 1;
        $response->message = "Registro editado com sucesso!";
      } else {
        $response->return = 0;
        $response->message = "Erro ao editar o registro!";
      }
    } else {

      $arrayData = [
        'name' => "$data->name",
        'phone' => "$data->phone",
        'cep' => $data->cep,
        'city' => "$data->city",
        'neigbouhod' => "$data->neigbouhod",
        'street' => "$data->street",
        'obs' => "$data->obs",
        'number' => "$data->number",
      ];

      $stmt = $pdo->prepare("INSERT INTO clients (name,phone,cep,city,neigbouhod,street,obs,number)
      VALUES (:name, :phone, :cep, :city, :neigbouhod, :street, :obs, :number)");

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
    $stmt = $pdo->prepare("SELECT id,name,phone,street,number,obs FROM clients where status = 1");
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
                  <h6 class='mb-0 text-sm'>". $value['name'] ."</h6>
                </div>
              </div>
            </td>
            <td class='align-middle text-center'>
              <div class='d-flex px-2 py-1'>
                <div class='d-flex flex-column justify-content-center'>
                  <h6 class='mb-0 text-sm'>".$value['phone']."</h6>
                </div>
              </div>
            </td>
            <td class='align-middle text-center'>
              <div class='d-flex px-2 py-1'>
                <div class='d-flex flex-column justify-content-center'>
                  <h6 class='mb-0 text-sm'>".$value['street']." - ".$value['number']."</h6>
                </div>
              </div>
            </td>
            <td class='align-middle text-center'><div class='d-flex px-2 py-1'>
                <div class='d-flex flex-column justify-content-center'>
                  <h6 class='mb-0 text-sm'>".$value['obs']."</h6>
                </div>
              </div>
            </td>
            <td class='text-right'>
              <a type='button' class='btn bg-gradient-warning m-0' data-toggle='tooltip' title='Editar' href=\"?route=route2&id='" . $value['id'] . "'\">
                <i class='material-symbols-rounded opacity-5'>edit</i>
              </a>
              <button type='button' class='btn bg-gradient-danger m-0' data-toggle='tooltip' data-placement='top' title='Excluir' onclick=\"deleteClient('" . $value['id'] . "')\">
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
}
