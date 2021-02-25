$(function () {
    $("#registros").DataTable({
        "responsive": true,
        "lengthChange": true,
        "paging": true,
        "autoWidth": false,
        "language": {
            paginate: {
                next: 'Siguiente',
                previous : 'Anterior',
                last: 'Último',
                first: 'Primero'
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ resultados",
            emptyTable: "No hay registros",
            infoEmpty: "0 registros",
            lengthMenu: "Mostrando _MENU_ registros",
            search: "Buscar:"
        },
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    // $('#example2').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "pageLength" :
    //   "searching": false,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    //   "responsive": true,
    // });
    $('#crear_registro_admin').attr('disabled', true);    
    $('#repetir_password').on('input', function (){
        var password_nuevo = $('#password').val();

        if ($(this).val() == password_nuevo) {
            $('#resultado_password').text('');
            $('input#password').parents('.form-group').addClass('was-validated').removeClass('is-invalid');
            $('input#repetir_password').parents('.form-group').addClass('was-validated').removeClass('is-invalid');
            $('#crear_registro_admin').attr('disabled', false);    

        } else {
            $('#resultado_password').text('No son iguales');
            $('input#password').addClass('is-invalid').parents('.form-group').removeClass('was-validated');
            $('input#repetir_password').addClass('is-invalid').parents('.form-group').removeClass('was-validated');
            $('#crear_registro_admin').attr('disabled', true);    

        }
    });
    $('#fechaEvento').datetimepicker({
        format: 'L'
    });
    $('#timepicker').datetimepicker({
        format: 'HH:mm'
      })
    //Initialize Select2 Elements
    $('.seleccionar').select2()

//  icono

    $('#icono').iconpicker({defaultValue: ($('#iconoid').attr('class'))});  
    
    // file input 
    $(function () {
        bsCustomFileInput.init();
      });

      $.getJSON('servicio-registrados.php', function(data){
        console.log(data);
        var line = new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'lineChart',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: data,
            // The name of the data record attribute that contains x-values.
            xkey: 'fecha',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['cantidad'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['cantidad']
          });
      });
     
});