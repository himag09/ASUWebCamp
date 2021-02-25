//map
if (document.getElementById('mapa')) {

var map = L.map('mapa').setView([-25.287489618582303, -57.63897370466273], 16.5);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

L.marker([-25.287489618582303, -57.63897370466273]).addTo(map)
    .bindPopup('ASUWebCamp.<br> Hotel Excelsior.')
    .openPopup();
}



//jquery
$(function() {

   
    //Lettering 
    $('.nombre-sitio').lettering();
    //Agregar clase a barra de body
    $('body.conferencia .navegacion-principal a:contains("Conferencia")').addClass('activo');
    $('body.calendario .navegacion-principal a:contains("Calendario")').addClass('activo');
    $('body.invitados .navegacion-principal a:contains("Invitados")').addClass('activo');

    //Menú fijo 
    var windowHeight = $(window).height();
    var barraAltura = $('.barra').innerHeight();
    var windowwidth = $(window).width();

        
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll > windowHeight) {
            $('.barra').addClass('fixed');
            $('body').css({'margin-top': barraAltura+'px'});
        } else {
            $('.barra').removeClass('fixed');
            $('body').css({'margin-top': '0px'});
        }
    });

    //Menu Responsive 
    $('.menu-movil').on('click', function(){
        $('.navegacion-principal').slideToggle();
    }); 



    //conferencias :D
    $('.programa-evento .info-curso:first').show();
    $('.menu-programa a:first').addClass('activo');

    $('.menu-programa a').on('click', function() {
        $('.menu-programa a').removeClass('activo');
        $(this).addClass('activo');
        $('.ocultar').hide();
        var enlace = $(this).attr('href');
        $(enlace).fadeIn(1000);
        return false;
    });

    //Animaciones para los Numeros
    var resumenLista = jQuery('.resumen-evento');
    if (resumenLista.length > 0) {
         $('.resumen-evento').waypoint(function() {

            $('.resumen-evento li:nth-child(1) p').animateNumber({ number: 6}, 1200);
            $('.resumen-evento li:nth-child(2) p').animateNumber({ number: 15}, 1200);
            $('.resumen-evento li:nth-child(3) p').animateNumber({ number: 3}, 1400);
            $('.resumen-evento li:nth-child(4) p').animateNumber({ number: 9}, 1200);

         }, {
             offset: '60%'
         });
    }



    //Cuenta Regresiva
    $('.cuenta-regresiva').countdown('2021/12/10 09:00', function(e) {
        $('#dias').html(e.strftime('%D'));
        $('#horas').html(e.strftime('%H'));
        $('#minutos').html(e.strftime('%M'));
        $('#segundos').html(e.strftime('%S'));
    });

    //COLORBOX
    if (document.getElementsByClassName('invitados')) {
        $('.invitado-info').colorbox({inline:true, width:"50%"});
        
    }
    if (document.getElementById('boton_newsletter')) {
        $('.boton_newsletter').colorbox({inline:true, width:"50%"});
    }
});

