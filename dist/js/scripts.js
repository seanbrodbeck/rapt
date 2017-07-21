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
		qScrollPositions[i] = qScrollPositions[i] - 1
		questions[i].querySelector('.intro-question-text').style.transform = 'translate3d(' + qScrollPositions[i] + 'px,0,0)'
		scrollRequest = requestAnimationFrame( () => { scrollQuestionText(i)})
	}
	init();

})( jQuery );

