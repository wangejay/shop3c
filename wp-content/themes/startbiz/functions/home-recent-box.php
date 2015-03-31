<?php
/**
* 首頁最新文章區塊框
*
* @file 		 home-recent-box.php
* @package	 StartPress Company
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://carrielis.com
*/
function get_home_recent( $cat_data ){

	$exclude = $Posts = $Box_Title = $pagination = $offset = '';
	
	if( !empty( $cat_data['exclude'] ) )
		$exclude = $cat_data['exclude'];
	
	if( !empty($cat_data['number']) )
		$Posts = $cat_data['number'];
	
	if( !empty($cat_data['title']) )	
		$Box_Title = $cat_data['title'];
	
	if( !empty($cat_data['display']) )
		$display = $cat_data['display'];
	
	if( !empty($cat_data['pagi']) )
		$pagination = $cat_data['pagi'];
	
	if( !empty($cat_data['offset']) )
		$offset =  $cat_data['offset'];

	$args = array ( 'posts_per_page' => $Posts , 'category__not_in' => $exclude , 'offset' => $offset, 'ignore_sticky_posts' => 1   );
	if ( !empty( $pagination ) && $pagination == 'y' ) $args[ 'paged' ] = get_query_var('paged');
	else $args[ 'no_found_rows' ] = 1 ;
	
	$cat_query = new WP_Query( $args ); 
?>
		<section class="cat-box recent-box">
			<div class="cat-box-title">
				<h2><?php if( function_exists('icl_t') ) echo icl_t( theme_name , $cat_data['boxid'] , $Box_Title); else echo $Box_Title ; ?></h2>
				<div class="stripe-line"></div>
			</div><!-- post-thumbnail /-->
			<div class="cat-box-content">
			
				<?php if($cat_query->have_posts()): ?>

				<?php while ( $cat_query->have_posts() ) : $cat_query->the_post()?>
				<?php if( $display == 'blog' ): ?>
					<article <?php stf_post_class('item-list'); ?>>
						<h2 class="post-box-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<?php get_template_part( 'includes/boxes-meta' ); ?>					

						<?php if( stf_get_option( 'blog_display' ) == 'content' ): ?>
						<div class="entry">
							<?php the_content( '繼續閱讀 &raquo;' ); ?>
						</div>
						
						<?php else: ?>
						
							<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
						<div class="post-thumbnail">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark">
								<?php the_post_thumbnail( 'thumbnail' );   ?>
								<span class="overlay-icon"></span>
							</a>
						</div><!-- post-thumbnail /-->
							<?php endif; ?>
									
						<div class="entry">
							<p><?php stf_excerpt() ?>
							<a class="more-link" href="<?php the_permalink() ?>">繼續閱讀 &raquo;</a></p>
						</div>
						<?php endif; ?>
						
						<?php if( stf_get_option( 'archives_socail' ) ) get_template_part( 'includes/post-share' );  // 獲取社交網站分享按鈕模版 ?>
					</article><!-- .item-list -->
				<?php else: ?>
					<div <?php stf_post_class('recent-item'); ?>>
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark">
									<?php stf_thumb( 'stf-medium' ); ?>
									<span class="overlay-icon"></span>
								</a>
							</div><!-- post-thumbnail /-->
						<?php endif; ?>			
						<h3 class="post-box-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						<p class="post-meta">
							<?php if( stf_get_option( 'box_meta_score' ) ) stf_get_score(); ?>
							<?php if( stf_get_option( 'box_meta_date'  ) )  stf_get_time() ?>
						</p>
					</div>
				<?php endif; ?>
				<?php endwhile;?>
				<div class="clear"></div>

			<?php endif; ?>
			</div><!-- .cat-box-content /-->
		</section>
		<?php if ( !empty( $pagination ) && $pagination == 'y' && $cat_query->max_num_pages > 1){?> <div class="recent-box-pagination"><?php stf_pagenavi($cat_query , $Posts); ?> </div> <?php } ?>
		<div class="clear"></div>
<?php
}
?>