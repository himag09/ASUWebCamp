(function () {
    'use strict';

    var regalo = document.getElementById('regalo');
    document.addEventListener('DOMContentLoaded', function () {



        //Datos Usuario
        var nombre = document.getElementById('nombre');
        var apellido = document.getElementById('apellido');
        var email = document.getElementById('email');

        //Pases
        var pase_dia = document.getElementById("pase_dia");
        var pase_dosdias = document.getElementById('pase_dosdias');
        var pase_completo = document.getElementById('pase_completo');

        

        //botones & divs
        var calcular = document.getElementById('calcular');
        var errorDiv = document.getElementById('error');
        var botonRegistro = document.getElementById('btnRegistro');
        
        var lista_productos = document.getElementById('lista-productos');
        var suma = document.getElementById('suma-total');
        
        
        //Extras
        
        var camisas = document.getElementById('camisa_evento');
        var etiquetas = document.getElementById('etiquetas');
        
        if (botonRegistro) {
            botonRegistro.disabled = true;
        }


        if (document.getElementById('calcular')) {
            
        calcular.addEventListener('click', calcularMontos);
        pase_dia.addEventListener('change', mostrarDias);
        pase_dosdias.addEventListener('change', mostrarDias);
        pase_completo.addEventListener('change', mostrarDias);

        nombre.addEventListener('blur', validarCampos);
        apellido.addEventListener('blur', validarCampos);
        email.addEventListener('blur', validarCampos);
        email.addEventListener('blur', validarEmail);

        if (pase_dia.value || pase_dosdias.value || pase_completo.value ) {
            console.log(pase_dia.value);
            mostrarDias();
        }


        function validarCampos() {
            if (this.value == '') {
                errorDiv.style.display = 'block';
                errorDiv.innerHTML = 'Este campo es obligatorio';
                this.style.border = '1px solid red';
                errorDiv.style.border = '1px solid red';
            } else {
                errorDiv.style.display = 'none';
                this.style.border = '1px solid #cccccc'
            }
        }
        function validarEmail() {
            if (this.value.indexOf('@') > -1) {
                errorDiv.style.display = 'none';
                this.style.border = '1px solid #cccccc'
            } else {
                errorDiv.style.display = 'block';
                errorDiv.innerHTML = 'Email invalido';
                this.style.border = '1px solid red';
                errorDiv.style.border = '1px solid red';
            }
        }
        botonRegistro.addEventListener('click', calcularMontos);

        function calcularMontos(e) {
            // e.preventDefault();

            if (regalo.value === '') {
                alert("Debes elegir un regalo");
                regalo.focus();
            } else {
                var boletoDia = parseInt(pase_dia.value, 10) || 0,
                    boleto2Dias = parseInt(pase_dosdias.value, 10) || 0,
                    boletoCompleto = parseInt(pase_completo.value, 10) || 0,
                    cantCamisas = parseInt(camisas.value, 10) || 0,
                    cantEtiquetas = parseInt(etiquetas.value, 10) || 0;

                //total a pagar 
                var totalPagar = (boletoDia * 30) + (boleto2Dias * 45) + (boletoCompleto * 50) + ((cantCamisas * 10) * .93) + (cantEtiquetas * 2);

                var listadoProductos = [];
                if (boletoDia >= 1) {
                    listadoProductos.push(boletoDia + ' Pase por un día');
                }
                if (boleto2Dias >= 1) {
                    listadoProductos.push(boleto2Dias + ' Pase por 2 días');
                }
                if (boletoCompleto >= 1) {
                    listadoProductos.push(boletoCompleto + ' Pase Completo');
                }
                //extras
                if (cantCamisas == 1) {
                    listadoProductos.push(cantCamisas + ' Camisa');
                } else if (cantCamisas > 1) {
                        listadoProductos.push(cantCamisas + ' Camisas');
                }
                if (cantEtiquetas >= 1) {
                    listadoProductos.push(cantEtiquetas + ' Paquete de etiquetas');
                }
                lista_productos.style.display = 'block'
                lista_productos.innerHTML = '';
                for (var i = 0; i < listadoProductos.length; i++) {
                    lista_productos.innerHTML += listadoProductos[i] + '<br/>'
                }

                suma.innerHTML = "$ " + totalPagar.toFixed(2);

                
                botonRegistro.disabled = false;
                document.getElementById('total_pedido').value = totalPagar;
                // console.log(listadoProductos);



            }
        }

        function mostrarDias() {
            var boletoDia = parseInt(pase_dia.value, 10) || 0,
                boleto2Dias = parseInt(pase_dosdias.value, 10) || 0,
                boletoCompleto = parseInt(pase_completo.value, 10) || 0;

            var diasElegidos = [];
            if (boletoDia > 0) {
                diasElegidos.push('viernes');
            } 
            if (boleto2Dias > 0) {
                diasElegidos.push('viernes', 'sabado');
            }
            if (boletoCompleto > 0) {
                diasElegidos.push('viernes', 'sabado', 'domingo');
            }
            for (var i = 0; i < diasElegidos.length; i++) {
                document.getElementById(diasElegidos[i]).style.display = 'block';
                
            }
           if (diasElegidos.length == 0) {
            document.getElementById('viernes').style.display = 'none';
            document.getElementById('sabado').style.display = 'none';
            document.getElementById('domingo').style.display = 'none';
               
           }
            
            
        }

    }

    }); //DOM CONTENT LOADED

})();