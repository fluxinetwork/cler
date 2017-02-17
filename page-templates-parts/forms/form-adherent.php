 <?php
/**
 * The template part for displaying the form "adhèrent" (add/re-add/update)
 */
?>

<div class="c-card__header">
	<h1 class="c-card__header__title"><?php echo $page_title; ?><br><span>Rejoignez notre réseau !</span></h1>
</div>

<form id="form-manage-adherent" role="form" class="c-card__body">
	<fieldset class="c-form__fieldset">
		<legend class="c-form__legend c-form--indicateur">Votre structure</legend>

		<div class="c-form__fieldset__row">
			<label class="c-form__label" for="nom_structure">Nom de la structure<span class="i-required">•</span></label>
	      	<input type="text" name="nom_structure" id="nom_structure" value="<?php echo $nom_structure; ?>" placeholder="" data-validation="required" class="c-form__input">	      
	    </div>

	    <div class="c-form__fieldset__row">
			<label class="c-form__label" for="type_structure">Type de structure<span class="i-required">•</span></label>
			<select name="type_structure" id="type_structure" data-validation="required" class="c-form__select">
				<option disabled selected value="">Faites votre choix</option>
				<option value="entreprise" <?php if($type_structure=='entreprise')echo 'selected';?>>Entreprise</option>
				<option value="association" <?php if($type_structure=='association')echo 'selected';?>>Association</option>
				<option value="collectivite" <?php if($type_structure=='collectivite')echo 'selected';?>>Collectivité</option>
				<option value="formation" <?php if($type_structure=='formation')echo 'selected';?>>Organisme de formation</option>
			</select>
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="adresse">Adresse<span class="i-required">•</span></label>
	     	<input type="text" placeholder="" value="<?php echo $adresse; ?>" name="adresse" id="adresse" data-validation="required" class="c-form__input">
	    </div>
		
		<div class="c-form__fieldset__flexrow c-form__fieldset__flexrow--asy">
			<div class="c-form__fieldset__row">
				<label class="c-form__label" for="code_postal">Code postal<span class="i-required">•</span></label>
		     	<input type="text" placeholder="" maxlength="5" value="<?php echo $code_postal; ?>" name="code_postal" id="code_postal" data-validation="number" class="c-form__input">
		    </div>

		    <div class="c-form__fieldset__row">
		    	<label class="c-form__label" for="ville">Ville<span class="i-required">•</span></label>
		    	<input type="text" placeholder="" value="<?php echo $ville; ?>" name="ville" id="ville" data-validation="required" class="c-form__input">
		    </div>
	    </div>

	</fieldset>

	<fieldset class="c-form__fieldset">
		<legend class="c-form__legend c-form--indicateur">Contact</legend>

		<div class="c-form__fieldset__flexrow">
    		<div class="c-form__fieldset__row">
		     	<label class="c-form__label" for="nom_contact1">Nom<span class="i-required">•</span></label>
		     	<input type="text" placeholder="" value="<?php echo $nom_contact1; ?>" name="nom_contact1" id="nom_contact1" data-validation="required" class="c-form__input">
		    </div>

		    <div class="c-form__fieldset__row">
		    	<label class="c-form__label" for="prenom_contact1">Prénom<span class="i-required">•</span></label>
		    	<input type="text" placeholder="" value="<?php echo $prenom_contact1; ?>" name="prenom_contact1" id="prenom_contact1" data-validation="required" class="c-form__input">
		    </div>
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="fonction_contact1">Fonction<span class="i-required">•</span></label>
	    	<input type="text" placeholder="" value="<?php echo $fonction_contact1; ?>" name="fonction_contact1" id="fonction_contact1" data-validation="required" class="c-form__input">
	    </div>

		<div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="email_contact1">Email<span class="i-required">•</span></label>
	    	<input type="text" placeholder="" value="<?php echo $email_contact1; ?>" name="email_contact1" id="email_contact1" data-validation="email" class="c-form__input">
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="telephone_contact1">Téléphone<span class="i-required">•</span></label>
	    	<input type="text" maxlength="14" placeholder="" value="<?php echo $telephone_contact1; ?>" name="telephone_contact1" id="telephone_contact1" data-validation="required" class="c-form__input">
	    </div>

	    <div class="c-form__fieldset__row">
			<label class="c-form__label--checkbox" for="add_contact">
				<input class="c-form__label__checkbox" type="checkbox" name="add_contact" id="add_contact" value="1" <?php if($add_contact=='1')echo 'checked'; ?>>
				<div class="c-form__label__txt t-fw--700">Ajouter un contact secondaire</div>
			</label>
	    </div>

		<div class="js-contact2" style="display:none">
			<div class="c-form__fieldset__flexrow">
				<div class="c-form__fieldset__row">
			    	<label class="c-form__label" for="nom_contact2">Nom<span class="i-required">•</span></label>
			    	<input type="text" placeholder="" value="<?php echo $nom_contact2; ?>" name="nom_contact2" id="nom_contact2" data-validation="required" data-validation-depends-on="add_contact" class="c-form__input">
			    </div>

			    <div class="c-form__fieldset__row">
			    	<label class="c-form__label" for="prenom_contact2">Prénom<span class="i-required">•</span></label>
			    	<input type="text" placeholder="" value="<?php echo $prenom_contact2; ?>" name="prenom_contact2" id="prenom_contact2" data-validation="required" data-validation-depends-on="add_contact" class="c-form__input">
			    </div>
		    </div>

		    <div class="c-form__fieldset__row">
		    	 <label class="c-form__label" for="fonction_contact2">Fonction<span class="i-required">•</span></label>
		    	<input type="text" placeholder="" value="<?php echo $fonction_contact2; ?>" name="fonction_contact2" id="fonction_contact2" data-validation="required" data-validation-depends-on="add_contact" class="c-form__input">
		    </div>

			<div class="c-form__fieldset__row">
		    	 <label class="c-form__label" for="email_contact2">Email<span class="i-required">•</span></label>
		    	<input type="text" placeholder="" value="<?php echo $email_contact2; ?>" name="email_contact2" id="email_contact2" data-validation="email" data-validation-depends-on="add_contact" class="c-form__input">
		    </div>

		    <div class="c-form__fieldset__row">
		    	 <label class="c-form__label" for="telephone_contact2">Téléphone<span class="i-required">•</span></label>
		    	<input type="text" maxlength="14" placeholder="" value="<?php echo $telephone_contact2; ?>" name="telephone_contact2" id="telephone_contact2" data-validation="required" data-validation-depends-on="add_contact" class="c-form__input">
		    </div>
		</div>

	</fieldset>

	<fieldset class="c-form__fieldset">
		<legend class="c-form__legend c-form--indicateur">Vos actions, vos attentes et vos motivations</legend>

		<div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="activites_territoire">Quelles sont les activités de votre structure ou de votre territoire sur l’énergie ?<span class="i-required">•</span></label>
	    	<textarea rows="6" placeholder="" name="activites_territoire" id="activites_territoire" data-validation="required" class="c-form__input c-form__textarea"><?php echo $activites_territoire; ?></textarea>
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="attente_du_reseau">Qu’attendez-vous du réseau ?<span class="i-required">•</span></label>
	    	<textarea rows="6" placeholder="" name="attente_du_reseau" id="attente_du_reseau" data-validation="required" class="c-form__input c-form__textarea"><?php echo $attente_du_reseau; ?></textarea>
	    </div>

		<div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="contribuer_au_reseau">De quelle manière souhaitez-vous contribuer au réseau ?<span class="i-required">•</span></label>
	    	<textarea rows="6" placeholder="" name="contribuer_au_reseau" id="contribuer_au_reseau" data-validation="required" class="c-form__input c-form__textarea"><?php echo $contribuer_au_reseau; ?></textarea>
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="connu_cler">Comment avez-vous connu le CLER ?<span class="i-required">•</span></label>
	    	<textarea rows="6" placeholder="" name="connu_cler" id="connu_cler" data-validation="required" class="c-form__input c-form__textarea"><?php echo $connu_cler; ?></textarea>
	    </div>

	    <div class="c-form__fieldset__row">
	      	<label class="c-form__label" for="reseaux_cler">Quels réseaux spécifiques animés par le CLER souhaitez-vous rejoindre ?<span class="i-required">•</span></label>
	      	<label class="c-form__label c-form__label--checkbox" for="reseaux_cler_0">
	      		<input class="c-form__label__checkbox" type="checkbox" name="reseaux_cler[]" value="rappel" id="reseaux_cler_0" <?php if(!empty($reseaux_cler) && in_array('rappel',$reseaux_cler))echo 'checked'; ?>>		       
	      		<div class="c-form__label__txt">RAPPEL <small>(Réseau des acteurs de la pauvreté et de la précarité énergétique dans le logement)</small></div>
	      	</label>
	      	<label class="c-form__label c-form__label--checkbox" for="reseaux_cler_1">
	      		<input class="c-form__label__checkbox" type="checkbox" name="reseaux_cler[]" value="tepos" id="reseaux_cler_1" <?php if(!empty($reseaux_cler) && in_array('tepos',$reseaux_cler))echo 'checked'; ?>>
	      		<div class="c-form__label__txt">Réseau TEPOS <small>(Territoires à énergie positive)</small></div>
	        </label>
	      	<label class="c-form__label c-form__label--checkbox" for="reseaux_cler_2">
	      		<input class="c-form__label__checkbox" type="checkbox" name="reseaux_cler[]" value="formateree" id="reseaux_cler_2" <?php if(!empty($reseaux_cler) && in_array('formateree',$reseaux_cler))echo 'checked'; ?>>
	      		<div class="c-form__label__txt">Format’eree <small>(Organismes de formation énergies renouvelables et efficacité énergétique)</small></div>
	        </label>
	      	<label class="c-form__label c-form__label--checkbox" for="reseaux_cler_3">
	      		<input class="c-form__label__checkbox" type="checkbox" name="reseaux_cler[]" value="eie" id="reseaux_cler_3" <?php if(!empty($reseaux_cler) && in_array('eie',$reseaux_cler))echo 'checked'; ?>>
	      		<div class="c-form__label__txt">Commission EIE <small>(Espaces Info Energies)</small></div>
	        </label>
	    </div>

	</fieldset>
	
	<div class="js-tepos" style="display:none">
    	<fieldset class="c-form__fieldset">
    		<legend class="c-form__legend c-form--indicateur c-form__fieldset__row">Réseau Territoires à énergie positive (TEPOS)</legend>

    		<div class="c-form__fieldset__flexrow">
    			<div class="c-form__fieldset__row">
			    	<label class="c-form__label" for="nom_elu">Nom de l'élu référent</label>
			    	<input type="text" placeholder="" value="<?php echo $nom_elu; ?>" name="nom_elu" id="nom_elu" class="c-form__input">
		    	</div>

			    <div class="c-form__fieldset__row">
			    	<label class="c-form__label" for="prenom_elu">Prénom de l'élu référent</label>
			    	<input type="text" placeholder="" value="<?php echo $prenom_elu; ?>" name="prenom_elu" id="prenom_elu" class="c-form__input">
			    </div>
		    </div>

		    <div class="c-form__fieldset__row">
		    	<label class="c-form__label" for="fonction_elu">Fonction de l'élu référent</label>
		    	<input type="text" placeholder="" value="<?php echo $fonction_elu; ?>" name="fonction_elu" id="fonction_elu" class="c-form__input">
		    </div>

			<div class="c-form__fieldset__row">
		    	<label class="c-form__label" for="email_elu">Email de l'élu référent</label>
		    	<input type="text" placeholder="" value="<?php echo $email_elu; ?>" name="email_elu" id="email_elu" class="c-form__input">
		    </div>

		    <div class="c-form__fieldset__row">
		    	<label class="c-form__label" for="telephone_elu">Téléphone de l'élu référent</label>
		    	<input type="text" maxlength="10" placeholder="" value="<?php echo $telephone_elu; ?>" name="telephone_elu" id="telephone_elu" class="c-form__input">
		    </div>

		    <div class="c-form__fieldset__row">		  
		    	<p>Votre candidature au réseau TEPOS doit être parrainé par un Territoire à énergie positive déjà membre. Si vous n’avez pas de parrain, écrivez "je n’ai pas de parrain".</p>  
		    	<label class="c-form__label" for="nom_parrain">Qui est votre parrain ?</label>
		    	<input type="text" placeholder="" value="<?php echo $nom_parrain; ?>" name="nom_parrain" id="nom_parrain" class="c-form__input">
		    </div>		    

		    <div class="c-form__fieldset__row">
				<p>L'appartenance au réseau TEPOS correspond à des valeurs et un engagement particuliers qui sont résumés dans une charte.<span class="i-required">•</span></p>
				<label class="c-form__label c-form__label--checkbox" for="accepte_charte_energie_positive">
					<input type="checkbox" name="accepte_charte_energie_positive" id="accepte_charte_energie_positive" data-validation="required" value="1" data-validation-depends-on="reseaux_cler[]" data-validation-depends-on-value="tepos" <?php if($accepte_charte_energie_positive=='1')echo 'checked'; ?> class="c-form__label__checkbox">
					<div class="c-form__label__txt">Je déclare avoir pris connaissance de la charte du Réseau Territoires à énergie positive<span class="i-required">•</span></div>
				</label>
				<a href="<?php echo get_the_permalink(CHARTE_CLER); ?>" class="c-link c-link--shy mgTop--xs">Lire la charte</a>
		    </div>
    	</fieldset>
	</div>

	<fieldset class="c-form__fieldset">
		<legend class="c-form__legend c-form--indicateur">Cotisation</legend>
		<div class="c-form__fieldset__row c-form--indicateur">
    		<p><span class="t-fw--700">Pour les entreprises, les associations ou les organismes de formation</span>  le montant de la cotisation au CLER correspond à 1/1000ème du chiffre d'affaires ou du budget.</p>

    		<p><span class="t-fw--700">Pour les collectivités</span>, le montant de la cotisation s'élève à :</p>
    		<ul class="t-list">
	    		<li><span class="t-fw--700">Région :</span> 0.1 centimes d'€/habitant</li>
	    		<li><span class="t-fw--700">Département :</span> 0.18 centimes d'€/habitant</li>
	    		<li><span class="t-fw--700">Syndicat départemental :</span> 500 € + 0.1 centimes d'€/habitant</li>
	    		<li><span class="t-fw--700">Autre :</span> 0.8 centimes d'€/habitant</li>
    		</ul>

    		<p class="t-fw--700 c-valid">Cotisation maximum :</p>
			<ul class="t-list">
	    		<li><span class="t-fw--700">Entreprises, organismes de formation et collectivités locales :</span> 2500€</li>
	    		<li><span class="t-fw--700">Associations :</span> 1000€</li>
    		</ul>

    	 	<p><span class="c-valid t-fw--700">Cotisation minimum de 160 €</span> avec montant final arrondi à l'entier inférieur.</p>

    		<p><span class="t-fw--700">Le montant de votre cotisation inclut l’abonnement au trimestriel CLER Infos</span>. Si vous souhaitez recevoir plusieurs exemplaires de la revue à un tarif préférentiel réservé à nos adhérents, veuillez nous contacter.</p>

    		<p><span class="t-fw--700">Si vous souhaitez faire un don au CLER, vous pouvez l'ajouter au montant de votre adhésion. Pour les structures fiscalisées, 60 % du montant de votre adhésion/don est déductibles de vos impôts.</p>
		</div>

		<div class="c-form__fieldset__row">
			<label class="c-form__label" for="annee_cotisation">Année de cotisation<span class="i-required">•</span></label>
			<select name="annee_cotisation" id="annee_cotisation" data-validation="required" class="c-form__select">
		        <?php echo $fields_annees_cotisation; ?>
		    </select>
		</div>

		<div class="c-form__fieldset__row">
			<label class="c-form__label" for="montant_cotisation">Montant de votre cotisation<span class="i-required">•</span></label>
			<input type="text" placeholder="" name="montant_cotisation" id="montant_cotisation" data-validation="number" data-validation-allowing="range[160;500000]" value="<?php echo $montant_cotisation; ?>" class="c-form__input">
		</div>

		<div class="c-form__fieldset__row">
			<label class="c-form__label c-form__label--checkbox" for="structure_fiscalisee">
				<input type="checkbox" name="structure_fiscalisee" id="structure_fiscalisee" value="1" <?php if($structure_fiscalisee=='1')echo 'checked'; ?> class="c-form__label__checkbox">
				<div class="c-form__label__txt">Si vous êtes une structure fiscalisée, souhaitez-vous recevoir un reçu d’adhésion ou de don ?</div>
			</label>
	    </div>

	</fieldset>

	<fieldset class="c-form__fieldset">
		<legend class="c-form__legend c-form--indicateur">Réglement et charte</legend>

		<div class="c-form__fieldset__row">
			<label class="c-form__label  c-form__label--checkbox" for="reglement_cler">
				<input type="checkbox" name="reglement_cler" id="reglement_cler" value="1" data-validation="required" <?php if($reglement_cler=='1')echo 'checked'; ?> class="c-form__label__checkbox">
				<div class="c-form__label__txt">Je déclare avoir pris connaissance du règlement intérieur du CLER<span class="i-required">•</span></div>
			</label>
			<a href="<?php echo get_the_permalink(REGLEMENT_CLER); ?>" class="c-link c-link--shy mgTop--xs" target="_blank">Lire le réglement</a>
	    </div>

		<div class="c-form__fieldset__row">
			<label class="c-form__label c-form__label--checkbox" for="charte_adherents">
				<input type="checkbox" name="charte_adherents" id="charte_adherents" value="1" data-validation="required" <?php if($charte_adherents=='1')echo 'checked'; ?> class="c-form__label__checkbox">
				<div class="c-form__label__txt">Je déclare avoir pris connaissance de la charte adhérent du CLER<span class="i-required">•</span></div>
			</label>
			<a href="<?php echo get_the_permalink(CHARTE_CLER); ?>" class="c-link c-link--shy mgTop--xs" target="_blank">Lire la charte</a>
	    </div>

	</fieldset>


    <input type="hidden" value="6348972154" name="toky_toky">
    <input type="hidden" value="<?php echo $type_form; ?>" name="act">
    <?php wp_nonce_field( 'fluxi_manage_adherent', 'fluxi_manage_adherent_nonce_field' ); ?>

    <div class="c-form__notify js-notify"></div>

	<div class="c-form__submit">		
    	<button type="submit" id="submit-adherent" class="c-btn"><?php echo $type_form_name; ?></button>
    </div>

</form>




