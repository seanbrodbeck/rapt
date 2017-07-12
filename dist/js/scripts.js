(function($) {

  // Header Shrink
  function init() {
    window.addEventListener('scroll', function(e){
        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
            shrinkOn = 100,
            header = document.querySelector("header");
        if (distanceY > shrinkOn) {
            classie.add(header,"smaller");
        } else {
            if (classie.has(header,"smaller")) {
                classie.remove(header,"smaller");
            }
        }
    });
  }
  window.onload = init();


  // Add Active Class to Tabs on Dermatology Pages

  $( "#dermatology-tabs .nav-tabs li:first-child" ).addClass( "active" );
  $( "#dermatology-tabs .tab-content .tab-pane:first-child" ).addClass( "active in" );
 
})( jQuery );

