<?php 
/**
* 文章標籤頁 Tag
*
* @file 		 tag.php
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
			<h1 class="page-title">
				<?php printf( _( '%s 標籤的存檔：' ), '<span>' . single_tag_title( '', false ) . '</span>' );	?>
			</h1>
			<?php if( stf_get_option( 'tag_rss' ) ):
				$tag_id = get_query_var('tag_id'); ?>
			<a class="rss-cat-icon tooltip" title="訂閱 Feed"  href="<?php echo  get_term_feed_link($tag_id , 'post_tag', "rss2") ?>"></a>
			<?php endif; ?>
			<div class="stripe-line"></div>
		</div>
		
		<?php get_template_part( 'loop', 'tag' );	?>
		<?php if ($wp_query->max_num_pages > 1) stf_pagenavi(); ?>
		
	</div> <!-- .content -->
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>