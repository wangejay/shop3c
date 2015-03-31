<?php 
/**
* Custom Slider
*
* @file 		 custom-slider.php
* @package	 StartPress Company
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://carrielis.com
*/
add_action('init', 'stf_slider_register');
 
function stf_slider_register() {
 
	$labels = array(
		'name' => '自訂幻燈片',
		'singular_name' => '幻燈片',
		'add_new_item' => '新增幻燈片',
	);
 
	$args = array(
		'labels' => $labels,
		'public' => false,
		'show_ui' => true,
		'menu_icon' => get_template_directory_uri().'/spanel/images/slideshow.png',
		'can_export' => true,
		'exclude_from_search' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 6,
		'rewrite' => array('slug' => 'slider'),
		'supports' => array('title')
	  ); 
 	   
	register_post_type( 'stf_slider' , $args );
}


add_action("admin_init", "stf_slider_init");
 
function stf_slider_init(){
  add_meta_box("stf_slider_slides", "幻燈片", "stf_slider_slides", "stf_slider", "normal", "high");
}
 

function stf_slider_slides(){
	global $post;
	$custom = get_post_custom($post->ID);
	$slider = unserialize( $custom["custom_slider"][0] );
  
	wp_enqueue_script( 'stf-admin-slider' );  
	wp_print_scripts('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
		
  ?>
  <script>
  jQuery(document).ready(function() {
  
	jQuery(function() {
		jQuery( "#stf-slider-items" ).sortable({placeholder: "ui-state-highlight"});
	});

	function custom_slider_uploader(field) {
		var button = "#upload_"+field;
		jQuery(button).click(function() {
			window.restore_send_to_editor = window.send_to_editor;
			tb_show('', 'media-upload.php?referer=stf-settings&amp;type=image&amp;TB_iframe=true&amp;post_id=0');
			stf_set_slider_img(field);
			return false;
		});

	}
	function stf_set_slider_img(field) {
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			
			if(typeof imgurl == 'undefined') 
				imgurl = jQuery(html).attr('src');
			
			
			classes = jQuery('img', html).attr('class');
			if(typeof classes != 'undefined')
				id = classes.replace(/(.*?)wp-image-/, '');
			
			if(typeof classes == 'undefined'){ 
				classes = jQuery(html).attr('class');
				if(typeof classes != 'undefined')
					id = classes.replace(/(.*?)wp-image-/, '');
			}
				
			jQuery('#stf-slider-items').append('<li id="listItem_'+ nextCell +'" class="ui-state-default"><div class="widget-content option-item"><div class="slider-img"><img src="'+imgurl+'" alt=""></div><label for="custom_slider['+ nextCell +'][title]"><span>幻燈片標題 :</span><input id="custom_slider['+ nextCell +'][title]" name="custom_slider['+ nextCell +'][title]" value="" type="text" /></label><label for="custom_slider['+ nextCell +'][link]"><span>幻燈片連結網址 :</span><input id="custom_slider['+ nextCell +'][link]" name="custom_slider['+ nextCell +'][link]" value="" type="text" /></label><label for="custom_slider['+ nextCell +'][caption]"><span style="float:left" >幻燈片說明文字 :</span><textarea name="custom_slider['+ nextCell +'][caption]" id="custom_slider['+ nextCell +'][caption]"></textarea></label><input id="custom_slider['+ nextCell +'][id]" name="custom_slider['+ nextCell +'][id]" value="'+id+'" type="hidden" /><a class="del-cat"></a></div></li>');
			nextCell ++ ;
			tb_remove();
			window.send_to_editor = window.restore_send_to_editor;
		}
	};
	
	custom_slider_uploader("add_slide");
	
});

  </script>
  
 <input id="upload_add_slide" type="button" class="spanel-save" value="新增幻燈片">

	<ul id="stf-slider-items">
	<?php
	if( $slider ){
	$i=0;
	foreach( $slider as $slide ):
		$i++; ?>
		<li id="listItem_<?php echo $i ?>"  class="ui-state-default">
			<div class="widget-content option-item">
				<div class="slider-img"><?php echo wp_get_attachment_image( $slide['id'] , 'thumbnail' );  ?></div>
				<label for="custom_slider[<?php echo $i ?>][title]"><span>幻燈片標題 :</span><input id="custom_slider[<?php echo $i ?>][title]" name="custom_slider[<?php echo $i ?>][title]" value="<?php  echo stripslashes( $slide['title'] )  ?>" type="text" /></label>
				<label for="custom_slider[<?php echo $i ?>][link]"><span>幻燈片連結網址 :</span><input id="custom_slider[<?php echo $i ?>][link]" name="custom_slider[<?php echo $i ?>][link]" value="<?php  echo stripslashes( $slide['link'] )  ?>" type="text" /></label>
				<label for="custom_slider[<?php echo $i ?>][caption]"><span style="float:left" >幻燈片說明文字 :</span><textarea name="custom_slider[<?php echo $i ?>][caption]" id="custom_slider[<?php echo $i ?>][caption]"><?php echo stripslashes($slide['caption']) ; ?></textarea></label>
				<input id="custom_slider[<?php echo $i ?>][id]" name="custom_slider[<?php echo $i ?>][id]" value="<?php  echo $slide['id']  ?>" type="hidden" />
				<a class="del-cat"></a>
			</div>
		</li>
	<?php endforeach; 
	}else{
		echo ' <p> 請使用上面的按鈕來新增幻燈片 !</p>';
	}?>
	</ul>
	<script> var nextCell = <?php echo $i+1 ?> ;</script>

  <?php
}
 


add_action('save_post', 'save_slide');
function save_slide(){
  global $post;
  
  	if( !empty( $_POST['custom_slider'] ) && $_POST['custom_slider'] != "" ){
		update_post_meta($post->ID, 'custom_slider' , $_POST['custom_slider']);		
	}
	else{ 
		if( isset($post->ID) )
			delete_post_meta($post->ID, 'custom_slider' );
	}
}


add_filter("manage_edit-stf_slider_columns", "stf_slider_edit_columns");
function stf_slider_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "標題",
	"slides" => "幻燈片數量",
    "date" => "日期",
  );
 
  return $columns;
}


add_action("manage_stf_slider_posts_custom_column",  "stf_slider_custom_columns");
function stf_slider_custom_columns($column){
	global $post;
	
	switch ($column) {
		case "slides":
			$custom_slider_args = array( 'post_type' => 'stf_slider', 'p' => $post->ID, 'no_found_rows' => 1  );
			$custom_slider = new WP_Query( $custom_slider_args );
			while ( $custom_slider->have_posts() ) {
				$number =0;
				$custom_slider->the_post();
				$custom = get_post_custom($post->ID);
				if( !empty($custom["custom_slider"][0])){
					$slider = unserialize( $custom["custom_slider"][0] );
					echo $number = count($slider);
				}
				else echo 0;
			}
		break;
	}
}

?>