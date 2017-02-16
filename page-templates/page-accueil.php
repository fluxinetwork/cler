<?php
/*
Template Name: Accueil
*/
?>
<?php get_header(); ?>

<section class="l-row bg-light hp-hero">
	<div class="l-col l-hero">
		<div class="hp-hero__content">
			<h1 class="l-hero__title">Réseau pour la<br class="u-show@small"> transition énergétique</h1>
			<h2 class="l-hero__subtitle"><?php echo get_field('fluxi_resum', false, false); ?></h2>
			<div class="l-hero__btn">
			<?php
			if (!is_user_logged_in()) :
				echo '<a href="'.get_the_permalink(MAP_ADHERENT).'" class="c-btn c-btn--cta"><span><i class="fa fa-map mgRight--xs"></i>Explorer le réseau</span></a>';
			else :
				if (!is_adherent_cler()) :
					echo '<a href="'.get_the_permalink(FORM_ADHESION).'?act=add" class="c-btn c-btn--cta"><span><i class="fa fa-user-plus mgRight--xs"></i>Devenir adhérent</span></a>';
				else :
					echo '<a href="'.get_the_permalink(HUB_ADHERENT).'?act=add" class="c-btn c-btn--cta"><span><i class="fa fa-users mgRight--xs"></i>Espace adhérents</span></a>';
				endif;
			endif;
			?>

			</div>
		</div>

		<div class="hp-portraits">
			<?php
				for ($i=1; $i<6; $i++) {
					echo '<div class="hp-portraits__row">';
					for ($j=0; $j<$i+2; $j++) {
						echo '<div class="hp-portraits_img"></div>';
					}
					echo '</div>';
				}
			?>
		</div>	
	</div>
</section>

<section class="l-row bg-main--grad">
	<div class="l-col">
		<?php get_template_part( 'page-templates-parts/sliders/hp-actus' ); ?>
	</div>
</section>

<section class="l-row">
	<div class="l-col"> 
		<h2 class="c-section-title">Vos espaces dédiés</h2>
		<div class="l-grid l-grid--2col grid-espaces-dedies">
			<div class="l-grid__col">
				<a href="<?php echo get_the_permalink(HUB_ADHERENT); ?>" class="c-tile c-tile--round c-tile--noBorder">
					<div class="c-tile__content">
						<i class="fa fa-star c-tile__content__icon" aria-hidden="true"></i>
						<span class="c-link">Adhérents</span>
					</div>
				</a>
			</div>
			<div class="l-grid__col">
				<a href="<?php echo get_the_permalink(HUB_CITOYEN); ?>" class="c-tile c-tile--round c-tile--noBorder">
					<div class="c-tile__content">
						<i class="fa fa-users c-tile__content__icon" aria-hidden="true"></i>
						<span class="c-link">Citoyens</span>
					</div>
				</a>
			</div>
			<div class="l-grid__col">
				<a href="<?php echo get_the_permalink(HUB_PRESSE); ?>" class="c-tile c-tile--round c-tile--noBorder">
					<div class="c-tile__content">
						<i class="fa fa-microphone c-tile__content__icon" aria-hidden="true"></i>
						<span class="c-link">Presse</span>
					</div>
				</a>
			</div>
			<div class="l-grid__col">
				<a href="<?php echo get_the_permalink(HUB_ELU); ?>" class="c-tile c-tile--round c-tile--noBorder">
					<div class="c-tile__content">
						<i class="fa fa-handshake-o c-tile__content__icon" aria-hidden="true"></i>
						<span class="c-link">Élus</span>
					</div>
				</a>
			</div>
		</div>
	</div>
</section>

<section class="l-row bg-accent--grad">
	<div class="l-col">
		<?php get_template_part( 'page-templates-parts/sliders/hp-offres' ); ?>
	</div>
</section>

<section class="l-row">
	<div class="l-col">
		<h2 class="c-section-title">Nos actions</h2>
		<div class="l-grid l-grid--2col grid-actions">
			<div class="l-grid__col">
				<a href="<?php echo get_the_permalink(PAGE_SLIME); ?>" class="c-tile c-tile--rectangle c-tile--hover action1">
					<div class="c-tile__content">
						<span class="c-tile__content__title">SLIME</span>
						<span class="c-tile__content__subtitle">Services Locaux d'Intervention pour la Maîtrise de l'Énergie</span>
					</div>
				</a>
			</div>
			<div class="l-grid__col">
				<a href="<?php echo get_the_permalink(PAGE_TEPOS); ?>" class="c-tile c-tile--rectangle c-tile--hover action2">
					<div class="c-tile__content">
						<span class="c-tile__content__title">TEPOS</span>
						<span class="c-tile__content__subtitle">TErritoires à énergie POSitive</span>
					</div>
				</a>
			</div>
			<div class="l-grid__col">
				<a href="<?php echo get_the_permalink(PAGE_RAPPEL); ?>" class="c-tile c-tile--rectangle c-tile--hover action3">
					<div class="c-tile__content">
						<span class="c-tile__content__title">RAPPEL</span>
						<span class="c-tile__content__subtitle">Réseau des Acteurs de la Pauvreté et de la Précarité Energétique dans le Logement</span>
					</div>
				</a>
			</div>
			<div class="l-grid__col">
				<div class="c-tile c-tile--rectangle c-tile--noBorder">
					<div class="c-tile__content">
						<a href="<?php echo get_the_permalink(PAGE_ACTIONS); ?>" class="c-link">Voir tout</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="l-row">
	<div class="l-col l-grid hp_adhesion">
		<div class="l-grid__col u-show@large">
		<?php
			for ($i=1; $i<4; $i++) {
				echo '<div class="hp-portraits__row">';
				for ($j=0; $j<$i+1; $j++) {
					echo '<div class="hp-portraits_img"></div>';
				}
				echo '</div>';
			}
		?>
		</div>
		<div class="l-grid__col l-flexCol l-flex--center">
			<h2 class="c-section-title">Devenir adhérent</h2>
			<p class="hp-adherer-txt">Adhérer au réseau du CLER, c’est avant tout adhérer à des valeurs et intégrer un réseau partageant des objectifs communs. Mais c’est aussi bénéficier de nombreux avantages…</p>
			<a href="<?php echo get_the_permalink(PAGE_ADHEREZ); ?>" class="c-btn c-btn--cta mgTop--l"><span>Ça m'interesse !</span></a>
		</div>
	</div>
</section>

<?php get_footer(); ?>