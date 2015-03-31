<?php
/**
* Tabbed 頁籤小工具函式
*
* @file 		 widget-tabbed.php
* @package	 StartPress Company
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://carrielis.com
*/
## widget_tabs
add_action( 'widgets_init', 'stf_widget_tabs_box' );
function stf_widget_tabs_box(){
	register_widget( 'stf_widget_tabs' );
}
class stf_widget_tabs extends WP_Widget {
	function stf_widget_tabs() {
		$widget_ops = array( 'description' => '熱門文章, 最新文章, 最新留言, 熱門標籤'  );
		$this->WP_Widget( 'widget_tabs',theme_name .'- Tabbed  ', $widget_ops );
	}
	function widget( $args, $instance ) {
		
		if( empty($instance['posts_number']) || $instance['posts_number'] == ' ' || !is_numeric($instance['posts_number']))	$posts_number = 5;
		else $posts_number = $instance['posts_number'];
	?>
	<div class="widget" id="tabbed-widget">
		<div class="widget-container">
			<div class="widget-top">
				<ul class="tabs posts-taps">
					<li class="tabs"><a href="#tab1">熱門文章</a></li>
					<li class="tabs"><a href="#tab2">最新文章</a></li>
					<li class="tabs"><a href="#tab3">最新留言</a></li>
					<li class="tabs" style="margin-left:0"><a href="#tab4">熱門標籤</a></li>
				</ul>
			</div>
			<div id="tab1" class="tabs-wrap">
				<ul>
					<?php stf_popular_posts( $posts_number ) ?>	
				</ul>
			</div>
			<div id="tab2" class="tabs-wrap">
				<ul>
					<?php stf_last_posts( $posts_number )?>	
				</ul>
			</div>
			<div id="tab3" class="tabs-wrap">
				<ul>
					<?php stf_most_commented( $posts_number );?>
				</ul>
			</div>
			<div id="tab4" class="tabs-wrap tagcloud">
				<?php wp_tag_cloud( $args = array('largest' => 8,'number' => 25,'orderby'=> 'count', 'order' => 'DESC' )); ?>
			</div>
		</div>
	</div><!-- .widget /-->
<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['posts_number'] = strip_tags( $new_instance['posts_number'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'posts_number' => 5 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'posts_number' ); ?>">文章顯示數量 : </label>
			<input id="<?php echo $this->get_field_id( 'posts_number' ); ?>" name="<?php echo $this->get_field_name( 'posts_number' ); ?>" value="<?php echo $instance['posts_number']; ?>" size="3" type="text" />
		</p>


	<?php
	}
}
?>
