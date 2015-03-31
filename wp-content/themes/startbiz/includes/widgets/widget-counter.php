<?php
/**
* 社交網站追蹤數的小工具函式
*
* @file 		 widget-counter.php
* @package	 StartPress Company
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://carrielis.com
*/
add_action( 'widgets_init', 'stf_counter_widget_box' );
function stf_counter_widget_box() {
	register_widget( 'stf_counter_widget' );
}
class stf_counter_widget extends WP_Widget {

	function stf_counter_widget() {
		$widget_ops = array( 'classname' => 'counter-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'counter-widget' );
		$this->WP_Widget( 'counter-widget',theme_name .' - 社交網站追蹤人數', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {

		$facebook_page = @$instance['facebook'] ;
		$rss_id = @$instance['rss'] ;
		$twitter_id =  @$instance['twitter'] ;
		$youtube_url = @$instance['youtube'] ;
		$vimeo_url = @$instance['vimeo'] ;
		$dribbble_url = @$instance['dribbble'];
		$soundcloud_url = @$instance['soundcloud'];
		$soundcloud_api = @$instance['soundcloud_api'];
		$instagram_url = @$instance['instagram'];
		$instagram_api = @$instance['instagram_api'];
		$new_window = @$instance['new_window'];

		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';
				
		$counter = 0;
		if( $rss_id ) $counter ++ ;
		if( $twitter_id ) $counter ++ ;
		if( $facebook_page ) $counter ++ ;
		if( $youtube_url ) $counter ++ ;
		if( $vimeo_url ) $counter ++ ;
		if( $dribbble_url ) $counter ++ ;
		if( $soundcloud_url ) $counter ++ ;
		if( $instagram_url ) $counter ++ ;

		?>
		<div class="widget widget-counter col<?php echo $counter; ?>">
			<ul>
			<?php if( $rss_id ): ?>
				<li class="rss-subscribers">
					<a href="<?php echo $rss_id ?>"<?php echo $new_window ?>>
						<strong class="stficon-rss"></strong>
						<span>訂戶</span>
						<small>RSS Feed</small>
					</a>
				</li>
			<?php endif; ?>
			<?php if( $twitter_id ):
					$twitter = stf_followers_count(); ?>
				<li class="twitter-followers">
					<a href="<?php echo $twitter['page_url'] ?>"<?php echo $new_window ?>>
						<strong class="stficon-twitter"></strong>
						<span><?php echo @number_format($twitter['followers_count']) ?></span>
						<small>追蹤數</small>
					</a>
				</li>
			<?php endif; ?>
			<?php if( $facebook_page ):
					$facebook = stf_facebook_fans( $facebook_page ); ?>
				<li class="facebook-fans">
					<a href="<?php echo $facebook_page ?>"<?php echo $new_window ?>>
						<strong class="stficon-facebook"></strong>
						<span><?php echo @number_format( $facebook ) ?></span>
						<small>粉絲數</small>
					</a>
				</li>
			<?php endif; ?>
			<?php if( $youtube_url ):
					$youtube = stf_youtube_subs( $youtube_url ); ?>
				<li class="youtube-subs">
					<a href="<?php echo $youtube_url ?>"<?php echo $new_window ?>>
						<strong class="stficon-youtube"></strong>
						<span><?php echo @number_format( $youtube ) ?></span>
						<small>訂戶</small>
					</a>
				</li>
			<?php endif; ?>
			<?php if( $vimeo_url ):
					$vimeo = stf_vimeo_count( $vimeo_url ); ?>
				<li class="vimeo-subs">
					<a href="<?php echo $vimeo_url ?>"<?php echo $new_window ?>>
						<strong class="stficon-vimeo"></strong>
						<span><?php echo @number_format( $vimeo ) ?></span>
						<small>訂戶</small>
					</a>
				</li>
			<?php endif; ?>
			<?php if( $dribbble_url ):
					$dribbble = stf_dribbble_count( $dribbble_url ); ?>
				<li class="dribbble-followers">
					<a href="<?php echo $dribbble_url ?>"<?php echo $new_window ?>>
						<strong class="stficon-dribbble"></strong>
						<span><?php echo @number_format( $dribbble ) ?></span>
						<small>追蹤數</small>
					</a>
				</li>
			<?php endif; ?>
			<?php if( $soundcloud_url && $soundcloud_api ):
				$soundcloud = stf_soundcloud_count( $soundcloud_url , $soundcloud_api ); ?>
				<li class="soundcloud-followers">
					<a href="<?php echo $soundcloud_url ?>"<?php echo $new_window ?>>
						<strong class="stficon-soundcloud"></strong>
						<span><?php echo @number_format( $soundcloud ) ?></span>
						<small>追蹤數</small>
					</a>
				</li>
			<?php endif; ?>
			<?php if( $instagram_url && $instagram_api ):
				$instagram = stf_instagram_count( $instagram_url , $instagram_api ); ?>
				<li class="instagram-followers">
					<a href="<?php echo $instagram_url ?>"<?php echo $new_window ?>>
						<strong class="stficon-instagram"></strong>
						<span><?php echo @number_format( $instagram ) ?></span>
						<small>追蹤數</small>
					</a>
				</li>
			<?php endif; ?>

			</ul>
		</div>
		
	<?php 
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['facebook'] = $new_instance['facebook'] ;
		$instance['rss'] =  $new_instance['rss'] ;
		$instance['twitter'] =  strip_tags($new_instance['twitter']) ;
		$instance['youtube'] = $new_instance['youtube'] ;
		$instance['vimeo'] =  $new_instance['vimeo'] ;
		$instance['dribbble'] =  $new_instance['dribbble'] ;
		$instance['soundcloud'] =  $new_instance['soundcloud'] ;
		$instance['soundcloud_api'] =  $new_instance['soundcloud_api'] ;
		$instance['instagram'] =  $new_instance['instagram'] ;
		$instance['instagram_api'] =  $new_instance['instagram_api'] ;
		
		delete_transient('fans_count');
		delete_transient('twitter_count');
		delete_transient('youtube_count');
		delete_transient('vimeo_count');
		delete_transient('dribbble_count');
		delete_transient('soundcloud_count');
		delete_transient('instagram_count');

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>">在瀏覽器新頁籤開啟鏈結網址:</label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( $instance['new_window'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p style="border-bottom: 1px solid #DDD;padding-bottom: 10px;">
			<label for="<?php echo $this->get_field_id( 'rss' ); ?>"><strong>Feed</strong> 網址 : </label>
			<input id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php echo $instance['rss']; ?>" class="widefat" type="text" />
		</p>
		<p style="border-bottom: 1px solid #DDD;padding-bottom: 10px;">
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><strong>Facebook</strong> 粉絲頁網址 : </label>
			<input id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" class="widefat" type="text" />
		</p>
		<?php
		$twitter_username 		= stf_get_option('twitter_username');
		$consumer_key 			= stf_get_option('twitter_consumer_key');
		$consumer_secret		= stf_get_option('twitter_consumer_secret');
		$access_token 			= stf_get_option('twitter_access_token');
		$access_token_secret 	= stf_get_option('twitter_access_token_secret');
		
		if( empty($twitter_username) || empty($consumer_key) || empty($consumer_secret) || empty($access_token) || empty($access_token_secret)  )
				echo '<p style="display:block; padding: 5px; font-weight:bold; clear:both; background: rgb(255, 157, 157);">錯誤 : 請至 > 外觀 > 主題選項 > 設定 Twitter API 。</p>';
		
		?>
		<p style="border-bottom: 1px solid #DDD;padding-bottom: 10px;">
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><strong>Twitter</strong> 追蹤人數: </label>
			<input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>"  value="true" <?php if( $instance['twitter'] ) echo 'checked="checked"'; ?> type="checkbox"  />
		</p>
		<p style="border-bottom: 1px solid #DDD;padding-bottom: 10px;">
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><strong>Youtube</strong> 頻道網址 : </label>
			<input id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo $instance['youtube']; ?>" class="widefat" type="text" />
			<small>鏈結網址類似： http://www.youtube.com/user/username 或 http://www.youtube.com/channel/channel-name </small>

		</p>
		<p style="border-bottom: 1px solid #DDD;padding-bottom: 10px;">
			<label for="<?php echo $this->get_field_id( 'vimeo' ); ?>"><strong>Vimeo</strong> 頻道網址 : </label>
			<input id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" value="<?php echo $instance['vimeo']; ?>" class="widefat" type="text" />
			<small>鏈結網址類似： http://vimeo.com/channels/username </small>

		</p>
		<p style="border-bottom: 1px solid #DDD;padding-bottom: 10px;">
			<label for="<?php echo $this->get_field_id( 'dribbble' ); ?>"><strong>dribbble</strong> 粉絲頁網址 : </label>
			<input id="<?php echo $this->get_field_id( 'dribbble' ); ?>" name="<?php echo $this->get_field_name( 'dribbble' ); ?>" value="<?php echo $instance['dribbble']; ?>" class="widefat" type="text" />
			<small>鏈結網址類似： http://dribbble.com/username</small>
		</p>
		<p style="border-bottom: 1px solid #DDD;padding-bottom: 10px;">
			<label for="<?php echo $this->get_field_id( 'soundcloud' ); ?>"><strong>SoundCloud</strong> 會員專頁網址 : </label>
			<input id="<?php echo $this->get_field_id( 'soundcloud' ); ?>" name="<?php echo $this->get_field_name( 'soundcloud' ); ?>" value="<?php echo $instance['soundcloud']; ?>" class="widefat" type="text" />
			
			<label for="<?php echo $this->get_field_id( 'soundcloud_api' ); ?>">API Key : </label>
			<input id="<?php echo $this->get_field_id( 'soundcloud_api' ); ?>" name="<?php echo $this->get_field_name( 'soundcloud_api' ); ?>" value="<?php echo $instance['soundcloud_api']; ?>" class="widefat" type="text" />
		</p>
		<p style="border-bottom: 1px solid #DDD;padding-bottom: 10px;">
			<label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><strong>Instagram</strong> 會員專頁網址 : </label>
			<input id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" value="<?php echo $instance['instagram']; ?>" class="widefat" type="text" />
			
			<label for="<?php echo $this->get_field_id( 'instagram_api' ); ?>">存取權限密鑰 Key : </label>
			<input id="<?php echo $this->get_field_id( 'instagram_api' ); ?>" name="<?php echo $this->get_field_name( 'instagram_api' ); ?>" value="<?php echo $instance['instagram_api']; ?>" class="widefat" type="text" />
		</p>

	<?php
	}
}


?>