<?php
/**
 * The template part for displaying the content of concours
 */
?>

<?php 	
	$nom_prenom=$nom_structure=$mail_contact=$titre_participation=$texte_participation=$lien_video=$accepte_reglement='';
	$type_concours = get_field('type_concours');
	
	$idp = get_the_ID();
	$date_debut_candidatures = get_field('date_debut_candidatures', false, false);
	$date_fin_candidatures = get_field('date_fin_candidatures', false, false);
	$date_debut_votes = get_field('date_debut_votes', false, false);
	$date_fin_votes = get_field('date_fin_votes', false, false);
	$date_publication_resultats = get_field('date_publication_resultats', false, false);

	$today = date('Ymd');
?>

<section>
	<h1><?php the_title(); ?></h1>
	<!-- Régles et jury -->
	<?php echo 'ICI LE CONTENT ::: '.get_the_content(); ?>
</section>

<!-- Form participation concours -->	
<?php if( $today >= $date_debut_candidatures && $today <= $date_fin_candidatures ): ?>				
	<!-- **** data-idp est utilisée par le formulaire *** -->
	<!-- **** data-idp est utilisée par le formulaire *** -->
	<!-- **** data-idp est utilisée par le formulaire *** -->
	<section class="l-row bg-light"  id="concours" data-idp="<?php echo get_the_ID(); ?>">
		<div class="l-col">
			<div class="c-form c-form--large c-card">
				<?php require_once( get_template_directory() . '/page-templates-parts/forms/form-concours.php' ); ?>							
			</div>
		</div>
	</section>
<?php endif; ?>

<!-- Participations -->
<?php
	if( $today >= $date_debut_votes && $today <= $date_fin_votes ):
		if( have_rows('candidatures') ): 
			$i = 0;
			echo '<section class="participations">';
		    while ( have_rows('candidatures') ) : the_row(); 
		    	$i++; 
		    	$nb_votes = get_sub_field('nombre_votes');
				$video = get_sub_field('video_candidature');
				?>
				<div class="participation">
			        <h3><?php echo get_sub_field('titre_candidature'); ?></h3>
			        <p><?php echo get_sub_field('texte_candidature'); ?></p>
			        <div><?php echo $video; ?></div>

					<div class="rating">
						<p>Votes : <span class="js-nb-rate"><?php echo $nb_votes; ?></span></p>
				       <form class="form-rating" role="form">					       		
				       		<input type="hidden" value="<?php echo $idp; ?>" name="idp">
							<input type="hidden" value="<?php echo $i; ?>" name="idc">
							<?php wp_nonce_field( 'fluxi_rating_concours', 'fluxi_rating_concours_nonce_field' ); ?>
				       		<button type="submit" class="c-btn">Voter</button>					       		
				       </form>
			       </div>
				</div>
			<?php
		    endwhile;
			echo '</section>';
		endif;
	endif;
?>
