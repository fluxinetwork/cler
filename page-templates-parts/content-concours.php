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
	$date_publication_resultats = get_field('date_publication_resultats', false, false);

	$start_candidatures = new DateTime($date_debut_candidatures);
	$stop_candidatures = new DateTime($date_fin_candidatures);
	$start_votes = new DateTime($date_debut_votes);
	$stop_votes = new DateTime($date_fin_votes);
	$date_resultats = new DateTime($date_publication_resultats);

	$today = date('Ymd');
?>

<div class="l-row bg-light">
	<header class="l-col l-col--content l-header">
		<time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="t-meta l-header__date"><?php echo get_the_date(); ?></time>
		<h1><?php echo get_the_title(); ?></h1>

		<div class="l-miniDashboard ">
			<div class="l-miniDashboard__row">
				<span class="l-miniDashboard__row__element"><i class="fa fa-toggle-on c-meta__meta__icon" aria-hidden="true"></i>Participation : <?php echo $start_candidatures->format('j M'); ?> - <?php echo $stop_candidatures->format('j M'); ?></span>
				<?php if( $today >= $date_debut_candidatures && $today <= $date_fin_candidatures ): ?>
					<span class="l-miniDashboard__row__element"><i class="fa fa-trophy c-meta__meta__icon" aria-hidden="true"></i>Résultats : <?php echo $date_resultats->format('j M Y'); ?></span>
					<a href="#concours" class="l-miniDashboard__row__element l-miniDashboard__row__element--btn c-btn c-btn--ghost"><i class="fa fa-user-plus c-meta__meta__icon" aria-hidden="true"></i>Participer</a>
				<?php else : ?>
					<span class="l-miniDashboard__row__element"><i class="fa fa-comments c-meta__meta__icon" aria-hidden="true"></i>Jury : <?php echo $start_votes->format('j M'); ?> - <?php echo $stop_votes->format('j M'); ?></span>
					<span class="l-miniDashboard__row__element"><i class="fa fa-trophy c-meta__meta__icon" aria-hidden="true"></i>Résultats : <?php echo $date_resultats->format('j M Y'); ?></span>
				<?php endif; ?>
			</div>
		</div>

		<?php
		if (get_field('add_image') == 1) {
			//$post_img_id = get_post_thumbnail_id();
			$post_img_id = get_field('main_image');

			if ($post_img_id) {
				$post_img_array = wp_get_attachment_image_src($post_img_id, 'large', true);
				$post_img_url = $post_img_array[0];	
				//$post_caption = get_post($post_img_id)->post_excerpt;

				$output = '<figure class="c-figure l-header__figure is-none">';
				$output .= ' <img src="'.$post_img_url.'" class="c-figure__img">';
				//$output .= ' <figcaption class="c-figure__caption">'.$post_caption.'</figcaption>';
				$output .= '</figure>';
				echo $output;
			}
		}
		?>

		<h2 class="l-header__excerpt"><?php echo get_field('fluxi_resum', false, false); ?></h2>

	</header>
</div>

<div class="l-row">
	<div class="l-col l-col--content">
		<?php the_content(); ?>
	</div>
</div>

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
