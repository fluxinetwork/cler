 <?php
/**
 * The template part for displaying the form "concours" (add)
 */
?>
<div class="form">
	<form id="form-participation-concours" role="form" data-idp="<?php echo get_the_ID(); ?>">
		<fieldset>
			<legend>Je participe au concours</legend>
			<div class="form__row">	      
		      <input type="text" placeholder="" class="js-input-effect input-effect--2" value="<?php echo $nom_prenom; ?>" name="nom_prenom" id="nom_prenom" data-validation="required">
		      <label for="nom_prenom">Nom et prénom<i class="i-required">*</i></label>
		      <span class="focus-bg"></span>
		    </div>
			
		    <div class="form__row">	      
		      <input type="text" placeholder="" class="js-input-effect input-effect--2" value="<?php echo $nom_structure; ?>" name="nom_structure" id="nom_structure">
		      <label for="nom_structure">Nom de la structure<i class="i-required">*</i></label>
		      <span class="focus-bg"></span>
		    </div>

			<div class="form__row">	      
		      <input type="text" placeholder="" class="js-input-effect input-effect--2" value="<?php echo $mail_contact; ?>" name="mail_contact" id="mail_contact" data-validation="email">
		      <label for="mail_contact">Email<i class="i-required">*</i></label>
		      <span class="focus-bg"></span>
		    </div>

			<?php // Cler Obscur
				if( $type_concours == 'cler_obscur'):?>

				<div class="form__row">		      
			      <input type="text" placeholder="" class="js-input-effect input-effect--2" value="<?php echo $titre_participation; ?>" name="titre_participation" id="titre_participation" data-validation="required">
			      <label for="titre_participation">Titre du court métrage<i class="i-required">*</i></label>
			      <span class="focus-bg"></span>
			    </div>

			    <div class="form__row">		      
			      <textarea rows="6" placeholder="" class="js-input-effect input-effect--2" name="texte_participation" id="texte_participation" data-validation="required"><?php echo $texte_participation; ?></textarea>
			      <label for="texte_participation">Synopsis et intentions<i class="i-required">*</i></label>
			      <span class="focus-bg"></span>
			    </div>
				
			    <div class="form__row">		      
			      <input type="text" placeholder="" class="js-input-effect input-effect--2" value="<?php echo $lien_video; ?>" name="lien_video" id="lien_video" data-validation="url">
			      <label for="lien_video">Lien vers votre vidéo en ligne<i class="i-required">*</i></label>
			      <span class="focus-bg"></span>
			    </div>
			<?php endif; ?>

			<?php // Haiku
				if( $type_concours == 'haiku'):?>

				<div class="form__row">		      
			      <input type="text" placeholder="" class="js-input-effect input-effect--2" value="<?php echo $titre_participation; ?>" name="titre_participation" id="titre_participation" data-validation="required">
			      <label for="titre_participation">Titre du Haïku<i class="i-required">*</i></label>
			      <span class="focus-bg"></span>
			    </div>

			    <div class="form__row">		      
			      <textarea rows="6" placeholder="" class="js-input-effect input-effect--2" name="texte_participation" id="texte_participation" data-validation="required"><?php echo $texte_participation; ?></textarea>
			      <label for="texte_participation">Votre Haïku<i class="i-required">*</i></label>
			      <span class="focus-bg"></span>
			    </div>			
			  
			<?php endif; ?>

			<div class="form__group">							 
				<label for="accepte_reglement" class="form__control form__control--checkbox">
					J'ai pris connaissance et j'accepte le règlement du concours<i class="i-required">*</i>
					<input type="checkbox" name="accepte_reglement" id="accepte_reglement" value="1" data-validation="required">
					<div class="form__control__indicator"></div>
				</label>		 
		    </div>
	    </fieldset> 

	    <input type="hidden" value="5931886351" name="toky_toky">
	    <input type="hidden" value="<?php echo get_the_ID(); ?>" name="idp">
	    <input type="hidden" value="<?php echo get_the_title(); ?>" name="titre_concours">
	    <input type="hidden" value="<?php echo get_the_permalink(); ?>" name="link_concours">
	    <?php wp_nonce_field( 'fluxi_participation_concours', 'fluxi_participation_concours_nonce_field' ); ?>

	    <div class="notify"></div>

		<div class="form__buttons">
	    	<button type="submit" id="submit-participation-concours" class="form__submit">Participer au concours</button>
	    </div>

	</form>	 	  
	    
</div> 