<?php include 'backend/conn.php'; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8' />
    <title>Список співробітників</title>
    <link rel='stylesheet' href='vendor/bootstrap.min.css' />
    <link rel='stylesheet' href='index.css' />
    <script src='vendor/jquery-2.2.2.min.js'></script>
  </head>
  <body>
    <?php include '_menu.php'; ?>
    <?php
      $stmt = $conn->prepare('SELECT id, fio, position, experience FROM staff');
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $staff = $stmt->fetchAll();
    ?>

    <h3>Список співробітників</h3>
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

    <h3>Додади нового співробітника</h3>
    <form id='form-staff'>
      <div class='form-group'>
        <label>Прізвище, Ім'я, По-батькові *</label>
        <input type='text' name='employee[fio]' placeholder='ПІБ' required='required' />
      </div>
      <div class='form-group'>
        <label>Посада *</label>
        <input type='text' name='employee[position]' placeholder='Посада' required='required' />
      </div>
      <div class='form-group'>
        <label>Досвід *</label>
        <textarea name='employee[experience]' placeholder='Досвід' required='required'></textarea>
      </div>
      <div class='form-controls'>
        <button type='submit'>Додати</button>
      </div>
    </form>
    <hr />

    <script src='index.js'></script>
  </body>
</html>
