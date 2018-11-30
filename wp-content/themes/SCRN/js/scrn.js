'use strict';
jQuery(document).ready(function(){

  // animsition
  jQuery(".animsition").animsition({
    inClass: 'fade-in',
    outClass: 'fade-out',
    inDuration: 1500,
    outDuration: 800,
    linkElement: '.animsition-link',
    // e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"])'
    loading: true,
    loadingParentElement: 'body', //animsition wrapper element
    loadingClass: 'animsition-loading',
    loadingInner: '', // e.g '<img src="loading.svg" />'
    timeout: false,
    timeoutCountdown: 5000,
    onLoadEvent: true,
    browser: [ 'animation-duration', '-webkit-animation-duration'],
    // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
    // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
    overlay : false,
    overlayClass : 'animsition-overlay-slide',
    overlayParentElement : 'body',
    transition: function(url){ window.location.href = url; }
  });

  //setting the homepage heights for the border
  jQuery('.call-to-action').each(function() { 
    var hpleft = jQuery(this).find('.left'),
        hpright = jQuery(this).find('.right'),
        maxHeight = 0;
    maxHeight = Math.max(hpleft.height(), hpright.height() );

    hpleft.height(maxHeight);
    hpright.height(maxHeight);
  });

  jQuery('html').smoothScroll(500);

  // matchHeight
  jQuery('.match-height').matchHeight();

  // sticky nav
  jQuery(".js_fixedcontent").fixedcontent({
    marginTop: 0,
    minWidth: 0,
    zIndex: 500
  });


}); // end (document).ready(function()


// mixItUp
jQuery('#work-container').mixItUp({
  controls: {
    activeClass: 'on'
  }
});


// fade out intro on scroll
jQuery(window).scroll(function() {
  var scroll = jQuery(window).scrollTop();
  jQuery('.intro-content').css({'opacity':(( 1000-scroll )/1000)});
});



// close collapsed bootstrap nav
jQuery(document).on('click','.navbar-collapse.in',function(e) {
  if( jQuery(e.target).is('a') ) {
    jQuery(this).collapse('hide');
  }
});