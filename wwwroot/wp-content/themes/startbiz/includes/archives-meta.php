<?php 
/**
* 文章彙整資訊函式
*
* @file 		 archives-meta.php
* @package	 StartPress Company
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://carrielis.com
*/
global $post;
$get_meta = get_post_custom($post->ID);
?>		
<p class="post-meta">
<?php if( stf_get_option( 'arc_meta_score' ) ) stf_get_score(); ?>
<?php if( stf_get_option( 'arc_meta_author' ) ): ?>		
	<span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title="<?php sprintf( esc_attr_( '觀看 %s 的所有文章' ), get_the_author() ) ?>"><?php echo get_the_author() ?> </a></span>
<?php endif; ?>	
<?php if( stf_get_option( 'arc_meta_date' ) ): ?>		
	<?php stf_get_time() ?>
<?php endif; ?>	
<?php if( stf_get_option( 'arc_meta_cats' ) ): ?>
	<span><?php printf('%1$s', get_the_category_list( ', ' ) ); ?></span>
<?php endif; ?>	
<?php if( stf_get_option( 'arc_meta_comments' ) ): ?>
	<span><?php comments_popup_link( '發表留言', '1 則留言', '% 則留言' ); ?></span>
<?php endif; ?>
</p>
