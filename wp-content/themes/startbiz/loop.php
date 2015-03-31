<?php 
/**
* 重複循環的內容功能 Loop
*
* @file 		 loop.php
* @package	 StartPress Business
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://startpress.cc
*/
?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post not-found post-listing">
		<h2 class="post-title">沒有任何相關資料</h2>
		<div class="entry">
			<p>很抱歉，但找不到您所要求的資料！或許使用以下的搜尋可以幫助您。</p>
			<?php get_search_form(); ?>
		</div>
	</div>

<?php else : ?>
<div class="post-listing">
<?php while ( have_posts() ) : the_post(); ?>
<?php if( stf_get_option( 'blog_display' ) != 'full_thumb' ): ?>
	<article <?php stf_post_class('item-list'); ?>>
		<h2 class="post-box-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?> 的永久鏈結" rel="bookmark"><?php the_title(); ?></a></h2>
		<?php get_template_part( 'includes/archives-meta' ); ?>					

		<?php if( stf_get_option( 'blog_display' ) == 'content' ): ?>
		<div class="entry">
			<?php the_content( ( '繼續閱讀 &raquo;' ) ); ?>
		</div>
		<?php else: ?>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark">
				<?php the_post_thumbnail('thumbnail');  ?>
				<span class="overlay-icon"></span>
			</a>
		</div><!-- post-thumbnail /-->
			<?php endif; ?>
		<div class="entry">
			<p><?php stf_excerpt() ?>
			<a class="more-link" href="<?php the_permalink() ?>">繼續閱讀 &raquo;</a></p>
		</div>
		<?php endif; ?>

		<?php if( stf_get_option( 'archives_socail' ) ) get_template_part( 'includes/post-share' );  // 獲取社交網站分享按鈕的模版 ?>
		<div class="clear"></div>
	</article><!-- .item-list -->
<?php else: ?>
	<article <?php stf_post_class('item-list'); ?>>
		<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
		<div class="post-thumbnail single-post-thumb archive-wide-thumb">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php stf_thumb( 'slider' ); ?><span class="overlay-icon"></span></a>
		</div>
		<div class="clear"></div>
		<?php endif; ?>
		<h2 class="post-box-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<?php get_template_part( 'includes/archives-meta' ); ?>					
		<div class="entry">
			<p><?php stf_excerpt() ?>
			<a class="more-link" href="<?php the_permalink() ?>">繼續閱讀 &raquo;</a></p>
		</div>
		<?php if( stf_get_option( 'archives_socail' ) ) get_template_part( 'includes/post-share' );  // 獲取社交網站分享按鈕的模版 ?>
		<div class="clear"></div>
	</article><!-- .item-list -->
<?php endif; ?>
	
<?php endwhile;?>
</div>
<?php endif; ?>