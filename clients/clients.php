<?php include '../backend/conn.php'; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8' />
    <title>Список клієнтів</title>
    <link rel='stylesheet' href='../vendor/bootstrap.min.css' />
    <link rel='stylesheet' href='../index.css' />
    <script src='../vendor/jquery-2.2.2.min.js'></script>
  </head>
  <body>
    <?php include '../_menu.php'; ?>
    <?php
      $stmt = $conn->prepare('SELECT id, fio, gender, age FROM clients');
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $staff = $stmt->fetchAll();
    ?>

    <h3>Список клієнтів</h3>
    <table id='table-clients'>
      <tr>
        <th>ID</th>
        <th>ПІБ</th>
        <th>Стать</th>
        <th>Вік</th>
      </tr>
      <?php foreach( $staff as $employee ) { ?>
        <tr>
          <td><?= $employee['id']; ?></td>
          <td><?= $employee['fio']; ?></td>
          <td><?php if( $employee['gender'] ) {
            echo 'Чоловік';
          } else {
            echo 'Жінка';
          }
          ?></td>
          <td><?= $employee['age']; ?></td>
        </tr>
      <?php } ?>
    </table>
  </body>
</html>
