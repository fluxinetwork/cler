<?php
/**
 * The template part for displaying the content of concours
 */
?>

<?php 	
	$date_publi = get_the_date('d M Y');

	$nom_prenom=$nom_structure=$mail_contact=$titre_participation=$texte_participation=$lien_video=$accepte_reglement='';
	$type_concours = get_field('type_concours');
	
	$idp = get_the_ID();
	$date_debut_candidatures = get_field('date_debut_candidatures', false, false);
	$date_fin_candidatures = get_field('date_fin_candidatures', false, false);
	$date_debut_votes = get_field('date_debut_votes', false, false);
	$date_fin_votes = get_field('date_fin_votes', false, false);
	$date_publication_resultats = get_field('date_publication_resultats');


	$today = date('Ymd');

	$start = new DateTime($date_debut_candidatures);
	$date_start = $start->format('Ymd');
	$stop = new DateTime($date_fin_candidatures);
	$date_stop = $stop->format('Ymd');

	$start_votes = new DateTime($date_debut_votes);
	$date_start_votes = $start_votes->format('Ymd');
	$stop_votes = new DateTime($date_fin_votes);
	$date_stop_votes = $stop_votes->format('Ymd');
?>

<div class="l-row bg-light">
	<header class="l-col l-col--content l-intro">
		<h1><?php echo get_the_title(); ?></h1>
		<div class="c-meta l-intro__meta">
			<div class="c-dash"></div>
		</div>

		<div class="l-miniDashboard ">
			<div class="l-miniDashboard__row">
				
				<?php if( $today >= $date_start && $today <= $date_stop ): // PHASE PARTICPATION ?> 
					<span class="l-miniDashboard__row__element"><i class="fa fa-toggle-on c-meta__meta__icon" aria-hidden="true"></i>Participation : <?php echo $start->format('d/m/y'); ?> - <?php echo $stop->format('d/m/y'); ?></span>
					<span class="l-miniDashboard__row__element"><i class="fa fa-trophy c-meta__meta__icon" aria-hidden="true"></i>Résultats : <?php echo $date_publication_resultats; ?></span>
					<a href="#concours" class="l-miniDashboard__row__element l-miniDashboard__row__element--btn c-btn c-btn--ghost js-scroll-to"><i class="fa fa-user-plus c-meta__meta__icon" aria-hidden="true"></i>Participer</a>

				<?php elseif( $today >= $date_start_votes && $today <= $date_stop_votes ): // PHASE VOTE ?>
					<span class="l-miniDashboard__row__element"><i class="fa fa-comments c-meta__meta__icon" aria-hidden="true"></i>Jury : <?php echo $start_votes->format('d/m/y'); ?> - <?php echo $stop_votes->format('d/m/y'); ?></span>
					<span class="l-miniDashboard__row__element"><i class="fa fa-trophy c-meta__meta__icon" aria-hidden="true"></i>Résultats : <?php echo $date_publication_resultats; ?></span>
					<a href="#voter" class="l-miniDashboard__row__element l-miniDashboard__row__element--btn c-btn c-btn--ghost js-scroll-to"><i class="fa fa-heart c-meta__meta__icon" aria-hidden="true"></i>Voter</a>

				<?php else : ?>
					<span class="l-miniDashboard__row__element"><i class="fa fa-toggle-on c-meta__meta__icon" aria-hidden="true"></i>Participation : <?php echo $start->format('d/m/y'); ?> - <?php echo $stop->format('d/m/y'); ?></span>
					<span class="l-miniDashboard__row__element"><i class="fa fa-comments c-meta__meta__icon" aria-hidden="true"></i>Jury : <?php echo $start_votes->format('d/m/y'); ?> - <?php echo $stop_votes->format('d/m/y'); ?></span>
					<span class="l-miniDashboard__row__element"><i class="fa fa-trophy c-meta__meta__icon" aria-hidden="true"></i>Résultats : <?php echo $date_publication_resultats; ?></span>
				<?php endif; ?>
			</div>
		</div>

		<?php get_template_part( 'page-templates-parts/content', 'intro'); ?>

		<?php get_template_part( 'page-templates-parts/share' ); ?>
	</header>
</div>

<div class="l-row">
	<div class="l-col l-col--content">
		<?php the_content(); ?>
	</div>
</div>

<!-- Participations -->
<?php
	if( $today >= $date_start_votes && $today <= $date_stop_votes || is_user_logged_in() ):
		if( have_rows('candidatures') ): 
			$i = 0;
			echo '<section class="l-row participations bg-white" id="voter">';
			echo '<div class="l-col l-col--content"><h2 class="fc_title">Liste des participations</h2></div>';
			echo '<div class="l-col no-pdTop fc">';

			echo '<ul class="l-contest">';
		    while ( have_rows('candidatures') ) : the_row(); 
		    	$i++; 
		    	$nb_votes = get_sub_field('nombre_votes');
		    	$nb_votes_label = 'vote';
		    	if ( $nb_votes > 0 ) {
		    		$nb_votes_label == 'votes';
		    	}

				$video = get_sub_field('video_candidature');

				$nom = get_sub_field('nom_prenom');
				$structure = false;
				if ( get_sub_field('nom_structure') ) {
					$structure = get_sub_field('nom_structure');
				}
				?>
				<li class="l-contest__entry">
					<article class="c-haiku participation">
						<div class="c-haiku__content">
							<p class="c-haiku__content__txt"><?php echo get_sub_field('texte_candidature'); ?></p>
				        	<!-- <div><?php //echo $video; ?></div>	 -->
						</div>
				        
				        <div class="c-haiku__vote">
				       	 	<form class="form-rating c-haiku__vote__button" role="form">					       		
					       		<input type="hidden" value="<?php echo $idp; ?>" name="idp">
								<input type="hidden" value="<?php echo $i; ?>" name="idc">
								<?php wp_nonce_field( 'fluxi_rating_concours', 'fluxi_rating_concours_nonce_field' ); ?>
					       		<button type="submit" class="c-btn c-btn--ghost"><i class="fa fa-heart c-meta__meta__icon" aria-hidden="true"></i>Voter</button>			       		
					       	</form>
							<p class="c-haiku__vote__count"><span class="js-nb-rate"><?php echo $nb_votes; ?></span> <?php echo $nb_votes_label; ?></p>
						</div>
			       </article>
				</li>
			<?php
		    endwhile;
			echo '</ul>';
			echo '</div>';
			echo '</section>';
		endif;
	endif;
?>

<!-- Form participation concours -->	
<?php if( $today >= $date_debut_candidatures && $today <= $date_fin_candidatures ): ?>
	<?php //data-idp est utilisée par le formulaire ?>
	<section class="l-row bg-valid--grad"  id="concours" data-idp="<?php echo get_the_ID(); ?>">
		<div class="l-col">
			<div class="c-form c-form--large c-card">
				<?php require_once( get_template_directory() . '/page-templates-parts/forms/form-concours.php' ); ?>							
			</div>
		</div>
	</section>
<?php endif; ?>

