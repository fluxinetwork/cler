<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage Cler
 * @since Cler 1.0
 */

get_header(); ?>

<?php
$nb_results = $wp_query->found_posts;
if ($nb_results == 0) {
  $title = 'Aucun résultat';
} else {
  ($nb_results==1) ? $title = $nb_results.' résultat' : $title = $nb_results.' résultats';
}
?>

<div id="search">

  <div class="l-row bg-dark--grad">
    <header class="l-col l-col--content">
      <h1 class="c-white"><?php echo $title; ?></h1>
      <div class="c-meta c-meta--white">
        <div class="c-dash"></div>
        <span class="c-meta__meta"><i class="fa fa-tag c-meta__meta__icon" aria-hidden="true"></i><?php echo esc_html($wp_query->query['s']); ?></span>
      </div>
    </header>
  </div>

  <aside id="search-filters" class="l-filterList l-filterList--small">
      <div class="l-filterList__filter">
        <i class="fa fa-filter" aria-hidden="true"></i>
        <select class="c-form__select postform" id="filter" name="filter">
            <option value="-1">Aucun filtre</option>            
            <option value="post">Actualités</option>
            <option value="offres-emploi">Offres d'emploi</option>
            <!--<option value="adherents">Adhérents</option>-->
            <option value="evenements">Evènements</option>
            <option value="formations">Formations</option>
            <option value="webinaires">Webinaires</option>
            <option value="page">Pages</option>
        </select>
      </div>
  </aside>

  <div class="l-row">
    <div class="l-col l-col--content no-pdTop">

      <?php
      if ( have_posts() ) :
        echo '<ul class="l-postList">';
        
        while ( have_posts() ) : the_post();

          $post_type = $post->post_type;
          if ($post_type == 'post') {
            $post_type = 'actualité';
          } else if ($post_type == 'offres-emploi') {
            $post_type = 'emploi';
          }

          include(locate_template('page-templates-parts/get-thumb.php'));

          $permalink = get_permalink();
          $date_publi = get_the_date('d M Y');
          $categories = get_the_category();
          ($categories) ? $cat_name = $categories[0]->cat_name : $cat_name = 'non classé';
          $title = get_the_title();

          // WRAP

          $output = '<li class="l-postList__item">';
          $output .= '<a href="'.$permalink.'">';
          $output .= '<article class="c-newsH">';

          // HEADER
    
          if ($post_type == 'actualité' || $post_type == 'webinaires' || $post_type == 'portraits' || $post_type == 'retours-experience') { // ACTU

            $output .= '<div class="c-newsH__img" style="background-image: url('.$post_img_url.')"></div>';

          } else if ($post_type == 'emploi') { // EMPLOI

            $ob_type_de_poste = get_field_object('field_574dadcc3c7b1');
            $contrat = $ob_type_de_poste['choices'][ get_field('type_de_poste') ];
            $code_postal = get_field('code_postal');
            $num_departement = substr($code_postal,0,-3);

            $output .= '<div class="c-newsH__img">';
            $output .= '<div class="c-card__header__tag">'.$contrat.'</div>';
            $output .= '</div>';

          } else if ($post_type == 'evenements') { // EVENT
            $date = get_field('date_event', false, false);
            $date = new DateTime($date);
            $output .= '<div class="c-newsH__img "><div class="c-card__header__tag">'.$date->format('d M').'</div></div>';

          } else {

            $output .= '<div class="c-newsH__img"></div>';

          }

          // BODY

          $output .= '<div class="c-newsH__body">';
          if ($post_type == 'actualité' ) {
            $output .= '<span class="t-meta">'.$date_publi.'</span>';
          }
          $output .= '<h1 class="c-newsH__body__title">'.$title.'</h1>';

          // META

          $output .= '<div class="c-meta">';
          $output .= '<div class="c-dash"></div>';
          $output .= '<span class="c-meta__meta"><i class="fa fa-folder c-meta__meta__icon" aria-hidden="true"></i>'.$post_type.'</span>';

          if ($post_type != 'page' || $post_type != 'evenements') {
            if ($categories) {
              $output .= '<span class="c-meta__meta"><i class="fa fa-bookmark c-meta__meta__icon" aria-hidden="true"></i>'.$cat_name.'</span>';
            }
          }

          if ($post_type == 'webinaires') {
              $date_webiniare = new DateTime(get_field('date_webinaire', false, false));
              $heure_webinaire = get_field('heure_webinaire');
              $output .= '<span class="c-meta__meta"><i class="fa fa-calendar c-meta__meta__icon" aria-hidden="true"></i>'.$date_webiniare->format('j M Y').'</span>';
              $output .= '<span class="c-meta__meta"><i class="fa fa-clock-o c-meta__meta__icon" aria-hidden="true"></i>'.$heure_webinaire.'</span>';
          }

          // CLOSE META
          $output .= '</div>';

          // CLOSE BODY
          $output .= '</div>';

          // CLOSE WRAP
          $output .= '</article>';
          $output .= '</a>';
          $output .= '</li>';

          echo $output;

        endwhile;

        echo '</ul>';      

        include(locate_template('page-templates-parts/base/pagination.php'));

        else :

          ( !empty($_GET['s']) ) ? $search_string = filter_var( $_GET['s'], FILTER_SANITIZE_STRING) : $search_string = '';
          ( !empty($_GET['cpt']) ) ? $search_filter = ' filtré par <strong>'.filter_var( $_GET['cpt'], FILTER_SANITIZE_STRING).'</strong>' : $search_filter = '';
          echo '<p class="font-subh">Il n\'y a pas de résultat pour "<strong>'.$search_string.'</strong>"'.$search_filter.'.</p>';
          echo '<button class="c-btn c-btn--ghost mgTop--s js-force-search"><i class="fa fa-search"></i>Relancer une recherche</button>';

      endif;
      ?>

    </div>
  </div>

</div>


<?php get_footer(); ?>
