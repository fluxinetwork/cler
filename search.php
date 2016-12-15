<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage Cler
 * @since Cler 1.0
 */

get_header(); ?>

  <section id="search">

    <div id="search-filters" class="filtres wrap-extend">
      <h5 class="h5">Filtrer les résultats</h5>

      <select class="postform" id="filter" name="filter">
          <option value="-1">Aucun filtre</option>
          <option value="page">Pages</option>
          <option value="offres-emploi">Offres d'emploi</option>
          <option value="adherents">Adhérents</option>
          <option value="evenements">Evènements</option>
          <option value="formations">Formations</option>
          <option value="webinaires">Webinaires</option>
      </select>

    </div>

    <?php if ( have_posts() ) : ?>

      <p><?php printf( __( 'Résultats pour : %s', 'cler' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></p>

      <?php
      // Start the loop.
      while ( have_posts() ) : the_post();

        echo '<a style="margin:2rem auto; border-bottom:3px solid #ccc; display:block" href="'.get_the_permalink().'">
                <h2>'.get_the_title().'</h2>
                <p>'.get_field('fluxi_resum').'</p>
              </a>';

      // End the loop.
      endwhile;

      // Previous/next page navigation.
      the_posts_pagination( array(
        'prev_text'          => __( 'Précédent', 'cler' ),
        'next_text'          => __( 'Suivant', 'cler' ),
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'cler' ) . ' </span>',
      ) );

    // If no content, include the "No posts found" template.
    else :

      if( !empty($_GET['s']) ){ 
        $search_string = filter_var( $_GET['s'], FILTER_SANITIZE_STRING); }
      else{ $search_string = ''; }

      if( !empty($_GET['cpt']) ){ 
        $search_filter = ' filtré par <strong>'.filter_var( $_GET['cpt'], FILTER_SANITIZE_STRING).'</strong>'; }
      else{ $search_filter = ''; }

      echo '<p>Il n\'y a pas de résultat pour "<strong>'.$search_string.'</strong>"'.$search_filter.'.</p>';

    endif;
    ?>


  </section>


<?php get_footer(); ?>
