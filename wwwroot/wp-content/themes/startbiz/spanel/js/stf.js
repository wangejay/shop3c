// 圖片上傳函式庫
	function stf_styling_uploader(field) {
		var button = "#upload_"+field+"_button";
		jQuery(button).click(function() {
			window.restore_send_to_editor = window.send_to_editor;
			tb_show('', 'media-upload.php?referer=stf-settings&amp;type=image&amp;TB_iframe=true&amp;post_id=0');
			styling_send_img(field);
			return false;
		});
		jQuery('#'+field).change(function(){
			jQuery('#'+field+'-preview img').attr("src",jQuery('#'+field).val());
		});
	}
	function styling_send_img(field) {
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			
			if(typeof imgurl == 'undefined')
				imgurl = jQuery(html).attr('src');
				
			jQuery('#'+field+'-img').val(imgurl);
			jQuery('#'+field+'-preview').show();
			jQuery('#'+field+'-preview img').attr("src",imgurl);
			tb_remove();
			window.send_to_editor = window.restore_send_to_editor;
		}
	};
	
jQuery(document).ready(function() {
    jQuery('.tooltip').tipsy({fade: true, gravity: 's'});
	
	
	jQuery("select[name='stf_options[typography_test][font]']").change(function(){
		var selected_font = jQuery("select[name='stf_options[typography_test][font]'] option:selected").val();
		var parts = selected_font.split(':');
		var output =  parts[0] ;
		jQuery("#stf-fonts-css").attr( 'href' , 'http://fonts.googleapis.com/css?family='+output );
		jQuery("#font-preview").css( "font-family" , output );
	});

	jQuery("input[name='stf_options[typography_test][color]']").change(function(){
		var selected_color = jQuery("input[name='stf_options[typography_test][color]']").val();
		jQuery("#font-preview").css( "color" , selected_color );
	});
	
	jQuery("select[name='stf_options[typography_test][size]']").change(function(){
		var selected_size = jQuery("select[name='stf_options[typography_test][size]'] option:selected").val();
		jQuery("#font-preview").css( "font-size" , selected_size+'px' );
	});

	jQuery("select[name='stf_options[typography_test][weight]']").change(function(){
		var selected_weight = jQuery("select[name='stf_options[typography_test][weight]'] option:selected").val();
		jQuery("#font-preview").css( "font-weight" , selected_weight );
	});
	
	jQuery("select[name='stf_options[typography_test][style]']").change(function(){
		var selected_style = jQuery("select[name='stf_options[typography_test][style]'] option:selected").val();
		jQuery("#font-preview").css( "font-style" , selected_style );
	});


		
// 圖片上傳函式庫
	function stf_set_uploader(field) {
		var button = "#upload_"+field+"_button";
		jQuery(button).click(function() {
			window.restore_send_to_editor = window.send_to_editor;
			tb_show('', 'media-upload.php?referer=stf-settings&amp;type=image&amp;TB_iframe=true&amp;post_id=0');
			stf_set_send_img(field);
			return false;
		});
		jQuery('#'+field).change(function(){
			jQuery('#'+field+'-preview').show();
			jQuery('#'+field+'-preview img').attr("src",jQuery('#'+field).val());
		});
	}
	function stf_set_send_img(field) {
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			
			if(typeof imgurl == 'undefined')
				imgurl = jQuery(html).attr('src');
				
			jQuery('#'+field).val(imgurl);
			jQuery('#'+field+'-preview').show();
			jQuery('#'+field+'-preview img').attr("src",imgurl);
			tb_remove();
			window.send_to_editor = window.restore_send_to_editor;
		}
	};
	
	stf_set_uploader("logo");
	stf_set_uploader("favicon");
	stf_set_uploader("gravatar");
	stf_set_uploader("banner_top_img");
	stf_set_uploader("banner_bottom_img");
	stf_set_uploader("banner_above_img");
	stf_set_uploader("banner_below_img");
	stf_set_uploader("dashboard_logo");

// 刪除預覽圖
	jQuery(document).on("click", ".del-img" , function(){
		jQuery(this).parent().fadeOut(function() {
			jQuery(this).hide();
			jQuery(this).parent().find('input[class="img-path"]').attr('value', '' );
		});
	});	
	
// 即時新聞設定選項
	var selected_breaking = jQuery("input[name='stf_options[breaking_type]']:checked").val();
	
	jQuery('#breaking_cat-item , #breaking_tag-item , #breaking_custom-item , #breaking_number-item').hide();

	if (selected_breaking == 'category') {jQuery('#breaking_cat-item , #breaking_number-item').show();}
	if (selected_breaking == 'tag') {jQuery('#breaking_tag-item , #breaking_number-item').show();}
	if (selected_breaking == 'custom') { jQuery('#breaking_custom-item').show(); }

	jQuery("input[name='stf_options[breaking_type]']").change(function(){
		var selected_breaking = jQuery("input[name='stf_options[breaking_type]']:checked").val();
		if (selected_breaking == 'category') {
			jQuery('#breaking_tag-item , #breaking_custom-item').hide();
			jQuery('#breaking_cat-item , #breaking_number-item').fadeIn();
		}
		if (selected_breaking == 'tag') {
			jQuery('#breaking_cat-item , #breaking_custom-item').hide();
			jQuery('#breaking_tag-item , #breaking_number-item').fadeIn();
		}
		if (selected_breaking == 'custom') {
			jQuery('#breaking_cat-item , #breaking_tag-item , #breaking_number-item').hide();
			jQuery('#breaking_custom-item').fadeIn();
		}

	 });

// 單篇文章 Head
	var selected_item = jQuery("select[name='stf_post_head'] option:selected").val();
	
	if (selected_item == 'video') {jQuery('#stf_video_url-item, #stf_embed_code-item').show();}
	if (selected_item == 'audio') {jQuery('#stf_audio_mp3-item, #stf_audio_m4a-item, #stf_audio_oga-item').show();}
	if (selected_item == 'soundcloud') {jQuery('#stf_audio_soundcloud-item, #stf_audio_soundcloud_play-item').show();}
	if (selected_item == 'slider') {jQuery('#stf_post_slider-item').show();}
	if (selected_item == 'map') {jQuery('#stf_googlemap_url-item').show();}
	
	jQuery("select[name='stf_post_head']").change(function(){
		var selected_item = jQuery("select[name='stf_post_head'] option:selected").val();
		if (selected_item == 'video') {
			jQuery('#stf_post_slider-item, #stf_googlemap_url-item, #stf_audio_mp3-item, #stf_audio_m4a-item, #stf_audio_oga-item, #stf_audio_soundcloud-item, #stf_audio_soundcloud_play-item').hide();
			jQuery('#stf_video_url-item, #stf_embed_code-item').fadeIn();
		}
		if (selected_item == 'audio') {
			jQuery('#stf_video_url-item, #stf_embed_code-item, #stf_post_slider-item, #stf_googlemap_url-item, #stf_audio_soundcloud-item, #stf_audio_soundcloud_play-item').hide();
			jQuery('#stf_audio_mp3-item, #stf_audio_m4a-item, #stf_audio_oga-item').fadeIn();
		}
		if (selected_item == 'soundcloud') {
			jQuery('#stf_video_url-item, #stf_embed_code-item, #stf_post_slider-item, #stf_googlemap_url-item, #stf_audio_mp3-item, #stf_audio_m4a-item, #stf_audio_oga-item').hide();
			jQuery('#stf_audio_soundcloud-item, #stf_audio_soundcloud_play-item').fadeIn();
		}
		if (selected_item == 'slider') {
			jQuery('#stf_video_url-item, #stf_embed_code-item, #stf_googlemap_url-item, #stf_audio_mp3-item, #stf_audio_m4a-item, #stf_audio_oga-item, #stf_audio_soundcloud-item, #stf_audio_soundcloud_play-item').hide();
			jQuery('#stf_post_slider-item').fadeIn();
		}
		if (selected_item == 'map') {
			jQuery('#stf_video_url-item, #stf_embed_code-item, #stf_post_slider-item, #stf_audio_mp3-item, #stf_audio_m4a-item, #stf_audio_oga-item, #stf_audio_soundcloud-item, #stf_audio_soundcloud_play-item').hide();
			jQuery('#stf_googlemap_url-item').fadeIn();
		}
		if (selected_item == 'thumb' || selected_item == 'none' || selected_item == '') {
			jQuery('#stf_video_url-item, #stf_embed_code-item, #stf_post_slider-item, #stf_googlemap_url-item, #stf_audio_mp3-item, #stf_audio_m4a-item, #stf_audio_oga-item, #stf_audio_soundcloud-item, #stf_audio_soundcloud_play-item').hide();
		}
	 });
	 
// 單篇分頁模版 Head
	var selected_item = jQuery("select[name='page_template'] option:selected").val();
	
	if (selected_item == 'template-blog.php') {jQuery('#stf-template-blog').show();}
	if (selected_item == 'template-best-reviews.php') {jQuery('#stf-template-blog, #stf_posts_num-item').show();}
	if (selected_item == 'template-feed.php') {jQuery('#stf-template-feed').show();}
	if (selected_item == 'template-authors.php') {jQuery('#stf-template-authors').show();}
	
	jQuery("select[name='page_template']").change(function(){
		var selected_item = jQuery("select[name='page_template'] option:selected").val();
		jQuery('#stf-template-feed, #stf-template-blog, #stf-template-authors, #stf_posts_num-item').hide();

		if (selected_item == 'template-blog.php') {
			jQuery('#stf-template-blog').fadeIn();
		}
		if (selected_item == 'template-best-reviews.php') {
			jQuery('#stf-template-blog, #stf_posts_num-item').fadeIn();
		}
		if (selected_item == 'template-feed.php') {
			jQuery('#stf-template-feed').fadeIn();
		}
		if (selected_item == 'template-authors.php') {
			jQuery('#stf-template-authors').fadeIn();
		}
	 });

// 顯示在首頁
	var selected_radio = jQuery("input[name='stf_options[on_home]']:checked").val();
	if (selected_radio == 'latest') {	jQuery('#Home_Builder').hide();	}
	jQuery("input[name='stf_options[on_home]']").change(function(){
		var selected_radio = jQuery("input[name='stf_options[on_home]']:checked").val();
		if (selected_radio == 'latest') {
			jQuery('#Home_Builder').fadeOut();
		}else{
			jQuery('#Home_Builder').fadeIn();
		}
	 });
	 
// 開啟或關閉評分系統
	var reviews_on = jQuery("select[name='stf_review_position'] option:selected ").val();
	if (reviews_on != '') {	jQuery('#reviews-options').show();	}
	if (reviews_on == 'custom') {	jQuery('#taq_custom_position_hint').show();	}
	jQuery("select[name='stf_review_position']").change(function(){
		var reviews_on = jQuery("select[name='stf_review_position'] option:selected ").val();
		if (reviews_on == '') {
			jQuery('#reviews-options').fadeOut();
			jQuery('#taq_custom_position_hint').fadeOut();
		}else if( reviews_on == 'custom' ){
			jQuery('#reviews-options').fadeIn();
			jQuery('#taq_custom_position_hint').fadeIn();
		}else{
			jQuery('#reviews-options').fadeIn();
			jQuery('#taq_custom_position_hint').fadeOut();
		}
	 });
	 	 
// 新增新的評分標準		 
	jQuery("#stf_add_review_criteria").click(function() {
		jQuery('#stf-reviews-list').append('<li id="reviewItem_'+ nextReview +'" class="option-item review-item"><span class="label">評分標準</span><input name="stf_review_criteria['+ nextReview +'][name]" type="text" value="" /><div class="clear"></div><span class="label">標準分數</span><div id="criteria'+ nextReview +'-slider"></div><input type="text" id="criteria'+ nextReview +'" value="0" name="stf_review_criteria['+ nextReview +'][score]" style="width:40px; opacity: 0.7;" /><a class="del-cat" title="Delete"></a><script>jQuery("#criteria'+ nextReview +'-slider").slider({range: "min",min: 0,	max: 100,value: 0 ,	slide: function(event, ui) {jQuery("#criteria'+ nextReview+'").attr("value", ui.value );}});</script></li>');
		jQuery('#reviewItem_'+ nextReview).hide().fadeIn();
		nextReview ++ ;
	});	 
	
// 幻燈片位置
	var selected_pos = jQuery("input[name='stf_options[slider_type]']:checked").val();
	
	if (selected_pos == 'elastic') {jQuery('#elastic').show();}
	if (selected_pos == 'flexi') {jQuery('#flexi').show();}

	jQuery("input[name='stf_options[slider_type]']").change(function(){
		var selected_pos = jQuery("input[name='stf_options[slider_type]']:checked").val();
		if (selected_pos == 'elastic') {
			jQuery('#flexi').hide();
			jQuery('#elastic').fadeIn();
		}
		if (selected_pos == 'flexi') {
			jQuery('#elastic').hide();
			jQuery('#flexi').fadeIn();
		}
	 });
	 
// 幻燈片顯示型態
	var selected_type = jQuery("input[name='stf_options[slider_query]']:checked").val();
	
	if (selected_type == 'category') {jQuery('#slider_cat-item').show();}
	if (selected_type == 'tag') {jQuery('#slider_tag-item').show();}
	if (selected_type == 'post') {jQuery('#slider_posts-item').show();}
	if (selected_type == 'page') {jQuery('#slider_pages-item').show();}
	if (selected_type == 'custom') {jQuery('#slider_custom-item').show();}
	
	jQuery("input[name='stf_options[slider_query]']").change(function(){
		var selected_type = jQuery("input[name='stf_options[slider_query]']:checked").val();
		if (selected_type == 'category') {
			jQuery('#slider_tag-item ,#slider_posts-item ,#slider_pages-item,#slider_custom-item').hide();
			jQuery('#slider_cat-item').fadeIn();
		}
		if (selected_type == 'tag') {
			jQuery('#slider_cat-item ,#slider_posts-item ,#slider_pages-item,#slider_custom-item').hide();
			jQuery('#slider_tag-item').fadeIn();
		}
		if (selected_type == 'post') {
			jQuery('#slider_cat-item ,#slider_tag-item ,#slider_pages-item,#slider_custom-item').hide();
			jQuery('#slider_posts-item').fadeIn();
		}
		if (selected_type == 'page') {
			jQuery('#slider_cat-item ,#slider_posts-item ,#slider_tag-item,#slider_custom-item').hide();
			jQuery('#slider_pages-item').fadeIn();
		}
		if (selected_type == 'custom') {
			jQuery('#slider_cat-item ,#slider_posts-item ,#slider_tag-item,#slider_pages-item').hide();
			jQuery('#slider_custom-item').fadeIn();
		}
	 });
 
// 儲存設定的提示訊息
	jQuery(".spanel-save").click( function() {
		jQuery('#save-alert').fadeIn();
	});

// 首頁產生器
	var htm1l = jQuery('#cats_defult').html();
	
	jQuery("#add-cat").click(function() {
		jQuery('#cat_sortable').append('	<li id="listItem_'+ nextCell +'" class="ui-state-default"><div class="widget-head"> 新聞框 <a style="display:none" class="toggle-open">+</a><a style="display:block" class="toggle-close">-</a></div><div style="display:block" class="widget-content"><label><span>分類目錄框 : </span><select name="stf_home_cats['+ nextCell +'][id]" id="stf_home_cats['+ nextCell +'][id]">'+htm1l+'</select></label><label><span>文章排序 : </span><select name="stf_home_cats['+ nextCell +'][order]" id="stf_home_cats['+ nextCell +'][order]"><option value="latest" selected="selected">最新文章</option><option value="rand">隨機文章</option></select></label><label for="stf_home_cats['+ nextCell +'][number]"><span>文章顯示數量 :</span><input style="width:50px;" id="stf_home_cats['+ nextCell +'][number]" name="stf_home_cats['+ nextCell +'][number]" value="5" type="text" /></label> <label for="stf_home_cats['+ nextCell +'][offset]"><span>取消 - 傳送文章數</span><input style="width:50px;" id="stf_home_cats['+ nextCell +'][offset]" name="stf_home_cats['+ nextCell +'][offset]" value="" type="text" /></label><label><span style="float:left; width:162px">新聞框樣式 : </span><ul class="stf-cats-options stf-options"><li class="selected"><input id="stf_home_cats['+ nextCell +'][style]" name="stf_home_cats['+ nextCell +'][style]" type="radio" value="li" checked="checked"/><a class="checkbox-select" href="#"><img src="'+ templatePath +'/spanel/images/li.png" /></a></li><li><input id="stf_home_cats['+ nextCell +'][style]" name="stf_home_cats['+ nextCell +'][style]" type="radio" value="2c" /><a class="checkbox-select" href="#"><img src="'+ templatePath +'/spanel/images/2c.png" /></a></li><li><input id="stf_home_cats['+ nextCell +'][style]" name="stf_home_cats['+ nextCell +'][style]" type="radio" value="1c" /><a class="checkbox-select" href="#"><img src="'+ templatePath +'/spanel/images/1c.png" /></a></li></ul></label><input id="stf_home_cats['+ nextCell +'][type]" name="stf_home_cats['+ nextCell +'][type]" value="n" type="hidden" /><a class="del-cat"></a></div></li>');
		jQuery('#listItem_'+ nextCell).hide().fadeIn();
		nextCell ++ ;
	});
	jQuery("#add-slider").click(function() {
		jQuery('#cat_sortable').append('<li id="listItem_'+ nextCell +'" class="ui-state-default"><div class="widget-head"> 滾動新聞框 <a style="display:none" class="toggle-open">+</a><a style="display:block" class="toggle-close">-</a></div><div class="widget-content" style="display:block"><label><span>新聞框分類目錄 : </span><select name="stf_home_cats['+ nextCell +'][id]" id="stf_home_cats['+ nextCell +'][id]">'+htm1l+'</select></label><label for="stf_home_cats['+ nextCell +'][title]"><span>新聞框標題 :</span><input id="stf_home_cats['+ nextCell +'][title]" name="stf_home_cats['+ nextCell +'][title]" value="滾動新聞框" type="text" /></label><label for="stf_home_cats['+ nextCell +'][number]"><span>文章顯示數量 :</span><input style="width:50px;" id="stf_home_cats['+ nextCell +'][number]" name="stf_home_cats['+ nextCell +'][number]" value="12" type="text" /></label><label for="stf_home_cats['+ nextCell +'][offset]"><span>取消 - 傳送文章數</span><input style="width:50px;" id="stf_home_cats['+ nextCell +'][offset]" name="stf_home_cats['+ nextCell +'][offset]" value="" type="text" /></label><input id="stf_home_cats['+ nextCell +'][boxid]" name="stf_home_cats['+ nextCell +'][boxid]" value="s_'+ 1 + Math.floor(Math.random() * 1500)+'" type="hidden" /><input id="stf_home_cats['+ nextCell +'][type]" name="stf_home_cats['+ nextCell +'][type]" value="s" type="hidden" /><a class="del-cat"></a></div></li>');
		jQuery('#listItem_'+ nextCell).hide().fadeIn();
		nextCell ++ ;
	});
	jQuery("#add-news-picture").click(function() {
		jQuery('#cat_sortable').append('<li id="listItem_'+ nextCell +'" class="ui-state-default"><div class="widget-head">  圖片新聞 <a style="display:none" class="toggle-open">+</a><a style="display:block" class="toggle-close">-</a></div><div class="widget-content" style="display:block"><label><span>新聞分類目錄 : </span><select name="stf_home_cats['+ nextCell +'][id]" id="stf_home_cats['+ nextCell +'][id]">'+htm1l+'</select></label><label for="stf_home_cats['+ nextCell +'][title]"><span>新聞框標題 :</span><input id="stf_home_cats['+ nextCell +'][title]" name="stf_home_cats['+ nextCell +'][title]" value="圖片新聞" type="text" /></label><label for="stf_home_cats['+ nextCell +'][offset]"><span>取消 - 傳送文章數</span><input style="width:50px;" id="stf_home_cats['+ nextCell +'][offset]" name="stf_home_cats['+ nextCell +'][offset]" value="" type="text" /></label><input id="stf_home_cats['+ nextCell +'][boxid]" name="stf_home_cats['+ nextCell +'][boxid]" value="news-pic_'+ 1 + Math.floor(Math.random() * 1500)+'" type="hidden" /><input id="stf_home_cats['+ nextCell +'][type]" name="stf_home_cats['+ nextCell +'][type]" value="news-pic" type="hidden" /><label><span style="float:left;">新聞框樣式 : </span><ul class="stf-cats-options stf-options"><li class="selected"><input id="stf_home_cats['+ nextCell +'][style]" name="stf_home_cats['+ nextCell +'][style]" type="radio" value="default" checked="checked"/><a class="checkbox-select" href="#"><img src="'+ templatePath +'/spanel/images/news-in-pic1.png" /></a></li><li><input id="stf_home_cats['+ nextCell +'][style]" name="stf_home_cats['+ nextCell +'][style]" type="radio" value="row" /><a class="checkbox-select" href="#"><img src="'+ templatePath +'/spanel/images/news-in-pic2.png" /></a></li></ul></label><a class="del-cat"></a></div></li>');
		jQuery('#listItem_'+ nextCell).hide().fadeIn();
		nextCell ++ ;
	});
	jQuery("#add-news-videos").click(function() {
		jQuery('#cat_sortable').append('<li id="listItem_'+ nextCell +'" class="ui-state-default"><div class="widget-head"> 影片 <a style="display:none" class="toggle-open">+</a><a style="display:block" class="toggle-close">-</a></div><div class="widget-content" style="display:block"><label><span>新聞框分類目錄 : </span><select name="stf_home_cats['+ nextCell +'][id]" id="stf_home_cats['+ nextCell +'][id]">'+htm1l+'</select></label><label for="stf_home_cats['+ nextCell +'][title]"><span>新聞框標題 :</span><input id="stf_home_cats['+ nextCell +'][title]" name="stf_home_cats['+ nextCell +'][title]" value="最新影片" type="text" /></label><label for="stf_home_cats['+ nextCell +'][offset]"><span>取消 - 傳送文章數</span><input style="width:50px;" id="stf_home_cats['+ nextCell +'][offset]" name="stf_home_cats['+ nextCell +'][offset]" value="" type="text" /></label><input id="stf_home_cats['+ nextCell +'][boxid]" name="stf_home_cats['+ nextCell +'][boxid]" value="videos_'+ 1 + Math.floor(Math.random() * 1500)+'" type="hidden" /><input id="stf_home_cats['+ nextCell +'][type]" name="stf_home_cats['+ nextCell +'][type]" value="videos" type="hidden" /><a class="del-cat"></a></div></li>');
		jQuery('#listItem_'+ nextCell).hide().fadeIn();
		nextCell ++ ;
	});
	jQuery("#add-divider").click(function() {
		jQuery('#cat_sortable').append('<li id="listItem_'+ nextCell +'" class="ui-state-default"><div class="widget-head divider"> 分隔線 <a style="display:none" class="toggle-open">+</a><a style="display:block" class="toggle-close">-</a></div><div class="widget-content" style="display:block"><label for="stf_home_cats[<?php echo jQueryi ?>][height]"><span>高度 :</span><input id="stf_home_cats['+ nextCell +'][type]" name="stf_home_cats['+ nextCell +'][type]" value="divider" type="hidden" />  <input id="stf_home_cats['+ nextCell +'][height]" name="stf_home_cats['+ nextCell +'][height]" value="10" type="text" style="width:50px;" /> px</label>  <a class="del-cat"></a></div></li>');
		jQuery('#listItem_'+ nextCell).hide().fadeIn();
		nextCell ++ ;
	});
	jQuery("#add-recent").click(function() {
		jQuery('#cat_sortable').append('<li id="listItem_'+ nextCell +'" class="ui-state-default"><div class="widget-head">  最新文章  <a style="display:none" class="toggle-open">+</a><a style="display:block" class="toggle-close">-</a></div><div style="display:block" class="widget-content"><label><span style="float:left;">排除這些分類 : <br />（可按 ctrl 多選）</span><select multiple="multiple" name="stf_home_cats['+ nextCell +'][exclude][]" id="stf_home_cats['+ nextCell +'][exclude][]">'+htm1l+'</select></label><label for="stf_home_cats['+ nextCell +'][title]"><span>新聞框標題 :</span><input id="stf_home_cats['+ nextCell +'][title]" name="stf_home_cats['+ nextCell +'][title]" value="最新文章" type="text" /></label><label for="stf_home_cats['+ nextCell +'][number]"><span>文章顯示數量 :</span><input style="width:50px;" id="stf_home_cats['+ nextCell +'][number]" name="stf_home_cats['+ nextCell +'][number]" value="3" type="text" /></label><label for="stf_home_cats['+ nextCell +'][offset]"><span>取消 - 傳送文章數</span><input style="width:50px;" id="stf_home_cats['+ nextCell +'][offset]" name="stf_home_cats['+ nextCell +'][offset]" value="" type="text" /></label><label for="stf_home_cats[<?php echo $i ?>][display]"><span>顯示模式:</span><select id="stf_home_cats['+ nextCell +'][display]" name="stf_home_cats['+ nextCell +'][display]"><option value="default">預設樣式</option><option value="blog">部落格樣式</option></select></label> <label for="stf_home_cats['+ nextCell +'][pagi]"><span>顯示分頁:</span><select id="stf_home_cats['+ nextCell +'][pagi]" name="stf_home_cats['+ nextCell +'][pagi]"><option value="n" selected="selected">否</option><option value="y">是</option></select></label> <input id="stf_home_cats['+ nextCell +'][boxid]" name="stf_home_cats['+ nextCell +'][boxid]" value="recent_'+ 1 + Math.floor(Math.random() * 1500)+'" type="hidden" /><input id="stf_home_cats['+ nextCell +'][type]" name="stf_home_cats['+ nextCell +'][type]" value="recent" type="hidden" /><a class="del-cat"></a></div></li>');
		jQuery('#listItem_'+ nextCell).hide().fadeIn();
		nextCell ++ ;
	});
	jQuery("#add-ads").click(function() {
		jQuery('#cat_sortable').append('<li id="listItem_'+ nextCell +'" class="ui-state-default"><div class="widget-head">  廣告 / 自訂內容 <a style="display:none" class="toggle-open">+</a><a style="display:block" class="toggle-close">-</a></div><div class="widget-content" style="display:block"><textarea name="stf_home_cats['+ nextCell +'][text]" id="stf_home_cats['+ nextCell +'][text]"></textarea>											<br /><small>支援 <strong>文字, HTML 和短代碼</strong> .</small><input id="stf_home_cats['+ nextCell +'][type]" name="stf_home_cats['+ nextCell +'][type]" value="ads" type="hidden" /><a class="del-cat"></a></div></li>');
		jQuery('#listItem_'+ nextCell).hide().fadeIn();
		nextCell ++ ;
	});
	
// 開啟或關閉頁籤切換效果
	jQuery(document).on("click", ".toggle-open" , function(){
		jQuery(this).parent().parent().find(".widget-content").slideToggle(300);
		jQuery(this).hide();
		jQuery(this).parent().find(".toggle-close").show();
    });
	
	jQuery(document).on("click", ".toggle-close" , function(){
		jQuery(this).parent().parent().find(".widget-content").slideToggle("fast");
		jQuery(this).hide();
		jQuery(this).parent().find(".toggle-open").show();
    });
	
// 展開/折疊全部
	jQuery(document).on("click", "#expand-all" , function(){
		jQuery("#cat_sortable .widget-content").slideDown(300);
		jQuery("#cat_sortable .toggle-close").show();
		jQuery("#cat_sortable .toggle-open").hide();
    });
	jQuery(document).on("click", "#collapse-all" , function(){
		jQuery("#cat_sortable .widget-content").slideUp(300);
		jQuery("#cat_sortable .toggle-close").hide();
		jQuery("#cat_sortable .toggle-open").show();
    });
	
// 刪除分類
	jQuery(document).on("click", ".del-cat" , function(){
		jQuery(this).parent().parent().addClass('removered').fadeOut(function() {
			jQuery(this).remove();
		});
	});

// 刪除側邊欄的圖示
	jQuery(document).on("click", ".del-sidebar" , function(){
		var option = jQuery(this).parent().find('input').val();
		jQuery(this).parent().parent().addClass('removered').fadeOut(function() {
			jQuery(this).remove();
			jQuery('#custom-sidebars select').find('option[value="'+option+'"]').remove();

		});
	});	
	
// 刪除自訂文字的圖示
	jQuery(document).on("click", ".del-custom-text" , function(){
		var option = jQuery(this).parent().find('input').val();
		jQuery(this).parent().parent().addClass('removered').fadeOut(function() {
			jQuery(this).remove();
		});
	});	
	
// 側邊欄產生器
	jQuery("#sidebarAdd").click(function() {
		var SidebarName = jQuery('#sidebarName').val();
		if( SidebarName.length > 0){
			jQuery('#sidebarsList').append('<li><div class="widget-head">'+SidebarName+' <input id="stf_sidebars" name="stf_options[sidebars][]" type="hidden" value="'+SidebarName+'" /><a class="del-sidebar"></a></div></li>');
			jQuery('#custom-sidebars select').append('<option value="'+SidebarName+'">'+SidebarName+'</option>');
		}
		jQuery('#sidebarName').val('');

	});	
	
// 自訂即時新聞文字
	jQuery("#TextAdd").click(function() {
		var customlink = jQuery('#custom_link').val();
		var customtext = jQuery('#custom_text').val();
		if( customtext.length > 0 && customlink.length > 0  ){
			jQuery('#customList').append('<li><div class="widget-head"><a href="'+customlink+'" target="_blank">'+customtext+'</a> <input name="stf_options[breaking_custom]['+customnext+'][link]" type="hidden" value="'+customlink+'" /> <input name="stf_options[breaking_custom]['+customnext+'][text]" type="hidden" value="'+customtext+'" /><a class="del-custom-text"></a></div></li>');
		}
		customnext ++ ;
		jQuery('#custom_link , #custom_text').val('');

	});
	
// 背景類型
	var bg_selected_radio = jQuery("input[name='stf_options[background_type]']:checked").val();
	if (bg_selected_radio == 'custom') {	jQuery('#pattern-settings').hide();	}
	if (bg_selected_radio == 'pattern') {	jQuery('#bg_image_settings').hide();	}
	jQuery("input[name='stf_options[background_type]']").change(function(){
		var bg_selected_radio = jQuery("input[name='stf_options[background_type]']:checked").val();
		if (bg_selected_radio == 'pattern') {
			jQuery('#pattern-settings').fadeIn();
			jQuery('#bg_image_settings').hide();
		}else{
			jQuery('#bg_image_settings').fadeIn();
			jQuery('#pattern-settings').hide();
		}
	 });
 
// S-Panel 頁籤
	jQuery(".tabs-wrap").hide();
	jQuery(".stf-spanel-tabs ul li:first").addClass("active").show();
	jQuery(".tabs-wrap:first").show(); 
	jQuery("li.stf-tabs:not(.stf-not-tab)").click(function() {
		jQuery(".stf-spanel-tabs ul li").removeClass("active");
		jQuery(this).addClass("active");
		jQuery(".tabs-wrap").hide();
		var activeTab = jQuery(this).find("a").attr("href");
		jQuery(activeTab).fadeIn('fast');
		return false;
	});
	
// 主題樣式
	jQuery("#theme-skins input:checked").parent().addClass("selected");
	jQuery("#theme-skins .checkbox-select").click(
		function(event) {
			event.preventDefault();
			jQuery("#theme-skins li").removeClass("selected");
			jQuery(this).parent().addClass("selected");
			jQuery(this).parent().find(":radio").attr("checked","checked");			 
		}
	);	
	
// 背景圖片
	jQuery("#theme-pattern input:checked").parent().addClass("selected");
	jQuery("#theme-pattern .checkbox-select").click(
		function(event) {
			event.preventDefault();
			jQuery("#theme-pattern li").removeClass("selected");
			jQuery(this).parent().addClass("selected");
			jQuery(this).parent().find(":radio").attr("checked","checked");			 
		}
	);	
	
// 側邊欄位置	
	jQuery("#sidebar-position-options input:checked").parent().addClass("selected");
	jQuery("#sidebar-position-options .checkbox-select").click(
		function(event) {
			event.preventDefault();
			jQuery("#sidebar-position-options li").removeClass("selected");
			jQuery(this).parent().addClass("selected");
			jQuery(this).parent().find(":radio").attr("checked","checked");			 
		}
	);	

// 頁尾 Widgets	小工具
	jQuery("#footer-widgets-options input:checked").parent().addClass("selected");
	jQuery("#footer-widgets-options .checkbox-select").click(
		function(event) {
			event.preventDefault();
			jQuery("#footer-widgets-options li").removeClass("selected");
			jQuery(this).parent().addClass("selected");
			jQuery(this).parent().find(":radio").attr("checked","checked");			 
		}
	);	

// 分類目錄選項
	jQuery(".stf-cats-options input:checked").parent().addClass("selected");
	jQuery(document).on("click", ".stf-cats-options .checkbox-select" , function(event){
		event.preventDefault();
		jQuery(this).parent().parent().find("li").removeClass("selected");
		jQuery(this).parent().addClass("selected");
		jQuery(this).parent().find(":radio").attr("checked","checked");			 
		
	});
	
// 分類目錄頁籤框	
	jQuery("#tabs_cats input:checked").parent().addClass("selected");
	jQuery("#tabs_cats span").click(
		function(event) {
			event.preventDefault();
			if( jQuery(this).parent().find(":checkbox").is(':checked') ){
				jQuery(this).parent().removeClass("selected");
				jQuery(this).parent().find(":checkbox").removeAttr("checked");			 
			}else{
				jQuery(this).parent().addClass("selected");
				jQuery(this).parent().find(":checkbox").attr("checked","checked");
			}				
		}
	);
	 
  
	var allspanels = jQuery('.stf-accordion > .stf-accordion-contnet').hide();
	jQuery('.stf-accordion > .accordion-head > a').click(function() {
		$this = jQuery(this);
		$target =  $this.parent().next();
		if(!$target.hasClass('active')){
			allspanels.removeClass('active').slideUp();
			$target.addClass('active').slideDown();
		}
		return false;
	});
  

});

function toggleVisibility(id) {
	var e = document.getElementById(id);
    if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
}

(function($){var i=function(e){if(!e)var e=window.event;e.cancelBubble=true;if(e.stopPropagation)e.stopPropagation()};$.fn.checkbox=function(f){try{document.execCommand('BackgroundImageCache',false,true)}catch(e){}var g={cls:'jquery-checkbox',empty:'empty.png'};g=$.extend(g,f||{});var h=function(a){var b=a.checked;var c=a.disabled;var d=$(a);if(a.stateInterval)clearInterval(a.stateInterval);a.stateInterval=setInterval(function(){if(a.disabled!=c)d.trigger((c=!!a.disabled)?'disable':'enable');if(a.checked!=b)d.trigger((b=!!a.checked)?'check':'uncheck')},10);return d};return this.each(function(){var a=this;var b=h(a);if(a.wrapper)a.wrapper.remove();a.wrapper=$('<span class="'+g.cls+'"><span class="mark"><img src="'+g.empty+'" /></span></span>');a.wrapperInner=a.wrapper.children('span:eq(0)');a.wrapper.hover(function(e){a.wrapperInner.addClass(g.cls+'-hover');i(e)},function(e){a.wrapperInner.removeClass(g.cls+'-hover');i(e)});b.css({position:'absolute',zIndex:-1,visibility:'hidden'}).after(a.wrapper);var c=false;if(b.attr('id')){c=$('label[for='+b.attr('id')+']');if(!c.length)c=false}if(!c){c=b.closest?b.closest('label'):b.parents('label:eq(0)');if(!c.length)c=false}if(c){c.hover(function(e){a.wrapper.trigger('mouseover',[e])},function(e){a.wrapper.trigger('mouseout',[e])});c.click(function(e){b.trigger('click',[e]);i(e);return false})}a.wrapper.click(function(e){b.trigger('click',[e]);i(e);return false});b.click(function(e){i(e)});b.bind('disable',function(){a.wrapperInner.addClass(g.cls+'-disabled')}).bind('enable',function(){a.wrapperInner.removeClass(g.cls+'-disabled')});b.bind('check',function(){a.wrapper.addClass(g.cls+'-checked')}).bind('uncheck',function(){a.wrapper.removeClass(g.cls+'-checked')});$('img',a.wrapper).bind('dragstart',function(){return false}).bind('mousedown',function(){return false});if(window.getSelection)a.wrapper.css('MozUserSelect','none');if(a.checked)a.wrapper.addClass(g.cls+'-checked');if(a.disabled)a.wrapperInner.addClass(g.cls+'-disabled')})}})(jQuery);
// tipsy, version 1.0.0a
(function(a){function b(a,b){return typeof a=="function"?a.call(b):a}function c(a){while(a=a.parentNode){if(a==document)return true}return false}function d(b,c){this.$element=a(b);this.options=c;this.enabled=true;this.fixTitle()}d.prototype={show:function(){var c=this.getTitle();if(c&&this.enabled){var d=this.tip();d.find(".tipsy-inner")[this.options.html?"html":"text"](c);d[0].className="tipsy";d.remove().css({top:0,left:0,visibility:"hidden",display:"block"}).prependTo(document.body);var e=a.extend({},this.$element.offset(),{width:this.$element[0].offsetWidth,height:this.$element[0].offsetHeight});var f=d[0].offsetWidth,g=d[0].offsetHeight,h=b(this.options.gravity,this.$element[0]);var i;switch(h.charAt(0)){case"n":i={top:e.top+e.height+this.options.offset,left:e.left+e.width/2-f/2};break;case"s":i={top:e.top-g-this.options.offset,left:e.left+e.width/2-f/2};break;case"e":i={top:e.top+e.height/2-g/2,left:e.left-f-this.options.offset};break;case"w":i={top:e.top+e.height/2-g/2,left:e.left+e.width+this.options.offset};break}if(h.length==2){if(h.charAt(1)=="w"){i.left=e.left+e.width/2-15}else{i.left=e.left+e.width/2-f+15}}d.css(i).addClass("tipsy-"+h);d.find(".tipsy-arrow")[0].className="tipsy-arrow tipsy-arrow-"+h.charAt(0);if(this.options.className){d.addClass(b(this.options.className,this.$element[0]))}if(this.options.fade){d.stop().css({opacity:0,display:"block",visibility:"visible"}).animate({opacity:this.options.opacity})}else{d.css({visibility:"visible",opacity:this.options.opacity})}}},hide:function(){if(this.options.fade){this.tip().stop().fadeOut(function(){a(this).remove()})}else{this.tip().remove()}},fixTitle:function(){var a=this.$element;if(a.attr("title")||typeof a.attr("original-title")!="string"){a.attr("original-title",a.attr("title")||"").removeAttr("title")}},getTitle:function(){var a,b=this.$element,c=this.options;this.fixTitle();var a,c=this.options;if(typeof c.title=="string"){a=b.attr(c.title=="title"?"original-title":c.title)}else if(typeof c.title=="function"){a=c.title.call(b[0])}a=(""+a).replace(/(^\s*|\s*$)/,"");return a||c.fallback},tip:function(){if(!this.$tip){this.$tip=a('<div class="tipsy"></div>').html('<div class="tipsy-arrow"></div><div class="tipsy-inner"></div>');this.$tip.data("tipsy-pointee",this.$element[0])}return this.$tip},validate:function(){if(!this.$element[0].parentNode){this.hide();this.$element=null;this.options=null}},enable:function(){this.enabled=true},disable:function(){this.enabled=false},toggleEnabled:function(){this.enabled=!this.enabled}};a.fn.tipsy=function(b){function e(c){var e=a.data(c,"tipsy");if(!e){e=new d(c,a.fn.tipsy.elementOptions(c,b));a.data(c,"tipsy",e)}return e}function f(){var a=e(this);a.hoverState="in";if(b.delayIn==0){a.show()}else{a.fixTitle();setTimeout(function(){if(a.hoverState=="in")a.show()},b.delayIn)}}function g(){var a=e(this);a.hoverState="out";if(b.delayOut==0){a.hide()}else{setTimeout(function(){if(a.hoverState=="out")a.hide()},b.delayOut)}}if(b===true){return this.data("tipsy")}else if(typeof b=="string"){var c=this.data("tipsy");if(c)c[b]();return this}b=a.extend({},a.fn.tipsy.defaults,b);if(!b.live)this.each(function(){e(this)});if(b.trigger!="manual"){var h=b.live?"live":"bind",i=b.trigger=="hover"?"mouseenter":"focus",j=b.trigger=="hover"?"mouseleave":"blur";this[h](i,f)[h](j,g)}return this};a.fn.tipsy.defaults={className:null,delayIn:0,delayOut:0,fade:false,fallback:"",gravity:"n",html:false,live:false,offset:0,opacity:.8,title:"title",trigger:"hover"};a.fn.tipsy.revalidate=function(){a(".tipsy").each(function(){var b=a.data(this,"tipsy-pointee");if(!b||!c(b)){a(this).remove()}})};a.fn.tipsy.elementOptions=function(b,c){return a.metadata?a.extend({},c,a(b).metadata()):c};a.fn.tipsy.autoNS=function(){return a(this).offset().top>a(document).scrollTop()+a(window).height()/2?"s":"n"};a.fn.tipsy.autoWE=function(){return a(this).offset().left>a(document).scrollLeft()+a(window).width()/2?"e":"w"};a.fn.tipsy.autoBounds=function(b,c){return function(){var d={ns:c[0],ew:c.length>1?c[1]:false},e=a(document).scrollTop()+b,f=a(document).scrollLeft()+b,g=a(this);if(g.offset().top<e)d.ns="n";if(g.offset().left<f)d.ew="w";if(a(window).width()+a(document).scrollLeft()-g.offset().left<b)d.ew="e";if(a(window).height()+a(document).scrollTop()-g.offset().top<b)d.ns="s";return d.ns+(d.ew?d.ew:"")}}})(jQuery)

