<?php include '../backend/conn.php'; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8' />
    <title>Список клієнтів</title>
    <link rel='stylesheet' href='vedor/bootstrap.min.css' />
    <link rel='stylesheet' href='../index.css' />
    <script src='vendor/jquery-2.2.2.min.js'></script>
  </head>
  <body>
    <?php include '../_menu.php'; ?>
    <?php
      $stmt = $conn->prepare('SELECT id, fio, position, experience FROM staff');
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $staff = $stmt->fetchAll();
    ?>

    <h3>Клієнти</h3>
    <table id='table-staff'>
      <tr>
        <th>ID</th>
        <th>ПІБ</th>
        <th>Посада</th>
        <th>Досвід</th>
      </tr>
      <?php foreach( $staff as $employee ) { ?>
        <tr>
          <td><?= $employee['id']; ?></td>
          <td><?= $employee['fio']; ?></td>
          <td><?= $employee['position']; ?></td>
          <td><?= $employee['experience']; ?></td>
        </tr>
      <?php } ?>
    </table>
    <hr />

    <script src='index.js'></script>
  </body>
</html>
