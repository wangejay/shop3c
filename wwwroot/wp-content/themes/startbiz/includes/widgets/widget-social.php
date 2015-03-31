<?php
/**
* 社交網站小工具函式
*
* @file 		 widget-social.php
* @package	 StartPress Company
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://carrielis.com
*/
add_action( 'widgets_init', 'stf_social_widget_box' );
function stf_social_widget_box() {
	register_widget( 'stf_social_widget' );
}
class stf_social_widget extends WP_Widget {

	function stf_social_widget() {
		$widget_ops = array( 'classname' => 'social-icons-widget' );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'social' );
		$this->WP_Widget( 'social',theme_name .' - 社交網站圖示', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		
		if( !empty($instance['newtap']) ) $newtap = $instance['newtap'];
		else $newtap = '';

		if( !empty($instance['icons_size']) ) $icons_size = $instance['icons_size'];
		else $icons_size = '';
			
		if( !$tran_bg ){
			echo $before_widget;
			echo $before_title;
			echo $title ; 
			echo $after_title;
				stf_get_social($newtab= $newtap, $icon_size=$icons_size);
			echo $after_widget;
		}
		else { ?>
			<div class="widget social-icons-widget">
			<?php stf_get_social($newtab= $newtap, $icon_size=$icons_size); ?>
			</div>
		<?php }			
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['icons_size'] = strip_tags( $new_instance['icons_size'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['newtap'] = strip_tags( $new_instance['newtap'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>'社交圖示' , 'icon_size' =>'16' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">標題 : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>">透明背景 :</label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( $instance['tran_bg'] ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small>如果啟用此功能標題將會消失</small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'newtap' ); ?>">在瀏覽器新頁籤開啟鏈結網址 :</label>
			<input id="<?php echo $this->get_field_id( 'newtap' ); ?>" name="<?php echo $this->get_field_name( 'newtap' ); ?>" value="yes" <?php if( $instance['newtap'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'icons_size' ); ?>">圖示尺寸 : </label>
			<select id="<?php echo $this->get_field_id( 'icons_size' ); ?>" name="<?php echo $this->get_field_name( 'icons_size' ); ?>" >
				<option value="24" <?php if( $instance['icons_size'] == '24' ) echo "selected=\"selected\""; else echo ""; ?>>24px</option>
				<option value="32" <?php if( $instance['icons_size'] == '32' ) echo "selected=\"selected\""; else echo ""; ?>>32px</option>
			</select>
		</p>
		


	<?php
	}
}
?>