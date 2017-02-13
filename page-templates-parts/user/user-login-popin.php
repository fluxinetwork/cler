<?php if( !is_user_logged_in() ): ?>
	<div id="popin" class="l-overlay bg-main--grad">
		<div class="l-overlay__close">
			<button class="c-btnIcon c-btnIcon--controls js-popin-close"><i class="fa fa-times"></i></button>
		</div>

		<div class="l-overlay__content">
			<?php get_template_part( 'page-templates-parts/user/user-login'); ?>
		</div>
	</div>
<?php endif; ?>