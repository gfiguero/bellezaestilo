// Agency Theme JavaScript

(function($) {
    "use strict"; // Start of use strict

<<<<<<< HEAD
=======
    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

>>>>>>> 618b321da7762705690e6573e6c155e5d6e0feae
    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '#mainNav',
        offset: 51
    });

<<<<<<< HEAD
=======
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

>>>>>>> 618b321da7762705690e6573e6c155e5d6e0feae
})(jQuery); // End of use strict
