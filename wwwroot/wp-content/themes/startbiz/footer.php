<?php
/**
* Footer
*
* @file 		 footer.php
* @package	 StartPress Business
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://startpress.cc
*/
?>

	<div class="clear"></div>
</div><!-- .container /-->

<?php stf_banner( 'banner_bottom' , '<div class="ads-bottom">' , '</div>' ); ?>
<?php get_sidebar( 'footer' ); ?>
<div class="clear"></div>
<div class="footer-bottom">
	<div class="container">
		<div class="alignright">
			<?php 
				$footer_vars = array('%year%' , '%site%' , '%url%');
				$footer_val  = array( date('Y') , get_bloginfo('name') , home_url() );
				$footer_two  = str_replace( $footer_vars , $footer_val , stf_get_option( 'footer_two' ) );
				echo htmlspecialchars_decode( $footer_two );
			?>
		</div>
		<?php if( stf_get_option('footer_social') ) stf_get_social('yes',16); ?>
		
		<div class="alignleft">
			<?php 
				$footer_one = str_replace( $footer_vars , $footer_val , stf_get_option( 'footer_one' ) );
				echo htmlspecialchars_decode( $footer_one );
			?>
		</div>
		<div class="clear"></div>
	</div><!-- end .Container -->
</div><!-- end .Footer bottom -->
<?php if( stf_get_option('footer_top') ): ?>
	<div id="topcontrol" class="stficon-up-open" title="返回頁首"></div>
<?php endif; ?>
<div id="fb-root"></div>
<?php wp_footer();?>
</body>
</html>