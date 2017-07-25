
// Page Transition Wipe
var transitionWipeX = 0;
let el_transitionText = document.querySelectorAll('.transition-wipe h1 span');
animateTransition()
function animateTransition() {
  requestAnimationFrame(function(){
    transitionWipeX -= 3;
    for (var i=0;i<el_transitionText.length;i++) {
      // Reverse odd lines direction
      // if (i%1 - 1) {
      //   transitionWipeX = -transitionWipeX
      // }
      el_transitionText[i].style.transform = 'translate3d(' + (transitionWipeX) + 'px,0,0)'
    }
    animateTransition();
  })
}

(function($) {

  // Home Page Feature

  let questions = document.querySelectorAll('.intro-question');
  let images = document.querySelectorAll('.intro-image');
  let requestAnimationFrame = window.requestAnimationFrame;
  let cancelAnimationFrame = window.cancelAnimationFrame;
  let scrollRequest;
  let qScrollPositions = [];

  let init = () => {
    Array.prototype.map.call(questions, (q, i) => {
      if (i < questions.length) addImageHover(i);
    })
  }

  let addImageHover = i => {
    let testVar = 'whatever';
    qScrollPositions[i] = 0;
    questions[i].addEventListener('mouseenter', () => {
      images[i].classList.add('is-active');
      scrollQuestionText(i)
      Array.prototype.map.call(questions, (q, j) => {
        if (i != j) {
          questions[j].classList.add('is-off');
        }
      })
    })
    questions[i].addEventListener('mouseleave', () => {
      images[i].classList.remove('is-active');
      cancelAnimationFrame(scrollRequest);
      Array.prototype.map.call(questions, (q, j) => {
        questions[j].classList.remove('is-active')
        questions[j].classList.remove('is-off')
      })
    })
  }

  let scrollQuestionText = i => {
    qScrollPositions[i] = qScrollPositions[i] - 8
    questions[i].querySelector('.intro-question-text').style.transform = 'translate3d(' + qScrollPositions[i] + 'px,0,0)'
    scrollRequest = requestAnimationFrame( () => { scrollQuestionText(i)})
  }
  init();

  // Toggle Search and Filter
  $( ".filter-toggle" ).click(function() {
    $( "#filter-overlay" ).fadeIn( "fast", "linear" );

    // init Isotope
    var $grid = $('.filter-listings-filters').isotope({
      itemSelector: '.filter-listing-filter',
      percentPosition: true,
      masonry: {
        columnWidth: '.filter-listing-filter'
      },
    });
    // bind filter button click
    $('.filter-options').on( 'click', '.filter-option', function() {
      var filterValue = $( this ).attr('data-filter');
      $grid.isotope({ filter: filterValue });
    });
    // change is-checked class on buttons
    $('.filter-options').each( function( i, buttonGroup ) {
      var $buttonGroup = $( buttonGroup );
      $buttonGroup.on( 'click', '.filter-option', function() {
        $buttonGroup.find('.is-checked').removeClass('is-checked');
        $( this ).addClass('is-checked');
      });
    });


  });
  $( ".filter-search-btn" ).click(function() {
    $( "#search-overlay" ).fadeIn( "fast", "linear" );
    // Isotope Search 

      var qsRegex;

      var $grid = $('.filter-listings-search').imagesLoaded( function() {
        $grid.isotope({
          itemSelector: '.filter-listing-search',
          percentPosition: true,
          masonry: {
            columnWidth: '.filter-listing-search'
          },
          filter: function() {
            return qsRegex ? $(this).text().match( qsRegex ) : true;
          }
        });
      });

      var $quicksearch = $('.quicksearch').keyup( debounce( function() {
        qsRegex = new RegExp( $quicksearch.val(), 'gi' );
        $grid.isotope();
      }, 200 ) );

      function debounce( fn, threshold ) {
        var timeout;
        return function debounced() {
          if ( timeout ) {
            clearTimeout( timeout );
          }
          function delayed() {
            fn();
            timeout = null;
          }
          timeout = setTimeout( delayed, threshold || 100 );
        }
      }
  });
  $( ".close-filter-overlay" ).click(function() {
    $( "#filter-overlay" ).fadeOut( "fast", "linear" );
  });
  $( ".close-search-overlay" ).click(function() {
    $( "#search-overlay" ).fadeOut( "fast", "linear" );
  });

})( jQuery );

var WIN_H = window.innerHeight,
    el_primary_list,
    el_secondary_list,
    scrollHeight,
    scrollPercent,
    primaryHeight,
    secondaryHeight,
    heightDifference,
    newY,
    targY;

var detectRenderInterval = setInterval(function(){
  initScroll();
},300);

function initScroll() {
  clearInterval(detectRenderInterval);
  el_primary_list = document.querySelector('.primary-articles');
  el_secondary_list = document.querySelector('.secondary-articles');
  document.addEventListener('wheel',scrollHandler)
  scrollHeight = document.body.offsetHeight - WIN_H;
  primaryHeight = el_primary_list.offsetHeight;
  secondaryHeight = el_secondary_list.offsetHeight;
  heightDifference = primaryHeight - secondaryHeight;
  secondaryTargY = scrollHeight - heightDifference
  oldY = 0;
  newY = 0;
  targY = 0;
}
function scrollHandler(e) {
  requestAnimationFrame(function(){
    var scrollTop = document.body.scrollTop;
    scrollPercent = scrollTop/scrollHeight;
    if (primaryHeight > secondaryHeight) {
      el_secondary_list.style.willChange = "transform";
      el_secondary_list.style.transform = 'translate3d(0, ' + Math.floor(-secondaryTargY*scrollPercent) + 'px, 0)'
    }
  })
}
function setSecondaryY(secondaryScrollHeight, scrollPercent) {
  targY = Math.floor(secondaryScrollHeight * scrollPercent);
  newY += .9*(-targY - newY); // Slightly eased
  return newY;
}

