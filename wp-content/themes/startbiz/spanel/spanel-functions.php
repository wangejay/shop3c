<?php
/**
* S-Panel Functions
*
* @file 		 spanel-functions.php
* @package	 StartPress Business
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://startpress.cc
*/

/*-----------------------------------------------------------------------------------*/
# 註冊主要 Scripts 和 CSS 樣式
/*-----------------------------------------------------------------------------------*/
function stf_admin_register() {
    global $pagenow;
	
	wp_register_script( 'stf-admin-slider', get_template_directory_uri() . '/spanel/js/jquery.ui.slider.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-mouse', 'jquery-ui-sortable' ) , false , false );
	wp_register_script( 'stf-admin-main', get_template_directory_uri() . '/spanel/js/stf.js', array( 'jquery' ) , false , false ); 
	
	wp_register_script( 'stf-admin-colorpicker', get_template_directory_uri() . '/spanel/js/colorpicker.js', array( 'jquery' ) , false , false );  
	
	wp_register_style( 'stf-style', get_template_directory_uri().'/spanel/style.css', array(), '20140702', 'all' ); 
	
	if ( (isset( $_GET['page'] ) && $_GET['page'] == 'spanel') || (  $pagenow == 'post-new.php' ) || (  $pagenow == 'post.php' )|| (  $pagenow == 'edit-tags.php' ) ) {
		wp_enqueue_script( 'stf-admin-colorpicker');  
		wp_enqueue_script( 'stf-admin-slider' );  
	}
	wp_enqueue_script( 'stf-admin-main' );
	wp_enqueue_style( 'stf-style' );
	//wp_enqueue_style( 'stf-fonts' );
}
add_action( 'admin_enqueue_scripts', 'stf_admin_register' ); 


/*-----------------------------------------------------------------------------------*/
# 變更插入至文章的文字
/*-----------------------------------------------------------------------------------*/
function stf_options_setup() {
    global $pagenow;  
	
    if ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow )
        add_filter( 'gettext', 'stf_replace_thickbox_text'  , 1, 3 ); 
} 
add_action( 'admin_init', 'stf_options_setup' ); 
  
function stf_replace_thickbox_text($translated_text, $text, $domain) { 
    if ('插入至文章' == $text) { 
	
        $referer = strpos( wp_get_referer(), 'stf-settings' );
        if ( $referer != '' )
            return '使用此圖片'; 
    }  
    return $translated_text;  
} 


/*-----------------------------------------------------------------------------------*/
# 清除選項前先將資料儲存於資料庫中
/*-----------------------------------------------------------------------------------*/
function stf_clean_options(&$value) {
  $value = htmlspecialchars(stripslashes($value));
}


/*-----------------------------------------------------------------------------------*/
# 選項陣列
/*-----------------------------------------------------------------------------------*/
$array_options = 
	array(
		"stf_home_cats",
		"stf_options"
	);
	
	
/*-----------------------------------------------------------------------------------*/
# 儲存主題設定
/*-----------------------------------------------------------------------------------*/
function stf_save_settings ( $data , $refresh = 0 ) {
	global $array_options ;
		
	foreach( $array_options as $option ){
		if( isset( $data[$option] )){
			array_walk_recursive( $data[$option] , 'stf_clean_options');
			update_option( $option ,  $data[$option] );
			
			if(  function_exists('icl_register_string') && $option == 'stf_home_cats'){
				foreach( $data[$option] as $item ){
					if( !empty($item['boxid']) )
						icl_register_string( theme_name , $item['boxid'], $item['title'] );
						
					if( !empty($item['type']) && $item['type'] == 'ads' && !empty($item['boxid']) )
						icl_register_string( theme_name , $item['boxid'], $item['text'] );
				}
			}
		}
		elseif( !isset( $data[$option] ) && $option != 'stf_options' ){
			delete_option($option);
		}		
	}
	delete_transient('list_tweets');
	delete_transient('twitter_count');
	delete_option('stf_TwitterToken');

	if( $refresh == 2 )  die('2');
	elseif( $refresh == 1 )	die('1');
}


/*-----------------------------------------------------------------------------------*/
# 儲存選項
/*-----------------------------------------------------------------------------------*/
add_action('wp_ajax_test_theme_data_save', 'stf_save_ajax');
function stf_save_ajax() {
	
	check_ajax_referer('test-theme-data', 'security');
	$data = $_POST;
	$refresh = 1;

	if( !empty( $data['stf_import'] ) ){
		$refresh = 2;
		$data = unserialize(base64_decode( $data['stf_import'] ));
	}
	
	stf_save_settings ($data , $refresh );
	
}


/*-----------------------------------------------------------------------------------*/
# 新增後台主題設定選項頁面
/*-----------------------------------------------------------------------------------*/
function stf_add_admin() {

	$current_page = isset( $_REQUEST['page'] ) ? $_REQUEST['page'] : '';
	
	$icon = get_template_directory_uri().'/spanel/images/general.png';
	add_menu_page(theme_name.' 主題設定', theme_name.' 主題設定' ,'switch_themes', 'spanel' , 'spanel_options', $icon );
	$theme_page = add_submenu_page('spanel',theme_name.' 主題設定', theme_name.'  主題設定','switch_themes', 'spanel' , 'spanel_options');
	
	
	add_action( 'admin_head-'. $theme_page, 'stf_admin_head' );
	function stf_admin_head(){
	
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
		
			jQuery('.on-of').checkbox({empty:'<?php echo get_template_directory_uri(); ?>/spanel/images/empty.png'});
			
			jQuery('form#stf_form').submit(function() {
				
				// 停用空白選項
					jQuery('form#stf_form input, form#stf_form textarea, form#stf_form select').each(function() {
					if (!jQuery(this).val()) jQuery(this).attr("disabled", true );
					});
					
					var data = jQuery(this).serialize();
					
				// 啟用空白選項
					jQuery('form#stf_form input:disabled, form#stf_form textarea:disabled, form#stf_form select:disabled').attr("disabled", false );
					
					jQuery.post(ajaxurl, data, function(response) {
				  if(response == 1) {
					  jQuery('#save-alert').addClass('save-done');
					  t = setTimeout('fade_message()', 1000);
				  }
				else if( response == 2 ){
					location.reload();
				}
				else {
					 jQuery('#save-alert').addClass('save-error');
					  t = setTimeout('fade_message()', 1000);
				  }
			  });
			  return false;
			});
			
		});
		
		function fade_message() {
			jQuery('#save-alert').fadeOut(function() {
				jQuery('#save-alert').removeClass('save-done');
			});
			clearTimeout(t);
		}
				
		jQuery(function() {
			jQuery( "#cat_sortable" ).sortable({placeholder: "ui-state-highlight"});
			jQuery( "#customList" ).sortable({placeholder: "ui-state-highlight"});
			jQuery( "#tabs_cats" ).sortable({placeholder: "ui-state-highlight"});
		});
	</script>
	<?php
		wp_print_scripts('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		do_action('admin_print_styles');
	}
	if( isset( $_REQUEST['action'] ) ){
		if( 'reset' == $_REQUEST['action']  && $current_page == 'spanel' && check_admin_referer('reset-action-code' , 'resetnonce') ) {
			global $default_data;
			stf_save_settings( $default_data );
			header("Location: admin.php?page=spanel&reset=true");
			die;
		}
	}
}


/*-----------------------------------------------------------------------------------*/
# 新增主題選項
/*-----------------------------------------------------------------------------------*/
function stf_options($value){
	global $options;
?>
	<div class="option-item" id="<?php echo $value['id'] ?>-item">
		<span class="label"><?php  echo $value['name']; ?></span>
	<?php
	switch ( $value['type'] ) {
	
		case 'text': ?>
			<input  name="stf_options[<?php echo $value['id']; ?>]" id="<?php  echo $value['id']; ?>" type="text" value="<?php echo stf_get_option( $value['id'] ); ?>" />
			<?php
				if( $value['id']=="slider_tag" || $value['id']=="breaking_tag"){
				$tags = get_tags('orderby=count&order=desc&number=50'); ?>
				<a style="cursor:pointer" title="選擇最常用的標籤" onclick="toggleVisibility('<?php echo $value['id']; ?>_tags');"><img src="<?php echo get_template_directory_uri(); ?>/spanel/images/expand.png" alt="" /></a>
				<span class="tags-list" id="<?php echo $value['id']; ?>_tags">
					<?php foreach ($tags as $tag){?>
						<a style="cursor:pointer" onclick="if(<?php echo $value['id'] ?>.value != ''){ var sep = ' , '}else{var sep = ''} <?php echo $value['id'] ?>.value=<?php echo $value['id'] ?>.value+sep+(this.rel);" rel="<?php echo $tag->name ?>"><?php echo $tag->name ?></a>
					<?php } ?>
				</span>
			<?php } ?>		
		<?php 
		break;

		case 'arrayText':  $currentValue = stf_get_option( $value['id'] );?>
			<input  name="stf_options[<?php echo $value['id']; ?>][<?php echo $value['key']; ?>]" id="<?php  echo $value['id']; ?>[<?php echo $value['key']; ?>]" type="text" value="<?php echo $currentValue[$value['key']] ?>" />	
		<?php 
		break;

		case 'short-text': ?>
			<input style="width:50px" name="stf_options[<?php echo $value['id']; ?>]" id="<?php  echo $value['id']; ?>" type="text" value="<?php echo stf_get_option( $value['id'] ); ?>" />
		<?php 
		break;
		
		case 'checkbox':
			if(stf_get_option($value['id'])){$checked = "checked=\"checked\"";  } else{$checked = "";} ?>
				<input class="on-of" type="checkbox" name="stf_options[<?php echo $value['id'] ?>]" id="<?php echo $value['id'] ?>" value="true" <?php echo $checked; ?> />			
		<?php	
		break;


		case 'radio':
		?>
			<div style="float:left; width: 295px;">
				<?php foreach ($value['options'] as $key => $option) { ?>
				<label style="display:block; margin-bottom:8px;"><input name="stf_options[<?php echo $value['id']; ?>]" id="<?php echo $value['id']; ?>" type="radio" value="<?php echo $key ?>" <?php if ( stf_get_option( $value['id'] ) == $key) { echo ' checked="checked"' ; } ?>> <?php echo $option; ?></label>
				<?php } ?>
			</div>
		<?php
		break;
		
		case 'select':
		?>
			<select name="stf_options[<?php echo $value['id']; ?>]" id="<?php echo $value['id']; ?>">
				<?php foreach ($value['options'] as $key => $option) { ?>
				<option value="<?php echo $key ?>" <?php if ( stf_get_option( $value['id'] ) == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
		<?php
		break;
		
		case 'textarea':
		?>
			<textarea style="direction:ltr; text-align:left" name="stf_options[<?php echo $value['id']; ?>]" id="<?php echo $value['id']; ?>" type="textarea" cols="100%" rows="3" tabindex="4"><?php echo stf_get_option( $value['id'] );  ?></textarea>
		<?php
		break;

		case 'upload':
		?>
				<input id="<?php echo $value['id']; ?>" class="img-path" type="text" size="56" style="direction:ltr; text-laign:left" name="stf_options[<?php echo $value['id']; ?>]" value="<?php echo stf_get_option($value['id']); ?>" />
				<input id="upload_<?php echo $value['id']; ?>_button" type="button" class="small_button" value="上傳" />
				<?php if( isset( $value['extra_text'] ) ) : ?><span class="extra-text"><?php echo $value['extra_text'] ?></span><?php endif; ?>

				<div id="<?php echo $value['id']; ?>-preview" class="img-preview" <?php if(!stf_get_option( $value['id'] )) echo 'style="display:none;"' ?>>
					<img src="<?php if(stf_get_option( $value['id'] )) echo stf_get_option( $value['id'] ); else echo get_template_directory_uri().'/spanel/images/spacer.png'; ?>" alt="" />
					<a class="del-img" title="刪除"></a>
				</div>
		<?php
		break;

		case 'slider':
		?>
				<div id="<?php echo $value['id']; ?>-slider"></div>
				<input type="text" id="<?php echo $value['id']; ?>" value="<?php echo stf_get_option($value['id']); ?>" name="stf_options[<?php echo $value['id']; ?>]" style="width:50px;" /> <?php echo $value['unit']; ?>
				<script>
				  jQuery(document).ready(function() {
					jQuery("#<?php echo $value['id']; ?>-slider").slider({
						range: "min",
						min: <?php echo $value['min']; ?>,
						max: <?php echo $value['max']; ?>,
						value: <?php if( stf_get_option($value['id']) ) echo stf_get_option($value['id']); else echo 0; ?>,

						slide: function(event, ui) {
						jQuery('#<?php echo $value['id']; ?>').attr('value', ui.value );
						}
					});
				  });
				</script>
		<?php
		break;
		
		
		case 'background':
			$current_value = stf_get_option($value['id']);
		?>
				<input id="<?php echo $value['id']; ?>-img" class="img-path" type="text" size="56" style="direction:ltr; text-align:left" name="stf_options[<?php echo $value['id']; ?>][img]" value="<?php echo $current_value['img']; ?>" />
				<input id="upload_<?php echo $value['id']; ?>_button" type="button" class="small_button" value="上傳" />
					
				<div style="margin-top:15px; clear:both">
					<div id="<?php echo $value['id']; ?>colorSelector" class="color-pic"><div style="background-color:<?php echo $current_value['color'] ; ?>"></div></div>
					<input style="width:80px; margin-right:5px;"  name="stf_options[<?php echo $value['id']; ?>][color]" id="<?php echo $value['id']; ?>color" type="text" value="<?php echo $current_value['color'] ; ?>" />
					
					<select name="stf_options[<?php echo $value['id']; ?>][repeat]" id="<?php echo $value['id']; ?>[repeat]" style="width:96px;">
						<option value="" <?php if ( !$current_value['repeat'] ) { echo ' selected="selected"' ; } ?>></option>
						<option value="repeat" <?php if ( $current_value['repeat']  == 'repeat' ) { echo ' selected="selected"' ; } ?>>重複</option>
						<option value="no-repeat" <?php if ( $current_value['repeat']  == 'no-repeat') { echo ' selected="selected"' ; } ?>>不重複</option>
						<option value="repeat-x" <?php if ( $current_value['repeat'] == 'repeat-x') { echo ' selected="selected"' ; } ?>>水平重複</option>
						<option value="repeat-y" <?php if ( $current_value['repeat'] == 'repeat-y') { echo ' selected="selected"' ; } ?>>垂直重複</option>
					</select>

					<select name="stf_options[<?php echo $value['id']; ?>][attachment]" id="<?php echo $value['id']; ?>[attachment]" style="width:96px;">
						<option value="" <?php if ( !$current_value['attachment'] ) { echo ' selected="selected"' ; } ?>></option>
						<option value="fixed" <?php if ( $current_value['attachment']  == 'fixed' ) { echo ' selected="selected"' ; } ?>>固定</option>
						<option value="scroll" <?php if ( $current_value['attachment']  == 'scroll') { echo ' selected="selected"' ; } ?>>捲動</option>
					</select>
					
					<select name="stf_options[<?php echo $value['id']; ?>][hor]" id="<?php echo $value['id']; ?>[hor]" style="width:96px;">
						<option value="" <?php if ( !$current_value['hor'] ) { echo ' selected="selected"' ; } ?>></option>
						<option value="left" <?php if ( $current_value['hor']  == 'left' ) { echo ' selected="selected"' ; } ?>>靠左</option>
						<option value="right" <?php if ( $current_value['hor']  == 'right') { echo ' selected="selected"' ; } ?>>靠右</option>
						<option value="center" <?php if ( $current_value['hor'] == 'center') { echo ' selected="selected"' ; } ?>>置中</option>
					</select>
					
					<select name="stf_options[<?php echo $value['id']; ?>][ver]" id="<?php echo $value['id']; ?>[ver]" style="width:100px;">
						<option value="" <?php if ( !$current_value['ver'] ) { echo ' selected="selected"' ; } ?>></option>
						<option value="top" <?php if ( $current_value['ver']  == 'top' ) { echo ' selected="selected"' ; } ?>>靠上</option>
						<option value="center" <?php if ( $current_value['ver'] == 'center') { echo ' selected="selected"' ; } ?>>置中</option>
						<option value="bottom" <?php if ( $current_value['ver']  == 'bottom') { echo ' selected="selected"' ; } ?>>靠下</option>

					</select>
				</div>
				<div id="<?php echo $value['id']; ?>-preview" class="img-preview" <?php if( !$current_value['img']  ) echo 'style="display:none;"' ?>>
					<img src="<?php if( $current_value['img'] ) echo $current_value['img'] ; else echo get_template_directory_uri().'/spanel/images/spacer.png'; ?>" alt="" />
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
			<div id="<?php echo $value['id']; ?>colorSelector" class="color-pic"><div style="background-color:<?php echo stf_get_option($value['id']) ; ?>"></div></div>
			<input style="width:80px; margin-right:5px;"  name="stf_options[<?php echo $value['id']; ?>]" id="<?php echo $value['id']; ?>" type="text" value="<?php echo stf_get_option($value['id']) ; ?>" />
							
			<script>
				jQuery('#<?php echo $value['id']; ?>colorSelector').ColorPicker({
					color: '<?php echo stf_get_option($value['id']) ; ?>',
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
	
	}
	
	?>
	<?php if( isset( $value['extra_text'] ) && $value['type'] != 'upload' ) : ?><span class="extra-text"><?php echo $value['extra_text'] ?></span><?php endif; ?>
	<?php if( isset( $value['help'] ) ) : ?>
		<a class="stf-help tooltip"  title="<?php echo $value['help'] ?>"></a>
		<?php endif; ?>
	</div>
			
<?php
}
add_action('admin_menu', 'stf_add_admin'); 

?>