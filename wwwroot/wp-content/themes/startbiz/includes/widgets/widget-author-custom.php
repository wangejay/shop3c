<?php
/**
* 自訂作者內容小工具函式
*
* @file 		 widget-author-custom.php
* @package	 StartPress Company
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://carrielis.com
*/
add_action( 'widgets_init', 'stf_author_custom_widget' );
function stf_author_custom_widget() {
	register_widget( 'stf_author_custom' );
}
class stf_author_custom extends WP_Widget {

	function stf_author_custom() {
		$widget_ops = array( 'classname' => 'author-custom'  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'author-custom-widget' );
		$this->WP_Widget( 'author-custom-widget',theme_name .' - 自訂作者內容', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$center = $instance['center'];
		
		if ($center)
			$center = 'style="text-align:center;"';
		else
			$center = '';

		wp_reset_query();
		if ( get_the_author_meta( 'author_widget_content' ) && is_single() ) {
			$text_code = get_the_author_meta( 'author_widget_content' );
			if( !$tran_bg ){
				echo $before_widget;
				echo $before_title;
				echo $title ; 
				echo $after_title;
				echo '<div '.$center.'>';
				echo do_shortcode( $text_code ) .'
					</div><div class="clear"></div>';
				echo $after_widget;
			}
			else {?>
				<div class="text-html-box" <?php echo $center ?>>
				<?php echo do_shortcode( $text_code ) ?>
				</div>
			<?php
			}
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['center'] = strip_tags( $new_instance['center'] );
		return $instance;
	}

	function form( $instance ) {
		//$defaults = array( 'title' =>__('Text' , 'stf')  );
		//$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p><em style="color:red;">此小工具只顯示於單篇文章中。</em></p>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">標題 : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>">透明背景 :</label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( $instance['tran_bg'] ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small>如果啟用此功能，標題將會消失</small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'center' ); ?>">內容置中 :</label>
			<input id="<?php echo $this->get_field_id( 'center' ); ?>" name="<?php echo $this->get_field_name( 'center' ); ?>" value="true" <?php if( $instance['center'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		


	<?php
	}
}
?>