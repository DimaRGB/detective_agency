<ul class='menu'>
  <li><a href='/'>Співробітники</a></li>
  <li><a href='/orders/orders.php'>Замовлення</a></li>
  <li><a href='/clients/clients.php'>Клієнти</a></li>
</ul>
<hr />

<script>
  var href = window.location.pathname;
  var currentLink = $(".menu [href='" + href + "']");
  currentLink
    .parent()
    .addClass('active');
</script>
