<?php 
/**
* 搜尋頁面 Search
*
* @file 		 search.php
* @package	 StartPress Business
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://startpress.cc
*/
get_header(); ?>
	<div class="content">
		<?php stf_breadcrumbs();
 ?>

		<div class="page-head">
			<h2 class="page-title">
				<?php if ( have_posts() ) : ?>
				<?php printf( _( '%s 的搜尋結果：' ), '<span>' . get_search_query() . '</span>' ); ?>
				<?php else : ?>
				<?php echo '找不到符合您搜尋的資料'; ?>
				<?php endif; ?>
			</h2>
			<div class="stripe-line"></div>
		</div>
		
		<?php if ( have_posts() ) : ?>
			<?php get_template_part( 'loop', 'search' );	?>
			<?php if ($wp_query->max_num_pages > 1) stf_pagenavi(); ?>
		<?php else : ?>
			<div id="post-0" class="post not-found post-listing">
				<div class="entry">
					<p>抱歉，沒有符合您搜尋的條件，請更換其他關鍵字再試一次。</p>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>
