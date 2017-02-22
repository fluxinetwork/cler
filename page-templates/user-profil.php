<?php
/*
Template Name: Profil
*/
?>
<?php get_header(); ?>

<?php
	if( is_user_logged_in() ):

	global $current_user;
	$current_user = wp_get_current_user();
	$fullname = $current_user->user_firstname.' '.$current_user->user_lastname;
	$email = $current_user->user_email;
	(is_adherent_cler()) ? $adherent = true : $adherent = false;
?>

	<?php if ( get_adherent_status() == 'annulee' ) : ?>
		<div class="l-row bg-error">
			<h3 class="l-col l-col--pdM c-white t-align--c">Votre demande d'ahésion à été refusée.</h3>
		</div>
	<?php endif; ?>

	<section class="l-row bg-light">
		<div class="l-col <?php ( get_adherent_status() != 'annulee' ) ? print('no-pdBottom') : ''; ?>">
			<div class="userDashboard">
				<div class="userDashboard__infos">
					<header class="userDashboard__infos__header">
						<div>
							<span class="t-meta u-show@large">
							<?php
							if ( $adherent ) {
								echo 'Adhérent';
							} else {
								if ( get_adherent_status() == 'attente_validation' ) {
									echo 'En cours d\'adhésion';
								} else {
									echo 'Utilisateur';
								}
							}
							?>
							</span>
							<h1 class="c-section-title"><span class="u-show@small">Mes </span>informations</h1>
						</div>
						<a href="<?php echo get_the_permalink(FORM_PROFIL); ?>" class="c-btn c-btn--ghost"><i class="fa fa-pencil c-meta__meta__icon u-show@small" aria-hidden="true"></i>Modifier</a>
					</header>

					<div class="userDashboard__infos__body l-grid">
						
						<div class="l-grid__col l-center">
							<div class="l-grid__col__content l-center pd--s">
								<p class="t-fw--700"><?php echo $fullname; ?></p>
							</div>
						</div>
						<div class="l-grid__col l-center">
							<div class="l-grid__col__content l-center pd--s">
								<p class="t-break"><?php echo $email ?></p>
							</div>
						</div>
					</div>

					<footer class="userDashboard__infos__footer">
						<a href="<?php echo get_the_permalink(FORM_PROFIL); ?>?tf=mdp" class="c-link c-link--more">Modifier mot de passe</a>
					</footer>
				</div>

				<aside class="userDashboard__aside u-show@large">
					<?php include(TEMPLATEPATH.'/page-templates-parts/card-contact.php'); ?>
				</aside>
			</div>
			
			<?php if ( get_adherent_status() != 'annulee' ) : ?>

				<div class="l-col l-col--med l-grid l-center">
				<?php if ($adherent) : ?>

					<div class="l-grid__col l-center">
						<a href="<?php echo get_the_permalink(FORM_ADHESION); ?>?act=mod" class="c-btn c-btn--ghost"><i class="fa fa-pencil c-meta__meta__icon"></i>Modifier adhésion</a>
					</div>
					<div class="l-grid__col l-center">
						<a href="<?php echo get_the_permalink(FORM_ADHESION); ?>?act=rad" class="c-btn c-btn--cta"><div><i class="fa fa-refresh c-meta__meta__icon"></i>Renouveler adhésion</div></a>
					</div>

				<?php else : ?>

					<?php if ( get_adherent_status() == 'attente_validation' ) : ?>
						<a href="<?php echo get_the_permalink(FORM_ADHESION); ?>?act=mod" class="c-btn c-btn--cta"><div><i class="fa fa-pencil c-meta__meta__icon"></i>Modifier adhésion</div></a>
					<?php else : ?>
						<a href="<?php echo get_the_permalink(FORM_ADHESION); ?>?act=add" class="c-btn c-btn--cta"><div><i class="fa fa-user-plus c-meta__meta__icon"></i>Devenir adhérent</div></a>
					<?php endif; ?>

				<?php endif; ?>
				
				</div>
			<?php endif; ?>
		</div>
	</section>

	<section class="l-row bg-valid--grad">
		<div class="l-col">
			<?php include(TEMPLATEPATH.'/page-templates-parts/sliders/publications-slider.php'); ?>
		</div>
	</section>

		
	<?php include(TEMPLATEPATH.'/page-templates-parts/recus.php'); ?>


	<section class="l-row">
		<div class="l-col l-col--content">
			<h2 class="c-section-title">Publier un contenu</h2>

			<ul class="l-grid list-reset">
				<li class="l-grid__col">
					<div class="user-postLink">
						<a href="<?php echo get_the_permalink(FORM_EVENT); ?>?act=add" class="c-btn c-btn--ghost"><i class="u-show@large mgRight--xs fa fa-calendar"></i>Évènement</a>
						<span class="t-meta pdTop--s">Gratuit</span>
					</div>
				</li>
				<li class="l-grid__col">
					<div class="user-postLink">
						<a href="<?php echo get_the_permalink(FORM_OFFRE); ?>?act=add" class="c-btn c-btn--ghost"><i class="u-show@large mgRight--xs fa fa-briefcase"></i>Offre <span class="u-show@xlarge">d'</span>emploi</a>
						<span class="t-meta pdTop--s"><?php ($adherent) ? print('Gratuit') : print('Payant'); ?></span>
					</div>
				</li>
				<li class="l-grid__col">
					<div class="user-postLink">
						<a href="<?php echo get_the_permalink(FORM_FORMATION); ?>?act=add" class="c-btn c-btn--ghost"><i class="u-show@large mgRight--xs fa fa-graduation-cap"></i>Formation</a>
						<span class="t-meta pdTop--s">Gratuit</span>
					</div>
				</li>
			</ul>
		</div>
	</section>

<?php else : ?>

	<section class="l-row bg-light">
		<div class="l-col">
			<div class="c-form c-form--popin c-card">
				<div class="c-card__header">
					<h1 class="c-card__header__title">Pas si vite !</h1>
				</div>
				<?php get_template_part( 'page-templates-parts/message', 'need-login' ); ?>
				<footer class="c-card__footer">
					<a href="<?php echo get_the_permalink(CONTACT); ?>" class="c-link c-link--more">Contactez-nous</a>
				</footer>
			</div>
		</div>
	</section>

<?php endif; ?>

<?php get_footer(); ?>
