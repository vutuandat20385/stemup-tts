jQuery(document).ready(function($) {
    var hasTouchScreen = false;
    if ("maxTouchPoints" in navigator) { 
        hasTouchScreen = navigator.maxTouchPoints > 0;
    } else if ("msMaxTouchPoints" in navigator) {
        hasTouchScreen = navigator.msMaxTouchPoints > 0; 
    } else {
        var mQ = window.matchMedia && matchMedia("(pointer:coarse)");
        if (mQ && mQ.media === "(pointer:coarse)") {
            hasTouchScreen = !!mQ.matches;
        } else if ('orientation' in window) {
            hasTouchScreen = true; // depedicated, but good fallback
        } else {
            // Only as a last resort, fall back to user agent sniffing
            var UA = navigator.userAgent;
            hasTouchScreen = (
                /\b(BlackBerry|webOS|iPhone|IEMobile)\b/i.test(UA) ||
                /\b(Android|Windows Phone|iPad|iPod)\b/i.test(UA)
            );
        }
    }
    if (hasTouchScreen){
        $('.autoplay-slide').slick({
            dots: true,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000
        });
    } else {
        $('.autoplay-slide').slick({
            dots: true,
            infinite: true,
            speed: 500,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000
        });
    }
//     $('#myCarousel').carousel({
//         interval: 5000
//     });

// //Handles the carousel thumbnails
// $('[id^=carousel-selector-]').click(function () {
//     var id_selector = $(this).attr("id");
//     try {
//         var id = /-(\d+)$/.exec(id_selector)[1];
//         console.log(id_selector, id);
//         jQuery('#myCarousel').carousel(parseInt(id));
//     } catch (e) {
//         console.log('Regex failed!', e);
//     }
// });
// // When the carousel slides, auto update the text
// $('#myCarousel').on('slid.bs.carousel', function (e) {
//     var id = $('.item.active').data('slide-number');
//     $('#carousel-text').html($('#slide-content-'+id).html());
// });
  
});



