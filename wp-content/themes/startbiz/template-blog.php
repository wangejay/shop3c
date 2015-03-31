<?php 
/*
Template Name: 部落格文章列表
*
* @file 		 template-blog.php
* @package	 StartPress Business
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://startpress.cc
*/
?>
<?php get_header(); ?>
	<div class="content">
		<?php stf_breadcrumbs() ?>
		
		<?php $paged = ( get_query_var('page') ) ? get_query_var('page') : 1; ?>
		
		<?php if ( ! have_posts() ) : ?>
			<div id="post-0" class="post not-found post-listing">
				<h1 class="post-title">沒有任何相關資料</h1>
				<div class="entry">
					<p>很抱歉，但找不到您所要求的資料！或許使用以下的搜尋可以幫助您。</p>
					<?php get_search_form(); ?>
				</div>
			</div>
		<?php endif; ?>
		
		<div class="page-head">
			<h1 class="page-title">
				<?php the_title(); ?>
			</h1>
		</div>
		
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<?php $get_meta = get_post_custom($post->ID);  ?>
		<?php get_template_part( 'includes/post-head' ); ?>
		<div class="entry"><?php the_content(); ?></div>
		<?php endwhile; ?>
		
		<?php //文章上方的廣告 Banner
		if( empty( $get_meta["stf_hide_above"][0] ) ){
			if( !empty( $get_meta["stf_banner_above"][0] ) ) echo '<div class="ads-post">' .htmlspecialchars_decode($get_meta["stf_banner_above"][0]) .'</div>';
			else stf_banner('banner_above' , '<div class="ads-post">' , '</div>' );
		}
		?>
		
		<?php
			$stf_blog_cats = unserialize($get_meta["stf_blog_cats"][0]);
			if( empty( $stf_blog_cats ) ) $stf_blog_cats = get_all_category_ids();
			query_posts( array( 'paged' => $paged , 'category__in' => $stf_blog_cats ));
			get_template_part( 'loop', 'category' );
			if ($wp_query->max_num_pages > 1) stf_pagenavi(); ?>
		
		<?php //文章下方的廣告 Banner
		if( empty( $get_meta["stf_hide_below"][0] ) ){
			if( !empty( $get_meta["stf_banner_below"][0] ) ) echo '<div class="ads-post">' .htmlspecialchars_decode($get_meta["stf_banner_below"][0]) .'</div>';
			else stf_banner('banner_below' , '<div class="ads-post">' , '</div>' );
		}
		?>
		
		<?php comments_template( '', true ); ?>
	</div><!-- .content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>