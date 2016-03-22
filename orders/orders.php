<?php include '../backend/conn.php'; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8' />
    <title>Список замовлень</title>
    <link rel='stylesheet' href='../vendor/bootstrap.min.css' />
    <link rel='stylesheet' href='../index.css' />
    <script src='../vendor/jquery-2.2.2.min.js'></script>
  </head>
  <body>
    <?php include '../_menu.php'; ?>
    <?php
      // fetch orders
      $stmt = $conn->prepare('SELECT DISTINCT orders.id, staff.fio as employee_fio, clients.fio as client_fio, orders.price, orders.description, orders.created_at
                              FROM orders
                              INNER JOIN staff
                              ON orders.employee_id = staff.id
                              INNER JOIN clients
                              ON orders.client_id = clients.id');
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $orders = $stmt->fetchAll();

      // fetch all staff
      $stmt = $conn->prepare('SELECT id, fio FROM staff');
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $staff = $stmt->fetchAll();

      // fetch all clients
      $stmt = $conn->prepare('SELECT fio FROM clients');
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $clients = $stmt->fetchAll();
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
      <?php foreach( $orders as $order ) { ?>
        <tr>
          <td><?= $order['id']; ?></td>
          <td><?= $order['employee_fio']; ?></td>
          <td><?= $order['client_fio']; ?></td>
          <td><?= $order['price']; ?></td>
          <td><?= $order['description']; ?></td>
          <td><?= $order['created_at']; ?></td>
        </tr>
      <?php } ?>
    </table>
    <hr />

    <h3>Зробити замовлення</h3>
    <form id='form-order'>
      <div class='form-group'>
        <label>ПІБ Працівника</label>
        <select name='order[employee_fio]'>
          <?php foreach( $staff as $employee ) {
            echo "<option>{$employee['fio']}</option>";
          } ?>
        </select>
      </div>
      <div class='form-group'>
        <label>ПІБ Клієнта</label>
        <input type='text' name='order[client_fio]' placeholder='ПІБ Клієнта' list='clients' />
        <datalist id='clients'>
          <?php foreach( $clients as $client ) {

            echo "<option value='{$client['fio']}' data-id='{$client['fio']}' />";
          } ?>
        </datalist>
      </div>
      <div class='form-group'>
        <label>Ціна</label>
        <input type='number' name='order[price]' placeholder='Ціна' />
      </div>
      <div class='form-group'>
        <label>Опис розслідування</label>
        <textarea name='order[description]' placeholder='Опис'></textarea>
      </div>
      <div class='form-controls'>
        <button type='submit'>Створити</button>
      </div>
    </form>
    <hr />

    <script src='orders.js'></script>
  </body>
</html>
