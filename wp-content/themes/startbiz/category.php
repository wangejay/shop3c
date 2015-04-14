<?php 
/**
* 分類目錄頁面 Category
*
* @file 		 category.php
* @package	 StartPress Business
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://startpress.cc
*/
get_header(); ?>
	<div class="content">
	<?php stf_breadcrumbs() ?>
		
		<!-- JW add slider in cat page --> 
		<?php  
		switch (single_cat_title( '', false )){
			case '科技':
				get_template_part('includes/slider_tech');
			break; 
			case '品牌':
				get_template_part('includes/slider_brand');
			break; 
			case '趣味':
				get_template_part('includes/slider_fun');
			break; 
			case '生活':
				get_template_part('includes/slider_life');
			break; 
			default:
		}
		?>
		
		<?php $category_id = get_query_var('cat') ; ?>
		<div class="page-head">
			<h1 class="page-title">
				<?php echo single_cat_title( '', false ) ?>
			</h1>
			<?php if( stf_get_option( 'category_rss' ) ): ?>
			<a class="rss-cat-icon ttip" title="訂閱分類目錄文章" href="<?php echo get_category_feed_link($category_id) ?>"></a>
			<?php endif; ?>
			<div class="stripe-line"></div>

			<?php
			if( stf_get_option( 'category_desc' ) ):	
				$category_description = category_description();
				if ( ! empty( $category_description ) )
				echo '<div class="clear"></div><div class="archive-meta">' . $category_description . '</div>';
			endif;
			?>
		</div>
		<?php get_template_part( 'includes/slider-category' ); ?>

		<?php get_template_part( 'loop', 'category' );	?>
		<?php if ($wp_query->max_num_pages > 1) stf_pagenavi(); ?>
		
	</div> <!-- .content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>