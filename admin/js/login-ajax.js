$(document).ready(function(){
    $('#login-admin').on('submit', function(e){
        e.preventDefault();

        var datos = $(this).serializeArray();
        // console.log(datos);
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data){
                var resultado = data;
                if (resultado.respuesta === 'exitoso') {
                    Swal.fire({
                        title:'Login Correcto',
                        text:'Bienvenid@ ' +resultado.usuario+'! ',
                        icon:'success',
                        showConfirmButton: false,
                    })
                    setTimeout(() => {
                        window.location.href = 'admin-area.php';
                    }, 1500);
                } else {
                    Swal.fire(
                        'Error',
                        'Email o contraseña incorrectos',
                        'error'
                    )
                } 
            }
        });
    });
})