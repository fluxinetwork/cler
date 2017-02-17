<?php 
	echo '<div class="c-pagination">';
		echo '<div class="c-pagination__links">';
		echo paginate_links( array(
			'base' => @add_query_arg('paged','%#%'),
			'before_page_number' => 'Page ',
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $query_paged->max_num_pages,
			'prev_next'=> false
		) );
		echo '</div>';
	echo '</div>';
?>