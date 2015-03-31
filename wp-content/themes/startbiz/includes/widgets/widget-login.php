<?php
/**
* 登入小工具函式
*
* @file 		 widget-login.php
* @package	 StartPress Company
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://carrielis.com
*/
add_action( 'widgets_init', 'stf_login_widget_box' );
function stf_login_widget_box() {
	register_widget( 'stf_login_widget' );
}
class stf_login_widget extends WP_Widget {

	function stf_login_widget() {
		$widget_ops = array( 'classname' => 'login-widget'  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'login-widget' );
		$this->WP_Widget( 'login-widget',theme_name .' - 登入', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		
		echo $before_widget;
		echo $before_title;
		echo $title ; 
		echo $after_title;
		stf_login_form();
		echo $after_widget;
			
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => '登入'  );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">標題 : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>



	<?php
	}
}
?>