<?php
/**
* 作者小工具函式
*
* @file 		 widget-author.php
* @package	 StartPress Company
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://carrielis.com
*/

## 作者小工具
add_action( 'widgets_init', 'stf_Author_widget_box' );
function stf_Author_widget_box(){
	register_widget( 'stf_author_widget' );
}
class stf_author_widget extends WP_Widget {
	function stf_author_widget() {
		$widget_ops = array( 'classname' => 'widget_author' );
		$this->WP_Widget( 'author_widget',theme_name .' - 文章作者', $widget_ops );
	}
	function widget( $args, $instance ) {
		extract( $args );
		if ( is_single() ) :
		
		wp_reset_query();
		
		$avatar = $instance['avatar'];
		$social = $instance['social'];
		
		echo $before_widget;
		echo $before_title;
		printf( '關於 %s' , get_the_author() );
		echo $after_title; 
		
		stf_author_box( $avatar , $social );
		
		echo $after_widget;
		endif;
	}
	
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = ' ';
		$instance['avatar'] = strip_tags( $new_instance['avatar'] );
		$instance['social'] = strip_tags( $new_instance['social'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'avatar' => 'true' , 'social' => 'true' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		?>
		
		<p><em style="color:red;">此小工具只顯示於單篇文章中。</em></p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'avatar' ); ?>">顯示作者大頭貼 : </label>
			<input id="<?php echo $this->get_field_id( 'avatar' ); ?>" name="<?php echo $this->get_field_name( 'avatar' ); ?>" value="true" <?php if( $instance['avatar'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'social' ); ?>">顯示社交網站圖示 : </label>
			<input id="<?php echo $this->get_field_id( 'social' ); ?>" name="<?php echo $this->get_field_name( 'social' ); ?>" value="true" <?php if( $instance['social'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>

	<?php
	}
}




## 作者文章小工具
add_action( 'widgets_init', 'Author_post_widget_box' );
function Author_post_widget_box(){
	register_widget( 'author_post_widget' );
}
class author_post_widget extends WP_Widget {
	function author_post_widget() {
		$widget_ops = array( 'classname' => 'widget_author_posts'  );
		$this->WP_Widget( 'author_post_widget',theme_name .' - 文章作者', $widget_ops );
	}
	function widget( $args, $instance ) {
		extract( $args );
		wp_reset_query();
		if ( is_single() ) :
		
			$no_of_posts = $instance['no_of_posts'];
			$see_all = $instance['see_all'];
			
			$orig_post = $post;
			$authorID = get_the_author_meta( 'ID' );
			$args=array('author' => $authorID , 'post__not_in' => array($post->ID), 'posts_per_page'=> $no_of_posts, 'no_found_rows' => 1 );
			$my_query = new wp_query( $args );
		if( $my_query->have_posts() ) :
			echo $before_widget; 
				echo $before_title;
				printf( '作者 %s' , get_the_author() );
			echo $after_title; ?>
			<ul>
			<?php while( $my_query->have_posts() ) { $my_query->the_post();?>
				<li><a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
			<?php } ?>
			</ul>
			<?php if($see_all) : ?>
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"> 所有文章 (<?php echo count_user_posts($authorID) ?>)</a>
			<?php endif; ?>

			<?php
			$post = $orig_post; wp_reset_query();
			echo $after_widget;
		endif;
		endif;

	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = ' ';
		$instance['no_of_posts'] = strip_tags( $new_instance['no_of_posts'] );
		$instance['see_all'] = strip_tags( $new_instance['see_all'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'no_of_posts' => '5' , 'see_all' => 'true' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		?>
		
		<p><em style="color:red;">此小工具只顯示於單篇文章中。</em></p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>">文章顯示數量: </label>
			<input id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php echo $instance['no_of_posts']; ?>" type="text" size="3" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'see_all' ); ?>">顯示 ( 所有文章 ) 鏈結網址 : </label>
			<input id="<?php echo $this->get_field_id( 'see_all' ); ?>" name="<?php echo $this->get_field_name( 'see_all' ); ?>" value="true" <?php if( $instance['see_all'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>

	<?php
	}
}

?>