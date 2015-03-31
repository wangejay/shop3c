<?php
/**
* 評分小工具函式
*
* @file 		 widget-reviews.php
* @package	 StartPress Company
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://carrielis.com
*/

## 評分小工具
add_action( 'widgets_init', 'stf_review_widget_box' );
function stf_review_widget_box() {
	register_widget( 'stf_review_widget' );
}
class stf_review_widget extends WP_Widget {

	function stf_review_widget() {
		$widget_ops = array( 'classname' => 'review-widget'  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'review-widget' );
		$this->WP_Widget( 'review-widget',theme_name .' - 評分框', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		global $post ;
		$get_meta = get_post_custom($post->ID);
		if ( is_single() && !empty( $get_meta['stf_review_position'][0] )) :
				
			$title = apply_filters('widget_title', $instance['title'] );
			$page_url = $instance['page_url'];

			echo $before_widget;
			if ( $title )
				echo $before_title;
			echo $title ;
			echo $after_title;
			stf_get_review( 'review-bottom' );
			echo $after_widget;
		endif;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['page_url'] = strip_tags( $new_instance['page_url'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => '評分總覽' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p><em style="color:red;">這個小工具只出現在單篇文章中。</em></p>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">標題 : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>

	<?php
	}
}

?>