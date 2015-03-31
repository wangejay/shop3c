<?php 
/**
* Boxes 資訊函式
*
* @file 		 boxes-meta.php
* @package	 StartPress Business
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://startpress.cc
*/
?>		
<p class="post-meta">
<?php if( stf_get_option( 'box_meta_score' ) ) stf_get_score(); ?>
<?php if( stf_get_option( 'box_meta_author' ) ): ?>		
	<span>作者: <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title="觀看<?php echo get_the_author() ?>的所有文章"><?php echo get_the_author() ?> </a></span>
<?php endif; ?>	
<?php if( stf_get_option( 'box_meta_date' ) ): ?>		
	<?php stf_get_time() ?>
<?php endif; ?>	
<?php if( stf_get_option( 'box_meta_cats' ) ): ?>
	<span>文章目錄 <?php printf('%1$s', get_the_category_list( ', ' ) ); ?></span>
<?php endif; ?>	
<?php if( stf_get_option( 'box_meta_comments' ) ): ?>
	<span><?php comments_popup_link( '發表留言', '1 則留言', '% 則留言'); ?></span>
<?php endif; ?>
</p>