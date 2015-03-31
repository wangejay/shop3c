<?php 
/*
Template Name: 網站地圖
*
* @file 		 template-sitemap.php
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
				
		<?php if ( ! have_posts() ) : ?>
			<div id="post-0" class="post not-found post-listing">
				<h1 class="post-title">沒有任何相關資料</h1>
				<div class="entry">
					<p>很抱歉，但找不到您所要求的資料！或許使用以下的搜尋可以幫助您。</p>
					<?php get_search_form(); ?>
				</div>
			</div>
		<?php endif; ?>
		
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		
		<?php $get_meta = get_post_custom($post->ID);  ?>
		<?php //文章上方的廣告 Banner
		if( empty( $get_meta["stf_hide_above"][0] ) ){
			if( !empty( $get_meta["stf_banner_above"][0] ) ) echo '<div class="ads-post">' .htmlspecialchars_decode($get_meta["stf_banner_above"][0]) .'</div>';
			else stf_banner('banner_above' , '<div class="ads-post">' , '</div>' );
		}
		?>
		
		<article class="post-listing post">
			<?php get_template_part( 'includes/post-head' ); ?>
			<div class="post-inner">
				<h1 class="post-title"><?php the_title(); ?></h1>
				<p class="post-meta"></p>
				<div class="clear"></div>
				<div class="entry">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . _( '文章分頁:' ), 'after' => '</div>' ) ); ?>
					
					<div id="sitemap">
						<div class="sitemap-col">
							<h2>本站所有頁面</h2>
							<ul id="sitemap-pages"><?php wp_list_pages('title_li='); ?></ul>
						</div> <!-- end .sitemap-col -->
							
						<div class="sitemap-col">
							<h2>本站分類目錄</h2>
							<ul id="sitemap-categories"><?php wp_list_categories('title_li='); ?></ul>
						</div> <!-- end .sitemap-col -->
							
						<div class="sitemap-col">
							<h2>本站文章標籤</h2>
							<ul id="sitemap-tags">
								<?php $tags = get_tags();
								if ($tags) {
									foreach ($tags as $tag) {
										echo '<li><a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a></li> ';
									}
								} ?>
							</ul>
						</div> <!-- end .sitemap-col -->
														
						<div class="sitemap-col<?php echo ' last'; ?>">
							<h2>本站作者</h2>
							<ul id="sitemap-authors" ><?php wp_list_authors('optioncount=1&exclude_admin=0'); ?></ul>
						</div> <!-- end .sitemap-col -->
					
					</div> <!-- end #sitemap -->
						
					<?php edit_post_link( _( '編輯' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry /-->	
			
			</div><!-- .post-inner -->
		</article><!-- .post-listing -->
		<?php endwhile; ?>
		
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