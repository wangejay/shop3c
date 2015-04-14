<?php
/**
* S-Panel UI
*
* @file 		 spanel-ui.php
* @package	 StartPress Business
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://startpress.cc
*/

function spanel_options() {

	$categories_obj = get_categories('hide_empty=0');
	$categories = array();
	foreach ($categories_obj as $pn_cat) {
		$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
	}
	
	$sliders = array();
	$custom_slider = new WP_Query( array( 'post_type' => 'stf_slider', 'posts_per_page' => -1, 'no_found_rows' => 1  ) );
	while ( $custom_slider->have_posts() ) {
		$custom_slider->the_post();
		$sliders[get_the_ID()] = get_the_title();
	}
	
	
$save='
	<div class="spanel-submit">
		<input type="hidden" name="action" value="test_theme_data_save" />
         <input type="hidden" name="security" value="'. wp_create_nonce("test-theme-data").'" />
		<input name="save" class="spanel-save" type="submit" value="儲存變更" />    
	</div>'; 
?>

<div id="save-alert"></div>

<div class="stf-spanel">
	<div class="stf-spanel-tabs">
		<div class="logo"></div>
		<ul>
			<li class="stf-tabs general"><a href="#tab1"><span></span>一般設定</a></li>
			<li class="stf-tabs homepage"><a href="#tab2"><span></span>首頁設定</a></li>
			<li class="stf-tabs header"><a href="#tab9"><span></span>頁首設定</a></li>
			<li class="stf-tabs archives"><a href="#tab12"><span></span>彙整設定</a></li>
			<li class="stf-tabs article"><a href="#tab6"><span></span>文章設定</a></li>
			<li class="stf-tabs sidebars"><a href="#tab11"><span></span>側邊欄設定</a></li>
			<li class="stf-tabs footer"><a href="#tab7"><span></span>頁尾設定</a></li>
			<li class="stf-tabs slideshow"><a href="#tab5"><span></span>幻燈片設定</a></li>
			<li class="stf-tabs banners"><a href="#tab8"><span></span>廣告設定</a></li>
			<li class="stf-tabs styling"><a href="#tab13"><span></span>外觀樣式設定</a></li>
			<li class="stf-tabs social"><a href="#tab4"><span></span>社群網站</a></li>
			<li class="stf-tabs advanced"><a href="#tab10"><span></span>進階設定</a></li>
		</ul>
		<div class="clear"></div>
	</div><!-- end .stf-spanel-tabs /-->
	
	
	<div class="stf-spanel-content">
	<form action="/" name="stf_form" id="stf_form">
		<div id="tab1" class="tabs-wrap">
			<h2>一般設定</h2> <?php echo $save ?>
			<div class="stf-spanel-item">
				<h3>自定義網站圖示</h3>
				<?php
					stf_options(
						array(	"name" => "自定義網站圖示",
								"id" => "favicon",
								"type" => "upload"));
				?>
			</div>	
			<div class="stf-spanel-item">
				<h3>自定義會員大頭貼</h3>
				<?php
					stf_options(
						array(	"name" => "自定義會員大頭貼",
								"id" => "gravatar",
								"type" => "upload"));
				?>
			</div>
			
			<div class="stf-spanel-item">
				<h3>時間格式</h3>
				<?php
					stf_options(
						array( 	"name" => "文章時間格式",
								"id" => "time_format",
								"type" => "radio",
								"options" => array( "traditional"=>"傳統" ,
													"modern"=>"幾天以前",
													"none"=>"無 " )));
				?>									
			</div>	
			
			<div class="stf-spanel-item">
				<h3>網站導航設定</h3>
				<?php
					stf_options(
						array(	"name" => "開啟網站導航設定 ",
								"id" => "breadcrumbs",
								"type" => "checkbox")); 
					
					stf_options(
						array(	"name" => "網站導航分隔符號",
								"id" => "breadcrumbs_delimiter",
								"type" => "short-text"));
				?>
			</div>
						
			<div class="stf-spanel-item">
				<h3>頁首自定義程式碼</h3>
				<div class="option-item">
					<small>如果你需要在頁首 head 標籤增加 CSS 或者 js 程式碼，請在此處增加</small>
					<textarea id="header_code" name="stf_options[header_code]" style="width:100%" rows="7"><?php echo htmlspecialchars_decode(stf_get_option('header_code'));  ?></textarea>				
				</div>
			</div>
			
			<div class="stf-spanel-item">
				<h3>頁尾自定義程式碼</h3>
				<div class="option-item">
					<small>如果你需要在頁尾 footer 標籤增加 CSS 或者 js 程式碼，請在此處增加</small>

					<textarea id="footer_code" name="stf_options[footer_code]" style="width:100%" rows="7"><?php echo htmlspecialchars_decode(stf_get_option('footer_code'));  ?></textarea>				
				</div>
			</div>	
			
		</div>
		
		
		
		<div id="tab9" class="tabs-wrap">
			<h2>頁首設定</h2> <?php echo $save ?>
			
			<div class="stf-spanel-item">
				<h3>Logo</h3>
				<?php
					stf_options(
						array( 	"name" => "Logo 設定",
								"id" => "logo_setting",
								"type" => "radio",
								"options" => array( "logo"=>"自定義Logo 圖片" ,
													"title"=>"顯示網站名稱" )));

					stf_options(
						array(	"name" => "Logo 圖片",
								"id" => "logo",
								"help" => "上傳 Logo 圖片或者輸入 Logo 網址，如果沒有更換，將會顯示主題預設圖片",
								"type" => "upload",
								"extra_text" => '圖片建議最大尺寸 : 190px x 60px')); 
						
					stf_options(
						array(	"name" => "Logo 上方邊距（Top margin）",
								"id" => "logo_margin",
								"type" => "slider",
								"help" => "輸入邊距數值來設定 logo 上方邊距",
								"unit" => "px",
								"max" => 100,
								"min" => 0 ));

					stf_options(
						array(	"name" => "全寬 Logo",
								"id" => "full_logo",
								"type" => "checkbox",
								"extra_text" => 'Logo 建議寬度 : 1045px')); 

					stf_options(
						array(	"name" => "Logo 置中",
								"id" => "center_logo",
								"type" => "checkbox")); 			
				?>

			</div>
			

			<div class="stf-spanel-item">
				<h3>頁首選單設定</h3>
				<?php
					stf_options(
						array(	"name" => "隱藏頁首選單",
								"id" => "top_menu",
								"type" => "checkbox"));

					stf_options(
						array(	"name" => "隱藏主要導航",
								"id" => "main_nav",
								"type" => "checkbox"));	

					stf_options(
						array(	"name" => "今天日期",
								"id" => "top_date",
								"type" => "checkbox"));

					stf_options(
						array(	"name" => "日期格式 ",
								"id" => "todaydate_format",
								"type" => "text",
								"extra_text" => '<a target="_blank" href="http://codex.wordpress.org/Formatting_Date_and_Time">時間與日期格式的參考資料</a>')); 			
					stf_options(
						array(	"name" => "頁首右部區塊",
								"id" => "top_right",
								"type" => "radio",
								"options" => array( ""=>"無" ,
													"search"=>"搜尋" ,
													"social"=>"社群網絡圖示" ))); 
													
					stf_options(
						array(	"name" => "隨機文章按鈕",
								"id" => "random_article",
								"type" => "checkbox"));

					stf_options(
						array(	"name" => "鎖定導航選單",
								"id" => "stick_nav",
								"type" => "checkbox")); 			
				?>		
			</div>
			

			<div class="stf-spanel-item">
				<h3>即時新聞（頁首滾動跑馬燈）</h3>
				<?php
					stf_options(
						array(	"name" => "啟用",
								"id" => "breaking_news",
								"type" => "checkbox"));

					stf_options(
						array(	"name" => "僅顯示於首頁",
								"id" => "breaking_home",
								"type" => "checkbox")); 
												
					stf_options(
						array(	"name" => "即時新聞標題",
								"id" => "breaking_title",
								"type" => "text"));
																
					stf_options(
						array(	"name" => "動畫樣式",
								"id" => "breaking_effect",
								"type" => "select",
								"options" => array(
									'fade' => '淡入',
									'slide' => '滑動',
									'ticker' => '打字機',
								)));
								
					stf_options(
						array(	"name" => "滾動速度",
								"id" => "breaking_speed",
								"type" => "slider",
								"unit" => "ms",
								"max" => 40000,
								"min" => 100 ));

								
					stf_options(
						array(	"name" => "滾動間隔",
								"id" => "breaking_time",
								"type" => "slider",
								"unit" => "ms",
								"max" => 40000,
								"min" => 100 ));
				
				?>
				
				<?php				
					stf_options(
						array(	"name" => "即時新聞來源",
								"id" => "breaking_type",
								"options" => array( "category"	=>	"分類目錄" ,
													"tag"		=>	"標籤",
													"custom"	=>	"自定文字"),
								"type" => "radio")); 
															
					
					stf_options(
						array(	"name" => "顯示文章數量",
								"id" => "breaking_number",
								"type" => "short-text"));
								
					stf_options(
						array(	"name" => "即時新聞標籤",
								"help" => "輸入標籤名，用半形逗點（,）分隔 ",
								"id" => "breaking_tag",
								"type" => "text"));
								
				?>
					
				
					<div class="option-item" id="breaking_cat-item">
						<span class="label">即時新聞分類</span>
							<select multiple="multiple" name="stf_options[breaking_cat][]" id="stf_breaking_cat">
							<?php foreach ($categories as $key => $option) { ?>
								<option value="<?php echo $key ?>" <?php if ( @in_array( $key , stf_get_option('breaking_cat') ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
							<?php } ?>
						</select>
					</div>
		
			</div>
			
			<div class="stf-spanel-item" id="breaking_custom-item">
				<h3>自訂即時新聞文字</h3>
					<div class="option-item" >
					
						<span class="label" style="width:40px">文字</span>
						<input id="custom_text" type="text" size="56" style="direction:ltr; text-laign:left; width:200px; float:left" name="custom_text" value="" />
						<span class="label" style="width:40px; margin-left:10px;">連結網址</span>
						<input id="custom_link" type="text" size="56" style="direction:ltr; text-laign:left; width:200px; float:left" name="custom_link" value="" />
						<input id="TextAdd"  class="small_button" type="button" value="新增" />
							
						<ul id="customList" style="margin-top:15px;">
						<?php $breaking_custom = stf_get_option( 'breaking_custom' ) ;
							$custom_count = 0 ;
							if($breaking_custom){
								foreach ($breaking_custom as $custom_text) { $custom_count++; ?>
							<li>
								<div class="widget-head">
									<a href="<?php echo $custom_text['link'] ?>" target="_blank"><?php echo $custom_text['text'] ?></a>
									<input name="stf_options[breaking_custom][<?php echo $custom_count ?>][link]" type="hidden" value="<?php echo $custom_text['link'] ?>" />
									<input name="stf_options[breaking_custom][<?php echo $custom_count ?>][text]" type="hidden" value="<?php echo $custom_text['text'] ?>" />
									<a class="del-custom-text"></a></div>
							</li>
								<?php }
							}
						?>
						</ul>
						<script>
							var customnext = <?php echo $custom_count+1 ?> ;
						</script>
					</div>	
				</div>
		</div> <!-- 頁首設定結束 -->
		
		
		<div id="tab2" class="tabs-wrap">
			<h2>首頁設定</h2> <?php echo $save ?>
		
			<div class="stf-spanel-item">
				<h3>首頁顯示：</h3>
				<?php
					stf_options(
						array( 	"name" => "首頁顯示",
								"id" => "on_home",
								"type" => "radio",
								"options" => array( "latest"=>"最新文章——部落格樣式" ,
													"boxes"=>" 新聞框——使用首頁產生器" )));
				?>
			</div>	
			
		<div id="Home_Builder" style="width:100%;">

			<div class="stf-spanel-item">
				<h3>新聞框設定</h3>
				<?php
					stf_options(
						array( 	"name" => "文章摘要長度",
								"id" => "home_exc_length",
								"type" => "short-text"));	
					stf_options(
						array(	"name" => "文章投票",
								"id" => "box_meta_score",
								"type" => "checkbox" )); 			
					stf_options(
						array(	"name" => "作者簡介",
								"id" => "box_meta_author",
								"type" => "checkbox",
								"extra_text" => '此選項不適用於滾動框和部落格最新文章的樣式。')); 			
					stf_options(
						array(	"name" => "日期",
								"id" => "box_meta_date",
								"type" => "checkbox"));
					stf_options(
						array(	"name" => "標籤資訊",
								"id" => "box_meta_cats",
								"type" => "checkbox",
								"extra_text" => '此選項不適用於滾動框和部落格最新文章的樣式。')); 
					stf_options(
						array(	"name" => "評論資訊",
								"id" => "box_meta_comments",
								"type" => "checkbox",
								"extra_text" => '此選項不適用於滾動框和部落格最新文章的樣式。')); 
				?>
			</div>	
			
			
			<div class="stf-spanel-item"  style=" overflow: visible; ">
				<h3>首頁產生器 					<a id="collapse-all">[-] 全部隱藏</a>
					<a id="expand-all">[+] 全部顯示</a></h3>
				<div class="option-item">

					<select style="display:none" id="cats_defult">
						<?php foreach ($categories as $key => $option) { ?>
						<option value="<?php echo $key ?>"><?php echo $option; ?></option>
						<?php } ?>
					</select>
				
					
					<div style="clear:both"></div>
					<div class="home-builder-buttons">
						<a id="add-cat" >新聞框</a>
						<a id="add-slider" >滾動新聞框</a>
						<a id="add-ads" >廣告/自定義文字</a>
						<a id="add-news-picture" >新聞圖片</a>
						<a id="add-news-videos" >影片</a>
						<a id="add-recent" >最新文章</a>
						<a id="add-divider" >分隔線</a>
					</div>
										
					<ul id="cat_sortable">
						<?php
							$cats = get_option( 'stf_home_cats' ) ;
							if($cats){
							$i=0;
								foreach ($cats as $cat) { 
									$i++;
									?>
									<li id="listItem_<?php echo $i ?>" class="ui-state-default">
			
								<?php 
									if( $cat['type'] == 'n' ) :	?>
										<div class="widget-head"> 增加新聞框 : <?php if( !empty($cat['id']) ) echo get_the_category_by_ID( $cat['id'] ); ?>
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span>新聞框分類目錄 : </span><select name="stf_home_cats[<?php echo $i ?>][id]" id="stf_home_cats[<?php echo $i ?>][id]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label><span>文章排序 : </span><select name="stf_home_cats[<?php echo $i ?>][order]" id="stf_home_cats[<?php echo $i ?>][order]"><option value="latest" <?php if( $cat['order'] == 'latest' || $cat['order']=='' ) echo 'selected="selected"'; ?>>最新文章</option><option  <?php if( $cat['order'] == 'rand' ) echo 'selected="selected"'; ?> value="rand">隨機文章</option></select></label>
											<label for="stf_home_cats[<?php echo $i ?>][number]"><span>顯示文章數 :</span><input style="width:50px;" id="stf_home_cats[<?php echo $i ?>][number]" name="stf_home_cats[<?php echo $i ?>][number]" value="<?php  echo $cat['number']  ?>" type="text" /></label>
											<label for="stf_home_cats[<?php echo $i ?>][offset]"><span>取消 - 傳送文章數</span><input style="width:50px;" id="stf_home_cats[<?php echo $i ?>][offset]" name="stf_home_cats[<?php echo $i ?>][offset]" value="<?php  echo $cat['offset']  ?>" type="text" /></label>
											<label>
												<span style="float:left;">新聞框樣式 : </span>
												<ul class="stf-cats-options stf-options">
													<li>
														<input id="stf_home_cats[<?php echo $i ?>][style]" name="stf_home_cats[<?php echo $i ?>][style]" type="radio" value="li" <?php if( $cat['style'] == 'li' || $cat['style']=='' ) echo 'checked="checked"'; ?> />
														<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/li.png" /></a>
													</li>
													<li>
														<input id="stf_home_cats[<?php echo $i ?>][style]" name="stf_home_cats[<?php echo $i ?>][style]" type="radio" value="2c" <?php if( $cat['style'] == '2c' ) echo 'checked="checked"' ?> />
														<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/2c.png" /></a>
													</li>
													<li style="margin-right:0 !important;">
														<input id="stf_home_cats[<?php echo $i ?>][style]" name="stf_home_cats[<?php echo $i ?>][style]" type="radio" value="1c" <?php if( $cat['style'] == '1c') echo 'checked="checked"' ?> />
														<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/1c.png" /></a>
													</li>
												</ul>
											</label>
								<?php 
									elseif( $cat['type'] == 'recent' ) :	?>
										<div class="widget-head"> 最新文章
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span style="float:left;">排除這個分類 :<br />（可按 ctrl 多選） </span><select multiple="multiple" name="stf_home_cats[<?php echo $i ?>][exclude][]" id="stf_home_cats[<?php echo $i ?>][exclude][]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( @in_array( $key , $cat['exclude'] ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label for="stf_home_cats[<?php echo $i ?>][title]"><span>新聞框標題:</span><input id="stf_home_cats[<?php echo $i ?>][title]" name="stf_home_cats[<?php echo $i ?>][title]" value="<?php   if( !empty($cat['title']) ) echo $cat['title']  ?>" type="text" /></label>
											<label for="stf_home_cats[<?php echo $i ?>][number]"><span>顯示文章數 :</span><input style="width:50px;" id="stf_home_cats[<?php echo $i ?>][number]" name="stf_home_cats[<?php echo $i ?>][number]" value="<?php   if( !empty($cat['number']) ) echo $cat['number']  ?>" type="text" /></label>
											<label for="stf_home_cats[<?php echo $i ?>][offset]"><span>取消 - 傳送文章數</span><input style="width:50px;" id="stf_home_cats[<?php echo $i ?>][offset]" name="stf_home_cats[<?php echo $i ?>][offset]" value="<?php   if( !empty($cat['offset']) ) echo $cat['offset']  ?>" type="text" /></label>
											<label for="stf_home_cats[<?php echo $i ?>][display]"><span>顯示模式:</span>
												<select id="stf_home_cats[<?php echo $i ?>][display]" name="stf_home_cats[<?php echo $i ?>][display]">
													<option value="default" <?php if ( $cat['display'] == 'default') { echo ' selected="selected"' ; } ?>>預設樣式</option>
													<option value="blog" <?php if ( $cat['display'] == 'blog') { echo ' selected="selected"' ; } ?>>部落格樣式</option>
												</select>
											</label>
											<label for="stf_home_cats[<?php echo $i ?>][pagi]"><span>顯示分頁:</span>
												<select id="stf_home_cats[<?php echo $i ?>][pagi]" name="stf_home_cats[<?php echo $i ?>][pagi]">
													<option value="n" <?php if ( $cat['pagi'] == 'n') { echo ' selected="selected"' ; } ?>>否</option>
													<option value="y" <?php if ( $cat['pagi'] == 'y') { echo ' selected="selected"' ; } ?>>是</option>
												</select>
											</label>
											<p class="stf_message_hint">WordPress 警告: 設定中段分頁的取消選項，如果你想使用取消選項，請將分頁選項設定為 "NO"。</p>
											<input id="stf_home_cats[<?php echo $i ?>][boxid]" name="stf_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
										
									<?php elseif( $cat['type'] == 's' ) : ?>
										<div class="widget-head scrolling-box">滾動新聞框 : <?php if( !empty($cat['id']) ) echo get_the_category_by_ID( $cat['id'] ); ?>
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span>新聞框分類目錄 : </span><select name="stf_home_cats[<?php echo $i ?>][id]" id="stf_home_cats[<?php echo $i ?>][id]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label for="stf_home_cats[<?php echo $i ?>][title]"><span>新聞框標題 :</span><input id="stf_home_cats[<?php echo $i ?>][title]" name="stf_home_cats[<?php echo $i ?>][title]" value="<?php   if( !empty($cat['title']) ) echo $cat['title']  ?>" type="text" /></label>
											<label for="stf_home_cats[<?php echo $i ?>][number]"><span>顯示文章數 :</span><input style="width:50px;" id="stf_home_cats[<?php echo $i ?>][number]" name="stf_home_cats[<?php echo $i ?>][number]" value="<?php   if( !empty($cat['number']) ) echo $cat['number']  ?>" type="text" /></label>
											<label for="stf_home_cats[<?php echo $i ?>][offset]"><span>取消 - 傳送文章數</span><input style="width:50px;" id="stf_home_cats[<?php echo $i ?>][offset]" name="stf_home_cats[<?php echo $i ?>][offset]" value="<?php   if( !empty($cat['offset']) ) echo $cat['offset']  ?>" type="text" /></label>
											<input id="stf_home_cats[<?php echo $i ?>][boxid]" name="stf_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
									<?php elseif( $cat['type'] == 'ads' ) : ?>
										<div class="widget-head ads-box"> 廣告/自定文字
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<textarea cols="36" rows="5" name="stf_home_cats[<?php echo $i ?>][text]" id="stf_home_cats[<?php echo $i ?>][text]"><?php if( !empty($cat['text']) ) echo stripslashes($cat['text']) ; ?></textarea>
											<input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
											<br /><small>支援 <strong>文字，HTML 和短代碼</strong> .</small>

										
									<?php elseif( $cat['type'] == 'news-pic' ) : ?>
										<div class="widget-head news-pic-box">  圖片新聞
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span>新聞框分類目錄 : </span><select name="stf_home_cats[<?php echo $i ?>][id]" id="stf_home_cats[<?php echo $i ?>][id]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label for="stf_home_cats[<?php echo $i ?>][title]"><span>新聞框標題 :</span><input id="stf_home_cats[<?php echo $i ?>][title]" name="stf_home_cats[<?php echo $i ?>][title]" value="<?php if( !empty($cat['title']) ) echo $cat['title']  ?>" type="text" /></label>
											<label for="stf_home_cats[<?php echo $i ?>][offset]"><span>取消 - 傳送文章數</span><input style="width:50px;" id="stf_home_cats[<?php echo $i ?>][offset]" name="stf_home_cats[<?php echo $i ?>][offset]" value="<?php  if( !empty($cat['offset']) ) echo $cat['offset']  ?>" type="text" /></label>
											<label>
												<span style="float:left;">新聞框樣式 : </span>
												<ul class="stf-cats-options stf-options">
													<li>
														<input id="stf_home_cats[<?php echo $i ?>][style]" name="stf_home_cats[<?php echo $i ?>][style]" type="radio" value="default" <?php if( $cat['style'] == 'default' || $cat['style']=='' ) echo 'checked="checked"'; ?> />
														<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/news-in-pic1.png" /></a>
													</li>
													<li>
														<input id="stf_home_cats[<?php echo $i ?>][style]" name="stf_home_cats[<?php echo $i ?>][style]" type="radio" value="row" <?php if( $cat['style'] == 'row' ) echo 'checked="checked"' ?> />
														<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/news-in-pic2.png" /></a>
													</li>
												</ul>
											</label>
											<input id="stf_home_cats[<?php echo $i ?>][boxid]" name="stf_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
								
								<?php elseif( $cat['type'] == 'videos' ) : ?>
										<div class="widget-head news-pic-box">影片
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span>新聞框分類目錄 : </span><select name="stf_home_cats[<?php echo $i ?>][id]" id="stf_home_cats[<?php echo $i ?>][id]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label for="stf_home_cats[<?php echo $i ?>][title]"><span>新聞框標題 :</span><input id="stf_home_cats[<?php echo $i ?>][title]" name="stf_home_cats[<?php echo $i ?>][title]" value="<?php  echo $cat['title']  ?>" type="text" /></label>
											<label for="stf_home_cats[<?php echo $i ?>][offset]"><span>取消 - 傳送文章數</span><input style="width:50px;" id="stf_home_cats[<?php echo $i ?>][offset]" name="stf_home_cats[<?php echo $i ?>][offset]" value="<?php  echo $cat['offset']  ?>" type="text" /></label>
											<input id="stf_home_cats[<?php echo $i ?>][boxid]" name="stf_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
								
									<?php elseif( $cat['type'] == 'divider' ) : ?>
										<div class="widget-head news-pic-box">  分隔線
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label for="stf_home_cats[<?php echo $i ?>][height]"><span>高度 :</span><input id="stf_home_cats[<?php echo $i ?>][height]" name="stf_home_cats[<?php echo $i ?>][height]" value="<?php  echo $cat['height']  ?>" type="text" style="width:50px;" /> px</label>

									<?php endif; ?>
									
									
											<input id="stf_home_cats[<?php echo $i ?>][type]" name="stf_home_cats[<?php echo $i ?>][type]" value="<?php  echo $cat['type']  ?>" type="hidden" />
											<a class="del-cat"></a>
										
										</div>
									</li>
							<?php } 
							} else{?>
							<?php } ?>
					</ul>

					<script>
						var nextCell = <?php echo $i+1 ?> ;
						var templatePath =' <?php echo get_template_directory_uri(); ?>';
					</script>
				</div>	
			</div>
			
			<div class="stf-spanel-item">
				<h3>分類頁籤框</h3>
				
				<?php
				stf_options(
					array(	"name" => "顯示分類目錄頁籤框",
							"id" => "home_tabs_box",
							"type" => "checkbox")); 
							
					if( stf_get_option('home_tabs') )
						$stf_home_tabs = stf_get_option('home_tabs') ;
					else 
						$stf_home_tabs = array();
					
					$stf_home_tabs_new = array();					
					
					foreach ($stf_home_tabs as $key1 => $option1) {
						if ( array_key_exists( $option1 , $categories) )
							$stf_home_tabs_new[$option1] = $categories[$option1];
					}
					foreach ($categories as $key2 => $option2) {
						if ( !in_array( $key2 , $stf_home_tabs) )
							$stf_home_tabs_new[$key2] = $option2;
					}
				?>
					
				<div class="option-item">
					<span class="label">選擇一個分類 : </span>
					<div class="clear"></div> <p></p>
					<ul id="tabs_cats">
						<?php foreach ($stf_home_tabs_new as $key => $option) { ?>
						<li><input id="stf_home_tabs" name="stf_options[home_tabs][]" type="checkbox" <?php if ( in_array( $key , $stf_home_tabs) ) { echo ' checked="checked"' ; } ?> value="<?php echo $key ?>">
						<span><?php echo $option; ?></span></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>

		</div> <!-- 首頁設定結束 -->
		
		
		
		
		<div id="tab4" class="tabs-wrap">
			<h2> 社群網站設定</h2> <?php echo $save ?>

			<div class="stf-spanel-item">
				<h3>自訂 Feed 網址</h3>
							
				<?php
					stf_options(
						array(	"name" => "隱藏 RSS 圖示",
								"id" => "rss_icon",
								"type" => "checkbox"));
								
					stf_options(
						array(	"name" => "自訂 Feed 網址",
								"id" => "rss_url",
								"help" => "例如: http://feedburner.com/userid",
								"type" => "text"));
				?>
			</div>
			
		<div class="stf-spanel-item">
				<h3>社群網站</h3>
				<p class="stf_message_hint">網址前不要忘記加上 http:// 。</p>
						
				<?php						
					stf_options(
						array(	"name" => "Facebook 網址",
								"id" => "social",
								"key" => "facebook",
								"type" => "arrayText"));
					stf_options(
						array(	"name" => "Twitter 網址",
								"id" => "social",
								"key" => "twitter",
								"type" => "arrayText"));
					stf_options(
						array(	"name" => "Google+ 網址",
								"id" => "social",
								"key" => "google_plus",
								"type" => "arrayText"));
					stf_options(
						array(	"name" => "LinkedIn 網址",
								"id" => "social",
								"key" => "linkedin",
								"type" => "arrayText"));
					stf_options(
						array(	"name" => "evernote 網址",
								"id" => "social",
								"key" => "evernote",
								"type" => "arrayText"));
					stf_options(
						array(	"name" => "Dropbox 網址",
								"id" => "social",
								"key" => "dropbox",
								"type" => "arrayText"));
					stf_options(
						array(	"name" => "Flickr 網址",
								"id" => "social",
								"key" => "flickr",
								"type" => "arrayText"));
					stf_options(
						array(	"name" => "Picasa 網址",
								"id" => "social",
								"key" => "picasa",
								"type" => "arrayText"));
					stf_options(
						array(	"name" => "YouTube 網址",
								"id" => "social",
								"key" => "youtube",
								"type" => "arrayText"));
					stf_options(
						array(	"name" => "Tumblr 網址",
								"id" => "social",
								"key" => "tumblr",
								"type" => "arrayText"));
					stf_options(
						array(	"name" => "Blogger 網址",
								"id" => "social",
								"key" => "blogger",
								"type" => "arrayText"));
					stf_options(
						array(	"name" => "Wordpress 網址",
								"id" => "social",
								"key" => "wordpress",
								"type" => "arrayText"));
					stf_options(
						array(	"name" => "Github 網址",
								"id" => "social",
								"key" => "github",
								"type" => "arrayText"));
					stf_options(
						array(	"name" => "Pinterest 網址",
								"id" => "social",
								"key" => "Pinterest",
								"type" => "arrayText"));
					stf_options(
						array(	"name" => "Instagram 網址",
								"id" => "social",
								"key" => "instagram",
								"type" => "arrayText"));
				?>
			</div>			
		</div><!-- 社群網站設定結束 -->
		
		
		
		<div id="tab5" class="tab_content tabs-wrap">
			<h2>幻燈片設定</h2> <?php echo $save; ?>
			<div class="stf-spanel-item">
				<h3>幻燈片設定</h3>
				<?php
					stf_options(
						array(	"name" => "啟用",
								"id" => "slider",
								"type" => "checkbox")); 
					//JW 加上分類內的選單
					stf_options( 
						array(	"name" => "針對品牌類別啟用", 
								"id" => "slider_brand",
								"type" => "checkbox")); 
					stf_options( 
						array(	"name" => "針對科技類別啟用", 
								"id" => "slider_tech",
								"type" => "checkbox")); 
					stf_options( 
						array(	"name" => "針對生活類別啟用", 
								"id" => "slider_life",
								"type" => "checkbox")); 
					stf_options( 
						array(	"name" => "針對趣味類別啟用", 
								"id" => "slider_fun",
								"type" => "checkbox")); 
					//JW 加上分類內的選單
					
					
					stf_options(
						array(	"name" => "幻燈片輪播樣式類型",
								"id" => "slider_type",
								"options" => array( "flexi"=>"Flexi 幻燈片樣式" ,
													"elastic"=>"Elastic 幻燈片樣式 " ),
								"type" => "radio")); 

					stf_options(
						array(	"name" => "顯示幻燈片說明",
								"id" => "slider_caption",
								"type" => "checkbox")); 

					stf_options(
						array(	"name" => "幻燈片說明長度",
								"id" => "slider_caption_length",
								"type" => "short-text"));
								
				?>
				<div class="option-item">
					<span class="label">幻燈片位置</span>
					<div style="float:left; width: 338px;">
						<?php
							$checked = 'checked="checked"';
							$stf_slider_pos = stf_get_option('slider_pos');
						?>
						<ul id="sidebar-position-options" class="stf-options">
							<li style="margin:5px 20px 5px 0 ">
								<input id="stf_slider_pos"  name="stf_options[slider_pos]" type="radio" value="small" <?php if($stf_slider_pos == 'small' || !$stf_slider_pos ) echo $checked; ?> />
								<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/small-slider.png" /></a>
							</li>
							<li>
								<input id="stf_slider_pos"  name="stf_options[slider_pos]" type="radio" value="big" <?php if($stf_slider_pos == 'big') echo $checked; ?> />
								<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/big-slider.png" /></a>
							</li>
						</ul>
					</div>
				</div>
				
			</div>
			<div id="elastic" class="stf-spanel-item">
			<h3>Elastic 幻燈片展示效果設定</h3>
				<?php
					stf_options(
						array(	"name" => "動畫效果",
								"id" => "elastic_slider_effect",
								"type" => "select",
								"options" => array(
									'center' => '置中',
									'sides' => 'Sides'
								)));

					stf_options(
						array(	"name" => "自動播放",
								"id" => "elastic_slider_autoplay",
								"type" => "checkbox"));
					
					
					stf_options(
						array(	"name" => "播放速度",
								"id" => "elastic_slider_interval",
								"type" => "slider",
								"unit" => "ms",
								"max" => 40000,
								"min" => 100 ));

					stf_options(
						array(	"name" => "動畫速度",
								"id" => "elastic_slider_speed",
								"type" => "slider",
								"unit" => "ms",
								"max" => 40000,
								"min" => 100 ));
				?>
			</div>

			<div id="flexi" class="stf-spanel-item">
			<h3>Flexi 幻燈片展示效果設定</h3>
				<?php
					if( is_rtl() ){
						stf_options(
							array(	"name" => "動畫效果",
									"id" => "flexi_slider_effect",
									"type" => "select",
									"options" => array(
										'fade' => '淡入',
										'slideV' => '垂直播放',
									)));
					}else{
						stf_options(
							array(	"name" => "動畫效果",
									"id" => "flexi_slider_effect",
									"type" => "select",
									"options" => array(
										'fade' => '淡入',
										'slideV' => '垂直播放',
										'slideH' => '水平播放',
									)));
					}
								
					stf_options(
						array(	"name" => "播放速度",
								"id" => "flexi_slider_speed",
								"type" => "slider",
								"unit" => "ms",
								"max" => 40000,
								"min" => 100 ));

					stf_options(
						array(	"name" => "動畫速度",
								"id" => "flexi_slider_time",
								"type" => "slider",
								"unit" => "ms",
								"max" => 40000,
								"min" => 100 ));
				?>
			</div>
			
			<div class="stf-spanel-item">
				<h3>幻燈片文章設定</h3>
			<?php
					stf_options(
						array(	"name" => "顯示的幻燈片文章數",
								"id" => "slider_number",
								"type" => "short-text"));
								
					stf_options(
						array(	"name" => "幻燈片文章類型",
								"id" => "slider_query",
								"options" => array( "category"=>"分類目錄" ,
													"tag"=>"標籤",
													"post"=>"選定的文章",
													"page"=>"選定的分頁" ,
													"custom"=>"自定義幻燈片" ),
								"type" => "radio")); 
					//JW add UI for slider settings
					stf_options(
						array(	"name" => "針對品牌類別幻燈片文章類型",
								"id" => "slider_brand_query",
								"options" => array( "custom"=>"自定義幻燈片" ),
								"type" => "radio")); 
					stf_options(
						array(	"name" => "針對科技類別幻燈片文章類型",
								"id" => "slider_tech_query",
								"options" => array( "custom"=>"自定義幻燈片" ),
								"type" => "radio")); 
					stf_options(
						array(	"name" => "針對生活類別幻燈片文章類型",
								"id" => "slider_life_query",
								"options" => array( "custom"=>"自定義幻燈片" ),
								"type" => "radio")); 
					stf_options(
						array(	"name" => "針對趣味類別幻燈片文章類型",
								"id" => "slider_fun_query",
								"options" => array( "custom"=>"自定義幻燈片" ),
								"type" => "radio")); 
					//JW add UI for slider settings
					
					stf_options(
						array(	"name" => "標籤",
								"help" => "請輸入一個標籤名稱, 或以半形逗點分隔多個標籤名稱。",
								"id" => "slider_tag",
								"type" => "text"));
			?>
				<?php $slider_cat = stf_get_option('slider_cat') ; ?>
					<div class="option-item" id="slider_cat-item">
						<span class="label">幻燈片分類目錄</span>
							<select multiple="multiple" name="stf_options[slider_cat][]" id="stf_slider_cat">
							<?php foreach ($categories as $key => $option) { ?>
								<option value="<?php echo $key ?>" <?php if ( @in_array( $key , $slider_cat ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
							<?php } ?>
						</select>
						<a class="stf-help tooltip" title="請輸入一個分類目錄的 ID, 或以半形逗點分隔多個分類目錄的 ID。"></a>
					</div>
					
			<?php
																
					stf_options(
						array(	"name" => "選定的文章 ID",
								"help" => "請輸入一個文章的 ID，若有多個請以半形逗點分隔。",
								"id" => "slider_posts",
								"type" => "text"));
								
					stf_options(
						array(	"name" => "選定的分頁 ID",
								"help" => "請輸入一個分頁的 ID，若有多個請以半形逗點分隔。",
								"id" => "slider_pages",
								"type" => "text"));	
								
					stf_options(
						array(	"name" => "自定義幻燈片",
								"help" => "選擇自定義幻燈片",
								"id" => "slider_custom",
								"type" => "select",
								"options" => $sliders));
					// JW 選擇自定義幻燈片
					stf_options(
						array(	"name" => "針對品牌類別選擇自定義幻燈片",
								"help" => "選擇自定義幻燈片",
								"id" => "slider_tech_custom",
								"type" => "select",
								"options" => $sliders));
					stf_options(
						array(	"name" => "針對科技類別選擇自定義幻燈片",
								"help" => "選擇自定義幻燈片",
								"id" => "slider_tech_custom",
								"type" => "select",
								"options" => $sliders));
					stf_options(
						array(	"name" => "針對生活類別選擇自定義幻燈片",
								"help" => "選擇自定義幻燈片",
								"id" => "slider_life_custom",
								"type" => "select",
								"options" => $sliders));
					stf_options(
						array(	"name" => "針對趣味類別選擇自定義幻燈片",
								"help" => "選擇自定義幻燈片",
								"id" => "slider_fun_custom",
								"type" => "select",
								"options" => $sliders));
			?>
			
			</div>
		</div> <!-- 幻燈片設定結束 -->
		
		
		
		<div id="tab6" class="tab_content tabs-wrap">
			<h2>文章設定</h2> <?php echo $save ?>
			
			<div class="stf-spanel-item">
				<h3>文章評分系統設定</h3>
				<?php
					stf_options(
						array( 	"name" => '誰能評分？',
								"id" => "allowtorate",
								"type" => "radio",
								"options" => array( "none"=> '停用' ,
													"both"=> '註冊會員和訪客',
													"guests"=>'只有訪客',
													"users"=>'只有註冊會員') ));
				?>									
			</div>
			
			<div class="stf-spanel-item">
				<h3>文章元素</h3>
				<?php
					stf_options(
						array(	"name" => "顯示特色圖片",
								"desc" => "",
								"id" => "post_featured",
								"type" => "checkbox"));

					stf_options(
						array(	"name" => "文章作者資料",
								"desc" => "",
								"id" => "post_authorbio",
								"type" => "checkbox"));

					stf_options(
						array(	"name" => "下一篇/上一篇文章",
								"desc" => "",
								"id" => "post_nav",
								"type" => "checkbox")); 

					stf_options(
						array(	"name" => "OG Meta",
								"desc" => "",
								"id" => "post_og_cards",
								"type" => "checkbox")); 

				?>
			</div>
			
			<div class="stf-spanel-item">

				<h3>文章資訊設定</h3>
				<?php
					stf_options(
						array(	"name" => "文章資訊：",
								"id" => "post_meta",
								"type" => "checkbox"));

					stf_options(
						array(	"name" => "作者資料",
								"id" => "post_author",
								"type" => "checkbox"));

					stf_options(
						array(	"name" => "發表日期",
								"id" => "post_date",
								"type" => "checkbox"));


					stf_options(
						array(	"name" => "分類資訊",
								"id" => "post_cats",
								"type" => "checkbox"));


					stf_options(
						array(	"name" => "評論資訊",
								"id" => "post_comments",
								"type" => "checkbox"));


					stf_options(
						array(	"name" => "標籤資訊",
								"id" => "post_tags",
								"type" => "checkbox"));

								
				?>	
			</div>

				
			<div class="stf-spanel-item">

				<h3>文章分享設定</h3>
				<?php
					stf_options(
						array(	"name" => "顯示在文章下方的分享按鈕：",
								"id" => "share_post",
								"type" => "checkbox"));

					stf_options(
						array(	"name" => "顯示在文章頂端的分享按鈕：",
								"id" => "share_post_top",
								"type" => "checkbox"));

					stf_options(
						array(	"name" => "Tweet 按鈕",
								"id" => "share_tweet",
								"type" => "checkbox"));
								
					stf_options(
						array(	"name" => "Twitter 帳號 <small>(選擇填寫)</small>",
								"id" => "share_twitter_username",
								"type" => "text"));
						
					stf_options(
						array(	"name" => "Facebook 讚按鈕",
								"id" => "share_facebook",
								"type" => "checkbox"));
								
					stf_options(
						array(	"name" => "Google+ 按鈕",
								"id" => "share_google",
								"type" => "checkbox"));
								
																
					stf_options(
						array(	"name" => "Linkedin 按鈕",
								"id" => "share_linkdin",
								"type" => "checkbox"));
																					
					stf_options(
						array(	"name" => "Pinterest 按鈕",
								"id" => "share_pinterest",
								"type" => "checkbox"));
								
				?>	
			</div>

				
			<div class="stf-spanel-item">

				<h3>相關文章設定</h3>
				<?php
					stf_options(
						array(	"name" => "相關文章",
								"id" => "related",
								"type" => "checkbox"));

					stf_options(
						array(	"name" => "相關文章顯示標題( 例如：你可能喜歡 )",
								"id" => "related_title",
								"type" => "text")); 
								
					stf_options(
						array(	"name" => "顯示的文章數",
								"id" => "related_number",
								"type" => "short-text"));
								
					stf_options(
						array(	"name" => "文章類型",
								"id" => "related_query",
								"options" => array( "category"=>"分類目錄" ,
													"tag"=>"文章標籤",
													"author"=>"文章作者" ),
								"type" => "radio")); 
				?>
			</div>

			
			<div class="stf-spanel-item">

				<h3>留言驗證設定</h3>
				<?php
					stf_options(
						array(	"name" => "需要驗證留言 ",
								"id" => "comment_validation",
								"type" => "checkbox"));
				?>
			</div>
		</div> <!-- 文章設定結束 -->
		
		
		
		<div id="tab7" class="tabs-wrap">
			<h2>頁尾設定</h2> <?php echo $save ?>

			<div class="stf-spanel-item">

				<h3>頁尾元素</h3>
				<?php
					stf_options(
						array(	"name" => "' 返回頁首 ' 圖示",
								"id" => "footer_top",
								"type" => "checkbox"));

					stf_options(
						array(	"name" => "社群網站圖示",
								"desc" => "",
								"id" => "footer_social",
								"type" => "checkbox")); 

				?>
			</div>
			
			<div class="stf-spanel-item">
				<h3>頁尾自訂小工具（Widgets）</h3>
					<div class="option-item">

					<?php
						$checked = 'checked="checked"';
						$stf_footer_widgets = stf_get_option('footer_widgets');
					?>
					<ul id="footer-widgets-options" class="stf-options">
						<li>
							<input id="stf_footer_widgets"  name="stf_options[footer_widgets]" type="radio" value="footer-1c" <?php if($stf_footer_widgets == 'footer-1c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/footer-1c.png" /></a>
						</li>
						<li>
							<input id="stf_footer_widgets"  name="stf_options[footer_widgets]" type="radio" value="footer-2c" <?php if($stf_footer_widgets == 'footer-2c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/footer-2c.png" /></a>
						</li>
						<li>
							<input id="stf_footer_widgets"  name="stf_options[footer_widgets]" type="radio" value="narrow-wide-2c" <?php if($stf_footer_widgets == 'narrow-wide-2c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/footer-2c-narrow-wide.png" /></a>
						</li>
						<li>
							<input id="stf_footer_widgets"  name="stf_options[footer_widgets]" type="radio" value="wide-narrow-2c" <?php if($stf_footer_widgets == 'wide-narrow-2c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/footer-2c-wide-narrow.png" /></a>
						</li>
						<li>
							<input id="stf_footer_widgets"  name="stf_options[footer_widgets]" type="radio" value="footer-3c" <?php if($stf_footer_widgets == 'footer-3c' || !$stf_footer_widgets ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/footer-3c.png" /></a>
						</li>
						<li>
							<input id="stf_footer_widgets"  name="stf_options[footer_widgets]" type="radio" value="wide-left-3c" <?php if($stf_footer_widgets == 'wide-left-3c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/footer-3c-wide-left.png" /></a>
						</li>
						<li>
							<input id="stf_footer_widgets"  name="stf_options[footer_widgets]" type="radio" value="wide-right-3c" <?php if($stf_footer_widgets == 'wide-right-3c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/footer-3c-wide-right.png" /></a>
						</li>
						<li>
							<input id="stf_footer_widgets"  name="stf_options[footer_widgets]" type="radio" value="footer-4c" <?php if($stf_footer_widgets == 'footer-4c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/footer-4c.png" /></a>
						</li>
						<li>
							<input id="stf_footer_widgets"  name="stf_options[footer_widgets]" type="radio" value="disable" <?php if($stf_footer_widgets == 'disable') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/footer-no.png" /></a>
						</li>

					</ul>
				</div>
			</div>
			
			<div class="stf-spanel-item">
				<h3>頁尾文字框一</h3>
				<div class="option-item">
					<textarea id="stf_footer_one" name="stf_options[footer_one]" style="width:100%" rows="4"><?php echo htmlspecialchars_decode(stf_get_option('footer_one'));  ?></textarea>				
					<span style="padding-left:0" class="extra-text"><strong style="font-size: 12px;">變數</strong>
						這些標籤可以包含在上面的文字框區域，並在顯示頁面時將被替換。
						<br />
						<strong>%year%</strong> : <em>替換為今年的年份</em><br />
						<strong>%site%</strong> : <em>替換為本網站的網站名稱</em><br />
						<strong>%url%</strong>  : <em>替換為本網站連結網址</em>
					</span>
				</div>
			</div>
			
			<div class="stf-spanel-item">
				<h3>頁尾文字框二</h3>
				<div class="option-item">
					<textarea id="stf_footer_two" name="stf_options[footer_two]" style="width:100%" rows="4"><?php echo htmlspecialchars_decode(stf_get_option('footer_two'));  ?></textarea>				
					<span style="padding-left:0" class="extra-text"><strong style="font-size: 12px;">變數</strong>
						這些標籤可以包含在上面的文字框區域，並在顯示頁面時將被替換。
						<br />
						<strong>%year%</strong> : <em>替換為今年的年份</em><br />
						<strong>%site%</strong> : <em>替換為本網站的網站名稱</em><br />
						<strong>%url%</strong>  : <em>替換為本網站連結網址</em>
					</span>
				</div>
			</div>

		</div><!-- 頁尾設定結束 -->
		
		
		
		<div id="tab8" class="tab_content tabs-wrap">
			<h2>廣告設定</h2> <?php echo $save ?>
			<div class="stf-spanel-item">
				<h3>Banner 背景圖片廣告</h3>
				<?php
					stf_options(				
						array(	"name" => "啟用 Banner 背景圖片廣告",
								"id" => "banner_bg",
								"type" => "checkbox")); 	
							
					stf_options(					
						array(	"name" => "Banner 背景圖片廣告網址",
								"id" => "banner_bg_url",
								"type" => "text"));
				?>
				<p class="stf_message_hint">
					在 "外觀樣式設定" 頁籤中設定 "背景類型" 為 "自訂背景" 然後上傳你的自訂圖片並啟用 <strong>"全螢幕背景"</strong> 選項。
				</p>
			</div>
			<div class="stf-spanel-item">
				<h3>頁首 Banner 廣告區塊</h3>
				<?php
					stf_options(				
						array(	"name" => "頁首 Banner 廣告",
								"id" => "banner_top",
								"type" => "checkbox"));
				?>
				<div class="stf-accordion">
					<h4 class="accordion-head"><a href="">圖片廣告</a></h4>
					<div class="stf-accordion-contnet">
				<?php
					stf_options(			
						array(	"name" => "頁首 Banner 圖片廣告",
								"id" => "banner_top_img",
								"type" => "upload")); 
								
					stf_options(					
						array(	"name" => "頁首 Banner 廣告網址",
								"id" => "banner_top_url",
								"type" => "text")); 
								
					stf_options(				
						array(	"name" => "圖片替代文字",
								"id" => "banner_top_alt",
								"type" => "text"));
								
					stf_options(
						array(	"name" => "在瀏覽器的新分頁中開啟鏈結網頁",
								"id" => "banner_top_tab",
								"type" => "checkbox"));

					stf_options(
						array(	"name" => "Nofollow 屬性",
								"id" => "banner_top_nofollow",
								"type" => "checkbox"));
				?>
					</div>
					<h4 class="accordion-head"><a href="">響應式 Google 廣告</a></h4>
					<div class="stf-accordion-contnet">
				<?php
					stf_options(					
						array(	"name" => "Google Adsense 廣告商 ID",
								"id" => "banner_top_publisher",
								"type" => "text"));

					stf_options(					
						array(	"name" => "728x90 (大型橫幅廣告) - ad ID",
								"id" => "banner_top_728",
								"type" => "text"));
								
					stf_options(					
						array(	"name" => "468x60 (Banner 橫幅廣告) - ad ID",
								"id" => "banner_top_468",
								"type" => "text"));
								
					stf_options(					
						array(	"name" => "300x250 (中等矩型廣告) - ad ID",
								"id" => "banner_top_300",
								"type" => "text"));

				?>
					</div>
					<h4 class="accordion-head"><a href="">自訂廣告程式碼</a></h4>
					<div class="stf-accordion-contnet">
				<?php
					stf_options(					
						array(	"name" => "自訂廣告程式碼",
								"id" => "banner_top_adsense",
								"extra_text" => '支持 <strong>文字，HTML 和短代碼</strong> .',
								"type" => "textarea")); 
				?>
					</div>
				</div>
			</div>

			<div class="stf-spanel-item">
				<h3>頁尾 Banner 廣告區塊</h3>
				<?php
					stf_options(				
						array(	"name" => "頁尾 Banner 廣告",
								"id" => "banner_bottom",
								"type" => "checkbox")); 
				?>
				<div class="stf-accordion">
					<h4 class="accordion-head"><a href="">圖片廣告</a></h4>
					<div class="stf-accordion-contnet">
				<?php
					stf_options(			
						array(	"name" => "頁尾 Banner 圖片廣告",
								"id" => "banner_bottom_img",
								"type" => "upload")); 
								
					stf_options(					
						array(	"name" => "頁尾 Banner 廣告網址",
								"id" => "banner_bottom_url",
								"type" => "text")); 
								
					stf_options(				
						array(	"name" => "圖片替代文字",
								"id" => "banner_bottom_alt",
								"type" => "text"));
								
					stf_options(
						array(	"name" => "在瀏覽器的新分頁中開啟鏈結網頁",
								"id" => "banner_bottom_tab",
								"type" => "checkbox"));
						
					stf_options(
						array(	"name" => "Nofollow 屬性",
								"id" => "banner_bottom_nofollow",
								"type" => "checkbox"));
				?>
					</div>
					<h4 class="accordion-head"><a href="">響應式 Google 廣告</a></h4>
					<div class="stf-accordion-contnet">
				<?php
					stf_options(					
						array(	"name" => "Google Adsense 廣告商 ID",
								"id" => "banner_bottom_publisher",
								"type" => "text"));

					stf_options(					
						array(	"name" => "728x90 (大型橫幅廣告) - ad ID",
								"id" => "banner_bottom_728",
								"type" => "text"));
								
					stf_options(					
						array(	"name" => "468x60 (Banner 橫幅廣告) - ad ID",
								"id" => "banner_bottom_468",
								"type" => "text"));
								
					stf_options(					
						array(	"name" => "300x250 (中等矩型廣告) - ad ID",
								"id" => "banner_bottom_300",
								"type" => "text"));

				?>
					</div>
					<h4 class="accordion-head"><a href="">自訂廣告程式碼</a></h4>
					<div class="stf-accordion-contnet">
				<?php
					stf_options(					
						array(	"name" => "自訂廣告程式碼",
								"id" => "banner_bottom_adsense",
								"extra_text" => '支持 <strong>文字，HTML 和短代碼</strong> .',
								"type" => "textarea")); 
				?>
					</div>
				</div>
			</div>
	
	
			<div class="stf-spanel-item">
				<h3>文章上方 Banner 廣告區塊</h3>
				<?php
					stf_options(				
						array(	"name" => "文章上方 Banner 廣告區塊",
								"id" => "banner_above",
								"type" => "checkbox")); 	
				?>
				<div class="stf-accordion">
					<h4 class="accordion-head"><a href="">圖片廣告</a></h4>
					<div class="stf-accordion-contnet">
				<?php
					stf_options(			
						array(	"name" => "文章上方 Banner 廣告圖片",
								"id" => "banner_above_img",
								"type" => "upload")); 
								
					stf_options(					
						array(	"name" => "文章上方 Banner 廣告網址",
								"id" => "banner_above_url",
								"type" => "text")); 
								
					stf_options(				
						array(	"name" => "圖片替代文字",
								"id" => "banner_above_alt",
								"type" => "text"));
								
					stf_options(
						array(	"name" => "在瀏覽器的新分頁中開啟鏈結網頁",
								"id" => "banner_above_tab",
								"type" => "checkbox"));
					
					stf_options(
						array(	"name" => "Nofollow 屬性",
								"id" => "banner_above_nofollow",
								"type" => "checkbox"));
				?>
					</div>
					<h4 class="accordion-head"><a href="">響應式 Google 廣告</a></h4>
					<div class="stf-accordion-contnet">
				<?php
					stf_options(					
						array(	"name" => "Google Adsense 廣告商 ID",
								"id" => "banner_above_publisher",
								"type" => "text"));
	
					stf_options(					
						array(	"name" => "468x60 (Banner 橫幅廣告) - ad ID",
								"id" => "banner_above_468",
								"type" => "text"));
								
					stf_options(					
						array(	"name" => "300x250 (中等矩型廣告) - ad ID",
								"id" => "banner_above_300",
								"type" => "text"));

				?>
					</div>
					<h4 class="accordion-head"><a href="">自訂廣告程式碼</a></h4>
					<div class="stf-accordion-contnet">
				<?php
					stf_options(					
						array(	"name" => "自訂廣告程式碼",
								"id" => "banner_above_adsense",
								"extra_text" => '支持 <strong>文字，HTML 和短代碼</strong> .',
								"type" => "textarea")); 
				?>
					</div>
				</div>
			</div>
	
			
			<div class="stf-spanel-item">
				<h3>文章下方 Banner 廣告區塊</h3>
				<?php
					stf_options(				
						array(	"name" => "文章下方 Banner 廣告",
								"id" => "banner_below",
								"type" => "checkbox")); 	
				?>
				<div class="stf-accordion">
					<h4 class="accordion-head"><a href="">圖片廣告</a></h4>
					<div class="stf-accordion-contnet">
				<?php
					stf_options(			
						array(	"name" => "文章下方 Banner 廣告圖片",
								"id" => "banner_below_img",
								"type" => "upload")); 
								
					stf_options(					
						array(	"name" => "文章下方 Banner 廣告網址",
								"id" => "banner_below_url",
								"type" => "text")); 
								
					stf_options(				
						array(	"name" => "圖片替代文字",
								"id" => "banner_below_alt",
								"type" => "text"));
								
					stf_options(
						array(	"name" => "在瀏覽器的新分頁中開啟鏈結網頁",
								"id" => "banner_below_tab",
								"type" => "checkbox"));
							
					stf_options(
						array(	"name" => "Nofollow 屬性",
								"id" => "banner_below_nofollow",
								"type" => "checkbox"));
				?>
					</div>
					<h4 class="accordion-head"><a href="">響應式 Google 廣告</a></h4>
					<div class="stf-accordion-contnet">
				<?php
					stf_options(					
						array(	"name" => "Google Adsense 廣告商 ID",
								"id" => "banner_below_publisher",
								"type" => "text"));
	
					stf_options(					
						array(	"name" => "468x60 (Banner 橫幅廣告) - ad ID",
								"id" => "banner_below_468",
								"type" => "text"));
								
					stf_options(					
						array(	"name" => "300x250 (中等矩型廣告) - ad ID",
								"id" => "banner_below_300",
								"type" => "text"));

				?>
					</div>
					<h4 class="accordion-head"><a href="">自訂廣告程式碼</a></h4>
					<div class="stf-accordion-contnet">
				<?php
					stf_options(					
						array(	"name" => "自訂廣告程式碼",
								"id" => "banner_below_adsense",
								"extra_text" => '支持 <strong>文字，HTML 和短代碼</strong> .',
								"type" => "textarea")); 
				?>
					</div>
				</div>
			</div>

			<div class="stf-spanel-item">
				<h3>短代碼 ADS</h3>
				<?php
					stf_options(				
						array(	"name" => "[ads1] 短代碼 Banner 廣告",
								"id" => "ads1_shortcode",
								"type" => "textarea")); 
	
					stf_options(
						array(	"name" => "[ads2] 短代碼 Banner 廣告",
								"id" => "ads2_shortcode",
								"type" => "textarea")); 
				?>
			</div>
		</div> <!-- 廣告設定結束 -->
		
		
		
		<div id="tab11" class="tab_content tabs-wrap">
			<h2>側邊欄設定</h2>	<?php echo $save ?>	
			
			<div class="stf-spanel-item">
				<h3>側邊欄位置</h3>
				<div class="option-item">
					<?php
						$checked = 'checked="checked"';
						$stf_sidebar_pos = stf_get_option('sidebar_pos');
					?>
					<ul id="sidebar-position-options" class="stf-options">
						<li>
							<input id="stf_sidebar_pos" name="stf_options[sidebar_pos]" type="radio" value="right" <?php if($stf_sidebar_pos == 'right' || !$stf_sidebar_pos ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/sidebar-right.png" /></a>
						</li>
						<li>
							<input id="stf_sidebar_pos" name="stf_options[sidebar_pos]" type="radio" value="left" <?php if($stf_sidebar_pos == 'left') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/sidebar-left.png" /></a>
						</li>
					</ul>
				</div>
			</div>
			
			<div class="stf-spanel-item">
				<h3>新增側邊欄</h3>
				<div class="option-item">
					<span class="label">側邊欄名稱</span>
					
					<input id="sidebarName" type="text" size="56" style="direction:ltr; text-laign:left" name="sidebarName" value="" />
					<input id="sidebarAdd"  class="small_button" type="button" value="新增" />
					
					<ul id="sidebarsList">
					<?php $sidebars = stf_get_option( 'sidebars' ) ;
						if($sidebars){
							foreach ($sidebars as $sidebar) { ?>
						<li>
							<div class="widget-head"><?php echo $sidebar ?>  <input id="stf_sidebars" name="stf_options[sidebars][]" type="hidden" value="<?php echo $sidebar ?>" /><a class="del-sidebar"></a></div>
						</li>
							<?php }
						}
					?>
					</ul>
				</div>				
			</div>

			<div class="stf-spanel-item" id="custom-sidebars">
				<h3>自訂側邊欄</h3>
				<?php
				
				$new_sidebars = array(''=> '預設');
				
				if($sidebars){
					foreach ($sidebars as $sidebar) {
						$new_sidebars[$sidebar] = $sidebar;
					}
				}
				
				
				stf_options(				
					array(	"name" => "首頁側邊欄",
							"id" => "sidebar_home",
							"type" => "select",
							"options" => $new_sidebars ));
							
				stf_options(				
					array(	"name" => "分頁側邊欄",
							"id" => "sidebar_page",
							"type" => "select",
							"options" => $new_sidebars ));
							
				stf_options(				
					array(	"name" => "單篇文章側邊欄",
							"id" => "sidebar_post",
							"type" => "select",
							"options" => $new_sidebars ));
							
				stf_options(				
					array(	"name" => "分類頁面側邊欄",
							"id" => "sidebar_archive",
							"type" => "select",
							"options" => $new_sidebars ));

				?>
				<p class="stf_message_hint">
				你可以替文章分類頁面自訂側邊欄 .. 去 <strong><a target="Blank" href="edit-tags.php?taxonomy=category">文章分類編輯頁面</a></strong> - 編輯你想要自訂側邊欄的分類目錄 <strong><?php echo theme_name;?> - 自訂分類目錄側邊欄設定。</strong>
				</p>
			</div>
		</div> <!-- 側邊欄設定結束 -->
		
		
		
		<div id="tab12" class="tab_content tabs-wrap">
			<h2>彙整分類頁面設定</h2>	<?php echo $save ?>	
			
			<div class="stf-spanel-item">
				<h3>一般設定</h3>
				<p class="stf_message_hint">以下設定將適用於首頁部落格佈局和部落格列表模版的所有頁面。</p>
				<?php
					stf_options(
						array(	"name" => "顯示",
								"id" => "blog_display",
								"help" => "這將顯示於所有彙整頁面，例如：文章分類、文章標籤、搜尋頁和首頁部落格樣式。",
								"type" => "radio",
								"options" => array( "excerpt"=>"摘要和特色圖片" ,
													"full_thumb"=>"摘要和完整尺寸特色圖片" ,
													"content"=>"文章" )));
								
					stf_options(
						array(	"name" => "顯示社交按鈕",
								"id" => "archives_socail",
								"type" => "checkbox",
								"help" => "假如 Facebook , Twitter , Google+ 和 Pinterest 社交按鈕將顯示於所有彙整頁面，例如：文章分類、文章標籤、搜尋頁和首頁部落格樣式。" ));
					
					stf_options(
						array( 	"name" => "摘要長度",
								"id" => "exc_length",
								"type" => "short-text"));
				?>
			</div>

			<div class="stf-spanel-item">
				<h3>分類目錄文章資訊</h3>
				<p class="stf_message_hint">以下設定將適用於首頁部落格佈局和部落格列表模版的所有頁面。</p>
				<?php
					stf_options(
						array(	"name" => "投票分數",
								"id" => "arc_meta_score",
								"type" => "checkbox" )); 			
					stf_options(
						array(	"name" => "作者資料",
								"id" => "arc_meta_author",
								"type" => "checkbox")); 			
					stf_options(
						array(	"name" => "日期",
								"id" => "arc_meta_date",
								"type" => "checkbox"));
					stf_options(
						array(	"name" => "標籤資訊",
								"id" => "arc_meta_cats",
								"type" => "checkbox")); 
					stf_options(
						array(	"name" => "評論資訊",
								"id" => "arc_meta_comments",
								"type" => "checkbox")); 
				?>
			</div>	
			
			<div class="stf-spanel-item">
				<h3>分類目錄 頁面設定</h3>
				<?php
					stf_options(
						array(	"name" => "分類目錄描述",
								"id" => "category_desc",
								"type" => "checkbox"));

					stf_options(
						array(	"name" => "RSS 圖示",
								"id" => "category_rss",
								"type" => "checkbox"));
				?>
			</div>

			<div class="stf-spanel-item">
				<h3>標籤頁面設定</h3>
				<?php
					stf_options(
						array(	"name" => "RSS 圖示",
								"id" => "tag_rss",
								"type" => "checkbox"));
				?>
			</div>
			
			<div class="stf-spanel-item">
				<h3>作者頁面設定</h3>
				<?php
					stf_options(
						array(	"name" => "作者簡介",
								"id" => "author_bio",
								"type" => "checkbox"));
				?>
				<?php
					stf_options(
						array(	"name" => "RSS 圖示",
								"id" => "author_rss",
								"type" => "checkbox"));
				?>
			</div>
			
			<div class="stf-spanel-item">
				<h3>搜尋頁面設定</h3>
				<?php
					stf_options(
						array(	"name" => "用分類目錄 ID 搜尋",
								"id" => "search_cats",
								"help" => "使用減號 (-) 來排除文章分類。例如： (1,4,-7) 代表 僅在分類目錄 ID 的 1 & 4 搜尋，並且排除分類目錄 ID 7。",
								"type" => "text"));
				?>
				<?php
					stf_options(
						array(	"name" => "在搜尋頁面中顯示搜尋結果",
								"id" => "search_exclude_pages",
								"type" => "checkbox"));
				?>
			</div>
		</div> <!-- 彙整設定結束 -->
		
		
		
		<div id="tab13" class="tab_content tabs-wrap">
			<h2>外觀樣式設定</h2>	<?php echo $save ?>	
			<div class="stf-spanel-item">
				<h3>主題顏色設定</h3>

				<div class="option-item">
					<span class="label">選擇主題顏色</span>
			
					<?php
						$checked = 'checked="checked"';
						$theme_color = stf_get_option('theme_skin');
					?>
					<ul style="clear:both" id="theme-skins" class="stf-options">
						<li>
							<input id="stf_theme_skin"  name="stf_options[theme_skin]" type="radio" value="0" <?php if(!$theme_color) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/skin-none.png" /></a>
						</li>
						<li>
							<input id="stf_theme_skin"  name="stf_options[theme_skin]" type="radio" value="#f50000" <?php if($theme_color == '#f50000' ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/skin-red.png" /></a>
						</li>
						<li>
							<input id="stf_theme_skin"  name="stf_options[theme_skin]" type="radio" value="#29b1e4" <?php if($theme_color == '#29b1e4') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/skin-blue.png" /></a>
						</li>
						<li>
							<input id="stf_theme_skin"  name="stf_options[theme_skin]" type="radio" value="#26c66e" <?php if($theme_color == '#26c66e') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/skin-green.png" /></a>
						</li>
						<li>
							<input id="stf_theme_skin"  name="stf_options[theme_skin]" type="radio" value="#000" <?php if($theme_color == '#000') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/skin-black.png" /></a>
						</li>
						<li>
							<input id="stf_theme_skin"  name="stf_options[theme_skin]" type="radio" value="#FFBA00" <?php if($theme_color == '#FFBA00' ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/skin-yellow.png" /></a>
						</li>
					</ul>
				</div>

				<?php
					stf_options(
						array(	"name" => "自訂主題顏色",
								"id" => "global_color",
								"type" => "color"));

					stf_options(				
						array(	"name" => "深色背景",
								"id" => "dark_skin",
								"type" => "checkbox")); 
								
					stf_options(				
						array(	"name" => "現代化彩色捲軸",
								"id" => "modern_scrollbar",
								"type" => "checkbox",
								"extra_text" => '僅針對 Chrome 和 Safari 瀏覽器。'));
				?>
			</div>	
			<div class="stf-spanel-item">

				<h3>背景類型</h3>
				<?php
					stf_options(
						array( 	"name" => "背景類型",
								"id" => "background_type",
								"type" => "radio",
								"options" => array( "pattern"=>"圖片樣式" ,
													"custom"=>"自訂背景" )));
				?>
			</div>

			<div class="stf-spanel-item" id="pattern-settings">
				<h3>選擇背景樣式</h3>
				
				<?php
					stf_options(
						array( 	"name" => "背景顏色",
								"id" => "background_pattern_color",
								"type" => "color" ));
				?>
				
				<?php
					$checked = 'checked="checked"';
					$theme_pattern = stf_get_option('background_pattern');
				?>
				<ul id="theme-pattern" class="stf-options">
					<?php for($i=1 ; $i<=36 ; $i++ ){ 
					 $pattern = 'body-bg'.$i; ?>
					<li>
						<input id="stf_background_pattern"  name="stf_options[background_pattern]" type="radio" value="<?php echo $pattern ?>" <?php if($theme_pattern == $pattern ) echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/pattern<?php echo $i ?>.png" /></a>
					</li>
					<?php } ?>
				</ul>
			</div>

			<div class="stf-spanel-item" id="bg_image_settings">
				<h3>自訂背景</h3>
				<?php
					stf_options(
						array(	"name" => "自訂背景",
								"id" => "background",
								"type" => "background"));
				?>
				<?php
					stf_options(
						array(	"name" => "全螢幕背景",
								"id" => "background_full",
								"type" => "checkbox"));
				?>

			</div>	
			<div class="stf-spanel-item">
				<h3>網站主體樣式設定</h3>
				<?php
				
					stf_options(
						array(	"name" => "高亮文字顏色",
								"id" => "highlighted_color",
								"type" => "color"));
								
					stf_options(
						array(	"name" => "鏈結顏色",
								"id" => "links_color",
								"type" => "color"));
					stf_options(
						array(	"name" => "鏈結線顯示",
								"id" => "links_decoration",
								"type" => "select",
								"options" => array( ""=>"預設" ,
													"none"=>"無",
													"underline"=>"底線",
													"overline"=>"上劃線",
													"line-through"=>"刪除線" )));

					stf_options(
						array(	"name" => "滑鼠經過的鏈結顏色",
								"id" => "links_color_hover",
								"type" => "color"));
	
					stf_options(
						array(	"name" => "滑鼠經過的鏈結線",
								"id" => "links_decoration_hover",
								"type" => "select",
								"options" => array( ""=>"預設" ,
													"none"=>"無",
													"underline"=>"底線",
													"overline"=>"上劃線",
													"line-through"=>"刪除線" )));
				?>
			</div>

			<div class="stf-spanel-item">
				<h3>頁首導航欄樣式設定</h3>
				<?php
					stf_options(
						array(	"name" => "背景",
								"id" => "topbar_background",
								"type" => "background"));
				?>
				<?php
					stf_options(
						array(	"name" => "鏈結顏色",
								"id" => "topbar_links_color",
								"type" => "color"));
				?>
				<?php
					stf_options(
						array(	"name" => "滑鼠經過的鏈結顏色",
								"id" => "topbar_links_color_hover",
								"type" => "color"));
				?>

				<?php
					stf_options(
						array(	"name" => "今天日期的背景",
								"id" => "todaydate_background",
								"type" => "color"));
				?>
				<?php
					stf_options(
						array(	"name" => "今天日期的顏色",
								"id" => "todaydate_color",
								"type" => "color"));
				?>
			</div>
			
			<div class="stf-spanel-item">
				<h3>頁首背景</h3>
				<?php
					stf_options(
						array(	"name" => "背景",
								"id" => "header_background",
								"type" => "background"));
				?>
			</div>
			
						
			<div class="stf-spanel-item">
				<h3>主選單導航欄樣式設定</h3>
				<p class="stf_message_hint">圖片編輯軟體來變更 <strong>images/main-menu-bg</strong> 的顏色。</p>
				<?php
					stf_options(
						array(	"name" => "次選單背景",
								"id" => "sub_nav_background",
								"type" => "color"));

					stf_options(
						array(	"name" => "鏈結顏色",
								"id" => "nav_links_color",
								"type" => "color"));
										
					stf_options(
						array(	"name" => "鏈結文字陰影顏色",
								"id" => "nav_shadow_color",
								"type" => "color"));
								
					stf_options(
						array(	"name" => "滑鼠經過的鏈結顏色",
								"id" => "nav_links_color_hover",
								"type" => "color"));

					stf_options(
						array(	"name" => "滑鼠經過的鏈結文字陰影顏色",
								"id" => "nav_shadow_color_hover",
								"type" => "color"));
								
					stf_options(
						array(	"name" => "目前所在頁面的選單鏈結顏色",
								"id" => "nav_current_links_color",
								"type" => "color"));
										
					stf_options(
						array(	"name" => "目前所在頁面的鏈結文字陰影顏色",
								"id" => "nav_current_shadow_color",
								"type" => "color"));

					stf_options(
						array(	"name" => "選單分隔線顏色",
								"id" => "nav_sep1",
								"type" => "color"));
								
					stf_options(
						array(	"name" => "第二選單分隔線顏色",
								"id" => "nav_sep2",
								"type" => "color"));
				?>
			</div>
			
			
			<div class="stf-spanel-item">
				<h3>即時新聞樣式設定</h3>
				<?php
					stf_options(
						array(	"name" => "即時新聞文字背景 ",
								"id" => "breaking_title_bg",
								"type" => "color"));
				?>		
			</div>

			<div class="stf-spanel-item">
				<h3>文章樣式設定</h3>
				<?php
					stf_options(
						array(	"name" => "主要文章框背景 ",
								"id" => "main_content_bg",
								"type" => "background"));

					stf_options(
						array(	"name" => "Boxes / 小工具背景 ",
								"id" => "boxes_bg",
								"type" => "background"));

				?>		
			</div>
			<div class="stf-spanel-item">
				<h3>文章文字樣式設定</h3>
				<?php
					stf_options(
						array(	"name" => "文字鏈結顏色",
								"id" => "post_links_color",
								"type" => "color"));
				?>
				<?php
					stf_options(
						array(	"name" => "文字鏈結線樣式",
								"id" => "post_links_decoration",
								"type" => "select",
								"options" => array( ""=>"預設" ,
													"none"=>"無",
													"underline"=>"底線",
													"overline"=>"上劃線",
													"line-through"=>"刪除線" )));
				?>
				<?php
					stf_options(
						array(	"name" => "滑鼠經過的鏈結顏色",
								"id" => "post_links_color_hover",
								"type" => "color"));
				?>
				<?php
					stf_options(
						array(	"name" => "滑鼠經過的鏈結線樣式",
								"id" => "post_links_decoration_hover",
								"type" => "select",
								"options" => array( ""=>"預設" ,
													"none"=>"無",
													"underline"=>"底線",
													"overline"=>"上劃線",
													"line-through"=>"刪除線" )));
				?>
			</div>
			<div class="stf-spanel-item">
				<h3>頁尾背景</h3>
				<?php
					stf_options(
						array(	"name" => "背景",
								"id" => "footer_background",
								"type" => "background"));
				?>
				<?php
					stf_options(
						array(	"name" => "頁尾小工具區標題顏色",
								"id" => "footer_title_color",
								"type" => "color"));
				?>
				<?php
					stf_options(
						array(	"name" => "鏈結顏色",
								"id" => "footer_links_color",
								"type" => "color"));
				?>
				<?php
					stf_options(
						array(	"name" => "滑鼠經過的鏈結顏色",
								"id" => "footer_links_color_hover",
								"type" => "color"));
				?>
			</div>				
						
			<div class="stf-spanel-item">
				<h3>自定義 CSS</h3>	
				<div class="option-item">
					<p><strong>一般 CSS :</strong></p>
					<textarea id="stf_css" name="stf_options[css]" style="width:100%" rows="7"><?php echo stf_get_option('css');  ?></textarea>
				</div>	
				<div class="option-item">
					<p><strong>平板 CSS :</strong> 寬度介於 768px 到 985px 之間</p>
					<textarea id="stf_css" name="stf_options[css_tablets]" style="width:100%" rows="7"><?php echo stf_get_option('css_tablets');  ?></textarea>
				</div>
				<div class="option-item">
					<p><strong>高解析度智慧型手機 CSS :</strong> 寬度介於 480px 到 767px</p>
					<textarea id="stf_css" name="stf_options[css_wide_phones]" style="width:100%" rows="7"><?php echo stf_get_option('css_wide_phones');  ?></textarea>
				</div>
				<div class="option-item">
					<p><strong>一般智慧型手機 CSS :</strong> 寬度介於 320px 到 479px</p>
					<textarea id="stf_css" name="stf_options[css_phones]" style="width:100%" rows="7"><?php echo stf_get_option('css_phones');  ?></textarea>
				</div>	
			</div>	

		</div> <!-- 外觀樣式設定結束 -->
		
		
		
		<div id="tab10" class="tab_content tabs-wrap">
			<h2>進階設定</h2>	<?php echo $save ?>	

			<div class="stf-spanel-item">
				<h3>停用 Responsive 響應式</h3>
				<?php
					stf_options(
						array(	"name" => "停用 Responsive 響應式",
								"id" => "disable_responsive",
								"type" => "checkbox"));
				?>
				<p class="stf_message_hint">此選項僅在平板和智慧型手機上運作 .. 停用電腦上的響應式功能 .. 編輯 style.css 檔案和移除所有 Media Quries 的功能請從該檔案最末端編輯操作。</p>
			</div>	
			
			<div class="stf-spanel-item">
				<h3>停用主題 [Gallery] 短代碼</h3>
				<?php
					stf_options(
						array(	"name" => "停用主題 [Gallery]",
								"id" => "disable_gallery_shortcode",
								"type" => "checkbox"));
				?>
				<p class="stf_message_hint">設定它 <strong>開啟</strong> 假如你有使用 Jetpack Tiled Galleries 或自訂 lightbox 外掛給 [Gallery] 短代碼。</p>
			</div>	
			
			<div class="stf-spanel-item">
				<h3>Twitter API 設定</h3>
				<p class="stf_message_hint">此資訊將使用在社交中心和 Twitter 小工具 .. 你需要建立 <a href="https://dev.twitter.com/apps" target="_blank">Twitter APP</a> 才能取得此資訊 .. 點擊此 <a href="<?php echo home_url() ?>/twitter-api-settings" target="_blank">教學文章</a>。</p>

				<?php
					stf_options(
						array(	"name" => "Twitter 使用者帳號",
								"id" => "twitter_username",
								"type" => "text"));

					stf_options(
						array(	"name" => "Consumer key",
								"id" => "twitter_consumer_key",
								"type" => "text"));
								
					stf_options(
						array(	"name" => "Consumer secret",
								"id" => "twitter_consumer_secret",
								"type" => "text"));	
								
					stf_options(
						array(	"name" => "Access token",
								"id" => "twitter_access_token",
								"type" => "text"));	
								
					stf_options(
						array(	"name" => "Access token secret",
								"id" => "twitter_access_token_secret",
								"type" => "text"));
				?>
			</div>	
			
			<div class="stf-spanel-item">
				<h3>縮圖設定</h3>
				
				<?php
					stf_options(
						array(	"name" => "TimThumb <small style='font-weight:bold;'>(不建議)</small>",
								"id" => "timthumb",
								"type" => "checkbox"));
				?>
			</div>

			<div class="stf-spanel-item">
				<h3>Wordpress 登入介面 Logo</h3>
				<?php
					stf_options(
						array(	"name" => "Wordpress 登入介面 Logo",
								"id" => "dashboard_logo",
								"type" => "upload"));

					stf_options(
						array(	"name" => "Wordpress 登入介面 Logo 圖片網址",
								"id" => "dashboard_logo_url",
								"type" => "text"));
				?>
			
			</div>
			<?php
				global $array_options ;
				
				$current_options = array();
				foreach( $array_options as $option ){
					if( get_option( $option ) )
						$current_options[$option] =  get_option( $option ) ;
				}
			?>
			
			<div class="stf-spanel-item">
				<h3>匯出主題設定</h3>
				<div class="option-item">
					<textarea style="width:100%" rows="7"><?php echo $currentsettings = base64_encode( serialize( $current_options )); ?></textarea>
				</div>
			</div>
			<div class="stf-spanel-item">
				<h3>匯入主題設定</h3>
				<div class="option-item">
					<textarea id="stf_import" name="stf_import" style="width:100%" rows="7"></textarea>
				</div>
			</div>


		</div> <!-- 進階設定結束 -->
		
		
		<div class="stf-spanl-footer">
			<?php echo $save; ?>
		</form>
		
			<form method="post">
				<div class="spanel-reset">
					<input type="hidden" name="resetnonce" value="<?php echo wp_create_nonce('reset-action-code'); ?>" />
					<input name="reset" class="spanel-reset-button" type="submit" onClick="if(confirm('所有設定將會回復原始設定 .. 你確定嗎？')) return true ; else return false; " value="清除設定" />
					<input type="hidden" name="action" value="reset" />
				</div>
			</form>
		</div><!-- end .stf-spanel-footer /-->
		
	</div><!-- end .stf-spanel-content /-->
	<div class="clear"></div>
</div><!-- end .stf-spanel /-->
<?php
}
?>