<?php include 'conn.php';

try {
  $order = $_POST['order'];

  // find employee id
  $stmt = $conn->prepare("SELECT id
                          FROM staff
                          WHERE fio = '{$order['employee_fio']}'");
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_NUM);
  $employee_id = $stmt->fetchColumn();

  // find client id
  $stmt = $conn->prepare("SELECT id
                          FROM clients
                          WHERE fio = '{$order['client_fio']}'");
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_NUM);
  $client_id = $stmt->fetchColumn();
  if( !$client_id ) {
    $stmt = $conn->prepare("
      INSERT INTO clients (fio)
      VALUES ('{$order['client_fio']}')
    ");
    $stmt->execute();
    $client_id = $conn->lastInsertId();
  }

  // create order
  $stmt = $conn->prepare("
    INSERT INTO orders (employee_id, client_id, price, description)
    VALUES ('{$employee_id}', '{$client_id}', '{$order['price']}', '{$order['description']}')
  ");
  $stmt->execute();
  $order['id'] = $conn->lastInsertId();
  $order['created_at'] = date('Y-m-d h:m:s');
  echo json_encode($order);
} catch(PDOException $e) {
  echo json_encode(['error' => $e->getMessage()]);
}
