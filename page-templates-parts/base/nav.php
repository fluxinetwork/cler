<header class="wrap-navBar">
	<nav class="l-nav navBar" role="navigation">
		<a href="<?php bloginfo('url'); ?>" class="l-nav__logo nav-logo">
			<img src="<?php bloginfo('template_url'); ?>/app/img/cler-logo.png" alt="Logo du CLER, Réseau pour la transition énergétique">
		</a>
		<div class="l-nav__primary nav" role="navigation">
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

				<?php if (is_user_logged_in() && current_user_can('administrator')) : ?>
					<li class="c-navList__item">
						<a href="<?php bloginfo('url'); ?>/wp-admin" class="c-navList__item__link has-dropdown">Admin</a>
					</li>
					<li class="c-navList__item">
						<a href="<?php echo get_edit_post_link( get_the_ID() ); ?> " class="c-navList__item__link has-dropdown">Edit</a>
					</li>
				<?php endif; ?>
			</ul>
		</div>

		<div class="l-nav__login navLog"><?php get_template_part( 'page-templates-parts/user', 'log-btn' ); ?></div>

		<button id="search-btn" class="c-btnIcon js-open-search">
			<i class="fa fa-search"></i>
			<i class="fa fa-times"></i>
		</button>

		<div class="l-nav__buttons u-hide@large">
			<button class="c-btnIcon js-close-subnav is-none"><i class="fa fa-chevron-left"></i></button>
			<button class="c-btnIcon js-open-nav">
				<i class="fa fa-bars"></i>
				<i class="fa fa-times"></i>
			</button>
		</div>	
		
	</nav>
	
	<div class="l-row c-notify js-notify" id="search">
		<form method="get" class="l-col c-notify__content" action="<?php bloginfo('url'); ?>/">
			<label class="is-none" for="s"><?php _e('Recherche :'); ?></label>
		  	<input type="text" id="search-input" class="js-search-input c-notify__message" value="<?php if (is_search()) : the_search_query(); endif; ?>" name="s" id="s" placeholder="Rechercher" data-swplive="true">
		  	<button type="submit" class="c-btn" value=""><i class="fa fa-search mgRight--xs"></i>Rechercher</button>  
		</form>
	</div>
</header>
