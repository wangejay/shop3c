<?php
/**
* Flickr 小工具函式
*
* @file 		 widget-flickr.php
* @package	 StartPress Company
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://carrielis.com
*/
add_action( 'widgets_init', 'stf_flickr_photos_widget' );
function stf_flickr_photos_widget() {
	register_widget( 'stf_flickr_photos' );
}
class stf_flickr_photos extends WP_Widget {

	function stf_flickr_photos() {
		$widget_ops = array( 'classname' => 'flickr-widget' );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'flickr_photos-widget' );
		$this->WP_Widget( 'flickr_photos-widget',theme_name .' - Flickr', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$no_of_photos = $instance['no_of_photos'];
		$flickr_id = $instance['flickr_id'];
		$flickr_display = $instance['flickr_display'];

		echo $before_widget;
		if ( $title )
			echo $before_title;
			echo $title ; ?>
		<?php echo $after_title; ?>
		<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $no_of_photos; ?>&amp;display=<?php echo $flickr_display; ?>&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $flickr_id; ?>"></script>        
		<div class="clear"></div>
	<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['no_of_photos'] = strip_tags( $new_instance['no_of_photos'] );
		$instance['flickr_id'] = strip_tags( $new_instance['flickr_id'] );
		$instance['flickr_display'] = strip_tags( $new_instance['flickr_display'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'Flickr', 'no_of_photos' => '6' , 'flickr_display' => 'latest' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">標題 : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'flickr_id' ); ?>">Flickr ID : </label>
			<input id="<?php echo $this->get_field_id( 'flickr_id' ); ?>" name="<?php echo $this->get_field_name( 'flickr_id' ); ?>" value="<?php echo $instance['flickr_id']; ?>" class="widefat" type="text" />
			<small> 去(<a href="http://www.idgettr.com">idGettr</a>) 網站尋找你的 Flickr ID</small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_photos' ); ?>">顯示數量 : </label>
			<input id="<?php echo $this->get_field_id( 'no_of_photos' ); ?>" name="<?php echo $this->get_field_name( 'no_of_photos' ); ?>" value="<?php echo $instance['no_of_photos']; ?>" type="text" size="3" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'flickr_display' ); ?>">顯示 ? </label>
			<select id="<?php echo $this->get_field_id( 'flickr_display' ); ?>" name="<?php echo $this->get_field_name( 'flickr_display' ); ?>" >
				<option value="latest" <?php if( $instance['flickr_display'] == 'latest' ) echo "selected=\"selected\""; else echo ""; ?>>最新</option>
				<option value="random" <?php if( $instance['flickr_display'] == 'random' ) echo "selected=\"selected\""; else echo ""; ?>>隨機選擇</option>
			</select>
		</p>

	<?php
	}
}
?>