<?php 
/**
* 留言評論頁面 Comments
*
* @file 		 comments.php
* @package	 StartPress Business
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://startpress.cc
*/
?>
		<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword">這是一篇受密碼保護的文章，請輸入密碼才能觀看留言。</p>
			</div><!-- #comments -->
<?php
		return;
	endif;
?>

<?php if ( have_comments() ) : ?>
			<h3 id="comments-title">
			<?php comments_number(_('尚無留言'), _('1 則留言'), '% '._('則留言') );?>
			</h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( _( '<span class="meta-nav">&larr;</span> 之前的留言' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( _( '較新的留言 <span class="meta-nav">&rarr;</span>' ) ); ?></div>
			</div> <!-- .navigation -->
<?php endif; ?>
			<?php $comments_by_type = &separate_comments($comments); ?>
			<?php if ( !empty($comments_by_type['comment']) ) : ?>
				<ol class="commentlist"><?php wp_list_comments('type=comment&callback=custom_comments'); ?></ol>
			<?php endif; ?>    
			<?php $comment_counter = 0 ; ?>
			<?php if ( !empty($comments_by_type['pings']) ) : ?>
			<div id="pings" class="commentlist">
				<ol class="pinglist"><?php wp_list_comments('type=pings&trackback&pingback&callback=custom_pings'); ?></ol>
			</div>
			<?php endif; ?>	
<?php else : 
	if ( ! comments_open() ) :
?>
	<?php _( '留言功能已關閉。' ); ?>
	<?php endif; ?>
<?php endif; ?>


<?php

$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

$fields =  array(
	'author' => '<p class="comment-form-author">' . '<label for="author">' . _( '姓名' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
	            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
	'email'  => '<p class="comment-form-email"><label for="email">' . _( 'E-mail' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
	            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
	'url'    => '<p class="comment-form-url"><label for="url">' . _( '網址' ) . '</label>' .
	            '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
);
$required_text = _(' 必填欄位已標註' ).' <span class="required">*</span>';
?>
<?php comment_form( array(
	'fields' => apply_filters( 'comment_form_default_fields', $fields ),
	'must_log_in' => '<p class="must-log-in">' .  sprintf( _( '您必須 <a href="%s">登入</a>後才能發表留言' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
	'logged_in_as' => '<p class="logged-in-as">' . sprintf( _( '登入為 <a href="%1$s">%2$s</a>. <a href="%3$s" title="登出此帳戶">登出 ?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
	'comment_notes_before' => '<p class="comment-notes">' . _( '您的 e-mail 信箱將會保密' ) . ( $req ? $required_text : '' ) . '</p>',
	'title_reply' => _( '回覆' ),
	'title_reply_to' => _( '回覆 %s' ),
	'cancel_reply_link' => _( '取消回覆' ),
	'label_submit' => _( '發表留言' )
)); ?>

</div><!-- #comments -->
