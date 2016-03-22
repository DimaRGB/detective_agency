jQuery(function ($) {

  $('#form-order').on('submit', function (event) {
    event.preventDefault();
    var $table = $('#table-orders');
    var $form = $(this);
    $.ajax({
      type: 'POST',
      url: '/backend/add_order.php',
      data: $form.serialize(),
      dataType: 'json',
      success: function (data) {
        if( data.error ) {
          alert(data.error);
        } else {
          console.log(data);
          $table.append('<tr><td>' + data.id + '</td><td>' + data.employee_fio + '</td><td>' + data.client_fio + '</td><td>' + data.price + '</td><td>' + data.description + '</td><td>' + data.created_at + '</td></tr>');
          $form[0].reset();
        }
      }
    });
  });

});
