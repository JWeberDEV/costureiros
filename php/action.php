<?php

require_once(__DIR__ . "/php/_db.php");

$data = json_decode(json_encode($_REQUEST));

switch ($data->action) {
  case "login":
    $response = (object) [];

    $data = [
      'user' => $data->user,
      'password' => md5($data->password),
    ];

    // busca pelo usuáruio no banco
    $stmt = $pdo->prepare("SELECT u.id,u.name,u.login 
      FROM user u 
      WHERE user = :user AND password = :password
      and u.status = 1
    ");
    $execute = $stmt->execute($data);
    $result = $stmt->fetchAll();
    $numRows = count($result);

    if ($numRows > 0) {
      $user = $result[0];
      if ($user->status != 0) {

        $response->message = "Ok";
        $response->return = 1;
        $response->keyProfile = $user->key;

      } else {
        $response->return = 0;
        $response->message = "Usuário inativo contate um administrador!";
        $response->keyProfile = $user->key;
      }
    } else {
      $response->return = 0;
      $response->message = "Usuário ou senha inválidos!";
    }

    echo (json_encode($response));
    break;
}
