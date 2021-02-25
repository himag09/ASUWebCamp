$(document).ready(function(){
    $('#guardar-registro').on('submit', function(e){
        e.preventDefault();

        var datos = $(this).serializeArray();
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data){
                var resultado = data;
                
                console.log(resultado);
                if (resultado.respuesta === 'exito') {
                    Swal.fire(
                        'Correcto',
                        'Se guardó correctamente',
                        'success'
                      )
                } else if (resultado.num_error === 1062){
                    Swal.fire(
                        'Error',
                        'No pueden existir 2 administradores con el mismo correo',
                        'error'
                      )
                } else {
                    Swal.fire(
                        'Error',
                        'Ocurrió un error inesperado',
                        'error'
                      )
                } 
            }
        });
    });
    // archivo imagen 
    $('#guardar-registro-archivo').on('submit', function(e){
        e.preventDefault();

        var datos = new FormData(this);
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            contentType: false,
            processData: false,
            async: true,
            cache: false,
            success: function(data){
                console.log(data);
                var resultado = data;
                
                if (resultado.respuesta === 'exito') {
                    Swal.fire(
                        'Correcto',
                        'Se guardó correctamente',
                        'success'
                      )
                } else if (resultado.num_error === 1062){
                    Swal.fire(
                        'Error',
                        'No pueden existir 2 registros con el mismo nombre',
                        'error'
                      )
                } else {
                    Swal.fire(
                        'Error',
                        'Ocurrió un error inesperado',
                        'error'
                      )
                } 
            }
        });
    });
    // eliminar un registro
    $('.borrar_registro').on('click', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var tipo = $(this).attr('data-tipo');
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Un registro eliminado no se puede recuperar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'No, cancelar'
          }).then(function(result) {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    data: {
                        'id': id,
                        'registro': 'eliminar'
                    },
                    url: 'modelo-'+tipo+'.php',
                    success: function(data){
                        console.log(data);
                        var resultado = JSON.parse(data);
                        if (resultado.respuesta == 'exito')  {
                            jQuery ('[data-id="' + resultado.id_eliminado + '"').parents('tr').remove();
                            Swal.fire(
                                'Eliminado!',
                                'El usuario fue eliminado',
                                'success'
                            )
                        } else {
                            swal(
                                'Error',
                                'Ocurrió un error',
                                'error'
                            );
                        }
                        
                    }
                })
            }
          });
    });

});
