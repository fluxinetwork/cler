<header class="l-row wrap-navBar">
	<nav class="l-col l-nav navBar" role="navigation">
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
				<?php endif; ?>
			</ul>
		</div>

		<div class="l-nav__login navLog"><?php get_template_part( 'page-templates-parts/user', 'log-btn' ); ?></div>

		<div class="l-nav__buttons u-hide@large">
			<button class="c-btnArrow js-close-subnav"></button>
			<button class="c-btnMenu js-open-nav"></button>
		</div>	
		
	</nav>
</header>

<form method="get" id="nav__search" class="nav__search is-none" action="<?php bloginfo('url'); ?>/">
	<label class="is-hidden" for="s"><?php _e('Recherche :'); ?></label>
  	<input type="text" class="nav__search__input js-search-input" value="<?php if (is_search()) : the_search_query(); endif; ?>" name="s" id="s" placeholder="Rechercher" data-swplive="true">
  	<button type="submit" class="nav__search__submit icon-check_32 nav-bt" value="" id="nav__search__submit">Rechercher</button>  	
</form>
