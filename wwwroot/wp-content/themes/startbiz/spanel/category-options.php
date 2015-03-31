<?php
/**
* Category Options
*
* @file 		 category-options.php
* @package	 StartPress Company
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://carrielis.com
*/

add_action ( 'edit_category_form_fields', 'stf_category_fields');
function stf_category_fields( $tag ) {    //檢查現有文章目錄 ID
    $t_id = $tag->term_id;
	$cat_option = get_option('stf_cat_'.$t_id);

	wp_print_scripts('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');

	$sidebars = stf_get_option( 'sidebars' ) ;
	$new_sidebars = array(''=> '預設');
	
	if($sidebars){
		foreach ($sidebars as $sidebar) {
		$new_sidebars[$sidebar] = $sidebar;
		}
	}
		
	$custom_slider = new WP_Query( array( 'post_type' => 'stf_slider', 'posts_per_page' => -1, 'no_found_rows' => 1  ) );
	$cat_slider = array();
	$cat_slider[''] = '停用';
	$cat_slider['recent'] = '最新文章';
	$cat_slider['random'] = '隨機文章';

	while ( $custom_slider->have_posts() ) {
		$custom_slider->the_post();
		$cat_slider[get_the_ID()] = get_the_title();
	}
?>
<tr class="form-field">
	<td colspan="2">
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				jQuery('.on-of').checkbox({empty:'<?php echo get_template_directory_uri(); ?>/spanel/images/empty.png'});
			});
			
			//To Fix WPML Bug
			jQuery( window ).load(function($) {
				var logo_settings = jQuery('input[name=logo_setting_save]').val();
					jQuery("#logo_setting-item input").each(function(){	
					if( jQuery(this).val() == logo_settings ) jQuery(this).attr('checked','checked');
			});
		 });
		</script>
		<div class="stf-spanel-item">
			<h3><?php echo theme_name ?> - 分類目錄設定 </h3>
			<?php
				stf_cat_options(				
					array(	"name" => '自訂側邊欄',
							"id" => "cat_sidebar",
							"type" => "select",
							"cat" => $t_id ,
							"options" => $new_sidebars ));
							
				stf_cat_options(				
					array(	"name" => '自訂幻燈片',
							"id" => "cat_slider",
							"type" => "select",
							"cat" => $t_id ,
							"options" => $cat_slider )); 	
			?>
		</div>	
		
		<div class="stf-spanel-item">
			<h3><?php echo theme_name ?> - Logo 設定 </h3>
			<?php
				stf_cat_options(
					array(	"name" => " logo",
							"id" => "cat_custom_logo",
							"cat" => $t_id ,
							"type" => "checkbox"));
							
				stf_cat_options(
					array( 	"name" => "Logo 設定",
							"id" => "logo_setting",
							"type" => "radio",
							"cat" => $t_id ,
							"options" => array( "logo"=>"自訂圖片 logo" ,
												"title"=>"顯示分類目錄標題" )));
				?>
				<input type="hidden" name="logo_setting_save" value="<?php if( !empty($cat_option[ 'logo_setting' ]) )  echo $cat_option['logo_setting'];?>" />
				<?php
				stf_cat_options(
					array(	"name" => "自訂 logo 圖片",
							"id" => "logo",
							"cat" => $t_id ,
							"type" => "upload"));
					
				stf_cat_options(
					array(	"name" => "Logo 上方邊距",
							"id" => "logo_margin",
							"type" => "slider",
							"cat" => $t_id ,
							"unit" => "px",
							"max" => 100,
							"min" => 0 ));
			?>
		</div>
		
		<div class="stf-spanel-item">
			<h3><?php echo theme_name ?> - 分類目錄樣式設定（CSS） </h3>
			<?php
				stf_cat_options(				
					array(	"name" => "主要顏色",
							"id" => "cat_color",
							"cat" => $t_id ,
							"type" => "color" ));
								
				stf_cat_options(
					array(	"name" => "背景",
							"id" => "cat_background",
							"cat" => $t_id ,
							"type" => "background"));
								
				stf_cat_options(
					array(	"name" => "全螢幕背景",
							"id" => "cat_background_full",
							"cat" => $t_id ,
							"type" => "checkbox"));
				?>
		</div>
				
	</td>
</tr>
<?php
}


// 儲存額外目錄的額外欄位 hook
add_action ( 'edited_category', 'stf_save_extra_category_fileds');
   // 儲存額外目錄的額外欄位回叫函數（callback function）
function stf_save_extra_category_fileds( $term_id ) {
	$t_id = $term_id;
	update_option( "stf_cat_$t_id", $_POST["stf_cat"] );
}


function stf_cat_options($value){
	global $options_fonts;
?>
	<div class="option-item" id="<?php echo $value['id'] ?>-item">
		<span class="label"><?php  echo $value['name']; ?></span>
	<?php
	$cat_option = get_option('stf_cat_'.$value['cat']);
	
	switch ( $value['type'] ) {

		case 'checkbox':
			if( !empty($cat_option[$value['id']]) ){$checked = "checked=\"checked\"";  } else{$checked = "";} ?>
				<input class="on-of" type="checkbox" name="stf_cat[<?php echo $value['id']; ?>]" id="<?php echo $value['id'] ?>" value="true" <?php echo $checked; ?> />			
		<?php	
		break;
		
		case 'radio': 
		?>
			<div style="float:left; width: 295px;">
				<?php foreach ($value['options'] as $key => $option) {?>
				<label style="display:block; margin-bottom:8px;"><input  <?php if( !empty($cat_option[$value['id']]) ) checked($cat_option[$value['id']] , $key); ?> id="<?php echo $value['id'] ?>" name="stf_cat[<?php echo $value['id']; ?>]" type="radio" value="<?php echo $key ?>"> <?php echo $option; ?></label>
				<?php } ?>
			</div>
		<?php
		break;
		
		case 'select':
		?>
			<select name="stf_cat[<?php echo $value['id']; ?>]" id="<?php echo $value['id']; ?>">
				<?php foreach ($value['options'] as $key => $option) { ?>
				<option value="<?php echo $key ?>" <?php if ( !empty( $cat_option[$value['id']] ) && ( $cat_option[$value['id']] == $key) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
		<?php
		break;
		
		case 'upload':
		?>
				<input id="<?php echo $value['id']; ?>" class="img-path" type="text" size="56" style="direction:ltr; text-laign:left" name="stf_cat[<?php echo $value['id']; ?>]" value="<?php if( !empty($cat_option[$value['id']]) ) echo $cat_option[$value['id']]; ?>" />
				<input id="upload_<?php echo $value['id']; ?>_button" type="button" class="small_button" value="上傳" />
					
				<div id="<?php echo $value['id']; ?>-preview" class="img-preview" <?php if( empty( $cat_option[$value['id']] ) ) echo 'style="display:none;"' ?>>
					<img src="<?php if( !empty( $cat_option[$value['id']] ) ) echo $cat_option[$value['id']] ; else echo get_template_directory_uri().'/spanel/images/spacer.png'; ?>" alt="" />
					<a class="del-img" title="刪除"></a>
				</div>
		<?php
		break;

		case 'slider':
		?>
				<div id="<?php echo $value['id']; ?>-slider"></div>
				<input type="text" id="<?php echo $value['id']; ?>" value="<?php if( !empty( $cat_option[$value['id']]) ) echo $cat_option[$value['id']]; ?>" name="stf_cat[<?php echo $value['id']; ?>]" style="width:50px;" /> <?php echo $value['unit']; ?>
				<script>
				  jQuery(document).ready(function() {
					jQuery("#<?php echo $value['id']; ?>-slider").slider({
						range: "min",
						min: <?php echo $value['min']; ?>,
						max: <?php echo $value['max']; ?>,
						value: <?php if( $cat_option[$value['id']] ) echo $cat_option[$value['id']]; else echo 0; ?>,

						slide: function(event, ui) {
						jQuery('#<?php echo $value['id']; ?>').attr('value', ui.value );
						}
					});
				  });
				</script>
		<?php
		break;
		
		
		case 'background':
	?>
				<input id="<?php echo $value['id']; ?>-img" class="img-path" type="text" size="56" style="direction:ltr; text-align:left" name="stf_cat[<?php echo $value['id']; ?>][img]" value="<?php if( !empty($cat_option[$value['id']]['img']) ) echo $cat_option[$value['id']]['img']; ?>" />
				<input id="upload_<?php echo $value['id']; ?>_button" type="button" class="small_button" value="上傳" />
					
				<div style="margin-top:15px; clear:both">
					<div id="<?php echo $value['id']; ?>colorSelector" class="color-pic"><div style="background-color:<?php if( !empty($cat_option[$value['id']]['color']) ) echo $cat_option[$value['id']]['color'] ; ?>"></div></div>
					<input style="width:80px; margin-right:5px;"  name="stf_cat[<?php echo $value['id']; ?>][color]" id="<?php  echo $value['id']; ?>color" type="text" value="<?php if( !empty($cat_option[$value['id']]['color']) ) echo $cat_option[$value['id']]['color'] ; ?>" />
					
					<select name="stf_cat[<?php echo $value['id']; ?>][repeat]" id="<?php echo $value['id']; ?>[repeat]" style="width:96px;">
						<option value="" <?php if ( empty ($cat_option[$value['id']]['repeat']) ) { echo ' selected="selected"' ; } ?>></option>
						<option value="repeat" <?php if ( !empty($cat_option[$value['id']]['repeat']) && $cat_option[$value['id']]['repeat']  == 'repeat' ) { echo ' selected="selected"' ; } ?>>重複</option>
						<option value="no-repeat" <?php if ( !empty($cat_option[$value['id']]['repeat']) && $cat_option[$value['id']]['repeat']  == 'no-repeat') { echo ' selected="selected"' ; } ?>>不重複</option>
						<option value="repeat-x" <?php if ( !empty($cat_option[$value['id']]['repeat']) && $cat_option[$value['id']]['repeat'] == 'repeat-x') { echo ' selected="selected"' ; } ?>>水平重複</option>
						<option value="repeat-y" <?php if ( !empty($cat_option[$value['id']]['repeat']) && $cat_option[$value['id']]['repeat'] == 'repeat-y') { echo ' selected="selected"' ; } ?>>垂直重複</option>
					</select>

					<select name="stf_cat[<?php echo $value['id']; ?>][attachment]" id="<?php echo $value['id']; ?>[attachment]" style="width:96px;">
						<option value="" <?php if ( empty( $cat_option[$value['id']]['attachment']) ) { echo ' selected="selected"' ; } ?>></option>
						<option value="fixed" <?php if ( !empty($cat_option[$value['id']]['attachment']) && $cat_option[$value['id']]['attachment']  == 'fixed' ) { echo ' selected="selected"' ; } ?>>固定</option>
						<option value="scroll" <?php if ( !empty($cat_option[$value['id']]['attachment']) && $cat_option[$value['id']]['attachment']  == 'scroll') { echo ' selected="selected"' ; } ?>>捲動</option>
					</select>
					
					<select name="stf_cat[<?php echo $value['id']; ?>][hor]" id="<?php echo $value['id']; ?>[hor]" style="width:96px;">
						<option value="" <?php if ( empty($cat_option[$value['id']]['hor']) ) { echo ' selected="selected"' ; } ?>></option>
						<option value="left" <?php if ( !empty($cat_option[$value['id']]['hor']) && $cat_option[$value['id']]['hor']  == 'left' ) { echo ' selected="selected"' ; } ?>>靠左</option>
						<option value="right" <?php if ( !empty($cat_option[$value['id']]['hor']) && $cat_option[$value['id']]['hor']  == 'right') { echo ' selected="selected"' ; } ?>>靠右</option>
						<option value="center" <?php if ( !empty($cat_option[$value['id']]['hor']) && $cat_option[$value['id']]['hor'] == 'center') { echo ' selected="selected"' ; } ?>>置中</option>
					</select>
					
					<select name="stf_cat[<?php echo $value['id']; ?>][ver]" id="<?php echo $value['id']; ?>[ver]" style="width:100px;">
						<option value="" <?php if ( empty($cat_option[$value['id']]['ver'] )) { echo ' selected="selected"' ; } ?>></option>
						<option value="top" <?php if ( !empty($cat_option[$value['id']]['ver']) &&  $cat_option[$value['id']]['ver']  == 'top' ) { echo ' selected="selected"' ; } ?>>靠上</option>
						<option value="center" <?php if ( !empty($cat_option[$value['id']]['ver']) && $cat_option[$value['id']]['ver'] == 'center') { echo ' selected="selected"' ; } ?>>置中</option>
						<option value="bottom" <?php if ( !empty($cat_option[$value['id']]['ver']) && $cat_option[$value['id']]['ver']  == 'bottom') { echo ' selected="selected"' ; } ?>>靠下</option>

					</select>
				</div>
				<div id="<?php echo $value['id']; ?>-preview" class="img-preview" <?php if( empty($cat_option[$value['id']]['img'])  ) echo 'style="display:none;"' ?>>
					<img src="<?php if( !empty( $cat_option[$value['id']]['img']) ) echo $cat_option[$value['id']]['img'] ; else echo get_template_directory_uri().'/spanel/images/spacer.png'; ?>" alt="" />
					<a class="del-img" title="刪除"></a>
				</div>
					
				<script>
				jQuery('#<?php echo $value['id']; ?>colorSelector').ColorPicker({
					color: '<?php if( !empty($cat_option[$value['id']]['color']) ) echo $cat_option[$value['id']]['color'] ; ?>',
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
			<div id="<?php echo $value['id']; ?>colorSelector" class="color-pic"><div style="background-color:<?php if( !empty( $cat_option[$value['id']] ) ) echo $cat_option[$value['id']] ; ?>"></div></div>
			<input style="width:80px; margin-right:5px;"  name="stf_cat[<?php echo $value['id']; ?>]" id="<?php echo $value['id']; ?>" type="text" value="<?php if( !empty( $cat_option[$value['id']] ) ) echo $cat_option[$value['id']]; ?>" />
							
			<script>
				jQuery('#<?php echo $value['id']; ?>colorSelector').ColorPicker({
					color: '<?php if( !empty( $cat_option[$value['id']] ) ) echo $cat_option[$value['id']] ; ?>',
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
		case 'short-text': ?>
			<input style="width:50px" name="stf_cat[<?php echo $value['id']; ?>]" id="<?php  echo $value['id']; ?>" type="text" value="<?php if( !empty( $cat_option[$value['id']]) ) echo $cat_option[$value['id']]; ?>" />
		<?php 
		break;		
}
		if( !empty( $value['extra_text'] ) ) { ?><span class="extra-text"><?php echo $value['extra_text'] ?></span><?php }
?>
</div>
			
<?php
}
?>