<?php
/**
* For WP Editor Shortcode
*
* @file 		 shortcode.php
* @package	 StartPress Company
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://carrielis.com
*/
define ( 'JS_PATH' , get_template_directory_uri().'/spanel/shortcodes/customcodes.js');


add_action('admin_head','html_quicktags');
function html_quicktags() {

	$output = "<script type='text/javascript'>\n
	/* <![CDATA[ */ \n";
	wp_print_scripts( 'quicktags' );

	$buttons = array();
	
	$buttons[] = array(
		'name' => 'review',
		'options' => array(
			'display_name' => '評分總覽',
			'open_tag' => '\n[review]',
			'close_tag' => '',
			'key' => ''
	));

	$buttons[] = array(
		'name' => 'ads1',
		'options' => array(
			'display_name' => '廣告碼1',
			'open_tag' => '\n[ads1]',
			'close_tag' => '',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'ads2',
		'options' => array(
			'display_name' => '廣告碼2',
			'open_tag' => '\n[ads2]',
			'close_tag' => '',
			'key' => ''
	));

	$buttons[] = array(
		'name' => 'is_logged_in',
		'options' => array(
			'display_name' => '登入者 : ',
			'open_tag' => '\n[is_logged_in]',
			'close_tag' => '[/is_logged_in]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'is_guest',
		'options' => array(
			'display_name' => '訪客',
			'open_tag' => '\n[is_guest]',
			'close_tag' => '[/is_guest]\n',
			'key' => ''
	));

		
	$buttons[] = array(
		'name' => 'one_third',
		'options' => array(
			'display_name' => '1/3',
			'open_tag' => '\n[one_third]',
			'close_tag' => '[/one_third]\n',
			'key' => ''
	));
		
	$buttons[] = array(
		'name' => 'one_third_last',
		'options' => array(
			'display_name' => '1/3的最後',
			'open_tag' => '\n[one_third_last]',
			'close_tag' => '[/one_third_last]\n',
			'key' => ''
	));
			
	$buttons[] = array(
		'name' => 'two_third',
		'options' => array(
			'display_name' => '2/3',
			'open_tag' => '\n[two_third]',
			'close_tag' => '[/two_third]\n',
			'key' => ''
	));	
	
	$buttons[] = array(
		'name' => 'two_third_last',
		'options' => array(
			'display_name' => '2/3的最後',
			'open_tag' => '\n[two_third_last]',
			'close_tag' => '[/two_third_last]\n',
			'key' => ''
	));	
	
	$buttons[] = array(
		'name' => 'one_half',
		'options' => array(
			'display_name' => '1/2',
			'open_tag' => '\n[one_half]',
			'close_tag' => '[/one_half]\n',
			'key' => ''
	));	
	
	$buttons[] = array(
		'name' => 'one_half_last',
		'options' => array(
			'display_name' => '1/2的最後',
			'open_tag' => '\n[one_half_last]',
			'close_tag' => '[/one_half_last]\n',
			'key' => ''
	));	
	
	$buttons[] = array(
		'name' => 'one_fourth',
		'options' => array(
			'display_name' => '1/4',
			'open_tag' => '\n[one_fourth]',
			'close_tag' => '[/one_fourth]\n',
			'key' => ''
	));	
	
	$buttons[] = array(
		'name' => 'one_fourth_last',
		'options' => array(
			'display_name' => '1/4的最後',
			'open_tag' => '\n[one_fourth_last]',
			'close_tag' => '[/one_fourth_last]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'three_fourth',
		'options' => array(
			'display_name' => '3/4',
			'open_tag' => '\n[three_fourth]',
			'close_tag' => '[/three_fourth]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'three_fourth_last',
		'options' => array(
			'display_name' => '3/4的最後',
			'open_tag' => '\n[three_fourth_last]',
			'close_tag' => '[/three_fourth_last]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'one_fifth',
		'options' => array(
			'display_name' => '1/5',
			'open_tag' => '\n[one_fifth]',
			'close_tag' => '[/one_fifth]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'one_fifth_last',
		'options' => array(
			'display_name' => '1/5的最後',
			'open_tag' => '\n[one_fifth_last]',
			'close_tag' => '[/one_fifth_last]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'two_fifth',
		'options' => array(
			'display_name' => '2/5',
			'open_tag' => '\n[two_fifth]',
			'close_tag' => '[/two_fifth]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'two_fifth_last',
		'options' => array(
			'display_name' => '2/5的最後',
			'open_tag' => '\n[two_fifth_last]',
			'close_tag' => '[/two_fifth_last]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'three_fifth',
		'options' => array(
			'display_name' => '3/5',
			'open_tag' => '\n[three_fifth]',
			'close_tag' => '[/three_fifth]\n',
			'key' => ''
	));
		
	$buttons[] = array(
		'name' => 'three_fifth_last',
		'options' => array(
			'display_name' => '3/5的最後',
			'open_tag' => '\n[three_fifth_last]',
			'close_tag' => '[/three_fifth_last]\n',
			'key' => ''
	));
		
	$buttons[] = array(
		'name' => 'four_fifth',
		'options' => array(
			'display_name' => '4/5',
			'open_tag' => '\n[four_fifth]',
			'close_tag' => '[/four_fifth]\n',
			'key' => ''
	));
		
	$buttons[] = array(
		'name' => 'four_fifth_last',
		'options' => array(
			'display_name' => '4/5的最後',
			'open_tag' => '\n[four_fifth_last]',
			'close_tag' => '[/four_fifth_last]\n',
			'key' => ''
	));
		
	$buttons[] = array(
		'name' => 'one_sixth',
		'options' => array(
			'display_name' => '1/6',
			'open_tag' => '\n[one_sixth]',
			'close_tag' => '[/one_sixth]\n',
			'key' => ''
	));
		
	$buttons[] = array(
		'name' => 'one_sixth_last',
		'options' => array(
			'display_name' => '1/6的最後',
			'open_tag' => '\n[one_sixth_last]',
			'close_tag' => '[/one_sixth_last]\n',
			'key' => ''
	));
		
	$buttons[] = array(
		'name' => 'five_sixth',
		'options' => array(
			'display_name' => '5/6',
			'open_tag' => '\n[five_sixth]',
			'close_tag' => '[/five_sixth]\n',
			'key' => ''
	));
		
	$buttons[] = array(
		'name' => 'five_sixth_last',
		'options' => array(
			'display_name' => '5/6的最後',
			'open_tag' => '\n[five_sixth_last]',
			'close_tag' => '[/five_sixth_last]\n',
			'key' => ''
	));
		
			
	for ($i=0; $i <= (count($buttons)-1); $i++) {
		$output .= "edButtons[edButtons.length] = new edButton('ed_{$buttons[$i]['name']}'
			,'{$buttons[$i]['options']['display_name']}'
			,'{$buttons[$i]['options']['open_tag']}'
			,'{$buttons[$i]['options']['close_tag']}'
			,'{$buttons[$i]['options']['key']}'
		); \n";
	}
	
	$output .= "\n /* ]]> */ \n
	</script>";
	echo $output;
}



function stf_custom_addbuttons() {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;

	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "add_tcustom_tinymce_plugin");
		add_filter('mce_buttons_3', 'register_tcustom_button');
	}
}
function register_tcustom_button($buttons) {
	array_push(
		$buttons,
		"AddBox",
		"AddButtons",
		"Tabs",
		"Toggle",
		"AuthorBio",
		"|",		
		"AddFlickr",
		"AddTwitter",
		"AddFeeds",
		"AddMap",
		"|",
		"highlight",
		"dropcap",
		"|",
		"checklist",
		"starlist",
		"|",
		"Video",
		"Audio",
		"LightBox",
		"|",
		"Tooltip",
		"ShareButtons",
		"divider"	); 
	return $buttons;
} 
function add_tcustom_tinymce_plugin($plugin_array) {
	$plugin_array['stfShortCodes'] = JS_PATH;
	return $plugin_array;
}
add_action('init', 'stf_custom_addbuttons');




## 廣告碼 1 -------------------------------------------------- #
function stf_shortcode_ads1( $atts, $content = null ) {
	$out ='<div class="ads-in-post1">'. htmlspecialchars_decode(stf_get_option( 'ads1_shortcode' )) .'</div>';
   return $out;
}
add_shortcode('ads1', 'stf_shortcode_ads1');


## 廣告碼 2 -------------------------------------------------- #
function stf_shortcode_ads2( $atts, $content = null ) {
	$out ='<div class="ads-in-post2">'. htmlspecialchars_decode(stf_get_option( 'ads2_shortcode' )) .'</div>';
   return $out;
}
add_shortcode('ads2', 'stf_shortcode_ads2');


## Boxes -------------------------------------------------- #
function stf_shortcode_box( $atts, $content = null ) {
    @extract($atts);

	$type =  ($type)  ? ' '.$type  :'shadow' ;
	$align = ($align) ? ' '.$align : '';
	$class = ($class) ? ' '.$class : '';
	$width = ($width) ? ' style="width:'.$width.'"' : '';

	$out = '<div class="box'.$type.$class.$align.'"'.$width.'><div class="box-inner-block"><i class="stficon-boxicon"></i>
			' .do_shortcode($content). '
			</div></div>';
    return $out;
}
add_shortcode('box', 'stf_shortcode_box');


## 燈箱效果 -------------------------------------------------- #
function stf_shortcode_lightbox( $atts, $content = null ) {
    @extract($atts);

	$out = '<a rel="prettyPhoto" href="'.$full.'" title="'.$title.'">' .do_shortcode($content). '</a>';
    return $out;
}
add_shortcode('lightbox', 'stf_shortcode_lightbox');


## 滑塊切換頁籤 -------------------------------------------------- #
function stf_shortcode_Toggle( $atts, $content = null ) {
    @extract($atts);

	$state =  ($state)  ? ' '.$state  :' open' ;
	$title = ($title) ? ' '.$title : '';

	$out = '<div class="clear"></div><div class="toggle '.$state.'"><h3 class="toggle-head-open">'.$title.'<i class="stficon-up"></i></h3><h3 class="toggle-head-close">'.$title.'<i class="stficon-down"></i></h3><div class="toggle-content">
			' .do_shortcode($content). '
			</div></div>';
    return $out;
}
add_shortcode('toggle', 'stf_shortcode_Toggle');



## 作者資訊 -------------------------------------------------- #
function stf_shortcode_Author_info( $atts, $content = null ) {
    @extract($atts);

	$title = ($title) ? ' '.$title : '';

	$out = '<div class="clear"></div><div class="author-info"><img class="author-img" src="'.$image.'" alt="" /><div class="author-info-content"><h3>'. '關於作者'.'</h3>
			' .do_shortcode($content). '
			</div></div>';
    return $out;
}
add_shortcode('author', 'stf_shortcode_Author_info');



## 各式按鈕 -------------------------------------------------- #
function stf_shortcode_button( $atts, $content = null ) {
    @extract($atts);

	$size  = ($size)  ? ' '.$size  :' small' ;
	$color = ($color) ? ' '.$color : ' gray';
	$link  = ($link) ? ' '.$link : '';
	$target = ($target) ? ' target="_blank"' : '';

	$out = '<a href="'.$link.'"'.$target.' class="shortc-button'.$size.$color.$align.'">' .do_shortcode($content). '</a>';
    return $out;
}
add_shortcode('button', 'stf_shortcode_button');


## Flickr -------------------------------------------------- #
function stf_shortcode_flickr( $atts, $content = null ) {
    @extract($atts);

	$number  = ($number)  ? $number  : '5' ;
	$orderby = ($orderby) ? $orderby : 'random';

	$out = '<div class="flickr-wrapper">
	<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='. $number .'&amp;display='. $orderby .'&amp;size=s&amp;layout=x&amp;source=user&amp;user='. $id .'"></script>
	</div>';       

    return $out;
}
add_shortcode('flickr', 'stf_shortcode_flickr');


## Twitter -------------------------------------------------- #
function stf_shortcode_twitter( $atts, $content = null ) {
    @extract($atts);
	
	wp_enqueue_script( 'stf-tweet' );

	$number  = ($number)  ? $number  : '5' ;
	if($avatar == "true") $avatar = "avatar_size:32," ;
	else $avatar = "" ;

	$out = '
		<div id="twitter-shortcode">
			<div class="tweet-shortcode"></div>
		</div>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(".tweet-shortcode").tweet({
						username: "'. $id .'",
						'.$avatar .'
						count: '. $number .',
						loading_text: " 載入 Twitter 訊息中..." ,
					});
				});
			</script>

';       

    return $out;
}
add_shortcode('twitter', 'stf_shortcode_twitter');


## 評分區塊 -------------------------------------------------- #
function stf_shortcode_review( $atts, $content = null ) {
	ob_start();
	stf_get_review( 'review-bottom' );
	$output = ob_get_contents();
	ob_end_clean();
	return $output; 
}
add_shortcode('review', 'stf_shortcode_review');

## 訂閱 Feeds -------------------------------------------------- #
function stf_shortcode_feeds( $atts, $content = null ) {
    @extract($atts);
	$number  = ($number)  ? $number  : '5' ;
	return stf_get_feeds( $url , $number );
}
add_shortcode('feed', 'stf_shortcode_feeds');


## Google 地圖 -------------------------------------------------- #
function stf_shortcode_googlemap( $atts, $content = null ) {
    @extract($atts);
	$width  = ($width)  ? $width  :'620' ;
	$height = ($height) ? $height : '440';

	return stf_google_maps( $src , $width, $height , $align  );
}
add_shortcode('googlemap', 'stf_shortcode_googlemap');



## 會員已登入 shortcode -------------------------------------------------- #
function stf_shortcode_is_logged_in( $atts, $content = null ) {
	global $user_ID ;
	if( $user_ID )
		return do_shortcode($content) ;
}
add_shortcode('is_logged_in', 'stf_shortcode_is_logged_in');


## 訪客 shortcode -------------------------------------------------- #
function stf_shortcode_is_guest( $atts, $content = null ) {
	global $user_ID ;
	if( !$user_ID  )
		return do_shortcode($content) ;
}
add_shortcode('is_guest', 'stf_shortcode_is_guest');


## 追蹤 Twitter -------------------------------------------------- #
function stf_shortcode_follow( $atts, $content = null ) {
    @extract($atts);

	if($size == "large") $size = 'data-size="large"' ;
		else $size="";
		
	if($count == "true") $count = "true" ;
	else $count = "false" ;

	$out = '
	<a href="https://twitter.com/'. $id .'" class="twitter-follow-button" data-show-count="'.$count.'" '.$size.'>追蹤 @'. $id .'</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';       

    return $out;
}
add_shortcode('follow', 'stf_shortcode_follow');


## 新增音訊播放器屬性 -------------------------------------------------- #
function stf_shortcode_AddAudio( $atts, $content = null ) {
    @extract($atts);
	$player_id = rand(5, 15) ;
	
	wp_enqueue_script( 'stf-jplayer' );

$out= '
	<script type="text/javascript">
    jQuery(document).ready(function(){
      jQuery("#jquery_jplayer_'. $player_id .'").jPlayer({
        ready: function () {
          jQuery(this).jPlayer("setMedia", {
            mp3: "'. $mp3 .'",
            m4a: "'. $m4a .'",
            oga: "'. $ogg .'"
          });
        },
		cssSelectorAncestor: "#jp_container_'. $player_id .'",
        supplied: "m4a, oga, mp3"
      });
    });
  </script> 
  <div id="jquery_jplayer_'. $player_id .'" class="jp-jplayer"></div>
  <div id="jp_container_'. $player_id .'" class="jp-audio">
	<div class="jp-type-single">
		<div class="jp-gui jp-interface">
			<div class="jp-progress">
			  <div class="jp-seek-bar">
				<div class="jp-play-bar"><span></span></div>
			</div>
		</div>
		<a href="javascript:;" class="jp-play" tabindex="1">播放</a>
		<a href="javascript:;" class="jp-pause" tabindex="1">暫停</a>
			
		<div class="jp-volume-bar">
			<div class="jp-volume-bar-value"><span class="handle"></span></div>
		</div>
		
		<a href="javascript:;" class="jp-mute" tabindex="1" title="mute">靜音</a>
		<a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">停止靜音</a>
	</div>

	<div class="jp-no-solution">
		<span>更新需求</span>
		影音播放器需要將您使用的瀏覽器更新到最新版本，或請更新您的 <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash 外掛</a>。
	</div>
  </div>
  </div>';?>
 
  <?php
   return do_shortcode( $out );
}
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) ) add_shortcode('audio', 'stf_shortcode_AddAudio');


## 新增音訊 -------------------------------------------------- #
function stf_shortcode_Tooltip( $atts, $content = null ) {
    @extract($atts);
	if( empty($gravity) ) $gravity = '';
	$out = '<span class="post-tooltip tooltip-'.$gravity.'" title="'.$content.'">'.$text.'</span>';
   return $out;
}
add_shortcode('tooltip', 'stf_shortcode_Tooltip');



## 高亮顯示 -------------------------------------------------- #
function stf_highlight_shortcode( $atts, $content = null ) {  
    return '<span class="highlight">'.$content.'</span>';  
}  
add_shortcode("highlight", "stf_highlight_shortcode");  


## 首字下沉  -------------------------------------------------- #
function stf_dropcap_shortcode( $atts, $content = null ) {  
    return '<span class="dropcap">'.$content.'</span>';  
}  
add_shortcode("dropcap", "stf_dropcap_shortcode");  



## 檢查清單列表 -------------------------------------------------- #
function stf_checklist_shortcode( $atts, $content = null ) {  
    return '<div class="checklist">'.do_shortcode($content).'</div>';  
}  
add_shortcode("checklist", "stf_checklist_shortcode");


## 星號清單列表 -------------------------------------------------- #
function stf_starlist_shortcode( $atts, $content = null ) {  
    return '<div class="starlist">'.do_shortcode($content).'</div>';  
}  
add_shortcode("starlist", "stf_starlist_shortcode");


## Facebook -------------------------------------------------- #
function stf_facebook_shortcode( $atts, $content = null ) { 
	global $post;
    return '<iframe src="http://www.facebook.com/plugins/like.php?href='. get_permalink($post->ID) .'&amp;layout=box_count&amp;show_faces=false&amp;width=100&amp;action=like&amp;font&amp;colorscheme=light&amp;height=65" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:65px;" allowTransparency="true"></iframe>';  
}  
add_shortcode("facebook", "stf_facebook_shortcode");


## Tweet -------------------------------------------------- #
function stf_tweet_shortcode( $atts, $content = null ) { 
	global $post;
    return '<a href="http://twitter.com/share" class="twitter-share-button" data-url="'. get_permalink($post->ID) .'" data-text="'. get_the_title($post->ID) .'" data-via="'. stf_get_option( 'share_twitter_username' ) .'" data-lang="en" data-count="vertical" >tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>';  
}  
add_shortcode("tweet", "stf_tweet_shortcode");


## Digg -------------------------------------------------- #
function stf_digg_shortcode( $atts, $content = null ) { 
	global $post;
    return "
	<script type='text/javascript'>
(function() {
var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];
s.type = 'text/javascript';
s.async = true;
s.src = 'http://widgets.digg.com/buttons.js';
s1.parentNode.insertBefore(s, s1);
})();
</script><a class='DiggThisButton DiggMedium' href='http://digg.com/submit?url". get_permalink($post->ID) ."=&amp;title=". get_the_title($post->ID) ."'></a>";  
}  
add_shortcode("digg", "stf_digg_shortcode");


## pinterest -------------------------------------------------- #
function stf_pinterest_shortcode( $atts, $content = null ) { 
	global $post;
    return '<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
	<a href="http://pinterest.com/pin/create/button/?url='.get_permalink($post->ID).'&amp;media='.stf_thumb_src( 'slider' ).' class="pin-it-button" count-layout="vertical"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>';
 
}  
add_shortcode("pinterest", "stf_pinterest_shortcode");



## Google + -------------------------------------------------- #
function stf_google_shortcode( $atts, $content = null ) { 
	global $post;
    return "<g:plusone size='tall'></g:plusone>
<script type='text/javascript'>
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
";  
}  
add_shortcode("Google", "stf_google_shortcode");


## feedburner -------------------------------------------------- #
function stf_feedburner_shortcode( $atts, $content = null ) { 
    @extract($atts);
    return '<a href="http://feeds.feedburner.com/'.$name.'"><img src="http://feeds.feedburner.com/~fc/'.$name.'?anim=1" height="26" width="88" style="border:0" alt="" /></a>';  
}  
add_shortcode("feedburner", "stf_feedburner_shortcode");




## 文章頁籤 -------------------------------------------------- #
function stf_shortcode_tabs( $atts, $content = null ) {
    @extract($atts);
	
	if($type== "vertical" ) $type= '-ver';
	else $type= '';
	
    wp_enqueue_script( 'stf-tabs' );

	$out ='
	<script type="text/javascript">	jQuery(document).ready(function($){	jQuery("ul.tabs-nav").tabs("> .pane"); }); </script>

		<div class="post-tabs'.$type.'">
		'.do_shortcode($content).'
		</div>
	';
   return $out;
}
add_shortcode('tabs', 'stf_shortcode_tabs');


## 頁籤 -------------------------------------------------- #
function stf_shortcode_tab( $atts, $content = null ) {
	$out ='
		<div class="pane">
		'.do_shortcode($content).'
		</div>
	';
   return $out;
}
add_shortcode('tab', 'stf_shortcode_tab');


## 頁籤首部 -------------------------------------------------- #
function stf_shortcode_tabs_head( $atts, $content = null ) {
	$out ='<ul class="tabs-nav">'.do_shortcode($content).'</ul>';
   return $out;
}
add_shortcode('tabs_head', 'stf_shortcode_tabs_head');


## 頁籤標題 -------------------------------------------------- #
function stf_shortcode_tab_title( $atts, $content = null ) {
	$out ='<li>'.do_shortcode($content).'</li>';
   return $out;
}
add_shortcode('tab_title', 'stf_shortcode_tab_title');


## 分隔線 -------------------------------------------------- #
function stf_shortcode_divider( $atts, $content = null ) {
	$out ='<div class="clear"></div><div class="divider"></div>';
   return $out;
}
add_shortcode('divider', 'stf_shortcode_divider');




## 內容欄位  -------------------------------------------------- #
function stf_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'stf_one_third');

function stf_one_third_last( $atts, $content = null ) {
   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'stf_one_third_last');

function stf_two_third( $atts, $content = null ) {
   return '<div class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'stf_two_third');

function stf_two_third_last( $atts, $content = null ) {
   return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_third_last', 'stf_two_third_last');

function stf_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'stf_one_half');

function stf_one_half_last( $atts, $content = null ) {
   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'stf_one_half_last');

function stf_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'stf_one_fourth');

function stf_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 'stf_one_fourth_last');

function stf_three_fourth( $atts, $content = null ) {
   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'stf_three_fourth');

function stf_three_fourth_last( $atts, $content = null ) {
   return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fourth_last', 'stf_three_fourth_last');

function stf_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'stf_one_fifth');

function stf_one_fifth_last( $atts, $content = null ) {
   return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fifth_last', 'stf_one_fifth_last');

function stf_two_fifth( $atts, $content = null ) {
   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'stf_two_fifth');

function stf_two_fifth_last( $atts, $content = null ) {
   return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_fifth_last', 'stf_two_fifth_last');

function stf_three_fifth( $atts, $content = null ) {
   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'stf_three_fifth');

function stf_three_fifth_last( $atts, $content = null ) {
   return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fifth_last', 'stf_three_fifth_last');

function stf_four_fifth( $atts, $content = null ) {
   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'stf_four_fifth');

function stf_four_fifth_last( $atts, $content = null ) {
   return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('four_fifth_last', 'stf_four_fifth_last');

function stf_one_sixth( $atts, $content = null ) {
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'stf_one_sixth');

function stf_one_sixth_last( $atts, $content = null ) {
   return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_sixth_last', 'stf_one_sixth_last');

function stf_five_sixth( $atts, $content = null ) {
   return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'stf_five_sixth');

function stf_five_sixth_last( $atts, $content = null ) {
   return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('five_sixth_last', 'stf_five_sixth_last');
?>