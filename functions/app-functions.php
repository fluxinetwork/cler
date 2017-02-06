<?php
/**
 * fluxi_filter_posts()
 * fluxi_delete_post()
 * load_departements_fields()
 * is_adherent_cler()
 * get_adherent_idp()
 * get_footer_mail()
 * participation_webinaire_registered()
 */

/**
 * Filter posts - Use tags
 * 
 * @param   N/A
 *
 * @return	html - All filtered results
 */

function fluxi_filter_posts(){
	// Global array
    $results = array();
    global $reg_errors;
	$reg_errors = new WP_Error;
	$toky_toky = filter_var($_POST['toky_toky'], FILTER_SANITIZE_NUMBER_INT);

	$message_response = 'Aucune publication ne correspond à vos critères.';

	if ( isset( $_POST['fluxi_filter_posts_nonce_field'] ) && wp_verify_nonce( $_POST['fluxi_filter_posts_nonce_field'], 'fluxi_filter_posts' ) && is_numeric($toky_toky) && $toky_toky < 100000 && !empty($_POST['pt_slug']) ):

		$result_content = '';
		$count_post = 0;
		$all_tags = array();
		$pt_slug = filter_var($_POST['pt_slug'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

		foreach( $_POST as $index => $valeur ){

			if( $index != 'action' && $index != 'pt_slug' && $index != 'toky_toky' && $index != 'fluxi_filter_posts_nonce_field' && $index != '_wp_http_referer'):

				if( (array) $valeur === $valeur ):
					foreach($valeur as $id => $val ){
						$all_tags[]= $val;
					}
				else:
	            	$all_tags[]= $valeur;
	        	endif;

        	endif;
        }

		$args_filtered = array(
			'post_type' => $pt_slug,
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'tag' => implode('+', $all_tags)
 		);
		$query_filtered = new WP_Query( $args_filtered );

		if ( $query_filtered->have_posts() ) :

			$count_post = $query_filtered->found_posts;
		    $message_end = ($count_post > 1) ? 'publications qui correspondent à vos critères.' : 'publication qui correspond à vos critères.';
			$message_response = 'Il y a ' . $count_post .  ' ' .$message_end;

			while ( $query_filtered->have_posts() ) : $query_filtered->the_post();

				// Offres d'emploi
				if( $pt_slug == 'offres-emploi'):

					$ob_type_de_poste = get_field_object('field_574dadcc3c7b1');
					$label_type_de_poste = $ob_type_de_poste['choices'][ get_field('type_de_poste') ];

					$ob_departement = get_field_object('field_574dab093c7b0');
					$label_departement = $ob_departement['choices'][ get_field('departement') ];

					$code_postal = get_field('code_postal');
					$numero_departement = substr($code_postal,0,-3);

					$ob_experience = get_field_object('field_5773a4bc97554');
					$label_experience = $ob_experience['choices'][ get_field('experience') ];

					$ob_niveau_detude = get_field_object('field_574dae0e3c7b2');
					$ch_niveau_detude = $ob_niveau_detude['choices'];
					$val_niveau_detude = $ob_niveau_detude['value'];
					$label_niveau_detude = '';

					if( $val_niveau_detude ):

						foreach( $val_niveau_detude as $v ):

							$label_niveau_detude .= '<div class="c-tag">'.$ch_niveau_detude[ $v ] .'</div>';

						endforeach;

					endif;

					$result_content = '<li class="l-postList__item">';
					$result_content .= '<a href="'.get_permalink().'">';
					$result_content .= '<article class="offre">';

					$result_content .= '<h1 class="h2">'.get_the_title().'</h1>';

					$result_content .= '<div class="c-meta">';
					$result_content .= '<div class="c-dash"></div>';
					$result_content .= '<span class="c-meta__meta">'.get_field('nom_structure').'</span>';
					$result_content .= '<span class="c-meta__meta"><i class="fa fa-map-marker c-meta__meta__icon" aria-hidden="true"></i>'.get_field('ville').'</span>';
					$result_content .= '<span class="c-meta__meta"><i class="fa fa-location-arrow c-meta__meta__icon" aria-hidden="true"></i>'.$numero_departement.'</span>';
					$result_content .= '</div>';

					$result_content .= '<div class="mgTop--s">';
					$result_content .= '<div class="c-tag">'.$label_type_de_poste.'</div>';
					$result_content .= '<div class="c-tag">'.$label_experience.'</div>';
					$result_content .= $label_niveau_detude;
					$result_content .= '</div>';

					$result_content .= '</article>';
					$result_content .= '</a>';
					$result_content .= '</li>';

				elseif( $pt_slug == 'evenements'):

					$ob_departement = get_field_object('field_577e40ac4281f');
					$label_departement = $ob_departement['choices'][ get_field('departement') ];
					$code_postal = get_field('code_postal');
					$numero_departement = substr($code_postal,0,-3);

					$ob_publics = get_field_object('field_577e419326394');
					$ch_publics = $ob_publics['choices'];
					$val_publics = $ob_publics['value'];
					$label_publics = '';

					$date_event = date("d/m/y", strtotime(get_field('date_event')));

					if( $val_publics ):
						foreach( $val_publics as $v ):
							$label_publics .= '<span class="c-tag">'.$ch_publics[ $v ] .'</span>';
						endforeach;
					endif;

					$ob_themes = get_field_object('field_577e41d926395');
					$ch_themes = $ob_themes['choices'];
					$val_themes = $ob_themes['value'];
					$label_themes = '';

					if( $val_themes ):
						foreach( $val_themes as $v ):
							$label_themes .= '<span class="c-tag">'.$ch_themes[ $v ] .'</span>';
						endforeach;
					endif; 

					$result_content = '<li class="l-postList__item">';
					$result_content .= '<a href="'.get_permalink().'">';
					$result_content .= '<article class="offre">';

					$result_content .= '<h1 class="h2">'.get_the_title().'</h1>';

					$result_content .= '<div class="c-meta">';
					$result_content .= '<div class="c-dash"></div>';
					$result_content .= '<span class="c-meta__meta">'.$date_event.'</span>';
					$result_content .= '<span class="c-meta__meta"><i class="fa fa-map-marker c-meta__meta__icon" aria-hidden="true"></i>'.get_field('ville').'</span>';
					$result_content .= '<span class="c-meta__meta"><i class="fa fa-location-arrow c-meta__meta__icon" aria-hidden="true"></i>'.$numero_departement.'</span>';
					$result_content .= '</div>';

					//$result_content .= '<p class="c-offre_description">'.get_field('descriptif_organisme').'</p>';

					$result_content .= '<div class="mgTop--s">';
					$result_content .= $label_themes;
					$result_content .= $label_publics;
					$result_content .= '</div>';

					$result_content .= '</article>';
					$result_content .= '</a>';
					$result_content .= '</li>';

				elseif( $pt_slug == 'formations'):

					$ob_departement = get_field_object('field_57b6eab6f05cd');
					$label_departement = $ob_departement['choices'][ get_field('departement') ];					

					$ob_thematique = get_field_object('field_57b6ebc6f05d3');
					$ch_thematique = $ob_thematique['choices'];
					$val_thematique = $ob_thematique['value'];
					$label_thematique = '';

					if( $val_thematique ):
						foreach( $val_thematique as $v ):
							$label_thematique .= '<span class="c-tag">'.$ch_thematique[ $v ] .'</span>';
						endforeach;
					endif;

					$ob_secteur = get_field_object('field_57b6eb62f05d1');
					$ch_secteur = $ob_secteur['choices'];
					$val_secteur = $ob_secteur['value'];
					$label_secteur = '';

					if( $val_secteur ):
						foreach( $val_secteur as $v ):
							$label_secteur .= '<span class="c-tag">'.$ch_secteur[ $v ] .'</span>';
						endforeach;
					endif;

					$agrement_formateree = get_field_object('agrement_formateree');
					if($agrement_formateree == 'oui'):
						$formateree_label = 'Agrément Format’eree';
					else:
						$formateree_label = 'Non agréée Format’eree';
					endif;

					$nom_centre = $get_field('nom_centre');

					$result_content .= '<li classs="l-postList__item">
						<a href="'.get_the_permalink().'">
						<article class="c-offre">
							<h1 class="c-offre__title">'.get_the_title ().'</h1>
							<div class="c-offre__meta">'.$nom_centre.' <i class="mgLeft--s fa fa-map-marker" aria-hidden="true"></i>'.get_field('ville').' <i class="mgLeft--s fa fa-location-arrow" aria-hidden="true"></i>'.$label_departement.' - '.$formateree_label.'</div>
							<div class="c-offre__tags">								
								'.$label_secteur.$label_thematique.'
							</div>
						</article>
						</a>
					</li>';


				elseif( $pt_slug == 'actualites'):

					$post_img_id = get_field('main_image');
					$post_img_array = wp_get_attachment_image_src($post_img_id, 'thumb', true);
					$post_img_url = $post_img_array[0];	

					$date = get_the_date('d M Y');
					$categories = get_the_category();
					$cat_name = $categories[0]->cat_name;

					$result_content .= '<li class="l-postList__item">
											<a href="'.get_the_permalink().'">
												<article class="c-newsH">
													<div class="c-newsH__img" style="background-image: url('.$post_img_url.')"></div>
													<div class="c-newsH__body">
														<h1 class="c-newsH__body__title">'.get_the_title ().'</h1>
														<div class="c-meta">
															<div class="c-dash"></div>
															<span class="c-meta__meta"><i class="fa fa-calendar c-meta__meta__icon" aria-hidden="true"></i>'.$date.'</span>
															<span class="c-meta__meta"><i class="fa fa-bookmark c-meta__meta__icon" aria-hidden="true"></i>'.$cat_name.'</span>
														</div>
													</div>
												</article>
											</a>
										</li>';				

			 	endif;

			endwhile;


		endif;
		wp_reset_postdata();

	else :
		// If invalid toky
		$reg_errors->add( 'toky', 'Erreur, veuillez ré-essayer.');
	endif;

	if ( is_wp_error( $reg_errors ) && count( $reg_errors->get_error_messages() ) > 0):
 		$output_errors = '';
		foreach ( $reg_errors->get_error_messages() as $error ) {
			$output_errors .= $error . '<br>';
		}
		$data = array(
			'validation' => 'error',
			'message' => $output_errors
		);
		$results[] = $data;
	else:
		$data = array(
			'validation' => 'success',
			'content' => $result_content,
			'total' => $count_post,
			'message' => $message_response
		);
		$results[] = $data;
	endif;

	// Output JSON
	wp_send_json($results);

}

add_action('wp_ajax_nopriv_fluxi_filter_posts', 'fluxi_filter_posts');
add_action('wp_ajax_fluxi_filter_posts', 'fluxi_filter_posts');


/**
 * Filter posts - Use category
 * 
 * @param   N/A
 *
 * @return	html - All filtered results
 */

function fluxi_auto_filter_posts(){
	// Global array
    $results = array();
    global $reg_errors;
	$reg_errors = new WP_Error;
	$toky_toky = filter_var($_POST['toky_toky'], FILTER_SANITIZE_NUMBER_INT);

	$message_response = 'Aucune publication ne correspond à vos critères.';

	if ( isset( $_POST['fluxi_auto_filter_posts_nonce_field'] ) && wp_verify_nonce( $_POST['fluxi_auto_filter_posts_nonce_field'], 'fluxi_auto_filter_posts' ) && is_numeric($toky_toky) && $toky_toky < 100000 && !empty($_POST['pt_slug']) ):

		$result_content = '';
		$count_post = 0;
		$all_cats = array();
		$pt_slug = filter_var($_POST['pt_slug'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$category = filter_var($_POST['category'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

		$args_filtered = array(
			'post_type' => $pt_slug,
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'category_name' => $category
 		);
		$query_filtered = new WP_Query( $args_filtered );

		if ( $query_filtered->have_posts() ) :

			$count_post = $query_filtered->found_posts;
		    $message_end = ($count_post > 1) ? 'publications qui correspondent à vos critères.' : 'publication qui correspond à vos critères.';
			$message_response = 'Il y a ' . $count_post .  ' ' .$message_end;

			while ( $query_filtered->have_posts() ) : $query_filtered->the_post();

				if( $pt_slug == 'post'):

					$post_img_id = get_field('main_image');
					$post_img_array = wp_get_attachment_image_src($post_img_id, 'thumbnail', true);
					$post_img_url = $post_img_array[0];	

					$date = get_the_date('d M Y');
					$categories = get_the_category();
					$cat_name = $categories[0]->cat_name;

					$result_content .= '<li class="l-postList__item">
											<a href="'.get_the_permalink().'">
												<article class="c-newsH">
													<div class="c-newsH__img" style="background-image: url('.$post_img_url.')"></div>
													<div class="c-newsH__body">
														<h1 class="c-newsH__body__title">'.get_the_title ().'</h1>
														<div class="c-meta">
															<div class="c-dash"></div>
															<span class="c-meta__meta"><i class="fa fa-calendar c-meta__meta__icon" aria-hidden="true"></i>'.$date.'</span>
															<span class="c-meta__meta"><i class="fa fa-bookmark c-meta__meta__icon" aria-hidden="true"></i>'.$cat_name.'</span>
														</div>
													</div>
												</article>
											</a>
										</li>';		

			 	endif;

			endwhile;


		endif;
		wp_reset_postdata();

	else :
		// If invalid toky
		$reg_errors->add( 'toky', 'Erreur, veuillez ré-essayer.');
	endif;

	if ( is_wp_error( $reg_errors ) && count( $reg_errors->get_error_messages() ) > 0):
 		$output_errors = '';
		foreach ( $reg_errors->get_error_messages() as $error ) {
			$output_errors .= $error . '<br>';
		}
		$data = array(
			'validation' => 'error',
			'message' => $output_errors
		);
		$results[] = $data;
	else:
		$data = array(
			'validation' => 'success',
			'content' => $result_content,
			'total' => $count_post,
			'message' => $message_response
		);
		$results[] = $data;
	endif;

	// Output JSON
	wp_send_json($results);

}

add_action('wp_ajax_nopriv_fluxi_auto_filter_posts', 'fluxi_auto_filter_posts');
add_action('wp_ajax_fluxi_auto_filter_posts', 'fluxi_auto_filter_posts');


/**
 * Delete posts
 *
 * @param   int - the post ID (by form)
 *
 * @return	string - Error or success message
 */
function fluxi_delete_post(){
	// Global array
    $results = array();
    global $reg_errors;
	$reg_errors = new WP_Error;
	// vars
	$current_user = wp_get_current_user();
	$redirect_slug = '/mon-profil/';
	$toky_toky = filter_var($_POST['toky'], FILTER_SANITIZE_NUMBER_INT);
	$message_response = 'Erreur dans la suppression de votre publication. Essayez à nouveau.';

	// Verify nonce
	if ( is_numeric($toky_toky) && $toky_toky < 10000 && !empty($_POST['idp']) && is_numeric($_POST['idp']) ):
		$the_idp = filter_var($_POST['idp'], FILTER_SANITIZE_NUMBER_INT);

		// Verify id post & token
		if( verify_post_author( $current_user->ID, $the_idp ) && current_user_can( 'delete_posts', $the_idp ) && current_user_can( 'delete_published_posts', $the_idp ) ):

			// Delete post
			wp_delete_post($the_idp ,true);

			$message_response = 'Votre publication a été supprimée.';

		else:
			// If invalid rights
			$reg_errors->add( 'rights', $message_response );

		endif;

	else :
		// If invalid toky
		$reg_errors->add( 'toky', $message_response );
	endif;

	if ( is_wp_error( $reg_errors ) && count( $reg_errors->get_error_messages() ) > 0):
 		$output_errors = '';
		foreach ( $reg_errors->get_error_messages() as $error ) {
			$output_errors .= $error . '<br>';
		}
		$data = array(
			'validation' => 'error',
			'message' => $output_errors
		);
		$results[] = $data;
	else:
		$data = array(
			'validation' => 'success',
			'redirect' => $redirect_slug,
			'message' => $message_response
		);
		$results[] = $data;
	endif;

	// Output JSON
	wp_send_json($results);
}

add_action('wp_ajax_nopriv_fluxi_delete_post', 'fluxi_delete_post');
add_action('wp_ajax_fluxi_delete_post', 'fluxi_delete_post');



/**
 * Get select dropdown values
 *
 * @param   N/A
 *
 * @return	array - All departements
 */

function load_departements_fields() {

    $dataString = get_field('departements', 'option', false);

	$fields = array();

	foreach (explode(";", $dataString) as $cLine) {

		if($cLine != ''){

		  	list ($cKey, $cValue) = explode('=', $cLine, 2);

		  	$itemarray[$cKey] = $cValue;

		  	foreach($itemarray as $key => $value) {

			    $fields[$key] = $value;

		 	}
		}
	}

    // return the field
    return $fields;

}


/**
 * Is an adhérent
 *
 * @param   INT - user ID
 *
 * @return	bool
 */

function is_adherent_cler( $user_id = null ) {

	if( $user_id == null ):
		$current_user = wp_get_current_user();
		$user_id = $current_user->ID;
	endif;

	$args_adherent = array(
		'post_type' => 'adherents',
		'author' => $user_id,
		'posts_per_page' => 1,
		'post_status' => array( 'publish', 'pending', 'draft' )
	);
	$query_adherent = new WP_Query( $args_adherent );

	if ( $query_adherent->have_posts() ) :

		 while ( $query_adherent->have_posts() ) : $query_adherent->the_post();			
			$status_field = get_field('statut_adhesion');
			if( $status_field != 'attente_validation' && $status_field != 'annulee'):
				$status_adhesion = true;
			else:
				$status_adhesion = false;
			endif;

		 endwhile;

	else:

		$status_adhesion = false;

	endif;

	wp_reset_postdata();

    // return status
    return $status_adhesion;

}

/**
 * Get adhérent status
 *
 * @param   INT - user ID
 *
 * @return	string - Slug du statut de l'adhésion
 */

function get_adherent_status( $user_id = null ) {

	if( $user_id == null ):
		$current_user = wp_get_current_user();
		$user_id = $current_user->ID;
	endif;

	$args_adherent = array(
		'post_type' => 'adherents',
		'author' => $user_id,
		'posts_per_page' => 1,
		'post_status' => array( 'publish', 'pending', 'draft' )
	);
	$query_adherent = new WP_Query( $args_adherent );

	if ( $query_adherent->have_posts() ) :

		 while ( $query_adherent->have_posts() ) : $query_adherent->the_post();

			$status_adhesion = get_field('statut_adhesion');

		 endwhile;

	else:

		$status_adhesion = 'non_adherent';

	endif;

	wp_reset_postdata();

    // return status
    return $status_adhesion;

}

/**
 * Get adherents post ID
 *
 * @param   N/A
 *
 * @return	int - IDP : 0 if no post
 */

function get_adherent_idp( $user_id = null ){
	if( $user_id == null ):
		$current_user = wp_get_current_user();
		$user_id = $current_user->ID;
	endif;

	$args_adherent = array(
		'post_type' => 'adherents',
		'author' => $user_id,
		'posts_per_page' => 1,
		'post_status' => array( 'publish', 'pending', 'draft' )
	);
	$query_adherent = new WP_Query( $args_adherent );

	if ( $query_adherent->have_posts() ) :

		 while ( $query_adherent->have_posts() ) : $query_adherent->the_post();

			$adherent_idp = get_the_id();

		 endwhile;

	else:

		$adherent_idp = 0;

	endif;

	wp_reset_postdata();

    // return idp
    return $adherent_idp;
}

/**
 * Get email footer
 *
 * @param   N/A
 *
 * @return	string - The generic mail footer
 */

function get_footer_mail(){
	$footer_mail = '<table width="100%" style="text-align:left; font-size:13px;" border="0" cellpadding="0" cellspacing="0">
          <tr style="margin:0;padding:0;">
            <td style="background-color:#fff; padding:10px 10px 10px 20px; margin:0">
              <p>
                <a style="text-align:center; max-width:250px; display:block; border:none;" href="https://www.cler.org"><img style="width:100%" src="data:image/png;base64,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"></a>
              </p>
            </td>
            <td style="background-color:#fff; padding:10px 20px 10px 10px; line-height:18px; margin:0">
              <p style="text-align:left; line-height:18px; font-family: gotham,helvetica,arial,sans-serif; font-size:13px;">Mundo-m,<br>47 avenue Pasteur<br>93100 Montreuil</p>
              <hr>
              <p style="text-align:left; line-height:18px; font-family: gotham,helvetica,arial,sans-serif; font-size:13px;">Tél&nbsp;:&nbsp;01&nbsp;55&nbsp;86&nbsp;80&nbsp;00<br>
              Fax&nbsp;:&nbsp;01&nbsp;55&nbsp;86&nbsp;80&nbsp;01<br>
              Mail&nbsp;:&nbsp;info@cler.org</p>
            </td>
          </tr>
          <tr style="margin:0;padding:0;">
            <td colspan="2" style="margin:0;padding:0;"><p style="text-align:center; font-size:12px;line-height:16px;margin:15px 0 30px;padding:0;font-family: gotham,helvetica,arial,sans-serif;">Association loi 1901 • SIRET : 352 400 436 00049 • Code APE : 7022 Z</p></td>
          </tr>
          <tr style="margin:0;padding:0;">
            <td colspan="2" style="margin:0;padding:0;">
              <p style="text-align:center; line-height:18px;font-family: gotham,helvetica,arial,sans-serif; font-size:13px;"><a style="border-radius: 100px;letter-spacing: 1px;text-transform: uppercase;background-color: #00c15f;color: white;cursor: pointer;font-weight: bold;display: inline-block;padding:20px 30px; text-decoration:none;" href="https://www.cler.org" target="_blank">www.cler.org</a></p>
            </td>
          </tr>

        </table>';

	 // return footer mail
    return $footer_mail;
}

/**
 * Get adresse CLER
 *
 * @param   N/A
 *
 * @return	string - Coordonnées du CLER
 */

function get_adresse_cler(){
	$adresse_cler = '
	CLER – Réseau pour la transition énergétique<br>
	Mundo-m<br>
	47 avenue Pasteur<br>
	93100 Montreuil<br>
	Association loi 1901<br>
	SIRET : 352 400 436 00049<br>
	Code APE : 7022 Z<br><br>

	Tél : 01 55 86 80 00<br>
	Mail : info@cler.org<br>
	Fax : 01 55 86 80 01<br>
	<a href="https://www.cler.org" target="_blank">www.cler.org</a>';

	 // return footer mail
    return $adresse_cler;
}

/**
 * Test if a webinaire participation is already registered
 *
 * @param   email - Email adresse
 *
 * @return	bool - True is registered
 */

function participation_webinaire_registered($new_email_participant, $the_idp){
	$row_exist = false;
	$array_mails = array();
	if( have_rows('participants', $the_idp) ):
	    while( have_rows('participants', $the_idp) ) : the_row();
	        $email_participant = get_sub_field('email', $the_idp);
	        $array_mails[] = $email_participant;
	    endwhile;
	endif;

	if (in_array($new_email_participant, $array_mails)) :
		$row_exist = true;
	endif;

	return $row_exist;
}
