<?php include 'backend/conn.php'; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8' />
    <title>Список співробітників</title>
    <link href='index.css' rel='stylesheet' />
  </head>
  <body>
    <?php include '_menu.php'; ?>
    <?php
      $stmt = $conn->prepare('SELECT id, fio, position, experience FROM staff');
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $staff = $stmt->fetchAll();
    ?>

    <h3>Співробітники</h3>
    <table>
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
    <form>
      <div class='form-group'>
        <label>Прізвище, Ім'я, По-батькові</label>
        <input type='text' name='fio' placeholder='ПІБ' />
      </div>
      <div class='form-group'>
        <label>Посада</label>
        <input type='text' name='position' placeholder='Посада' />
      </div>
      <div class='form-group'>
        <label>Досвід</label>
        <input type='text' name='position' placeholder='Досвід' />
      </div>
      <div class='form-controls'>
        <button type='submit'>Додати</button>
      </div>
    </form>

    <hr />

    <script src='index.js'></script>
  </body>
</html>
