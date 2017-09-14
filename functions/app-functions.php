<?php
/**
 * update_formatere_cron()
 * fluxi_filter_posts()
 * fluxi_delete_post()
 * load_departements_fields()
 * is_adherent_cler()
 * get_adherent_idp()
 * get_footer_mail()
 * participation_webinaire_registered()
 */


/**
 * Auto update formatere page
 * 
 * @param   N/A
 *
 * @return	N/A
 */

function update_formatere_cron () {	
	$post_id = PAGE_FORMATERE;

	// Get Fluxi content
	$the_fluxi_content = get_fluxi_fields($post_id);
	$fluxi_resum = get_field('fluxi_resum', $post_id);

	// Update post content with Fluxi content
	wp_update_post(
		array(
			'ID' => $post_id,
			'post_content' => $the_fluxi_content,
			'post_excerpt' => $fluxi_resum
		)
	);

} add_action('update_formatere_cron', 'update_formatere_cron'); 


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

					$result_content .= '<li class="l-postList__item">';
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

					$date_event = get_field('date_event');

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

					$result_content .= '<li class="l-postList__item">';
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

					$agrement_formateree = get_field_object('field_57b6ed427ce87');
					if($agrement_formateree == 'oui'):
						$formateree_label = ' - Agrément Format’eree';
					else:
						$formateree_label = '';
					endif;

					$nom_centre = get_field('nom_centre');

					$result_content .= '<li class="l-postList__item">';
					$result_content .= '<a href="'.get_permalink().'">';
					$result_content .= '<article class="offre">';

					$result_content .= '<h1 class="h2">'.get_the_title().'</h1>';

					$result_content .= '<div class="c-meta">';
					$result_content .= '<div class="c-dash"></div>';
					$result_content .= '<span class="c-meta__meta">'.$nom_centre.$formateree_label.'</span>';
					$result_content .= '<span class="c-meta__meta"><i class="fa fa-map-marker c-meta__meta__icon" aria-hidden="true"></i>'.get_field('ville').'</span>';
					$result_content .= '<span class="c-meta__meta"><i class="fa fa-location-arrow c-meta__meta__icon" aria-hidden="true"></i>'.$numero_departement.'</span>';
					$result_content .= '</div>';

					$result_content .= '<div class="mgTop--s">';
					$result_content .= $label_secteur;
					$result_content .= $label_thematique;
					$result_content .= '</div>';

					$result_content .= '</article>';
					$result_content .= '</a>';
					$result_content .= '</li>';


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
		if( verify_post_author( $current_user->ID, $the_idp ) && current_user_can( 'delete_published_posts', $the_idp ) ):

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
			if( $status_field != 'attente_validation' && $status_field != 'annulee' && $status_field != 'attente_paiement' ):
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
                <a style="text-align:center; max-width:250px; display:block; border:none;" href="https://www.cler.org"><img style="width:100%" src="'.THEME_DIR_PATH.'/app/img/cler-logo.png"></a>
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
            <td colspan="2" style="margin:0;padding:0;"><p style="text-align:center; font-size:12px;line-height:16px;margin:15px 0 30px;padding:0;font-family: gotham,helvetica,arial,sans-serif;">Association loi 1901 • SIRET : 352 400 436 00056 • Code APE : 7022 Z</p></td>
          </tr>
          <tr style="margin:0;padding:0;" class="is-hide-print">
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
	SIRET : 352 400 436 00056<br>
	Code APE : 7022 Z<br><br>

	Tél : 01 55 86 80 00<br>
	Mail : info@cler.org<br>
	Fax : 01 55 86 80 01<br>
	<a href="'.get_home_url().'" target="_blank">www.cler.org</a>';

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
