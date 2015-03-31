<?php
/**
* Index
*
* @file 		 index.php
* @package	 StartPress Business
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://startpress.cc
*/

get_header(); ?>

	<?php
		if( stf_get_option( 'slider_pos' ) == 'big')
			get_template_part('includes/slider'); // 獲取幻燈片模版
	?>
	
<div class="content">
	<?php
		if( stf_get_option( 'slider_pos' ) != 'big')
			get_template_part('includes/slider'); // 獲取幻燈片模版
	?>
	<?php
	if( stf_get_option('on_home') != 'boxes' ){
	
		get_template_part( 'loop', 'index' );
		if ($wp_query->max_num_pages > 1) stf_pagenavi();
		
	}else{
	
		$cats = get_option( 'stf_home_cats' );
		if($cats)
			foreach ($cats as $cat)  stf_get_home_cats($cat);
		else '你可以使用首頁產生器來建立你的網站首頁';
		
		stf_home_tabs();
	}
	?>
</div><!-- end .content /-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>