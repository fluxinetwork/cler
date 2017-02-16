/*------------------------------*\

    #SLIDER

\*------------------------------*/

function slider() {

	var colW = $('.l-card-slider__cards__row__col').outerWidth(true);

	$('.js-slider-controls').each(function(){
		var nbSlides = $(this).parent().find('ul').children().length-1;
		$(this).data('slides', nbSlides).data('step', 0);
	})

	$('.js-slide').on('click', function(e) {
		$this = $(this);
		var $slides = $this.parent().prev().find('ul');
		var nbSlides = $this.parent().data('slides');
		var step = $this.parent().data('step');

		if( $this.data('direction') == 'prev' && step > 0 ) {
			$slides.css('left', (step-1)*colW*-1)
			$slides.children().eq(step-1).toggleClass('is-off');
			$this.parent().data('step', step-1);

		} else if( $this.data('direction') == 'next' && step < nbSlides ) {
			$slides.children().eq(step).toggleClass('is-off');
			$this.parent().data('step', step+1);
			$slides.css('left', (step+1)*colW*-1);
		}
	});

}