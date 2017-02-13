/*------------------------------*\

    #SLIDER

\*------------------------------*/

function slider() {

	var slider_in_motion = false;

	$('.js-slider-controls').each(function(){
		var nbSlides = $(this).parent().find('ul').children().length-1;
		$(this).data('slides', nbSlides).data('step', 0);
	})

	$('.js-slide').on('click', function(e) {
		e.preventDefault();
		if(!slider_in_motion){
			moveTile ($(this));
			setTimeout(function() {
			   slider_in_motion = false;
			}, 300);
		}
	});

	function moveTile ($button){

		$this = $button;
		var $slides = $this.parent().prev().find('ul');
		var nbSlides = $this.parent().data('slides');
		var step = $this.parent().data('step');
		var colW = parseInt($slides.children().eq(0).outerWidth(true));
		var posL = parseInt($slides.css('left'));
		slider_in_motion = true;

		if( $this.data('direction') == 'prev' && step > 0 ) {
			$slides.css('left', posL+colW)
			$slides.children().eq(step-1).toggleClass('is-off');
			$this.parent().data('step', step-1);

		} else if( $this.data('direction') == 'next' && step < nbSlides ) {
			$slides.children().eq(step).toggleClass('is-off');
			$slides.css('left', posL-colW);
			$this.parent().data('step', step+1);
		}
	}	
}