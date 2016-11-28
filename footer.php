		    </main>

		    <?php get_template_part( 'page-templates-parts/base/footer'); ?>
		    
    </div><!-- .global -->	

    <!-- Popin login-->
	<?php require_once(  FU_PLUGIN_DIR . 'assets/inc/page-templates-parts/user-login-popin.php' ); ?>	
	<div class="l-row c-notify js-notify">
		<div class="l-col c-notify__content">
			<h3 class="c-notify__message js-notify-message"></h3>
			<button class="c-link c-link--white js-notify-close">Fermer</button>
		</div>
	</div>

	<?php wp_footer(); ?>
	
</body>

</html>