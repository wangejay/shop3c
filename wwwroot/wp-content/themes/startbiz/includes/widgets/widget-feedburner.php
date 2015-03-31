<?php
/**
* FeedBurner 訂閱數小工具函數
*
* @file 		 widget-feedburner.php
* @package	 StartPress Company
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://carrielis.com
*/
add_action( 'widgets_init', 'stf_feedburner_widget_box' );
function stf_feedburner_widget_box() {
	register_widget( 'stf_feedburner_widget' );
}
class stf_feedburner_widget extends WP_Widget {

	function stf_feedburner_widget() {
		$widget_ops = array( 'classname' => 'widget-feedburner' , 'description' => '使用 Email 訂閱我們的 FeedBurner 新聞' );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget-feedburner' );
		$this->WP_Widget( 'widget-feedburner',theme_name .' - Feedburner 小工具 ', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		if( function_exists('icl_t') )  $text_code = icl_t( theme_name , 'widget_content_'.$this->id , $instance['text_code'] ); else $text_code = $instance['text_code'] ;
		$feedburner = $instance['feedburner'];
		
		echo $before_widget;
		echo $before_title;
		echo $title ; 
		echo $after_title;
		echo '<div class="widget-feedburner-counter">
		<p>'.do_shortcode( $text_code ).'</p>' ; ?>
		<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedburner ; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
			<input class="feedburner-email" type="text" name="email" value="請輸入你的 e-mail 信箱" onfocus="if (this.value == '請輸入你的 e-mail 信箱') {this.value = '';}" onblur="if (this.value == '') {this.value = '請輸入你的 e-mail 信箱';}">
			<input type="hidden" value="<?php echo $feedburner ; ?>" name="uri">
			<input type="hidden" name="loc" value="zh_TW">			
			<input class="feedburner-subscribe" type="submit" name="submit" value="訂閱我們"> 
		</form>
		</div>
		<?php
		echo $after_widget;			
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['text_code'] = $new_instance['text_code'] ;
		$instance['feedburner'] = strip_tags( $new_instance['feedburner'] );
		
		if (function_exists('icl_register_string')) {
			icl_register_string( theme_name , 'widget_content_'.$this->id, $new_instance['text_code'] );
		}

		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'FeedBurner 小工具' , 'text_code' => '訂閱我們的電子報' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">標題 : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'text_code' ); ?>">在上方的電子郵件欄位輸入文字 : <small>( 支援 : HTML 和 Shortcodes )</small> </label>
			<textarea rows="5" id="<?php echo $this->get_field_id( 'text_code' ); ?>" name="<?php echo $this->get_field_name( 'text_code' ); ?>" class="widefat" ><?php echo $instance['text_code']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'feedburner' ); ?>">Feedburner ID : </label>
			<input id="<?php echo $this->get_field_id( 'feedburner' ); ?>" name="<?php echo $this->get_field_name( 'feedburner' ); ?>" value="<?php echo $instance['feedburner']; ?>" class="widefat" type="text" />
		</p>


	<?php
	}
}
?>