<?php include 'conn.php';

try {
  $employee = $_POST['employee'];
  $stmt = $conn->prepare("
    INSERT INTO staff (fio, position, experience)
    VALUES ('{$employee['fio']}', '{$employee['position']}', '{$employee['experience']}')
  ");
  $stmt->execute();
  $employee['id'] = $conn->lastInsertId();
  echo json_encode($employee);
} catch(PDOException $e) {
  echo json_encode(['error' => $e->getMessage()]);
}
