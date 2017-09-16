var userAgent = window.navigator.userAgent.toLowerCase(),
safari = userAgent.indexOf('safari') != -1 && userAgent.indexOf('chrome') == -1;

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
    targY,
    zIndexes = [],
    currentQRow,
    currentQCol

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
    var title = document.title.substr(0, document.title.indexOf(' Rapt') - 2);
    var transitionText = title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title;

    $('.transition-wipe h1 span').html(transitionText)

    $('.logo-loader .rapt-logo polyline').css({
      transform: 'scaleX(1)'
    })

    setTimeout(function(){
      if (el_transition) {
        el_transition.classList.add('is-off')
      } else {
        $('.logo-loader').addClass('is-off')
        $('.intro').addClass('is-active')
      }
      setTimeout(function(){
        cancelAnimationFrame(transitionRAF);
        revealRaptLogo();
      },200)
    }, Math.floor(Math.random() * 2000 + 500))

    if ($('body').hasClass('home')) {
      Array.prototype.map.call(questions, function(q, i) {
        if (i < questions.length) {
          addImageHover(i);
          addTextClick(i);
        }
      })
      if (images.length > 0 && questions.length > 0) {
        window.addEventListener('click', function() {
          isActive = false;
          $('body').removeClass('is-scrolling');
          Array.prototype.map.call(images, function(image, i) {
            stopScrollingQuestionText();
            images[i].classList.remove('is-active');
            questions[i].classList.remove('is-active');
            questions[i].classList.remove('is-off');
          })
        })
      }
    }
    window.addEventListener('resize', resizeHandler);
    document.addEventListener('wheel', scrollHandler)
    document.addEventListener('scroll', scrollHandler)
    $('.blog .more-link').on('click', resizeHandler);
    resizeHandler();
  }

  function scrollHandler() {
    oldScrollTop = scrollTop;
    scrollTop = document.body.scrollTop;
    navScrollHandler();
    articlesScrollHandler()
    caseScrollHandler()
    if (!safari) {
      bgColorScrollHandler();
    }
  }

  function addImageHover(i) {
    var testVar = 'whatever';
    qScrollPositions[i] = Math.floor(Math.random() * -200);
    questions[i].querySelector('.intro-question-text').style.transform = 'translate3d(' + qScrollPositions[i] + 'px,0,0)';
    questions[i].addEventListener('mouseenter', function(){
      if (!isActive) {
        scrollQuestionText(i)
      }
    })
    questions[i].addEventListener('mouseleave', function(){
      if (!isActive) {
        stopScrollingQuestionText();
      }
    })
  }

  function addTextClick(i) {
    questions[i].addEventListener('click', function(e) {
      if (!isActive) {
        e.stopPropagation()
        isActive = true;
        $('body').addClass('is-scrolling');
        images[i].classList.add('is-active');
        Array.prototype.map.call(questions, function(q, j) {
          if (i != j) {
            questions[j].classList.add('is-off');
          } else {
            questions[j].classList.add('is-active');
            scrollQuestionText(i);
          }
        })
      }
    })
  }

  function scrollQuestionText(i) {
    cancelAnimationFrame(scrollRequest);
    var el_text = questions[i].querySelector('.intro-question-text');
    qScrollPositions[i] = qScrollPositions[i] - Math.floor(2 + WIN_W/400);
    if (qScrollPositions[i] < -el_text.clientWidth / 3 - 5) {
      qScrollPositions[i] = 0;
    }
    el_text.style.transform = 'translate3d(' + qScrollPositions[i] + 'px,0,0)'
    scrollRequest = requestAnimationFrame( function() { scrollQuestionText(i)})
  }

  function stopScrollingQuestionText(i) {
    cancelAnimationFrame(scrollRequest);
  }

  function navScrollHandler() {
    // if ($('body').hasClass('home')) {
    //   var topMax = 94;
    //   if (WIN_W > 960) {
    //     topMax = 104;
    //   }
    //   var logoTop = Math.max(-WIN_H + topMax,(-scrollTop));
    //   $('.rapt-logo-wrap').css({
    //     transform: 'translate3d(0,' + logoTop + 'px,0)'
    //   })
    // }
    var scrollAmount = oldScrollTop - scrollTop;
    if (scrollTop > 0 ) {
      document.body.classList.add('is-scrolled');
    } else {
      document.body.classList.remove('is-scrolled');
    }
    if (Math.abs(scrollAmount) > 4) {
      if (oldScrollTop > scrollTop + 4 && document.querySelector('#masthead').getBoundingClientRect().top <= 0) {
        document.body.classList.add('is-nav-fixed')
        // revealRaptLogo()
      } else {
        document.body.classList.remove('is-nav-fixed')
        if (scrollTop > 200 && !$('body').hasClass('home')) {
          // hideRaptLogo()
        }
      }
    }
  }

  function articlesScrollHandler() {
    if (el_secondary_list) {
      scrollPercent = scrollTop/scrollHeight;
      el_secondary_list.style.willChange = "transform";
      el_secondary_list.style.backfaceVisibility = "hidden";
      el_secondary_list.style.transform = 'translateY(' + Math.floor(-secondaryTargY*scrollPercent) + 'px)'
    }
    if ($('.post-social').length > 0) {
      if (scrollTop > $('.single-related-posts article').eq(0).offset().top - 400 && WIN_W > 960) {
        $('.post-social').css({
          opacity: 0,
          transition: '.2s'
        })
      } else {
        $('.post-social').css({
          opacity: 1
        })
      }
    }
  }

  function bgColorScrollHandler() {
    if ($('body').hasClass('blog') || $('body').hasClass('post-template-default')) {
      var scrollPercent = (scrollTop/$('body').innerHeight()).toFixed(3);
      var colorsR = new Array(252,250,244,212)
      var colorsG = new Array(239,224,252,219)
      var colorsB = new Array(223,218,255,210)
      var r,g,b;
      var num = Math.floor(scrollPercent*6);
      r = colorsR[num];
      g = colorsG[num];
      b = colorsB[num];
      if (num <= 3) {
        $('body').css({
          backgroundColor: 'rgb(' + r + ',' + g + ',' + b + ')'
        })
        $('#site-navigation').css({
          backgroundColor: 'rgb(' + r + ',' + g + ',' + b + ')'
        })
      }
    }
  }

  try {
    var images;
    images = $('img');
    setSizes();
    function setSizes() {
      for (var i=0; i<images.length; i++) {
        var image = images.eq(i);
        var w = image.attr("width");
        var h = image.attr("height");
        if (!image.hasClass("loaded") && w && h) {
          var ratio = w/h;
          image.css('width','100%');
          height = Math.floor(image.outerWidth()/ratio);
          image.css('height',height + 'px');
          image.css('width','auto');
          loadListener(image);
        }
      }
    }
    function loadListener(image) {
      image.imagesLoaded()
        .done( function() {
          image.addClass("loaded");
        })
        .fail( function() {
          image.addClass("missing");
        })
    }
  } catch (e) {
    console.log('Error in script: ', e);
  }

  initIntroScript();

  // Toggle Search and Filter

  $( ".filter-toggle" ).click(function() {
    resizeHandler();
    $('body').addClass('is-filter-overlay')
    $( "#filter-overlay" ).fadeIn( "fast", "linear" );

    // init Isotope
    var $grid = $('.filter-listings-filters').isotope({
      itemSelector: '.filter-listing-filter',
      percentPosition: true,
      layoutMode: 'fitRows',
      masonry: {
        columnWidth: '.filter-listing-filter'
      },
    });
    // Updated Multi Select Code with Checkboxes
    var $checkboxes = $('.filter-options input');

    $checkboxes.change( function() {
      var inclusives = [];
      $checkboxes.each( function( i, elem ) {
        if ( elem.checked ) {
          inclusives.push( elem.value );
        }
      });

      var filterValue = inclusives.length ? inclusives.join(', ') : '*';

      $( ".reset" ).click(function() {
        $( ".filter-options label" ).removeClass('is-checked');
        $('input').prop('checked', false);
        $(this).removeClass('is-checked');
      });

      $grid.isotope({ filter: filterValue })
    });
    $('.filter-options').each( function( i, buttonGroup ) {
      $('.filter-options .filter-option').on( 'mouseup', function(e){
        $(this).toggleClass('is-checked')
      });
      $('.filter-options .filter-option').on( 'touchend', function(e){
        $(this).toggleClass('is-checked')
      });
    });
    // bind filter button click
    // $('.filter-options').on( 'click', '.filter-option', function() {
    //   var filterValue = $( this ).attr('data-filter');
    //   $grid.isotope({ filter: filterValue });
    // });
    // change is-checked class on buttons
    // $('.filter-options').each( function( i, buttonGroup ) {
    //   var $buttonGroup = $( buttonGroup );
    //   $buttonGroup.on( 'click', '.filter-option', function() {
    //     $buttonGroup.find('.is-checked').removeClass('is-checked');
    //     $( this ).addClass('is-checked');
    //   });
    // });
  });

  // FILTER SEARCH
  $('#search-overlay').on('scroll',function(e) {
    e.stopPropagation();
  })
  $('#search-overlay').on('wheel',function(e) {
    e.stopPropagation();
  })
  $( ".filter-search-btn" ).click(function() {
    resizeHandler();
    $('body').addClass('is-search-overlay')
    $( "#search-overlay" ).fadeIn( "fast", "linear" );
    $(".quicksearch").focus();
    // Isotope Search

      var qsRegex;

      var $grid = $('.filter-listings-search').imagesLoaded( function() {
        $grid.isotope({
          itemSelector: '.filter-listing-search',
          percentPosition: true,
          layoutMode: 'fitRows',
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
    $('body').removeClass('is-filter-overlay')
  });
  $( ".close-search-overlay" ).click(function() {
    $( "#search-overlay" ).fadeOut( "fast", "linear" );
    $('body').removeClass('is-search-overlay')
  });


  // Team Sort

  $(".team-sort-links a").click(function (e) {
      var idname= $(this).data('group');
      $("#"+idname).delay(300).fadeIn(300).addClass('active').siblings().fadeOut(300);
      e.preventDefault();
      $(this).addClass('active').siblings().removeClass('active');
      $('.team-members').removeClass('is-all')
  });
  $( ".show-everyone" ).click(function() {
    $( ".team-members div" ).fadeIn().removeClass('active');
    $('.team-members').addClass('is-all')
  });

  if ($('body').hasClass('page-template-page-studio')) {
    var currentTeamMember = 0;

    setInterval(function(){
      cycleTeamMembers(i)
    },2000)

    function cycleTeamMembers() {
      var teamMember = $('.team-member').eq(currentTeamMember)
      if (currentTeamMember > 2) {
        $('.team-member').eq(currentTeamMember-3).removeClass('is-active');
      } else if (currentTeamMember == 0) {
        $('.team-member').eq($('.team-member').length - 3).removeClass('is-active');
      } else if (currentTeamMember == 1) {
        $('.team-member').eq($('.team-member').length - 2).removeClass('is-active');
      } else if (currentTeamMember == 2) {
        $('.team-member').eq($('.team-member').length - 1).removeClass('is-active');
      }
      if (teamMember.find('video').get(0)) {
        teamMember.addClass('is-active');
        teamMember.find('source').attr('src',teamMember.find('source').attr('data-src'))
        teamMember.find('video').get(0).play();
      } else {
        cycleTeamMembers();
      }
      if (currentTeamMember == $('.team-member').length - 1) {
        currentTeamMember = 0;
      } else {
        currentTeamMember++;
      }
    }

    // Logo Carousel
    var clientLogos = $('.client-logos-row .client-logo');
    var activeLogos = new Array();
    var logoOrder = new Array(1,2,0,3)
    var currentClientLogo = 0;
    for (var i=0;i<4;i++) {
      var myLeft = (logoOrder[i]*25);
      var myTop = 0;
      if (WIN_W < 992) {
        myLeft = ((logoOrder[i]%2)*50);
        myTop = logoOrder[i] > 1 ? '100%' : 0;
      }
      clientLogos.eq(i).addClass('is-active');
      currentClientLogo++;
      activeLogos[logoOrder[i]] = clientLogos.eq(i);
      clientLogos.eq(i).css({
        left: myLeft + '%',
        transform: 'translate3d(0,' + myTop + ',0)'
      })
    }
    if (clientLogos.length > 4) {
      var currentClientLogo = 0;
      var currentClientIndex = 0;
      setInterval(cycleClientLogo,1000);
      function cycleClientLogo(){
        activeLogos[logoOrder[currentClientIndex]].removeClass('is-active')
        activeLogos[logoOrder[currentClientIndex]] = clientLogos.eq(currentClientLogo);
        clientLogos.eq(currentClientLogo).addClass('is-active')
        var myLeft = (logoOrder[currentClientIndex]*25);
        var myTop = 0;
        if (WIN_W < 992) {
          myLeft = ((logoOrder[currentClientIndex]%2)*50);
          myTop = logoOrder[currentClientIndex] > 1 ? '100%' : 0;
        }
        clientLogos.eq(currentClientLogo).css({
          left: myLeft + '%',
          transform: 'translate3d(0,' + myTop + ',0)'
        })
        currentClientLogo = currentClientLogo < clientLogos.length-1 ? currentClientLogo+1 : 0;
        currentClientIndex = currentClientIndex < 3 ? currentClientIndex+1 : 0;
      }
    }
  }

  function revealRaptLogo() {
    $('.rapt-logo').addClass('is-active')
    $('.rapt-logo').removeClass('is-off')
  }
  function hideRaptLogo() {
    $('.rapt-logo').removeClass('is-active')
    $('.rapt-logo').addClass('is-off')
  }

  // Case Study Scroll Locking

  var scrollLockTops = new Array();
  var scrollLockBots = new Array();
  var scrollLockHeights = new Array();
  $('.scroll-lock-text').each(function(i) {
    setScrollLocks($(this),i);
  })
  function setScrollLocks(el,num) {
    scrollLockTops[num] = el.offset().top;
    scrollLockBots[num] = scrollLockTops[num] + el.innerHeight();
    scrollLockHeights[num] = scrollLockBots[num] - scrollLockTops[num];
  }
  var caseScrollCount = 0;
  function caseScrollHandler() {
    if ($('.single-hero').length > 0) {
      $('.single-hero').css({
        transform: 'translate3d(0,' + Math.floor(-scrollTop/8) + 'px,0)'
      })
    }
    if ($('.studio-hero').length > 0) {
      $('.studio-hero').css({
        transform: 'translate3d(0,' + Math.floor(-scrollTop/8) + 'px,0)'
      })
    }
    if ($('.scroll-lock-text').length > 0) {
      caseScrollCount++;
      $('.scroll-lock-text').each(function(i){
        if (caseScrollCount % 10 == 0) {
          setScrollLocks($(this),i);
        }
        var el_text = $('.lg-textformat-parent', this);
        var textHeight = el_text.innerHeight();
        var textWidth = el_text.innerWidth();

        var minTop = scrollLockTops[i] - 120;
        var maxTop = scrollLockBots[i] - textHeight - 180;

        if (scrollTop > minTop && scrollTop < maxTop) {
          el_text.css({width: textWidth})
          el_text.addClass('is-fixed');
        } else {
          el_text.removeClass('is-fixed');
          if (scrollTop > maxTop) {
            el_text.css({
              transform: 'translate3d(0,' + (scrollLockHeights[i] - textHeight - 60) + 'px,0)'
            })
          } else {
            el_text.css({
              transform: 'translate3d(0,0,0)'
            })
          }
        }
      })
    }
  }
  function resizeHandler() { // NEEDS TO NOT BREAK ON RESIZE
    WIN_W = window.innerWidth;
    WIN_H = window.innerHeight;
    if (window.innerWidth >= 960) {
      if (document.querySelector('.blog .primary-articles')) {
        setTimeout(function(){
          initScroll();
        },300);

        function initScroll() {
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
          scrollHandler()
        }
      }
    }
    setSizes();
  }

})( jQuery );
