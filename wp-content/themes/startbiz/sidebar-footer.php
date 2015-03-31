<?php
/**
* 頁尾側邊欄模組函式 Sidebar Footer
*
* @file 		 sidebar-footer.php
* @package	 StartPress Business
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://startpress.cc
*/
$footer_widgets = stf_get_option( 'footer_widgets' ) ? stf_get_option( 'footer_widgets' ) : "footer-3c" ;
if( $footer_widgets != 'disable' ): ?>
<footer id="theme-footer">
	<div id="footer-widget-area" class="<?php echo $footer_widgets ?>">

	<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
		<div id="footer-first" class="footer-widgets-box">
			<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
		</div>
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) : ?>
		<div id="footer-second" class="footer-widgets-box">
			<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
		</div><!-- #second .widget-area -->
	<?php endif; ?>


	<?php if ( is_active_sidebar( 'third-footer-widget-area' ) ) : ?>
		<div id="footer-third" class="footer-widgets-box">
			<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
		</div><!-- #third .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'fourth-footer-widget-area' ) ) : ?>
		<div id="footer-fourth" class="footer-widgets-box">
			<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
		</div><!-- #fourth .widget-area -->
	<?php endif; ?>
	
	</div><!-- #footer-widget-area -->
	<div class="clear"></div>
</footer><!-- .Footer /-->
<?php endif; ?>