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
    qScrollPositions[i] = qScrollPositions[i] - 10
    questions[i].querySelector('.intro-question-text').style.transform = 'translate3d(' + qScrollPositions[i] + 'px,0,0)'
    scrollRequest = requestAnimationFrame( () => { scrollQuestionText(i)})
  }
  init();

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
  if (document.querySelector('.primary-articles') && document.querySelector('.primary-articles').offsetHeight > WIN_H * 2) {
    initScroll();
  }
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
