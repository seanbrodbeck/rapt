jQuery(function($){

	$('.misha_loadmore2').click(function(){
 
		var button = $(this),
		    data = {
			'action': 'loadmore2',
			'query': misha_loadmore_params2.posts, // that's how we get params from wp_localize_script() function
			'page' : misha_loadmore_params2.current_page
		};
 
		$.ajax({
			url : misha_loadmore_params2.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Loading...'); // change the button text, you can also add a preloader image
			},
			success : function( data ){
				if( data ) { 
					$('#main .secondary-articles').find('article:last-of-type').after( data ); // where to insert posts
					button.text( 'More posts' ).prev().before(data); // insert new posts
					misha_loadmore_params2.current_page++;
 
					if ( misha_loadmore_params2.current_page == misha_loadmore_params2.max_page ) 
						button.remove(); // if last page, remove the button
				} else {
					button.remove(); // if no data, remove the button as well
				}
			}
		});

	});

});