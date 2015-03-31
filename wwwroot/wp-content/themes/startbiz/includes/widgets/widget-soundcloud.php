<?php
/**
* 雲端音樂小工具函式
*
* @file 		 widget-soundcloud.php
* @package	 StartPress Company
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://carrielis.com
*/
add_action( 'widgets_init', 'stf_soundcloud_widget' );
function stf_soundcloud_widget() {
	register_widget( 'stf_soundcloud' );
}
class stf_soundcloud extends WP_Widget {

	function stf_soundcloud() {
		$widget_ops = array( 'classname' => 'stf-soundcloud'  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'stf-soundcloud-widget' );
		$this->WP_Widget( 'stf-soundcloud-widget',theme_name .' - 雲端音樂', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$url = $instance['url'];
		$autoplay = $instance['autoplay'];
		
		$play = 'false';
		if( !empty( $autoplay )) $play = 'true';

			echo $before_widget;
			echo $before_title;
			echo $title ; 
			echo $after_title;
			echo stf_soundcloud( $url , $play );
			echo $after_widget;
				
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['url'] = $new_instance['url'] ;
		$instance['autoplay'] = strip_tags( $new_instance['autoplay'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => '雲端音樂'  );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">標題 : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'url' ); ?>">網址 :</label>
			<input id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" value="<?php echo $instance['url']; ?>" type="text" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'autoplay' ); ?>">自動播放 :</label>
			<input id="<?php echo $this->get_field_id( 'autoplay' ); ?>" name="<?php echo $this->get_field_name( 'autoplay' ); ?>" value="true" <?php if( $instance['autoplay'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>


	<?php
	}
}
?>