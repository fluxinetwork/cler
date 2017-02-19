 <?php
/**
 * The template part for displaying the form "concours" (add)
 */
?>

<form id="form-participation-concours" role="form" class="c-card__body">

	<fieldset class="c-form__fieldset">

		<legend class="c-form__legend c-form--indicateur">Je participe au concours</legend>

		<div class="c-form__fieldset__row">
			<label class="c-form__label" for="nom_prenom">Nom et prénom<span class="i-required">•</span></label>
	      	<input type="text" placeholder="" class="c-form__input" value="<?php echo $nom_prenom; ?>" name="nom_prenom" id="nom_prenom" data-validation="required">
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="nom_structure">Nom de la structure<span class="i-required">•</span></label>
	      	<input type="text" placeholder="" class="c-form__input" value="<?php echo $nom_structure; ?>" name="nom_structure" id="nom_structure">
	    </div>

		<div class="c-form__fieldset__row">
			<label class="c-form__label" for="mail_contact">Email<span class="i-required">•</span></label>
	      	<input type="text" placeholder="" class="c-form__input" value="<?php echo $mail_contact; ?>" name="mail_contact" id="mail_contact" data-validation="email">
	    </div>

		<?php // Cler Obscur
			if( $type_concours == 'cler_obscur'):?>

			<div class="c-form__fieldset__row">
				<label class="c-form__label" for="titre_participation">Titre du court métrage<span class="i-required">•</span></label>
		      	<input type="text" placeholder="" class="c-form__input" value="<?php echo $titre_participation; ?>" name="titre_participation" id="titre_participation" data-validation="required">
		    </div>

		    <div class="c-form__fieldset__row">
		    	<label class="c-form__label" for="texte_participation">Synopsis et intentions<span class="i-required">•</span></label>
		      	<textarea rows="6" placeholder="" class="c-form__input c-form__textarea" name="texte_participation" id="texte_participation" data-validation="required"><?php echo $texte_participation; ?></textarea>
		    </div>

		    <div class="c-form__fieldset__row">
		    	<label class="c-form__label" for="lien_video">Lien vers votre vidéo en ligne<span class="i-required">•</span></label>
		      	<input type="text" placeholder="" class="c-form__input" value="<?php echo $lien_video; ?>" name="lien_video" id="lien_video" data-validation="url">
		    </div>
		<?php endif; ?>

		<?php // Haiku
			if( $type_concours == 'haiku'):?>

			<div class="c-form__fieldset__row">
				<label class="c-form__label" for="titre_participation">Titre du Haïku<span class="i-required">•</span></label>
		      	<input type="text" placeholder="" class="c-form__input" value="<?php echo $titre_participation; ?>" name="titre_participation" id="titre_participation" data-validation="required">
		    </div>

		    <div class="c-form__fieldset__row">
		    	<label class="c-form__label" for="texte_participation">Votre Haïku<span class="i-required">•</span></label>
		      	<textarea rows="6" placeholder="" class="c-form__input c-form__textarea" name="texte_participation" id="texte_participation" data-validation="required"><?php echo $texte_participation; ?></textarea>	
		    </div>

		<?php endif; ?>

		<div class="c-form__fieldset__row">
			<label for="accepte_reglement" class="c-form__label c-form__label--checkbox">				
				<input class="c-form__label__checkbox" type="checkbox" name="accepte_reglement" id="accepte_reglement" value="1" data-validation="required">
				<div class="c-form__label__txt">J'ai pris connaissance et j'accepte le règlement du concours<span class="i-required">•</span></div>
			</label>
	    </div>
    </fieldset>

    <input type="hidden" value="5931886351" name="toky_toky">
    <input type="hidden" value="<?php echo get_the_ID(); ?>" name="idp">
    <input type="hidden" value="<?php echo get_the_title(); ?>" name="titre_concours">
    <input type="hidden" value="<?php echo get_the_permalink(); ?>" name="link_concours">
    <?php wp_nonce_field( 'fluxi_participation_concours', 'fluxi_participation_concours_nonce_field' ); ?>

    <div class="c-form__notify js-notify"></div>

	<div class="c-form__submit no-pdBottom">
    	<button type="submit" id="submit-participation-concours" class="c-btn"><i class="fa fa-plus" aria-hidden="true"></i> Participer au concours</button>
    </div>

</form>

