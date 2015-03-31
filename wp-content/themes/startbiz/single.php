<?php 
/**
* 單篇文章頁面
*
* @file 		 single.php
* @package	 StartPress Business
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://startpress.cc
*/
get_header(); ?>

	<div class="content">
		<?php stf_breadcrumbs() ?>
		
	
		<?php if ( ! have_posts() ) : ?>
		<div id="post-0" class="post not-found post-listing">
			<h1 class="post-title">沒有任何相關資料</h1>
			<div class="entry">
				<p>很抱歉，但我們找不到您所要求的資料！或許使用以下的搜尋可以幫助您。</p>
				<?php get_search_form(); ?>
			</div>
		</div>
		<?php endif; ?>

		<?php while ( have_posts() ) : the_post(); ?>
		
		<?php $get_meta = get_post_custom($post->ID);
			if( !empty( $get_meta['stf_review_position'][0] ) ){
				$review_position = $get_meta['stf_review_position'][0] ;
				$rv = $stf_reviews_attr;
			}
			
			$post_width = $get_meta["stf_sidebar_pos"][0];
			if( $post_width == 'full' ) $content_width = 955;
		?>
		
		<?php //文章上方的廣告 Banner
		if(  empty( $get_meta["stf_hide_above"][0] ) ){
			if( !empty( $get_meta["stf_banner_above"][0] ) ) echo '<div class="ads-post">' .htmlspecialchars_decode($get_meta["stf_banner_above"][0]) .'</div>';
			else stf_banner('banner_above' , '<div class="ads-post">' , '</div>' );
		}
		?>
				
		<article <?php if( !empty( $rv['review'] ) ) echo $rv['review']; post_class('post-listing'); ?>>
			<?php get_template_part( 'includes/post-head' ); ?>

			<div class="post-inner">
				<h1 class="name post-title entry-title" itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing"><span itemprop="name"><?php the_title(); ?></span></h1>

				<?php get_template_part( 'includes/post-meta' ); ?>

				<div class="entry">
					<?php if( ( stf_get_option( 'share_post_top' ) &&  empty( $get_meta["stf_hide_share"][0] ) ) || $get_meta["stf_hide_share"][0] == 'no' ) get_template_part( 'includes/post-share' ); // 獲取社交網站分享按鈕模版 ?>
					<?php if( !empty( $review_position ) && ( $review_position == 'top' || $review_position == 'both'  ) ) echo stf_get_review('review-top'); ?>

					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . _( '文章分頁:' ), 'after' => '</div>' ) ); ?>
					
					<?php if( !empty( $review_position ) && ( $review_position == 'bottom' || $review_position == 'both' ) ) echo stf_get_review('review-bottom'); ?>

					<?php edit_post_link( _( '編輯' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry /-->
				<?php the_tags( '<span style="display:none">',' ', '</span>'); ?>
				<span style="display:none" class="updated"><?php the_time( 'Y-m-d' ); ?></span>
				<?php if ( get_the_author_meta( 'google' ) ){ ?>
				<div style="display:none" class="vcard author" itemprop="author" itemscope itemtype="http://schema.org/Person"><strong class="fn" itemprop="name"><a href="<?php the_author_meta( 'google' ); ?>?rel=author">+<?php echo get_the_author(); ?></a></strong></div>
				<?php }else{ ?>
				<div style="display:none" class="vcard author" itemprop="author" itemscope itemtype="http://schema.org/Person"><strong class="fn" itemprop="name"><?php the_author_posts_link(); ?></strong></div>
				<?php } ?>
				
				<?php if( ( stf_get_option( 'share_post' ) &&  empty( $get_meta["stf_hide_share"][0] ) ) || $get_meta["stf_hide_share"][0] == 'no' ) get_template_part( 'includes/post-share' ); // 獲取社交網站分享按鈕模版 ?>

			</div><!-- .post-inner -->
		</article><!-- .post-listing -->
		<?php if( stf_get_option( 'post_tags' ) ) the_tags( '<p class="post-tag">'._( '文章標籤: ' )  ,' ', '</p>'); ?>

		
		<?php //文章下方廣告 Banner
		if( empty( $get_meta["stf_hide_below"][0] ) ){
			if( !empty( $get_meta["stf_banner_below"][0] ) ) echo '<div class="ads-post">' .htmlspecialchars_decode($get_meta["stf_banner_below"][0]) .'</div>';
			else stf_banner('banner_below' , '<div class="ads-post">' , '</div>' );
		}
		?>
		
		<?php if( ( stf_get_option( 'post_authorbio' ) && empty( $get_meta["stf_hide_author"][0] ) ) || ( isset( $get_meta["stf_hide_related"][0] ) && $get_meta["stf_hide_author"][0] == 'no' ) ): ?>		
		<section id="author-box">
			<div class="block-head">
				<h3>關於 <?php the_author() ?> </h3><div class="stripe-line"></div>
			</div>
			<div class="post-listing">
				<?php stf_author_box() ?>
			</div>
		</section><!-- #author-box -->
		<?php endif; ?>
		
		
		<?php if( stf_get_option( 'post_nav' ) ): ?>				
		<div class="post-navigation">
			<div class="post-previous"><?php previous_post_link( '%link', '<span>'. _( '上一篇:' ).'</span> %title' ); ?></div>
			<div class="post-next"><?php next_post_link( '%link', '<span>'. _( '下一篇:' ).'</span> %title' ); ?></div>
		</div><!-- .post-navigation -->
		<?php endif; ?>
	
		<?php get_template_part( 'includes/post-related' ); ?>

		<?php endwhile;?>

		<?php comments_template( '', true ); ?>
	
	</div><!-- .content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>