/**
 * Ayana.js
 *
 * Theme js code drops for better UX.
 *
 */

( function( $ ) {
    
    'use strict';
     
     // Search
     $(".search-toggle").click(function(){
        $("#search-container").slideToggle('slow', function(){
            $('.search-toggle').toggleClass('active');
        });
        // Optional return false to avoid the page "jumping" when clicked
        return false;
    });
    
    // Menu
    $('#ayana-menu .menu').slicknav({
        prependTo:'.mobile-menu',
        label:'',
        allowParentLinks: true
    });
    
    // Sticky Menu
    $('.main-navigation .ayana-menu').stickThis();
    
    // BXSlider
    $('.post-gallery-slider .bxslider').bxSlider({
          adaptiveHeight: true,
          mode: 'fade',
          pager: false,
          captions: true,
          auto: true,
    });
    
    $('.kgm-featured-posts .bxslider').bxSlider({
          adaptiveHeight: true,
          mode: 'fade',
          pager: false,
          captions: false,
          auto: true,
          nextSelector: '.slider-next',
          prevSelector: '.slider-prev',
          nextText: '<i class="fa fa-chevron-right"></i>',
          prevText: '<i class="fa fa-chevron-left"></i>',
    });
    
    $('.kgm-latest-posts .bxslider').bxSlider({
          minSlides: 3,
          maxSlides: 3,
          moveSlides: 1,
          slideWidth: 390,
          slideMargin: 0,
          nextSelector: '.post-next',
          prevSelector: '.post-prev',
          nextText: '<i class="fa fa-chevron-right"></i>',
          prevText: '<i class="fa fa-chevron-left"></i>',
    });
    
    // Magnific Pop
    $('.popup-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: 'Loading...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            titleSrc: 'data-caption'
        }
    });
    
    // Fitvids
    $(".post-thumbnail").fitVids();
    
    //Scroll To Top
    $(window).scroll(function(){
        if ($(this).scrollTop() > 500) {
            $('#ScrollToTop').fadeIn();
        } else {
            $('#ScrollToTop').fadeOut();
        }
    });
    
    //Click event to scroll to top
    $('#ScrollToTop').click(function(){
        $('html, body').animate({scrollTop : 0},2000);
        return false;
    });
    
    
} )( jQuery );