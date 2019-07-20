jQuery(document).ready(function ($) {

    // Initializes slick carousel
    $('.slick-carousel').slick({
        prevArrow: '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        nextArrow: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
        fade: true,
        adaptiveHeight: true,
    });


    $('.single-project-gallery').slick({
        prevArrow: '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        nextArrow: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
        fade: true,
    });

    $('a[data-slide]').click(function(e) {
        e.preventDefault();
        slideIndex = $(this).index();
        $('.single-project-gallery').slick('slickGoTo', slideIndex);         
      });

    $('.thumbnails-gallery .thumbnail').on('click', function () {
        // Make sure this.hash has a value before overriding default behavior
            var hash = '#big-image';
            offset = $(hash).offset().top - 10            

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
                scrollTop: offset
            }, 300, function () {
                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
    })
});
