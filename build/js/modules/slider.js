/*------------------------------*\

    #SLIDER

\*------------------------------*/

function slider() {
	$('.js-slider-controls').each(function(){
		var nbSlides = $(this).parent().find('ul').children().length-1;
		$(this).attr('data-slides', nbSlides).attr('data-step', 0);
	})

	$('.js-slide').on('click', function() {
		var $this = $(this);
		var $slides = $this.parent().prev().find('ul');
		var nbSlides = parseInt($this.parent().attr('data-slides'));
		var step = parseInt($this.parent().attr('data-step'));
		var colW = parseInt($slides.children().eq(0).outerWidth(true));
		var posL = parseInt($slides.css('left'));

		//console.log(posL-colW);

		if( $this.attr('data-direction') == 'prev' && step > 0 ) {
			$slides.css('left', posL+colW)
			$slides.children().eq(step-1).toggleClass('is-off');
			$this.parent().attr('data-step', step-1);

		} else if( $this.attr('data-direction') == 'next' && step < nbSlides ) {
			$slides.children().eq(step).toggleClass('is-off');
			$slides.css('left', posL-colW);
			$this.parent().attr('data-step', step+1);
		}
	});
}
