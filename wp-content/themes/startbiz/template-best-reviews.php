<?php 
/*
Template Name: 最佳評分
*
* @file 		 template-best-reviews.php
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

		<?php $get_meta = get_post_custom($post->ID);  ?>
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<?php //文章上方的廣告 Banner
		if( empty( $get_meta["stf_hide_above"][0] ) ){
			if( !empty( $get_meta["stf_banner_above"][0] ) ) echo '<div class="ads-post">' .htmlspecialchars_decode($get_meta["stf_banner_above"][0]) .'</div>';
			else stf_banner('banner_above' , '<div class="ads-post">' , '</div>' );
		}
		?>
		
		<article <?php if( !empty( $rv['review'] ) ) echo $rv['review']; post_class('post-listing post'); ?>>
			<?php get_template_part( 'includes/post-head' ); ?>
			<div class="post-inner">
				<h1 class="name post-title entry-title" itemprop="name"><?php the_title(); ?></h1>
				<p class="post-meta"></p>
				<div class="clear"></div>
				<div class="entry">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . _( '文章分頁:' ), 'after' => '</div>' ) ); ?>

					<ul class="best-reviews">
					<?php
						$stf_blog_cats = unserialize($get_meta["stf_blog_cats"][0]);
						if( empty( $stf_blog_cats ) ) $stf_blog_cats = get_all_category_ids();
						$num_posts = $get_meta["stf_posts_num"][0];
						$counter = 0;
						$cat_query = new WP_Query(array('category__in' => $stf_blog_cats , 'posts_per_page' => $num_posts, 'orderby' => 'meta_value_num' ,  'meta_key' => 'stf_review_score', 'post_status' => 'publish', 'no_found_rows' => 1 ));
						while ( $cat_query->have_posts() ) : $cat_query->the_post(); $counter++ ;?>
					<li>
						<span class="best-review-score" ><?php echo $counter ?></span>
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
						<div class="post-thumbnail">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark">
								<?php the_post_thumbnail('thumbnail');  ?>
							</a>
						</div><!-- post-thumbnail /-->
						<?php endif; ?>
						<div class="best-reviews-content">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php stf_get_score('large'); ?>
							<p class="post-meta">
								<span>文章作者： <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title="<?php sprintf( esc_attr_( '觀看 %s 的所有文章' ), get_the_author() ) ?>"><?php echo get_the_author() ?> </a></span>
								<?php if( stf_get_option( 'post_date' ) && stf_get_option( 'time_format' ) != 'none' ): ?>		
									<?php _( '發表於 ' ); ?><?php stf_get_time() ?>
								<?php endif; ?>	
								<span>文章分類：<?php printf('%1$s', get_the_category_list( ', ' ) ); ?></span>
							</p>
						</div>
					</li>
					<?php endwhile;
						$post = $orig_post;
					?>
					</ul>
					<?php edit_post_link( _( '編輯' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry /-->	
				<span style="display:none" class="updated"><?php the_time( 'Y-m-d' ); ?></span>
				<div style="display:none" class="vcard author" itemprop="author" itemscope itemtype="http://schema.org/Person"><strong class="fn" itemprop="name"><?php the_author_posts_link(); ?></strong></div>

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