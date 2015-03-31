<?php
/**
* 搜尋小工具函式
*
* @file 		 widget-search.php
* @package	 StartPress Company
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://carrielis.com
*/
add_action( 'widgets_init', 'stf_search_widget' );
function stf_search_widget() {
	register_widget( 'stf_search' );
}
class stf_search extends WP_Widget {
	function stf_search() {
		$widget_ops = array( 'classname' => 'search'  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'search-widget' );
		$this->WP_Widget( 'search-widget',theme_name .' - 搜尋', $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) { ?>
	<div class="search-widget">
		<form method="get" id="searchform" action="<?php echo home_url() ; ?>/">
			<input type="text" id="s" name="s" value="輸入關鍵字並按 Enter 搜尋" onfocus="if (this.value == '輸入關鍵字並按 Enter 搜尋') {this.value = '';}" onblur="if (this.value == '') {this.value = '輸入關鍵字並按 Enter 搜尋';}"  />
		</form>
	</div><!-- .search-widget /-->		
<?php
	}
}
?>