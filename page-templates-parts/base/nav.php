<div class="navBar">
	<nav class="l-nav l-col nav" role="navigation">
		<a href="<?php bloginfo('url'); ?>" class="l-nav__logo nav-logo">
			<img src="<?php bloginfo('template_url'); ?>/app/img/cler-logo.jpg" alt="Logo du CLER, Réseau pour la transition énergétique" class="l-nav__logo__img">
		</a>

		<div class="l-nav__primary" role="navigation">
			<ul class="c-navList  c-navList--lvl1">			
				<?php wp_nav_menu( array(
					'theme_location' => 'main-menu',
					'container'      => '',
					'menu_id'         => 'main-menu',
					'menu_class'     => 'c-navList  c-navList--lvl1',
					'echo'           => true,
					'items_wrap'     => '%3$s',
					'depth'          => 3, 
					'walker'         => new fluxi_walker_nav_menu
				) ); ?>
			</ul>
		</div>

		<div class="l-nav__login"><?php get_template_part( 'page-templates-parts/user', 'log-btn' ); ?></div>
	</nav>
</div>

<div class="l-navExtra">
	<div class="l-navExtra__buttons">
		<button class="c-btnIcon c-btn--ghost js-close-subnav is-hidden"><i class="fa fa-chevron-left"></i></button>

		<button class="u-hide@large c-btnIcon js-open-nav">
			<i class="fa fa-bars"></i>
			<i class="fa fa-times"></i>
		</button>
	</div>

	<div class="l-navExtra__search">
		<button class="l-navExtra__search__btn c-btnIcon js-open-search">
			<i class="fa fa-search"></i>
			<i class="fa fa-times"></i>
		</button>

		<div class="l-navExtra__search__input l-row c-notify" id="search">
			<form method="get" class="l-col c-notify__content" action="<?php bloginfo('url'); ?>/">
				<label class="is-none" for="s"><?php _e('Recherche :'); ?></label>
			  	<input type="text" id="search-input" class="js-search-input c-notify__message" value="<?php if (is_search()) : the_search_query(); endif; ?>" name="s" id="s" placeholder="Que cherchez-vous ?" data-swplive="true">
			  	<button type="submit" class="c-btn" value="">Rechercher</button>  
			</form>
		</div>
	</div>

	<?php if ( is_user_logged_in() && ( current_user_can('administrator') || current_user_can('subadmin') )) : ?>
	<div class="l-navExtra__admin">
		<a href="<?php echo get_edit_post_link( get_the_ID() ); ?> " class="c-btnIcon c-btn--ghost"><i class="fa fa-pencil"></i></a>
		<a href="<?php bloginfo('url'); ?>/wp-admin" class="c-btnIcon c-btn--ghost"><i class="fa fa-wrench"></i></a>
	</div>
	<?php endif; ?>
</div>
