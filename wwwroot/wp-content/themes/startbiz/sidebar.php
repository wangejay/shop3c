<?php 
/**
* 側邊欄模組函式庫
*
* @file 		 sidebar.php
* @package	 StartPress Business
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://startpress.cc
*/
?>
<aside id="sidebar">
<?php
	wp_reset_query();
	if ( is_home() ){
	
		$sidebar_home = stf_get_option( 'sidebar_home' );
		if( !empty( $sidebar_home ) )
			dynamic_sidebar ( sanitize_title( $sidebar_home ) ); 
			
		else dynamic_sidebar( 'primary-widget-area' );	
		
	}elseif( is_page() || ( function_exists('bp_current_component') && bp_current_component() ) ){
		global $get_meta;
		$stf_sidebar_pos = $get_meta["stf_sidebar_pos"][0];

		if( $stf_sidebar_pos != 'full' ){
			$stf_sidebar_post = sanitize_title($get_meta["stf_sidebar_post"][0]);
			$sidebar_page = stf_get_option( 'sidebar_page' );
			if( !empty( $stf_sidebar_post ) )
				dynamic_sidebar($stf_sidebar_post);
				
			elseif( $sidebar_page )
				dynamic_sidebar ( sanitize_title( $sidebar_page ) ); 
			
			else dynamic_sidebar( 'primary-widget-area' );
		}

	}elseif ( is_single() ){
		global $get_meta;
		$stf_sidebar_pos = $get_meta["stf_sidebar_pos"][0];

		if( $stf_sidebar_pos != 'full' ){
			$stf_sidebar_post = sanitize_title($get_meta["stf_sidebar_post"][0]);
			$sidebar_post = stf_get_option( 'sidebar_post' );
			if( !empty( $stf_sidebar_post ) )
				dynamic_sidebar($stf_sidebar_post);
				
			elseif( $sidebar_post )
				dynamic_sidebar ( sanitize_title( $sidebar_post ) ); 
			
			else dynamic_sidebar( 'primary-widget-area' );
		}
		
	}elseif ( is_category() ){
		
		$category_id = get_query_var('cat') ;
		$cat_options = get_option( "stf_cat_$category_id");

		if( !empty($cat_options['cat_sidebar']) )
			$cat_sidebar = $cat_options['cat_sidebar'];
			
		$sidebar_archive = stf_get_option( 'sidebar_archive' );

		if( !empty( $cat_sidebar ) )
			dynamic_sidebar ( sanitize_title( $cat_sidebar ) ); 
			
		elseif( $sidebar_archive )
			dynamic_sidebar ( sanitize_title( $sidebar_archive ) );
			
		else dynamic_sidebar( 'primary-widget-area' );
		
	}else{
		$sidebar_archive = stf_get_option( 'sidebar_archive' );
		if( !empty( $sidebar_archive ) ){
			dynamic_sidebar ( sanitize_title( $sidebar_archive ) );
		}
		else dynamic_sidebar( 'primary-widget-area' );
	}
?>
</aside>