<?php

if( is_admin() ){
	if( get_option('stf_active') ){
		$old_options  = array(
			"stf_logo_setting",
			"stf_logo",
			"stf_logo_margin",
			"stf_favicon",
			"stf_gravatar",
			"stf_timthumb",
			"stf_top_right",
			"stf_top_date",
			"stf_todaydate_format",
			"stf_random_article",
			"stf_breadcrumbs",
			"stf_breadcrumbs_delimiter",
			"stf_css",
			"stf_header_code",
			"stf_footer_code",
			"stf_sidebar_pos",
			"stf_on_home",
			"stf_home_layout",
			"stf_home_tabs_box",
			"stf_post_featured",
			"stf_post_authorbio",
			"stf_post_nav",
			"stf_post_meta",
			"stf_post_author",
			"stf_post_date",
			"stf_post_cats",
			"stf_post_comments",
			"stf_post_tags",
			"stf_comment_validation",
			"stf_share_post",
			"stf_share_tweet",
			"stf_share_twitter_username",
			"stf_share_facebook",
			"stf_share_google",
			"stf_share_linkdin",
			"stf_share_stumble",
			"stf_share_pinterest",
			"stf_related",
			"stf_related_number",
			"stf_related_query",
			"stf_footer_top",
			"stf_footer_social",
			"stf_footer_widgets",
			"stf_footer_one",
			"stf_footer_two",
			"stf_share_buttons",
			"stf_archives_socail",
			"stf_blog_display",
			"stf_category_desc",
			"stf_category_rss",
			"stf_tag_rss",
			"stf_author_bio",
			"stf_author_rss",
			"stf_search_cats",
			"stf_search_exclude_pages",
			"stf_sidebar_home",
			"stf_sidebar_page",
			"stf_sidebar_post",
			"stf_sidebar_archive",
			"stf_breaking_news",
			"stf_breaking_title",
			"stf_breaking_number",
			"stf_breaking_effect",
			"stf_breaking_speed",
			"stf_breaking_time",
			"stf_breaking_type",
			"stf_breaking_tag",
			"stf_rss_url",
			"stf_slider",
			"stf_slider_type",
			"stf_slider_pos",
			"stf_slider_number",
			"stf_flexi_slider_effect",
			"stf_flexi_slider_speed",
			"stf_flexi_slider_time",
			"stf_elastic_slider_effect",
			"stf_elastic_slider_autoplay",
			"stf_elastic_slider_interval",
			"stf_elastic_slider_speed",
			"stf_slider_query",
			"stf_slider_tag",
			"stf_slider_cat",
			"stf_slider_posts",
			"stf_slider_pages",
			"stf_slider_custom",
			"stf_banner_top",
			"stf_banner_top_img",
			"stf_banner_top_url",
			"stf_banner_top_alt",
			"stf_banner_top_tab",
			"stf_banner_top_adsense",
			"stf_banner_bottom",
			"stf_banner_bottom_img",
			"stf_banner_bottom_url",
			"stf_banner_bottom_alt",
			"stf_banner_bottom_tab",
			"stf_banner_bottom_adsense",
			"stf_banner_above",
			"stf_banner_above_img",
			"stf_banner_above_url",
			"stf_banner_above_alt",
			"stf_banner_above_tab",
			"stf_banner_above_adsense",
			"stf_banner_below",
			"stf_banner_below_img",
			"stf_banner_below_url",
			"stf_banner_below_alt",
			"stf_banner_below_tab",
			"stf_banner_below_adsense",
			"stf_ads1_shortcode", 
			"stf_ads2_shortcode",
			"stf_theme_skin",
			"stf_background_type",
			"stf_background_pattern",
			"stf_background_pattern_color",
			"stf_background_full",
			"stf_exclude_shortcodes",
			"stf_notify_theme",
			"stf_dashboard_logo",
			"stf_global_color",
			"stf_links_color",
			"stf_links_decoration",
			"stf_links_color_hover",
			"stf_links_decoration_hover",
			"stf_topbar_links_color",
			"stf_topbar_links_color_hover",
			"stf_todaydate_background",
			"stf_todaydate_color",
			"stf_breaking_title_bg",
			"stf_footer_title_color",
			"stf_footer_links_color",
			"stf_footer_links_color_hover",
			"stf_breaking_cat",
			"stf_sidebars",
			"stf_social",
			"stf_home_tabs",
			"stf_background",
			"stf_topbar_background",
			"stf_header_background",
			"stf_footer_background"
		);
		
		$current_options = array();
		foreach( $old_options as $option ){
			if( get_option( $option ) ){
				$new_option = preg_replace('/stf_/', '' , $option);
				if( $option == 'stf_home_tabs' ){
					$stf_home_tabs = explode (',' , get_option( $option ) );
					$current_options[$new_option] = $stf_home_tabs  ;
				}else{			
					$current_options[$new_option] =  get_option( $option ) ;
				}
				update_option( 'stf_options' , $current_options );
				delete_option($option);
			}
		}
		update_option( 'stf_active' );
		echo '<script>location.reload();</script>';
		die;
	}
					
	if( get_option('stf_active') ){
		$categories_obj = get_categories('hide_empty=0');
		foreach ($categories_obj as $pn_cat) {
			$category_id = $pn_cat->cat_ID;
			
			$cat_sidebar = stf_get_option( 'sidebar_cat_'.$category_id );
			$cat_slider  = stf_get_option( 'slider_cat_'.$category_id  );
			$cat_bg 	 = stf_get_option( 'cat'.$category_id.'_background' );
			$cat_full_bg = stf_get_option( 'cat'.$category_id.'_background_full' );
			$cat_color   = stf_get_option( 'cat_'.$category_id.'_color' );
			
			$new_cat = array();
			$new_cat['cat_sidebar'] =  $cat_sidebar;
			$new_cat['cat_slider']  = $cat_slider;
			$new_cat['cat_color'] = $cat_color;
			$new_cat['cat_background'] = $cat_bg;
			$new_cat['cat_background_full'] = $cat_full_bg;
			
			update_option( "stf_cat_".$category_id , $new_cat );
		}


		$theme_options = get_option( 'stf_options' );
		
		if( !empty($theme_options['theme_skin']) ){
			if( $theme_options['theme_skin'] == 'red' )
				$theme_options['theme_skin'] = '#f50000';
			elseif( $theme_options['theme_skin'] == 'blue' )
				$theme_options['theme_skin'] = '#29b1e4';
			elseif( $theme_options['theme_skin'] == 'green' )
				$theme_options['theme_skin'] = '#26c66e';
			elseif( $theme_options['theme_skin'] == 'black' )
				$theme_options['theme_skin'] = '#000';
			elseif( $theme_options['theme_skin'] == 'yellow' )
				$theme_options['theme_skin'] = '#FFBA00';
		}
		$theme_options['post_og_cards'] = true;
		$theme_options['slider_caption'] = true;
		$theme_options['slider_caption_length'] = 100;

		$theme_options['box_meta_score'] 	= true;
		$theme_options['box_meta_date'] 	= true;
		$theme_options['box_meta_comments'] = true;
		
		$theme_options['arc_meta_score'] 	= true;
		$theme_options['arc_meta_date'] 	= true;
		$theme_options['arc_meta_comments'] = true;
		
		$theme_options['modern_scrollbar']  = true;

		update_option( 'stf_options' , $theme_options );


		update_option( 'stf_active' );
		echo '<script>location.reload();</script>';
		die;
	}
}

?>