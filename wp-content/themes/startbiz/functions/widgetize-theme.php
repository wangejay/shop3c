<?php
/**
* STF 主題客製化小工具
*
* @file 		 widgetize-theme.php
* @package	 StartPress Business
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://startpress.cc
*/
## STF Widgets
add_action( 'widgets_init', 'stf_widgets_init' );
function stf_widgets_init() {
	$before_widget =  '<div id="%1$s" class="widget %2$s">';
	$after_widget  =  '</div></div>';
	$before_title  =  '<div class="widget-top"><h4>';
	$after_title   =  '</h4><div class="stripe-line"></div></div>
						<div class="widget-container">';
					
	register_sidebar( array(
		'name' =>  '主要小工具（Widget）區塊',
		'id' => 'primary-widget-area',
		'description' => '主要小工具（Widget）區塊',
		'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
	) );
	
	// 自訂側邊欄
	$sidebars = stf_get_option( 'sidebars' ) ;
	if($sidebars){
		foreach ($sidebars as $sidebar) {
			register_sidebar( array(
				'name' => $sidebar,
				'id' => sanitize_title($sidebar),
				'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
			) );
		}
	}
	

	
## 頁尾小工具 ------------------------------------------------------------
	$footer_before_widget =  '<div id="%1$s" class="footer-widget %2$s">';
	$footer_after_widget  =  '</div></div>';
	$footer_before_title  =  '<div class="footer-widget-top"><h4>';
	$footer_after_title   =  '</h4></div>
						<div class="footer-widget-container">';
						
	$footer_widgets = stf_get_option( 'footer_widgets' );
	if( $footer_widgets != 'disable' ){
	
		register_sidebar( array(
			'name' =>  '第一個頁尾小工具（widget）區塊',
			'id' => 'first-footer-widget-area',
			'description' => '第一個頁尾小工具（widget）區塊',
			'before_widget' => $footer_before_widget , 'after_widget' => $footer_after_widget , 'before_title' => $footer_before_title , 'after_title' => $footer_after_title ,
		) );

		if( $footer_widgets == 'footer-2c' || $footer_widgets == 'narrow-wide-2c' || $footer_widgets == 'wide-narrow-2c' || $footer_widgets == 'footer-3c' || $footer_widgets == 'wide-left-3c' || $footer_widgets == 'wide-right-3c' || $footer_widgets == 'footer-4c' ){
			register_sidebar( array(
				'name' =>  '第二個頁尾小工具（widget）區塊',
				'id' => 'second-footer-widget-area',
				'description' => '第二個頁尾小工具（widget）區塊',
				'before_widget' => $footer_before_widget , 'after_widget' => $footer_after_widget , 'before_title' => $footer_before_title , 'after_title' => $footer_after_title ,
			) );
		}
		
		if( $footer_widgets == 'footer-3c' || $footer_widgets == 'wide-left-3c' || $footer_widgets == 'wide-right-3c' || $footer_widgets == 'footer-4c' ){
			register_sidebar( array(
				'name' =>  '第三個頁尾小工具（widget）區塊',
				'id' => 'third-footer-widget-area',
				'description' => '第三個頁尾小工具（widget）區塊',
				'before_widget' => $footer_before_widget , 'after_widget' => $footer_after_widget , 'before_title' => $footer_before_title , 'after_title' => $footer_after_title ,
			) );
		}
		
		if( $footer_widgets == 'footer-4c' ){
			register_sidebar( array(
				'name' => '第四個頁尾小工具（widget）區塊',
				'id' => 'fourth-footer-widget-area',
				'description' => '第四個頁尾小工具（widget）區塊',
				'before_widget' => $footer_before_widget , 'after_widget' => $footer_after_widget , 'before_title' => $footer_before_title , 'after_title' => $footer_after_title ,
			) );
		}
	}
}
?>