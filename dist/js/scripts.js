var userAgent = window.navigator.userAgent.toLowerCase(),
safari = userAgent.indexOf('safari') != -1 && userAgent.indexOf('chrome') == -1;

// Page Transition Wipe
var transitionWipeX = 0;
// var el_transitionText = document.querySelectorAll('.transition-wipe h1 span');
// var el_transition = document.querySelector('.transition-wipe');
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
    currentQCol,
    qFrame = 0;

// animateTransition()
// function animateTransition() {
//   transitionRAF = requestAnimationFrame(function(){
//     transitionWipeX -= 3;
//     for (var i=0;i<el_transitionText.length;i++) {
//       // Reverse odd lines direction
//       if (i%1 - 1) {
//         transitionWipeX = -transitionWipeX
//       }
//       el_transitionText[i].style.transform = 'translate3d(' + (transitionWipeX) + 'px,0,0)'
//     }
//     animateTransition();
//   })
// }

(function($){

  // Home Page Feature

  var questions = document.querySelectorAll('.intro-question');
  var images = document.querySelectorAll('.intro-image');
  var scrollRequest;
  var qScrollPositions = [];
  var isActive = false;

  function initIntroScript() {
    // var title = document.title.substr(0, document.title.indexOf(' Rapt') - 2);
    // var transitionText = title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title + ' ' + title;

    // $('.transition-wipe h1 span').html(transitionText)

    setTimeout(function(){
      $('.logo-loader .rapt-logo polyline').css({
        transform: 'scaleX(1)'
      })
    },300)

    setTimeout(function(){
      // if (el_transition) {
      //   el_transition.classList.add('is-off')
      // } else {
        $('.logo-loader').addClass('is-off')
        $('.intro').addClass('is-active')
      // }
      setTimeout(function(){
        revealRaptLogo();
      },200)
    }, Math.floor(Math.random() * 2000 + 1000))

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
            image.classList.remove('is-active');
          })
          Array.prototype.map.call(questions, function(question, i) {
            question.classList.remove('is-active');
            question.classList.remove('is-off');
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
    scrollTop = $(window).scrollTop();
    navScrollHandler();
    articlesScrollHandler()
    caseScrollHandler()
    imageScrollHandler()
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
          questions[j].style.transitionDelay = '0s';
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
    var shift = Math.floor(2 + WIN_W/800) * Math.min(1, qFrame / 20);
    cancelAnimationFrame(scrollRequest);
    var el_text = questions[i].querySelector('.intro-question-text');
    qScrollPositions[i] = qScrollPositions[i] - shift;
    if (qScrollPositions[i] < -el_text.clientWidth / 4 - 5) {
      qScrollPositions[i] = 0;
    }
    el_text.style.transform = 'translate3d(' + qScrollPositions[i] + 'px,0,0)'
    qFrame++;
    scrollRequest = requestAnimationFrame( function() { scrollQuestionText(i)})
  }

  function stopScrollingQuestionText(i) {
    cancelAnimationFrame(scrollRequest);
    qFrame = 0;
  }

  function imageScrollHandler() {
    // var fullRow = $('#main .work-grid .work-row.work-row-full');
    // fullRow.css({
    //   backgroundPositionY: ((scrollTop-fullRow.offset().top)/WIN_H) * 100 + '%'
    // })
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
      var scrollPercent = (scrollTop/($('body').innerHeight() - WIN_H*1.5)).toFixed(3);
      var colorsR = new Array(252,250,244,212)
      var colorsG = new Array(239,224,252,219)
      var colorsB = new Array(223,218,255,210)
      var r,g,b;
      var localPos = 0;
      var p1,p2;
      if (scrollPercent < .333) {
        localPos = scrollPercent/.333;
        p1 = 0;
        p2 = 1;
      } else if (scrollPercent < .666) {
        localPos = (scrollPercent-.333)/.333;
        p1 = 1;
        p2 = 2;
      } else if (scrollPercent <= 1) {
        localPos = (scrollPercent-.666)/.333;
        p1 = 2;
        p2 = 3;
      }
      r = Math.round(colorsR[p1] - ((colorsR[p1] - colorsR[p2]) * localPos));
      g = Math.round(colorsG[p1] - ((colorsG[p1] - colorsG[p2]) * localPos));
      b = Math.round(colorsB[p1] - ((colorsB[p1] - colorsB[p2]) * localPos));
      $('body').css({
        backgroundColor: 'rgb(' + r + ',' + g + ',' + b + ')'
      })
      $('#site-navigation').css({
        backgroundColor: 'rgb(' + r + ',' + g + ',' + b + ')'
      })
    }
  }

  // SOCIAL LINKS

  if ($('.post-social').length > 0) {
    $('.twitter-link').attr('href','https://twitter.com/intent/tweet?text=' + document.title.substr(0, document.title.indexOf(' Rapt') - 2) + ' by @raptstudio ' + document.location);
    $('.facebook-link').attr('href','https://www.facebook.com/sharer/sharer.php?u=' + document.location)
    var subhead = $('.entry-header h2').text() || ''
    $('.in-link').attr('href','https://www.linkedin.com/shareArticle?mini=true&url=' + document.location + '&title=' + document.title + '&summary=' + subhead + '&source=RaptStudio')
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

  // Image Lightbox
  for (var i=0;i<$('.single .grid-content img').length;i++) {
    addImageClick(i)
  }
  function addImageClick(num) {
    $('.single .grid-content img').eq(num).on('click',function(){
      openLightbox($(this),num);
    })
  }
  var currentLBImage = 0;
  function openLightbox(img,num) {
    $('body').addClass('is-lightbox');
    $('body').append('<div class="lightbox fade-in"><img class="lb-image" src="' + img[0].src + '"> \
      <div class="arrows"> \
        <svg class="arrow-prev" x="0px" y="0px" viewBox="0 0 43.7119 91.4985" enable-background="new 0 0 43.7119 91.4985" xml:space="preserve"><polygon fill="#010101" points="41.4756,91.4985 0,45.0923 41.4902,0 43.6973,2.0312 4.0498,45.1216 43.7119,89.4985 "/></svg> \
        <div class="indicator"><span class="current-img">1</span> of <span class="total-img">10</span></div> \
        <svg class="arrow-next" x="0px" y="0px" viewBox="0 0 43.7119 91.4985" enable-background="new 0 0 43.7119 91.4985" xml:space="preserve"><polygon fill="#010101" points="2.2363,91.4985 43.7119,45.0923 2.2217,0 0.0146,2.0312 39.6621,45.1216 0,89.4985 "/></svg> \
      </div>');
    $('.lightbox').on('click',function(){
      $('.lightbox').remove();
      $('body').removeClass('is-lightbox');
    })
    setLBImage(num);
    $('.lightbox .arrow-next').on('click',function(e){
      e.stopPropagation()
      if (num < $('.single .grid-content img').length - 1) {
        num++;
        setLBImage(num)
      }
    })
    $('.lightbox .arrow-prev').on('click',function(e){
      e.stopPropagation()
      if (num > 0) {
        num--;
        setLBImage(num);
      }
    })
    var moved, touchStartX, touchStartY;
    $('.arrows').on('touchstart',function(e){
      var touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
      moved = 0;
      touchStartX = touch.pageX;
    })
    $('.arrows').on('touchmove',function(e){
      var touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
      moved = touchStartX - touch.pageX;
      touchStartX = touch.pageX;
      $('.lightbox img').css({
        transform: 'translate3d(' + Math.floor(-moved) + 'px,0,0)'
      })
    })
    $('.arrows').on('touchend',function(e){
      if (moved < -4 && num > 0) {
        num--;
        setLBImage(num);
      } else if (moved > 4 && num < $('.single .grid-content img').length - 1) {
        num++;
        setLBImage(num)
      } else {
        $('.lightbox img').css({
          transform: 'translate3d(0,0,0)'
        })
      }
    })
    $(window).on('keydown',function(e){
      if (e.keyCode === 37) {
        if (num > 0) {
          num--;
          setLBImage(num);
        }
      }
      if (e.keyCode === 39 || e.keyCode === 32) {
        if (num < $('.single .grid-content img').length - 1) {
          num++;
          setLBImage(num)
        }
      }
    })
  }


  function setLBImage(num) {
    $('.lightbox img')[0].src = $('.single .grid-content img').eq(num)[0].src;
    $('.arrows .indicator .current-img').html(num + 1);
    $('.arrows .indicator .total-img').html($('.single .grid-content img').length);
    $('.lightbox img').css({
      opacity: 0,
      transitionDuration: '0s',
      transform: 'translate3d(0,0,0)'
    })
    setTimeout(function(){
      $('.lightbox img').imagesLoaded( function(){
        $('.lightbox img').css({
          opacity: 1,
          transitionDuration: '.4s',
          transform: 'translate3d(0,0,0)'
        })
      })
    },10)
  }

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

  $( ".show-everyone" ).click(function(e) {
    e.preventDefault();
    $('.team-members').toggleClass('is-everyone');
    $('.team-members').addClass('is-switching');
    setTimeout(function(){
      $('.team-members').removeClass('is-switching');
    },1000)
    if ($('.show-everyone').html() === '↪︎ Just show me everyone.'){
      $('.show-everyone').html('↪︎ Don’t show me everyone.')
    } else {
      $('.show-everyone').html('↪︎ Just show me everyone.')
    }
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
      if (teamMember.find('.team-member img')) {
        teamMember.addClass('is-active');
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
        backgroundPositionY: 80 - ((scrollTop/WIN_H)*80) + '%'
      })
    }
    if ($('.studio-hero').length > 0) {
      $('.studio-hero').css({
        backgroundPositionY: 80 - ((scrollTop/WIN_H)*80) + '%'
      })
    }
    if ($('.work-row.work-row-full').length > 0) {
      $('.work-row.work-row-full').each(function(i){
        $(this).css({
          backgroundPositionY: 80 - (((scrollTop-$(this).offset().top)/WIN_H)*80) + '%'
        })
      })
    }
    if ($('.work-row .col-sm-7').length > 0) {
      if (WIN_W > 679) {
        $('.work-row-twothirds-onethird .col-sm-7, .work-row-onethird-twothirds .col-sm-7').each(function(i){
          $(this).css({
            transform: 'translate3d(0,' + (((scrollTop-$(this).offset().top+80)/WIN_H)*-120) + 'px,0)'
          })
        })
      } else {
        $('.work-row .col-sm-7').css({
          transform: 'translate3d(0,0,0)'
        })
      }
    }
    if ($('.home .secondary-articles').length > 0) {
      if (WIN_W > 679) {
        $('.home .secondary-articles').css({
          transform: 'translate3d(0,' + (((scrollTop-$('.home .secondary-articles').offset().top+80)/WIN_H)*-120) + 'px,0)'
        })
      } else {
        $('.home .secondary-articles').css({
          transform: 'translate3d(0,0,0)'
        })
      }
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
