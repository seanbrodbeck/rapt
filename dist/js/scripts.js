(function($) {

	// Home Page Feature

  let questions = document.querySelectorAll('.intro-question');
	let images = document.querySelectorAll('.intro-image');

	let init = () => {
	  Array.prototype.map.call(questions, (q, i) => {
	    if (i < questions.length - 1) addImageHover(i);
	  })
	}

	let addImageHover = i => {
	  let testVar = 'whatever';
	  questions[i].addEventListener('mouseenter', () => {
	    images[i].classList.add('is-active');
	    document.querySelector('.intro-logo').classList.add('is-white');
	    Array.prototype.map.call(questions, (q, j) => {
	      if (i != j) {
	        questions[j].classList.add('is-off');
	      }
	    })
	  })
	  questions[i].addEventListener('mouseleave', () => {
	    images[i].classList.remove('is-active');
	    document.querySelector('.intro-logo').classList.remove('is-white');
	    Array.prototype.map.call(questions, (q, j) => {
	      questions[j].classList.remove('is-active')
	      questions[j].classList.remove('is-off')
	    })
	  })
	}
	init();
 
})( jQuery );

