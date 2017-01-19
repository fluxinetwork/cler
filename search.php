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
        <span class="c-meta__meta"><i class="fa fa-search c-meta__meta__icon" aria-hidden="true"></i><?php echo esc_html($wp_query->query['s']); ?></span>
      </div>
    </header>
  </div>

  <aside id="search-filters" class="c-filterList c-filterList--small">
      <div class="c-filterList__filter">
        <i class="fa fa-filter" aria-hidden="true"></i>
        <select class="c-form__select postform" id="filter" name="filter">
            <option value="-1">Aucun filtre</option>
            <option value="page">Pages</option>
            <option value="offres-emploi">Offres d'emploi</option>
            <option value="adherents">Adhérents</option>
            <option value="evenements">Evènements</option>
            <option value="formations">Formations</option>
            <option value="webinaires">Webinaires</option>
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

          $post_img_id = get_field('main_image');
          $post_img_array = wp_get_attachment_image_src($post_img_id, 'full', true);
          $post_img_url = $post_img_array[0];  

          $permalink = get_permalink();
          $date = get_the_date('d M Y');
          $categories = get_the_category();
          if ($categories) {
             $cat_name = $categories[0]->cat_name;
          }
          $title = get_the_title();

          $output = '<li class="l-postList__item">';
          $output .= '<a href="'.$permalink.'">';
          $output .= '<article class="c-newsH">';
          $output .= '<div class="c-newsH__img" style="background-image: url('.$post_img_url.')"></div>';
          $output .= '<div class="c-newsH__body">';
          $output .= '<h1 class="c-newsH__body__title">'.$title.'</h1>';
          $output .= '<div class="c-meta">';
          $output .= '<div class="c-dash"></div>';
          $output .= '<span class="c-meta__meta"><i class="fa fa-folder c-meta__meta__icon" aria-hidden="true"></i>'.$post_type.'</span>';
          $output .= '<span class="c-meta__meta"><i class="fa fa-calendar c-meta__meta__icon" aria-hidden="true"></i>'.$date.'</span>';
          if ($categories) {
            $output .= '<span class="c-meta__meta"><i class="fa fa-bookmark c-meta__meta__icon" aria-hidden="true"></i>'.$cat_name.'</span>';
          }
          $output .= '</div>';
          $output .= '</div>';
          $output .= '</article>';
          $output .= '</a>';
          $output .= '</li>';

          echo $output;

        endwhile;

        echo '</ul>';      

        the_posts_pagination( array(
        'prev_text'          => __( 'Précédent', 'cler' ),
        'next_text'          => __( 'Suivant', 'cler' ),
        'before_page_number' => '<span>' . __( 'Page', 'cler' ) . ' </span>',
        ) );

        else :

          ( !empty($_GET['s']) ) ? $search_string = filter_var( $_GET['s'], FILTER_SANITIZE_STRING) : $search_string = '';
          ( !empty($_GET['cpt']) ) ? $search_filter = ' filtré par <strong>'.filter_var( $_GET['cpt'], FILTER_SANITIZE_STRING).'</strong>' : $search_filter = '';
          echo '<p>Il n\'y a pas de résultat pour "<strong>'.$search_string.'</strong>"'.$search_filter.'.</p>';

      endif;
      ?>

    </div>
  </div>

</div>


<?php get_footer(); ?>
