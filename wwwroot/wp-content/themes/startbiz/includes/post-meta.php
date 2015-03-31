<?php
/**
* 文章資訊函式
*
* @file 		 post-meta.php
* @package	 StartPress Company
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://carrielis.com
*/
global $get_meta;
if( ( stf_get_option( 'post_meta' ) && empty( $get_meta["stf_hide_meta"][0] ) ) || $get_meta["stf_hide_meta"][0] == 'no' ): ?>		
<p class="post-meta">
<?php if( stf_get_option( 'post_author' ) ): ?>		
	<span>作者: <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title="觀看<?php echo get_the_author() ?>的所有文章"><?php echo get_the_author() ?> </a></span>
<?php endif; ?>	
<?php if( stf_get_option( 'post_date' ) && stf_get_option( 'time_format' ) != 'none' ): ?>		
	<?php _( '發表於 ' ); ?><?php stf_get_time() ?>
<?php endif; ?>	
<?php if( stf_get_option( 'post_cats' ) ): ?>
	<span>文章目錄 <?php printf('%1$s', get_the_category_list( ', ' ) ); ?></span>
<?php endif; ?>	
<?php if( stf_get_option( 'post_comments' ) ): ?>
	<span><?php comments_popup_link( '發表留言', '1 則留言', '% 則留言'); ?></span>
<?php endif; ?>
</p>
<div class="clear"></div>
<?php endif; ?>