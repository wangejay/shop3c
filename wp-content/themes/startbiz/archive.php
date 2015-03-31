<?php 
/**
* 文章存檔頁面 Archive
*
* @file 		 archive.php
* @package	 StartPress Business
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://startpress.cc
*/
get_header(); ?>
	<div class="content">
		<?php stf_breadcrumbs() ?>
		
		<div class="page-head">
			<?php if ( have_posts() ) the_post(); ?>
			<h2 class="page-title">
				<?php if ( is_day() ) : ?>
					<?php printf( _( '每日存檔: <span>%s</span>' ), get_the_date() ); ?>
				<?php elseif ( is_month() ) : ?>
					<?php printf( _( '按月存檔: <span>%s</span>' ), get_the_date( 'F Y' ) ); ?>
				<?php elseif ( is_year() ) : ?>
					<?php printf( _( '年度存檔: <span>%s</span>' ), get_the_date( 'Y' ) ); ?>
				<?php else : ?>
					<?php echo '部落格存檔'; ?>
				<?php endif; ?>
			</h2>
			<div class="stripe-line"></div>
		</div>

				
		<?php
		rewind_posts();
		get_template_part( 'loop', 'archive' );	?>
		<?php if ($wp_query->max_num_pages > 1) stf_pagenavi(); ?>
	</div>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>