<?php
/**
* Facebook 小工具函式
*
* @file 		 widget-facebook.php
* @package	 StartPress Company
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://carrielis.com
*/
add_action( 'widgets_init', 'stf_acebook_widget_box' );
function stf_acebook_widget_box() {
	register_widget( 'stf_facebook_widget' );
}
class stf_facebook_widget extends WP_Widget {

	function stf_facebook_widget() {
		$widget_ops = array( 'classname' => 'facebook-widget' );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'facebook-widget' );
		$this->WP_Widget( 'facebook-widget',theme_name .' - Facebook', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$color = 'light';
		if( !empty($instance['dark']) ) $color = 'dark';
		$title = apply_filters('widget_title', $instance['title'] );
		$page_url = $instance['page_url'];

		echo $before_widget;
		if ( $title )
			echo $before_title;
			echo $title ; ?>
		<?php echo $after_title; ?>
			<div class="facebook-box">
				<iframe src="http://www.facebook.com/plugins/likebox.php?href=<?php echo $page_url ?>&amp;width=300&amp;height=250&amp;colorscheme=<?php echo $color; ?>&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:250px;" allowTransparency="true"></iframe>
			</div>
	<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['page_url'] = strip_tags( $new_instance['page_url'] );
		$instance['dark'] = strip_tags( $new_instance['dark'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => '加入我們的 Facebook' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">標題 : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'page_url' ); ?>">粉絲頁網址 : </label>
			<input id="<?php echo $this->get_field_id( 'page_url' ); ?>" name="<?php echo $this->get_field_name( 'page_url' ); ?>" value="<?php echo $instance['page_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'dark' ); ?>">深色外觀 ?</label>
			<input id="<?php echo $this->get_field_id( 'dark' ); ?>" name="<?php echo $this->get_field_name( 'dark' ); ?>" value="true" <?php if( $instance['dark'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>

	<?php
	}
}
?>