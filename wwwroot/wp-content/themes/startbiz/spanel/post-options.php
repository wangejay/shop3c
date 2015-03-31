<?php
/**
* Post Options
*
* @file 		 post-options.php
* @package	 StartPress Business
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://startpress.cc
*/
add_action("admin_init", "posts_init");
function posts_init(){
	add_meta_box("stf_post_options", theme_name ." - 文章設定選項", "stf_post_options_module", "post", "normal", "high");
	add_meta_box("stf_page_options", theme_name ." - 頁面設定選項", "stf_page_options_module", "page", "normal", "high");
}

function stf_post_options_module(){
	global $post ;
	$get_meta = get_post_custom($post->ID);
	
	if( !empty($get_meta["stf_sidebar_pos"][0]) )
		$stf_sidebar_pos = $get_meta["stf_sidebar_pos"][0];
	
	if( !empty($get_meta["stf_review_criteria"][0]) )
		$stf_review_criteria = unserialize($get_meta["stf_review_criteria"][0]);
?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
		  jQuery('.on-of').checkbox({empty:'<?php echo get_template_directory_uri(); ?>/spanel/images/empty.png'});
		 });
		jQuery(function() {
			jQuery( "#stf-reviews-list" ).sortable({placeholder: "stf-review-state-highlight"});
		});
	</script>
		<input type="hidden" name="stf_hidden_flag" value="true" />
		<div class="stf-spanel-item">
			<h3>文章頁首選項</h3>
			<?php	

			stf_post_options(				
				array(	"name" => "文章顯示格式",
						"id" => "stf_post_head",
						"type" => "select",
						"options" => array(
							''=> '預設',
							'none'=> '無',
							'video'=> '影片',
							'audio'=> '音訊 - 自架空間',
							'soundcloud'=> '音訊 - SoundCloud',
							'slider'=> '幻燈片',
							'map'=> 'Google 地圖',
							'thumb'=> '特色圖片',
							'lightbox'=> '特色圖片 + 燈箱效果'
						)));


			stf_post_options(				
				array(	"name" => "Embed 嵌入碼",
						"id" => "stf_embed_code",
						"type" => "textarea"));

			stf_post_options(				
				array(	"name" => "影片網址 <br /><small>支援 : YouTube, Vimeo, Viddler, Qik, Hulu, FunnyOrDie, DailyMotion, WordPress.tv 和 blip.tv</small>",
						"id" => "stf_video_url",
						"type" => "text"));

			stf_post_options(				
				array(	"name" => "SoundCloud 網址",
						"id" => "stf_audio_soundcloud",
						"type" => "text"));
						
			stf_post_options(				
				array(	"name" => "SoundCloud 自動播放",
						"id" => "stf_audio_soundcloud_play",
						"type" => "checkbox"));
						
			stf_post_options(				
				array(	"name" => "Mp3 檔案網址",
						"id" => "stf_audio_mp3",
						"type" => "text"));

			stf_post_options(				
				array(	"name" => "M4A 檔案網址",
						"id" => "stf_audio_m4a",
						"type" => "text"));
						
			stf_post_options(				
				array(	"name" => "OGA 檔案網址",
						"id" => "stf_audio_oga",
						"type" => "text"));	
						
			global $post;
			$orig_post = $post;
			
			$sliders = array();
			$custom_slider = new WP_Query( array( 'post_type' => 'stf_slider', 'posts_per_page' => -1, 'no_found_rows' => 1  ) );
			while ( $custom_slider->have_posts() ) {
				$custom_slider->the_post();
				$sliders[get_the_ID()] = get_the_title();
			}
			$post = $orig_post;
			wp_reset_query();
	
			stf_post_options(				
				array(	"name" => "自訂幻燈片",
						"id" => "stf_post_slider",
						"type" => "select",
						"options" => $sliders ));

			stf_post_options(				
				array(	"name" => "Google 地圖網址",
						"id" => "stf_googlemap_url",
						"type" => "text"));

			?>
		</div>
		<div class="stf-spanel-item">

			<h3>文章評分選項</h3>
			<?php	

			stf_post_options(				
				array(	"name" => "評分區塊位置",
						"id" => "stf_review_position",
						"type" => "select",
						"options" => array( "" => "停用" ,
											"top" => "顯示於文章上方" ,
											"bottom" => "顯示於文章下方",
											"both" => "文章上下方皆顯示",
											"custom" => "自訂顯示位置")));
			?>
			<p id="taq_custom_position_hint" class="stf_message_hint">
			使用 <strong>[review]</strong> 短代碼，可以將評分區塊放置在文章內容區的任何位置，或使用 <strong><?php echo theme_name ?> - 評分框 </strong> 小工具（Widget）。
			</p>
			<div id="reviews-options">
			<?php
			stf_post_options(				
				array(	"name" => "評分框外觀樣式",
						"id" => "stf_review_style",
						"type" => "select",
						"options" => array( "stars" => "星號" ,
											"percentage" => "百分比",
											"points" => "積分")));
											
			stf_post_options(				
				array(	"name" => "評分總覽",
						"id" => "stf_review_summary",
						"type" => "textarea"));

			stf_post_options(				
				array(	"name" => "文字會出現在總分底下",
						"id" => "stf_review_total",
						"type" => "text"));

			?>
				<input id="stf_add_review_criteria" type="button" class="spanel-save" value="新增評分標準">
				<ul id="stf-reviews-list">
				<?php $i = 0;
				if(!empty($stf_review_criteria) && is_array($stf_review_criteria) ){
					foreach( $stf_review_criteria as $stf_review ){  ; $i++; ?>
					<li class="option-item review-item">
						<div>
						<span class="label">評分標準</span>
						<input name="stf_review_criteria[<?php echo $i ?>][name]" type="text" value="<?php if( !empty($stf_review['name'] ) ) echo $stf_review['name'] ?>" />
						<div class="clear"></div>
						<span class="label">標準分數</span>
						<div id="criteria<?php echo $i ?>-slider"></div>
						<input type="text" id="criteria<?php echo $i ?>" value="<?php if( !empty($stf_review['score']) ) echo $stf_review['score']; else echo 0; ?>" name="stf_review_criteria[<?php echo $i ?>][score]" style="width:40px; opacity: 0.7;" />
						<a class="del-cat"></a>
						<script>
						  jQuery(document).ready(function() {
							jQuery("#criteria<?php echo $i ?>-slider").slider({
								range: "min",
								min: 0,
								max: 100,
								value: <?php if( !empty($stf_review['score']) ) echo $stf_review['score']; else echo 0; ?>,
								slide: function(event, ui) {
									jQuery('#criteria<?php echo $i ?>').attr('value', ui.value );
								}
								});
							});
						</script>
						</div>
					</li>	

						<?php
					}
				}
					?>
				</ul>
				<script>var nextReview = <?php echo $i+1 ?> ;</script>

			</div>
		</div>
		
		<div class="stf-spanel-item">
			<h3>側邊欄選項</h3>
			<div class="option-item">
				<?php
					$checked = 'checked="checked"';
				?>
				<ul id="sidebar-position-options" class="stf-options">
					<li>
						<input id="stf_sidebar_pos"  name="stf_sidebar_pos" type="radio" value="default" <?php if($stf_sidebar_pos == 'default' || !$stf_sidebar_pos ) echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/sidebar-default.png" /></a>
					</li>						<li>
						<input id="stf_sidebar_pos"  name="stf_sidebar_pos" type="radio" value="right" <?php if($stf_sidebar_pos == 'right' ) echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/sidebar-right.png" /></a>
					</li>
					<li>
						<input id="stf_sidebar_pos"  name="stf_sidebar_pos" type="radio" value="left" <?php if($stf_sidebar_pos == 'left') echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/sidebar-left.png" /></a>
					</li>
					<li>
						<input id="stf_sidebar_pos"  name="stf_sidebar_pos" type="radio" value="full" <?php if($stf_sidebar_pos == 'full') echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/sidebar-no.png" /></a>
					</li>
				</ul>
			</div>
			<?php
			$sidebars = stf_get_option( 'sidebars' ) ;
			$new_sidebars = array(''=> '預設');
			
			if($sidebars){
				foreach ($sidebars as $sidebar) {
					$new_sidebars[$sidebar] = $sidebar;
				}
			}
					
			stf_post_options(				
				array(	"name" => "選擇側邊欄",
						"id" => "stf_sidebar_post",
						"type" => "select",
						"options" => $new_sidebars ));
			?>
		</div>
		
		<div class="stf-spanel-item">
			<h3>Post Style </h3>
			<?php
				stf_post_options(				
					array(	"name" => "自訂顏色",
							"id" => "post_color",
							"type" => "color" ));
								
				stf_post_options(
					array(	"name" => "背景",
							"id" => "post_background",
							"type" => "background"));
								
				stf_post_options(
					array(	"name" => "全螢幕背景",
							"id" => "post_background_full",
							"type" => "checkbox"));
			?>
		</div>
		
		<div class="stf-spanel-item">
			<h3>一般選項</h3>
			<?php	

			stf_post_options(				
				array(	"name" => "隱藏文章資訊",
						"id" => "stf_hide_meta",
						"type" => "select",
						"options" => array( "" => "" ,
											"yes" => "是" ,
											"no" => "否")));

			stf_post_options(				
				array(	"name" => "隱藏作者資料",
						"id" => "stf_hide_author",
						"type" => "select",
						"options" => array( "" => "" ,
											"yes" => "是" ,
											"no" => "否")));
											
			stf_post_options(				
				array(	"name" => "隱藏分享按鈕",
						"id" => "stf_hide_share",
						"type" => "select",
						"options" => array( "" => "" ,
											"yes" => "是" ,
											"no" => "否")));
											
			stf_post_options(				
				array(	"name" => "隱藏相關文章",
						"id" => "stf_hide_related",
						"type" => "select",
						"options" => array( "" => "" ,
											"yes" => "是" ,
											"no" => "否")));
			?>
		</div>

		<div class="stf-spanel-item">
			<h3>廣告 Banners 選項</h3>
			<?php	
			stf_post_options(				
				array(	"name" => "隱藏上方 Banner",
						"id" => "stf_hide_above",
						"type" => "checkbox"));

			stf_post_options(				
				array(	"name" => "自訂上方 Banner",
						"id" => "stf_banner_above",
						"type" => "textarea"));

			stf_post_options(				
				array(	"name" => "隱藏下方 Banner",
						"id" => "stf_hide_below",
						"type" => "checkbox"));

			stf_post_options(				
				array(	"name" => "自訂下方 Banner",
						"id" => "stf_banner_below",
						"type" => "textarea"));
			?>
		</div>
  <?php
}


/*********************************************************************************************/

function stf_page_options_module(){
	global $post ;
	$get_meta = get_post_custom($post->ID);
	$stf_sidebar_pos = $get_meta["stf_sidebar_pos"][0];
	
	if( !empty( $get_meta["stf_review_criteria"][0] ) )
		$stf_review_criteria = unserialize($get_meta["stf_review_criteria"][0]);

	$categories_obj = get_categories();
	$categories = array();
	foreach ($categories_obj as $pn_cat) {
		$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
	}
	
?>	
	<script type="text/javascript">
		jQuery(document).ready(function($) {
		  jQuery('.on-of').checkbox({empty:'<?php echo get_template_directory_uri(); ?>/spanel/images/empty.png'});
		 });
		jQuery(function() {
			jQuery( "#stf-reviews-list" ).sortable({placeholder: "stf-review-state-highlight"});
		});
	</script>
		<input type="hidden" name="stf_hidden_flag" value="true" />	
		
		<div class="stf-spanel-item" id="stf-template-feed">
			<h3>顯示 Feed 模版選項</h3>
			<?php	
			stf_post_options(				
				array(	"name" => "RSS feed 網址",
						"id" => "stf_rss_feed",
						"type" => "text"));
			?>
		</div>

		<div class="stf-spanel-item" id="stf-template-blog">
			<h3>選擇分類目錄</h3>
			<div class="option-item">
				<span class="label">分類目錄</span>
				<select multiple="multiple" name="stf_blog_cats[]" id="stf_blog_cats">
					<?php
					 $stf_blog_cats = unserialize($get_meta["stf_blog_cats"][0]);
					 foreach ($categories as $key => $option) { ?>
					<option value="<?php echo $key ?>" <?php if ( @in_array( $key , $stf_blog_cats ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
					<?php } ?>
				</select>
			</div>
			<div id="stf_posts_num">
			<?php	
			stf_post_options(				
				array(	"name" => "文章數量",
						"id" => "stf_posts_num",
						"type" => "text"));
			?>
			</div>
		</div>
		
		<?php
			global $wp_roles;
			$roles = $wp_roles->get_names();
		?>
		<div class="stf-spanel-item" id="stf-template-authors">
			<h3>作者模版選項</h3>
			<div class="option-item">
					<span class="label">使用者角色</span>
					<select multiple="multiple" name="stf_authors[]" id="stf_authors">
						<?php
						 $stf_authors = unserialize($get_meta["stf_authors"][0]);
						 foreach ($roles as $key => $option) { ?>
						<option value="<?php echo $key ?>" <?php if ( @in_array( $key , $stf_authors ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		
		<div class="stf-spanel-item">
			<h3>文章頁首選項</h3>
			<?php	

			stf_post_options(				
				array(	"name" => "文章顯示格式",
						"id" => "stf_post_head",
						"type" => "select",
						"options" => array(
							''=> '預設',
							'none'=> '無',
							'video'=> '影片',
							'audio'=> '音訊 - 自架空間',
							'soundcloud'=> '音訊 - SoundCloud',
							'slider'=> '幻燈片',
							'map'=> 'Google 地圖',
							'thumb'=> '特色圖片',
							'lightbox'=> '特色圖片 + 燈箱效果'
						)));


			stf_post_options(				
				array(	"name" => "Embed 嵌入碼",
						"id" => "stf_embed_code",
						"type" => "textarea"));

			stf_post_options(				
				array(	"name" => "影片網址 <br /><small>支援 : YouTube, Vimeo, Viddler, Qik, Hulu, FunnyOrDie, DailyMotion, WordPress.tv 和 blip.tv</small>",
						"id" => "stf_video_url",
						"type" => "text"));
						
			stf_post_options(				
				array(	"name" => "SoundCloud 網址",
						"id" => "stf_audio_soundcloud",
						"type" => "text"));
						
			stf_post_options(				
				array(	"name" => "SoundCloud 自動播放",
						"id" => "stf_audio_soundcloud_play",
						"type" => "checkbox"));
						
			stf_post_options(				
				array(	"name" => "Mp3 檔案網址",
						"id" => "stf_audio_mp3",
						"type" => "text"));

			stf_post_options(				
				array(	"name" => "M4A 檔案網址",
						"id" => "stf_audio_m4a",
						"type" => "text"));
					
			stf_post_options(				
				array(	"name" => "OGA 檔案網址",
						"id" => "stf_audio_oga",
						"type" => "text"));			

						
			global $post;
			$orig_post = $post;
			
			$sliders = array();
			$custom_slider = new WP_Query( array( 'post_type' => 'stf_slider', 'posts_per_page' => -1, 'no_found_rows' => 1  ) );
			while ( $custom_slider->have_posts() ) {
				$custom_slider->the_post();
				$sliders[get_the_ID()] = get_the_title();
			}
			$post = $orig_post;
			wp_reset_query();
	
			stf_post_options(				
				array(	"name" => "自訂幻燈片",
						"id" => "stf_post_slider",
						"type" => "select",
						"options" => $sliders ));
						
						
			stf_post_options(				
				array(	"name" => "Google 地圖網址",
						"id" => "stf_googlemap_url",
						"type" => "text"));
			?>
		</div>
		
		<div class="stf-spanel-item">
			<h3>頁面評分選項</h3>
			<?php	

			stf_post_options(				
				array(	"name" => "評分區塊位置",
						"id" => "stf_review_position",
						"type" => "select",
						"options" => array( "" => "停用" ,
											"top" => "顯示於文章上方" ,
											"bottom" => "顯示於文章下方",
											"both" => "文章上下方皆顯示",
											"custom" => "自訂位置")));
			?>
			<p id="taq_custom_position_hint" class="stf_message_hint">
			使用 <strong>[review]</strong> 短代碼，可以將評分區塊放置在文章內容區的任何位置，或使用 <strong><?php echo theme_name ?> - 評分框 </strong> 小工具（Widget）。
			</p>
			<div id="reviews-options">
			<?php
			stf_post_options(				
				array(	"name" => "評分框外觀樣式",
						"id" => "stf_review_style",
						"type" => "select",
						"options" => array( "stars" => "星號" ,
											"percentage" => "百分比",
											"points" => "積分")));
											
			stf_post_options(				
				array(	"name" => "評分總覽",
						"id" => "stf_review_summary",
						"type" => "textarea"));

			stf_post_options(				
				array(	"name" => "文字顯示在總分底下",
						"id" => "stf_review_total",
						"type" => "text"));

			?>
				<input id="stf_add_review_criteria" type="button" class="spanel-save" value="新增評分標準">
				<ul id="stf-reviews-list">
				<?php $i = 0;
				if(!empty($stf_review_criteria) && is_array($stf_review_criteria) ){
					foreach( $stf_review_criteria as $stf_review ){  ; $i++; ?>
					<li class="option-item review-item">
						<div>
						<span class="label">評分標準</span>
						<input name="stf_review_criteria[<?php echo $i ?>][name]" type="text" value="<?php if( !empty($stf_review['name'] ) ) echo $stf_review['name'] ?>" />
						<div class="clear"></div>
						<span class="label">標準分數</span>
						<div id="criteria<?php echo $i ?>-slider"></div>
						<input type="text" id="criteria<?php echo $i ?>" value="<?php if( !empty($stf_review['score']) ) echo $stf_review['score']; else echo 0; ?>" name="stf_review_criteria[<?php echo $i ?>][score]" style="width:40px; opacity: 0.7;" />
						<a class="del-cat"></a>
						<script>
						  jQuery(document).ready(function() {
							jQuery("#criteria<?php echo $i ?>-slider").slider({
								range: "min",
								min: 0,
								max: 100,
								value: <?php if( !empty($stf_review['score']) ) echo $stf_review['score']; else echo 0; ?>,
								slide: function(event, ui) {
									jQuery('#criteria<?php echo $i ?>').attr('value', ui.value );
								}
								});
							});
						</script>
						</div>
					</li>	

						<?php
					}
				}
					?>
				</ul>
				<script>var nextReview = <?php echo $i+1 ?> ;</script>
			</div>
		</div>
	
		<div class="stf-spanel-item">
			<h3>側邊欄選項</h3>
			<div class="option-item">
				<?php
					$checked = 'checked="checked"';
				?>
				<ul id="sidebar-position-options" class="stf-options">
					<li>
						<input id="stf_sidebar_pos"  name="stf_sidebar_pos" type="radio" value="default" <?php if($stf_sidebar_pos == 'default' || !$stf_sidebar_pos ) echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/sidebar-default.png" /></a>
					</li>						<li>
						<input id="stf_sidebar_pos"  name="stf_sidebar_pos" type="radio" value="right" <?php if($stf_sidebar_pos == 'right' ) echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/sidebar-right.png" /></a>
					</li>
					<li>
						<input id="stf_sidebar_pos"  name="stf_sidebar_pos" type="radio" value="left" <?php if($stf_sidebar_pos == 'left') echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/sidebar-left.png" /></a>
					</li>
					<li>
						<input id="stf_sidebar_pos"  name="stf_sidebar_pos" type="radio" value="full" <?php if($stf_sidebar_pos == 'full') echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/sidebar-no.png" /></a>
					</li>
				</ul>
			</div>
			<?php
			$sidebars = stf_get_option( 'sidebars' ) ;
			$new_sidebars = array(''=> '預設');
			
			if($sidebars){
				foreach ($sidebars as $sidebar) {
					$new_sidebars[$sidebar] = $sidebar;
				}
			}
					
			stf_post_options(				
				array(	"name" => "選擇側邊欄",
						"id" => "stf_sidebar_post",
						"type" => "select",
						"options" => $new_sidebars ));
			?>
		</div>
		
		<div class="stf-spanel-item">
			<h3>頁面外觀樣式 </h3>
			<?php
				stf_post_options(				
					array(	"name" => "自訂顏色",
							"id" => "post_color",
							"type" => "color" ));
								
				stf_post_options(
					array(	"name" => "背景",
							"id" => "post_background",
							"type" => "background"));
								
				stf_post_options(
					array(	"name" => "全螢幕背景",
							"id" => "post_background_full",
							"type" => "checkbox"));
			?>
		</div>
		
		<div class="stf-spanel-item">
			<h3>廣告 Banners 選項</h3>
			<?php	
			stf_post_options(				
				array(	"name" => "隱藏上方 Banner",
						"id" => "stf_hide_above",
						"type" => "checkbox"));

			stf_post_options(				
				array(	"name" => "自訂上方 Banner",
						"id" => "stf_banner_above",
						"type" => "textarea"));

			stf_post_options(				
				array(	"name" => "隱藏下方 Banner",
						"id" => "stf_hide_below",
						"type" => "checkbox"));

			stf_post_options(				
				array(	"name" => "自訂下方 Banner",
						"id" => "stf_banner_below",
						"type" => "textarea"));
			?>
		</div>
  <?php
}

add_action('save_post', 'save_post');
function save_post( $post_id ){
	global $post;
	
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return $post_id;
		
    if (isset($_POST['stf_hidden_flag'])) {
	
		$custom_meta_fields = array(
			'stf_rss_feed',
			'stf_hide_meta',
			'stf_hide_author',
			'stf_hide_share',
			'stf_hide_related',
			'stf_sidebar_pos',
			'stf_sidebar_post',
			'stf_post_head',
			'stf_post_slider',
			'stf_googlemap_url',
			'stf_video_url',
			'stf_embed_code',
			'stf_audio_m4a',
			'stf_audio_mp3',
			'stf_audio_oga',
			'stf_audio_soundcloud',
			'stf_audio_soundcloud_play',
			'stf_hide_above',
			'stf_banner_above',
			'stf_hide_below',
			'stf_banner_below',
			'stf_posts_num',
			'post_color',
			'post_background_full',
			'stf_review_position',
			'stf_review_style',
			'stf_review_summary',
			'stf_review_total');
			
		foreach( $custom_meta_fields as $custom_meta_field ){
			if(isset($_POST[$custom_meta_field]) )
				update_post_meta($post_id, $custom_meta_field, htmlspecialchars(stripslashes($_POST[$custom_meta_field])) );
			else
				delete_post_meta($post_id, $custom_meta_field);
		}
		
		if(isset($_POST[ 'stf_review_criteria' ]) )
			update_post_meta($post_id, 'stf_review_criteria', $_POST['stf_review_criteria']);
		
		if(isset($_POST[ 'stf_blog_cats' ]) )
			update_post_meta($post_id, 'stf_blog_cats', $_POST['stf_blog_cats']);
		
		if(isset($_POST[ 'post_background' ]) )
			update_post_meta($post_id, 'post_background', $_POST['post_background']);
		
		if(isset($_POST[ 'stf_authors' ]) )
			update_post_meta($post_id, 'stf_authors', $_POST['stf_authors']);


		$get_meta = get_post_custom($post_id);

		$total_counter = $score = 0;
		if( isset( $get_meta['stf_review_criteria'][0] ))
		$criterias = unserialize( $get_meta['stf_review_criteria'][0] );
		
		if( !empty($criterias) && is_array($criterias) ){
			foreach( $criterias as $criteria){ 
				if( $criteria['name'] && $criteria['score'] && is_numeric( $criteria['score'] )){
					if( $criteria['score'] > 100 ) $criteria['score'] = 100;
					if( $criteria['score'] < 0 ) $criteria['score'] = 1;
						
				$score += $criteria['score'];
				$total_counter ++;
				}
			}
			if( !empty( $score ) && !empty( $total_counter ) )
				$total_score =  $score / $total_counter ;

			update_post_meta($post_id, 'stf_review_score', $total_score);
		}
	}
}




/*********************************************************/

function stf_post_options($value){
	global $post;
?>

	<div class="option-item" id="<?php echo $value['id'] ?>-item">
		<span class="label"><?php  echo $value['name']; ?></span>
	<?php
		$id = $value['id'];
		$get_meta = get_post_custom($post->ID);
		
		if( isset( $get_meta[$id][0] ) )
			$current_value = $get_meta[$id][0];
			
	switch ( $value['type'] ) {
	
		case 'text': ?>
			<input  name="<?php echo $value['id']; ?>" id="<?php  echo $value['id']; ?>" type="text" value="<?php echo $current_value ?>" />
		<?php 
		break;

		case 'checkbox':
			if( !empty( $current_value ) ){$checked = "checked=\"checked\"";  } else{$checked = "";} ?>
				<input class="on-of" type="checkbox" name="<?php echo $value['id'] ?>" id="<?php echo $value['id'] ?>" value="true" <?php echo $checked; ?> />			
		<?php	
		break;
		
		case 'select':
		?>
			<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
				<?php foreach ($value['options'] as $key => $option) { ?>
				<option value="<?php echo $key ?>" <?php if ( $current_value == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
		<?php
		break;
		
		case 'textarea':
		?>
			<textarea style="direction:ltr; text-align:left; width:430px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="textarea" cols="100%" rows="3" tabindex="4"><?php echo $current_value  ?></textarea>
		<?php
		break;
		
		case 'background':
			if( !empty( $current_value ) )
				$current_value = unserialize($current_value);
		?>
				<input id="<?php echo $value['id']; ?>-img" class="img-path" type="text" size="56" style="direction:ltr; text-align:left" name="<?php echo $value['id']; ?>[img]" value="<?php if( !empty( $current_value['img'] ) ) echo $current_value['img']; ?>" />
				<input id="upload_<?php echo $value['id']; ?>_button" type="button" class="small_button" value="上傳" />
					
				<div style="margin-top:15px; clear:both">
					<div id="<?php echo $value['id']; ?>colorSelector" class="color-pic"><div style="background-color:<?php if( !empty( $current_value['color'] ) ) echo $current_value['color'] ; ?>"></div></div>
					<input style="width:80px; margin-right:5px;"  name="<?php echo $value['id']; ?>[color]" id="<?php  echo $value['id']; ?>color" type="text" value="<?php if( !empty( $current_value['color'] ) ) echo $current_value['color'] ; ?>" />
					
					<select name="<?php echo $value['id']; ?>[repeat]" id="<?php echo $value['id']; ?>[repeat]" style="width:96px;">
						<option value="" <?php if ( empty( $current_value['repeat'] ) ) { echo ' selected="selected"' ; } ?>></option>
						<option value="repeat" <?php if ( !empty( $current_value['repeat'] ) && $current_value['repeat']  == 'repeat' ) { echo ' selected="selected"' ; } ?>>重複</option>
						<option value="no-repeat" <?php if ( !empty( $current_value['repeat'] ) && $current_value['repeat']  == 'no-repeat') { echo ' selected="selected"' ; } ?>>不重複</option>
						<option value="repeat-x" <?php if ( !empty( $current_value['repeat'] ) && $current_value['repeat'] == 'repeat-x') { echo ' selected="selected"' ; } ?>>水平重複</option>
						<option value="repeat-y" <?php if ( !empty( $current_value['repeat'] ) && $current_value['repeat'] == 'repeat-y') { echo ' selected="selected"' ; } ?>>垂直重複</option>
					</select>

					<select name="<?php echo $value['id']; ?>[attachment]" id="<?php echo $value['id']; ?>[attachment]" style="width:96px;">
						<option value="" <?php if ( empty( $current_value['attachment'] ) ) { echo ' selected="selected"' ; } ?>></option>
						<option value="fixed" <?php if ( !empty( $current_value['attachment'] ) && $current_value['attachment']  == 'fixed' ) { echo ' selected="selected"' ; } ?>>固定</option>
						<option value="scroll" <?php if ( !empty( $current_value['attachment'] ) && $current_value['attachment']  == 'scroll') { echo ' selected="selected"' ; } ?>>捲動</option>
					</select>
					
					<select name="<?php echo $value['id']; ?>[hor]" id="<?php echo $value['id']; ?>[hor]" style="width:96px;">
						<option value="" <?php if ( empty($current_value['hor']) ) { echo ' selected="selected"' ; } ?>></option>
						<option value="left" <?php if ( !empty( $current_value['hor'] ) && $current_value['hor']  == 'left' ) { echo ' selected="selected"' ; } ?>>靠左</option>
						<option value="right" <?php if ( !empty( $current_value['hor'] ) && $current_value['hor']  == 'right') { echo ' selected="selected"' ; } ?>>靠右</option>
						<option value="center" <?php if ( !empty( $current_value['hor'] ) && $current_value['hor'] == 'center') { echo ' selected="selected"' ; } ?>>置中</option>
					</select>
					
					<select name="<?php echo $value['id']; ?>[ver]" id="<?php echo $value['id']; ?>[ver]" style="width:100px;">
						<option value="" <?php if ( empty( $current_value['ver'] ) ) { echo ' selected="selected"' ; } ?>></option>
						<option value="top" <?php if ( !empty( $current_value['ver'] ) && $current_value['ver']  == 'top' ) { echo ' selected="selected"' ; } ?>>靠上</option>
						<option value="center" <?php if ( !empty( $current_value['ver'] ) && $current_value['ver'] == 'center') { echo ' selected="selected"' ; } ?>>置中</option>
						<option value="bottom" <?php if ( !empty( $current_value['ver'] ) && $current_value['ver']  == 'bottom') { echo ' selected="selected"' ; } ?>>靠下</option>

					</select>
				</div>
				<div id="<?php echo $value['id']; ?>-preview" class="img-preview" <?php if( !$current_value['img']  ) echo 'style="display:none;"' ?>>
					<img src="<?php if( !empty( $current_value['img'] ) ) echo $current_value['img'] ; else echo get_template_directory_uri().'/spanel/images/spacer.png'; ?>" alt="" />
					<a class="del-img" title="刪除"></a>
				</div>
					
				<script>
				jQuery('#<?php echo $value['id']; ?>colorSelector').ColorPicker({
					color: '<?php echo $current_value['color'] ; ?>',
					onShow: function (colpkr) {
						jQuery(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						jQuery(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						jQuery('#<?php echo $value['id']; ?>colorSelector div').css('backgroundColor', '#' + hex);
						jQuery('#<?php echo $value['id']; ?>color').val('#'+hex);
					}
				});
				stf_styling_uploader('<?php echo $value['id']; ?>');
				</script>
		<?php
		break;
		
		
		case 'color':
		?>
			<div id="<?php echo $value['id']; ?>colorSelector" class="color-pic"><div style="background-color:<?php echo $current_value ; ?>"></div></div>
			<input style="width:80px; margin-right:5px;"  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php echo $current_value ; ?>" />
							
			<script>
				jQuery('#<?php echo $value['id']; ?>colorSelector').ColorPicker({
					color: '<?php echo $current_value ; ?>',
					onShow: function (colpkr) {
						jQuery(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						jQuery(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						jQuery('#<?php echo $value['id']; ?>colorSelector div').css('backgroundColor', '#' + hex);
						jQuery('#<?php echo $value['id']; ?>').val('#'+hex);
					}
				});
				</script>
		<?php
		break;
	} ?>
	</div>
<?php
}
?>