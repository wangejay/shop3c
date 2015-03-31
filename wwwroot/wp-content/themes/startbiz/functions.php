<?php
/**
* Functions
*
* @file 		 functions.php
* @package	 StartPress Business
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://startpress.cc
*/

$themename = "StartBiz";
$themefolder = "startbiz";
define ('theme_name', $themename );
define ('theme_ver' , 1 );

// 定義主題名稱與資料夾
define( 'MTHEME_NOTIFIER_THEME_NAME', $themename );
define( 'MTHEME_NOTIFIER_THEME_FOLDER_NAME', $themefolder );
define( 'MTHEME_NOTIFIER_CACHE_INTERVAL', 1 );

// 載入自定佈景主題函式庫
include (TEMPLATEPATH . '/custom-functions.php');

// 獲取主題函式
include (TEMPLATEPATH . '/functions/banners.php');
include (TEMPLATEPATH . '/functions/common-scripts.php');
include (TEMPLATEPATH . '/functions/default-options.php');
include (TEMPLATEPATH . '/functions/home-cat-pic.php');
include (TEMPLATEPATH . '/functions/home-cats.php');
include (TEMPLATEPATH . '/functions/home-cat-scroll.php');
include (TEMPLATEPATH . '/functions/home-cat-tabs.php');
include (TEMPLATEPATH . '/functions/home-cat-videos.php');
include (TEMPLATEPATH . '/functions/home-recent-box.php');
include (TEMPLATEPATH . '/functions/theme-functions.php');
include (TEMPLATEPATH . '/functions/updates.php');
include (TEMPLATEPATH . '/functions/widgetize-theme.php');

include (TEMPLATEPATH . '/includes/breadcrumbs.php');
include (TEMPLATEPATH . '/includes/pagenavi.php');
include (TEMPLATEPATH . '/includes/wp_list_comments.php');
include (TEMPLATEPATH . '/includes/widgets.php');

// 載入主題設定選項
include (TEMPLATEPATH . '/spanel/shortcodes/shortcode.php');
if (is_admin()) {
	include (TEMPLATEPATH . '/spanel/spanel-ui.php');
	include (TEMPLATEPATH . '/spanel/spanel-functions.php');
	include (TEMPLATEPATH . '/spanel/category-options.php');
	include (TEMPLATEPATH . '/spanel/post-options.php');
	include (TEMPLATEPATH . '/spanel/custom-slider.php');
}


/*-----------------------------------------------------------------------------------*/
# 自訂控制台工具欄選單
/*-----------------------------------------------------------------------------------*/
function stf_admin_bar() {
	global $wp_admin_bar;
	
	if ( current_user_can( 'switch_themes' ) ){
		$wp_admin_bar->add_menu( array(
			'parent' => 0,
			'id' => 'spanel_page',
			'title' => theme_name ,
			'href' => admin_url( 'admin.php?page=spanel')
		) );
	}
}
add_action( 'wp_before_admin_bar_render', 'stf_admin_bar' );

if ( ! isset( $content_width ) ) $content_width = 618;

// 主題安裝啟用後進入主題設定選項頁面
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {

	if( !get_option('stf_active') ){
		stf_save_settings( $default_data );
		update_option( 'stf_active' , theme_ver );
	}
   //header("Location: admin.php?page=spanel");
}


?>