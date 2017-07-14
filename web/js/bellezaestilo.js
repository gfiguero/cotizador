// Agency Theme JavaScript

(function($) {
    "use strict"; // Start of use strict

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    });

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function(){ 
            $('.navbar-toggle:visible').click();
    });

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    })

    $('.brands').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        arrows: false,
        autoplaySpeed: 2000,
        responsive: [
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
            }
        },
        ]
    });

})(jQuery); // End of use strict

function initMap() {
    var myLatLng = {lat: -32.4501874, lng: -71.2418708};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        scrollwheel: false,
        draggable: false,
        center: myLatLng
    });

    var contentString = 
        '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading">Tienda Belleza Estilo</h1>'+
            '<div id="bodyContent">'+
                '<p><b>Belleza Estilo</b>, fusce suscipit enim non sapien convallis, ac scelerisque magna porttitor. Suspendisse potenti. Aliquam ex magna, bibendum id facilisis id, laoreet a ligula. Nullam ornare dictum tortor, ac convallis velit rhoncus congue. Pellentesque purus nisl, commodo sed aliquet quis, eleifend id quam. Nunc ultricies risus massa, in porttitor massa pretium a.'+
                '<p>Página web: <a href="https://www.bellezaestilo.cl">'+
                'www.bellezaestilo.cl</a> '+
            '</div>'+
        '</div>';

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Tienda Belleza Estilo'
    });

    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });
}
