//--- Customcode's Javascripts for WP Editor Shortcode ---//
(function() {

	tinymce.create('tinymce.plugins.Addshortcodes', {
		init : function(ed, url) {
		
			//AddBoxs
			ed.addButton('AddBox', {
				title : '新增 Box 區塊',
				cmd : 'tinyBoxes',
				image : url + '/images/boxes.png'
			});
			ed.addCommand('tinyBoxes', function() {
				ed.windowManager.open({file : url + '/ui.php?page=box',width : 600 ,	height : 450 ,	inline : 1});
			});	
			
			//AddButtons
			ed.addButton('AddButtons', {
				title : '新增按鈕',
				cmd : 'tinyButtons',
				image : url + '/images/buttons.png'
			});
			ed.addCommand('tinyButtons', function() {
				ed.windowManager.open({file : url + '/ui.php?page=buttons',width : 600 ,	height : 250 ,	inline : 1});
			});
			
			//AddFlickr
			ed.addButton('AddFlickr', {
				title : '新增來自 FLickr 的相片',
				cmd : 'tinyFlickr',
				image : url + '/images/flickr.png'
			});
			ed.addCommand('tinyFlickr', function() {
				ed.windowManager.open({file : url + '/ui.php?page=flickr',width : 600 ,	height : 180 ,	inline : 1});
			});
			
			//AddTwitter
			ed.addButton('AddTwitter', {
				title : '新增你的最新 Tweets',
				cmd : 'tinyTwitter',
				image : url + '/images/twitter.png'
			});
			ed.addCommand('tinyTwitter', function() {
				ed.windowManager.open({file : url + '/ui.php?page=twitter',width : 600 ,	height : 180 ,	inline : 1});
			});
			
			//AddFeeds
			ed.addButton('AddFeeds', {
				title : '顯示 Feeds',
				cmd : 'tinyFedds',
				image : url + '/images/feeds.png'
			});
			ed.addCommand('tinyFedds', function() {
				ed.windowManager.open({file : url + '/ui.php?page=feeds',width : 600 ,	height : 150 ,	inline : 1});
			});

			
			//Google maps
			ed.addButton('AddMap', {
				title : '插入 Google 地圖',
				cmd : 'tinymaps',
				image : url + '/images/maps.png'
			});
			ed.addCommand('tinymaps', function() {
				ed.windowManager.open({file : url + '/ui.php?page=googlemap',width : 600 ,	height : 220 ,	inline : 1});
			});

			//Add Video
			ed.addButton('Video', {
				title : '新增影片',
				cmd : 'tinyVideo',
				image : url + '/images/video.png'
			});
			ed.addCommand('tinyVideo', function() {
				ed.windowManager.open({file : url + '/ui.php?page=video',width : 600 ,	height : 180 ,	inline : 1});
			});
			
			//Add Tooltip
			ed.addButton('Tooltip', {
				title : '新增 Tooltip 提示訊息',
				cmd : 'tinyTooltip',
				image : url + '/images/tooltip.png'
			});
			ed.addCommand('tinyTooltip', function() {
				ed.windowManager.open({file : url + '/ui.php?page=tooltip',width : 600 ,	height : 440 ,	inline : 1});
			});

			//Add Audio
			ed.addButton('Audio', {
				title : '新增音訊檔案播放器',
				cmd : 'tinyAudio',
				image : url + '/images/audio.png'
			});
			ed.addCommand('tinyAudio', function() {
				ed.windowManager.open({file : url + '/ui.php?page=audio',width : 600 ,	height : 200 ,	inline : 1});
			});
			
			//Add Lightbox
			ed.addButton('LightBox', {
				title : '新增 LightBox 燈箱效果',
				cmd : 'tinylightbox',
				image : url + '/images/lightbox.png'
			});
			ed.addCommand('tinylightbox', function() {
				ed.windowManager.open({file : url + '/ui.php?page=lightbox',width : 600 ,	height : 380 ,	inline : 1});
			});

			//Add AuthorBio
			ed.addButton('AuthorBio', {
				title : '新增作者簡介',
				cmd : 'tinyAuthorBio',
				image : url + '/images/author.png'
			});
			ed.addCommand('tinyAuthorBio', function() {
				ed.windowManager.open({file : url + '/ui.php?page=author',width : 600 ,	height : 375 ,	inline : 1});
			});
			
			//Add Toggle
			ed.addButton('Toggle', {
				title : '新增 Toggle 滑塊頁籤區塊',
				cmd : 'tinyToggle',
				image : url + '/images/toggle.png'
			});
			ed.addCommand('tinyToggle', function() {
				ed.windowManager.open({file : url + '/ui.php?page=toggle',width : 600 ,	height : 375 ,	inline : 1});
			});

			//Add Tabs
			ed.addButton('Tabs', {
				title : '新增 Tabbed 切換頁籤區塊',
				cmd : 'tinytabs',
				image : url + '/images/tabs.png'
			});
			ed.addCommand('tinytabs', function() {
				ed.windowManager.open({file : url + '/ui.php?page=tabs',width : 600 ,	height : 375 ,	inline : 1});
			});

			//Highlight Text
			ed.addButton('highlight', {  
				title : '高亮顯示文字',  
				image : url+'/images/highlight.png',  
				onclick : function() {
					//if(ed.selection.getContent().length > 0)				
					ed.selection.setContent('[highlight]' + ed.selection.getContent() + '[/highlight]');  
				}  
			});  			
			
			//dropcap Text
			ed.addButton('dropcap', {  
				title : '首字大寫下沉',  
				image : url+'/images/dropcap.png',  
				onclick : function() {
					//if(ed.selection.getContent().length > 0)				
					ed.selection.setContent(' [dropcap]' + ed.selection.getContent() + '[/dropcap]');  
				}  
			});  
				
			//Checklist
			ed.addButton('checklist', {  
				title : '新增檢查清單列表',  
				image : url+'/images/check.png',  
				onclick : function() { 
					//if(ed.selection.getContent().length > 0)								
					ed.selection.setContent('[checklist]' + ed.selection.getContent() + '[/checklist]');  
				}  
			});  
				  
			//starlist
			ed.addButton('starlist', {  
				title : '新增星號清單列表',  
				image : url+'/images/star.png',  
				onclick : function() { 
					//if(ed.selection.getContent().length > 0)								
					ed.selection.setContent('[starlist]' + ed.selection.getContent() + '[/starlist]');  
				}  
			});

			//ShareButtons
			ed.addButton('ShareButtons', {
				title : '新增社交網站分享按鈕',
				cmd : 'tinyShareButtons',
				image : url + '/images/share.png'
			});
			ed.addCommand('tinyShareButtons', function() {
				ed.windowManager.open({file : url + '/ui.php?page=share',width : 600 ,	height : 550 ,	inline : 1});
			});
			
			//Divider
			ed.addButton('divider', {  
				title : '新增分隔線',  
				image : url+'/images/divider.png',  
				onclick : function() { 
					ed.selection.setContent('[divider]');  
				}  
			});
  			
		},
		getInfo : function() {
			return {
				longname : "STFramework Shortcodes",
				author : 'StartPress Team - Carrie',
				authorurl : 'http://startpress.cc',
				infourl : 'http://startpress.cc',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('stfShortCodes', tinymce.plugins.Addshortcodes);	
	
})();