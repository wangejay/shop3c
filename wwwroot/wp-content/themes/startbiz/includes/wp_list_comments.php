<?php
/**
* WordPress 迴響函式庫
*
* @file 		 wp_list_comments.php
* @package	 StartPress Company
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://carrielis.com
*/
function custom_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment ;
	?>
	<li id="comment-<?php comment_ID(); ?>">
		<div  <?php comment_class('comment-wrap'); ?> >
			<div class="comment-avatar"><?php echo get_avatar( $comment, 45 ); ?></div>
			<div class="author-comment">
				<?php printf( _( '%s ' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">	<?php printf( _( '%1$s 在 %2$s' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( _( '(編輯)' ), ' ' ); ?></div><!-- .comment-meta .commentmetadata -->
			</div>
			<div class="clear"></div>
			<div class="comment-content">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"> '你的留言正在等待審核中'</em>
					<br />
				<?php endif; ?>
					
				<?php comment_text(); ?>
			</div>
			<div class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div><!-- .reply -->
		</div><!-- #comment-##  -->

	<?php
}

function custom_pings($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
	<li class="comment pingback">
		<p>引用通告: <?php comment_author_link(); ?><?php edit_comment_link( _( '(編輯)' ), ' ' ); ?></p>
<?php	
}
?>