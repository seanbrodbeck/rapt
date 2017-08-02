
// Page Transition Wipe
var transitionWipeX = 0;
var el_transitionText = document.querySelectorAll('.transition-wipe h1 span');
var el_transition = document.querySelector('.transition-wipe');
var transitionRAF;

var WIN_H,
    WIN_W,
    el_primary_list,
    el_secondary_list,
    scrollHeight,
    scrollTop,
    oldScrollTop,
    scrollPercent,
    primaryHeight,
    secondaryHeight,
    heightDifference,
    newY,
    targY;

animateTransition()
function animateTransition() {
  transitionRAF = requestAnimationFrame(function(){
    transitionWipeX -= 3;
    for (var i=0;i<el_transitionText.length;i++) {
      // Reverse odd lines direction
      if (i%1 - 1) {
        transitionWipeX = -transitionWipeX
      }
      el_transitionText[i].style.transform = 'translate3d(' + (transitionWipeX) + 'px,0,0)'
    }
    animateTransition();
  })
}

(function($) {

  // Home Page Feature

  var questions = document.querySelectorAll('.intro-question');
  var images = document.querySelectorAll('.intro-image');
  var scrollRequest;
  var qScrollPositions = [];
  var isActive = false;

  function initIntroScript() {

    setTimeout(function(){
      el_transition.classList.add('is-off')
      setTimeout(function(){
        cancelAnimationFrame(transitionRAF);
        revealRaptLogo();
      },1000)
    }, Math.floor(Math.random() * 2000 + 500))

    Array.prototype.map.call(questions, function(q, i) {
      if (i < questions.length) {
        addImageHover(i);
        addTextClick(i);
      }
    })
    document.addEventListener('resize', resizeHandler);
    document.addEventListener('wheel', scrollHandler)
    document.addEventListener('scroll', scrollHandler)
    window.addEventListener('click', function() {
      isActive = false;
      Array.prototype.map.call(images, function(image, i) {
        images[i].classList.remove('is-active');
        questions[i].classList.remove('is-active')
        questions[i].classList.remove('is-off')
      })
    })
    resizeHandler();
  }

  function scrollHandler(e) {
    oldScrollTop = scrollTop;
    scrollTop = document.body.scrollTop; // REDUNDANT;
    navScrollHandler(e);
    articlesScrollHandler(e)
  }

  function addImageHover(i) {
    var testVar = 'whatever';
    qScrollPositions[i] = 0;
    questions[i].addEventListener('mouseenter', function(){
      scrollQuestionText(i)
    })
    questions[i].addEventListener('mouseleave', function(){
      cancelAnimationFrame(scrollRequest);
    })
  }

  function addTextClick(i) {
    questions[i].addEventListener('click', function(e) {
      if (!isActive) {
        e.stopPropagation()
        isActive = true;
        images[i].classList.add('is-active');
        Array.prototype.map.call(questions, function(q, j) {
          if (i != j) {
            questions[j].classList.add('is-off');
          } else {
            questions[j].classList.add('is-active');
          }
        })
      }
    })
  }

  function scrollQuestionText(i) {
    var el_text = questions[i].querySelector('.intro-question-text');
    qScrollPositions[i] = qScrollPositions[i] - 5;
    if (qScrollPositions[i] < -el_text.clientWidth / 3 - 5) {
      qScrollPositions[i] = 0;
    }
    el_text.style.transform = 'translate3d(' + qScrollPositions[i] + 'px,0,0)'
    scrollRequest = requestAnimationFrame( function() { scrollQuestionText(i)})
  }

  function navScrollHandler(e) {
    var scrollAmount = oldScrollTop - scrollTop;
    if (Math.abs(scrollAmount) > 4) {
      if (oldScrollTop > scrollTop + 4 && document.querySelector('#masthead').getBoundingClientRect().bottom < 0) {
        document.body.classList.add('is-nav-fixed')
        revealRaptLogo()
      } else {
        document.body.classList.remove('is-nav-fixed')
        if (scrollTop > 200) {
          hideRaptLogo()
        }
      }
    }
  }

  function articlesScrollHandler(e) {
    if (el_secondary_list) {
      requestAnimationFrame(function(){
        scrollPercent = scrollTop/scrollHeight;
        if (primaryHeight > secondaryHeight) {
          el_secondary_list.style.willChange = "transform";
          el_secondary_list.style.transform = 'translate3d(0, ' + Math.floor(-secondaryTargY*scrollPercent) + 'px, 0)'
        }
      })
    }
  }

  initIntroScript();

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

  // FILTER SEARCH
  $('#search-overlay .quicksearch').on('keyup',function(){
    if ($('#search-overlay .quicksearch').val() != '') {
      $('.search-filter-overlay .container').addClass('active')
    } else {
      $('.search-filter-overlay .container').removeClass('active')
    }
  })
  $( ".filter-search-btn" ).click(function() {
    $( "#search-overlay" ).fadeIn( "fast", "linear" );
    $(".quicksearch").focus();
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


  // Team Sort
  $('.team-members .team-member-group:first').css("display", "block");

  $(".team-sort-links a").click(function (e) {
      var idname= $(this).data('divid');
      $("#"+idname).delay(300).fadeIn(300).addClass('active').siblings().fadeOut(300);
      e.preventDefault();
      $(this).addClass('active').siblings().removeClass('active');
  });
  $( ".show-everyone" ).click(function() {
    $( ".team-members div" ).fadeIn().removeClass('active');
    $('.team-members .team-member-group:first').addClass("active");
  });

  // Logo Carousel
  var clientLogos = $('.clients .carousel .carousel-item');
  if (clientLogos.length > 4) {
    var clientGroup = 0;
    cycleClientLogos();
    setInterval(cycleClientLogos,5000)
    function cycleClientLogos(){
      clientGroup++;
      if (clientGroup > Math.floor(clientLogos.length/4)) {
        clientGroup = 1;
      }
      clientLogos.removeClass('active')
      for (var i = clientGroup * 4 - 4; i < clientGroup * 4; i++) {
        clientLogos.eq(i).addClass('active')
      }
    }
  }

  function revealRaptLogo() {
    $('.rapt-logo polyline').css({
      transform: 'scaleX(1)'
    })
  }
  function hideRaptLogo() {
    $('.rapt-logo polyline').css({
      transform: 'scaleX(0)'
    })
  }

})( jQuery );

function resizeHandler() { // NEEDS TO NOT BREAK ON RESIZE
  WIN_W = window.innerWidth;
  WIN_H = window.innerHeight;
  if (window.innerWidth >= 960) {
    if (document.querySelector('.blog .primary-articles')) {
      var detectRenderInterval = setInterval(function(){
        initScroll();
      },300);

      function initScroll() {
        clearInterval(detectRenderInterval);
        el_primary_list = document.querySelector('.blog .primary-articles');
        el_secondary_list = document.querySelector('.blog .secondary-articles');
        el_secondary_list.style.transform = 'translate3d(0, 0, 0)'
        scrollHeight = document.body.offsetHeight - WIN_H;
        primaryHeight = el_primary_list.offsetHeight;
        secondaryHeight = el_secondary_list.offsetHeight;
        heightDifference = primaryHeight - secondaryHeight;
        secondaryTargY = scrollHeight - heightDifference
        oldY = 0;
        newY = 0;
        targY = 0;
      }
    }
  }
}
