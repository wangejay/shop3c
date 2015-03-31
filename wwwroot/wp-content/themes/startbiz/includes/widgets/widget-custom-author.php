<?php
/**
* 自訂作者簡介的小工具函式
*
* @file 		 widget-custom-author.php
* @package	 StartPress Company
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://carrielis.com
*/
add_action( 'widgets_init', 'stf_Author_Bio_widget' );
function stf_Author_Bio_widget() {
	register_widget( 'stf_Author_Bio' );
}
class stf_Author_Bio extends WP_Widget {

	function stf_Author_Bio() {
		$widget_ops = array( 'classname' => 'Author-Bio' );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'author-bio-widget' );
		$this->WP_Widget( 'author-bio-widget',theme_name .' - 自訂作者簡介', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$img = $instance['img'];
		if( function_exists('icl_t') )  $text_code = icl_t( theme_name , 'widget_content_'.$this->id , $instance['text_code'] ); else $text_code = $instance['text_code'] ;
	
			echo $before_widget;
			echo $before_title;
			echo $title ; 
			echo $after_title; ?>
			<div class="author-avatar">
				<img alt="" src="<?php echo $img; ?>">
			</div>
			<div class="author-description">
			<?php
			echo do_shortcode( $text_code ); ?>
			</div><div class="clear"></div>
			<?php
			echo $after_widget;
		
		
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['img'] = $new_instance['img'] ;
		$instance['text_code'] = $new_instance['text_code'] ;
		
		if (function_exists('icl_register_string')) {
			icl_register_string( theme_name , 'widget_content_'.$this->id, $new_instance['text_code'] );
		}
		
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => '關於作者' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">標題 : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'img' ); ?>">大頭貼 : </label>
			<input id="<?php echo $this->get_field_id( 'img' ); ?>" name="<?php echo $this->get_field_name( 'img' ); ?>" value="<?php echo $instance['img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'text_code' ); ?>">關於 : <i>你可以使用 Shortcodes</i></label>
			<textarea rows="15" id="<?php echo $this->get_field_id( 'text_code' ); ?>" name="<?php echo $this->get_field_name( 'text_code' ); ?>" class="widefat" ><?php echo $instance['text_code']; ?></textarea>
		</p>
		


	<?php
	}
}
?>