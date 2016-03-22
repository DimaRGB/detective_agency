<?php include '../backend/conn.php'; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8' />
    <title>Список замовлень</title>
    <link rel='stylesheet' href='vendor/bootstrap.min.css' />
    <link rel='stylesheet' href='../index.css' />
    <script src='vendor/jquery-2.2.2.min.js'></script>
  </head>
  <body>
    <?php include '../_menu.php'; ?>
    <?php
      $stmt = $conn->prepare('SELECT DISTINCT orders.id, staff.fio as employee_fio, clients.fio as client_fio, orders.price, orders.description, orders.created_at
                              FROM orders
                              INNER JOIN staff
                              ON orders.employee_id = staff.id
                              INNER JOIN clients
                              ON orders.client_id = clients.id');
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $staff = $stmt->fetchAll();
      var_dump($staff);
    ?>

    <h3>Замовлення</h3>
    <table id='table-orders'>
      <tr>
        <th>ID</th>
        <th>ПІБ Співробітника</th>
        <th>ПІБ Клієнта</th>
        <th>Ціна</th>
        <th>Опис розслідування</th>
        <th>Дата створення</th>
      </tr>
      <?php foreach( $staff as $employee ) { ?>
        <tr>
          <td><?= $employee['id']; ?></td>
          <td><?= $employee['employee_fio']; ?></td>
          <td><?= $employee['client_fio']; ?></td>
          <td><?= $employee['price']; ?></td>
          <td><?= $employee['description']; ?></td>
          <td><?= $employee['created_at']; ?></td>
        </tr>
      <?php } ?>
    </table>
    <hr />

    <h3>Зробити замовлення</h3>
    <form id='form-staff'>
      <div class='form-group'>
        <label>Прізвище, Ім'я, По-батькові</label>
        <input type='text' name='employee[fio]' placeholder='ПІБ' />
      </div>
      <div class='form-group'>
        <label>Посада</label>
        <input type='text' name='employee[position]' placeholder='Посада' />
      </div>
      <div class='form-group'>
        <label>Досвід</label>
        <textarea name='employee[experience]' placeholder='Досвід'></textarea>
      </div>
      <div class='form-controls'>
        <button type='submit'>Додати</button>
      </div>
    </form>
    <hr />

    <script src='index.js'></script>
  </body>
</html>
