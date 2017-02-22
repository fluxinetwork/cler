		    </main>

		    <?php 
		    if (is_page_template('page-templates/page-formateree.php')) :
		    	get_template_part( 'page-templates-parts/base/footer-formateree');
		    else :
		    	get_template_part( 'page-templates-parts/base/footer');
		    endif;
		    ?>
		    
    </div><!-- .global -->	

    <!-- Popin login-->
	<?php get_template_part( 'page-templates-parts/user/user-login-popin'); ?>	

	<div class="l-row c-notify js-notify" style="z-index:1000;">
		<div class="l-col c-notify__content">
			<h3 class="c-notify__message js-notify-message"></h3>
			<button class="c-notify__btn c-btnIcon c-btn--ghost js-notify-close"><i class="fa fa-times"></i></button>
		</div>
	</div>

	<?php wp_footer(); ?>
	
</body>

</html>