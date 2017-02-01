<?php if( !is_user_logged_in() ): ?>
	<div id="popin" class="l-overlay bg-main bg-main--grad">
		<div class="l-overlay__close">
			<button class="c-btn c-btn--close js-popin-close"></button>
		</div>

		<div class="l-overlay__content">
			<?php get_template_part( 'page-templates-parts/user/user-login'); ?>
		</div>
	</div>
<?php endif; ?>