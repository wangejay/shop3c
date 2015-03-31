<?php
/**
* 文章分享函式
*
* @file 		 post-share.php
* @package	 StartPress Company
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://carrielis.com
*/
global $post;
$share_box_class= "mini-share-post";
if( is_singular() ) $share_box_class = "share-post";
?>
<div class="<?php echo $share_box_class ?>">
	<span class="share-text">分享此文！</span>
	<script>
	window.___gcfg = {lang: 'zh-TW'};
	(function(w, d, s) {
	  function go(){
		var js, fjs = d.getElementsByTagName(s)[0], load = function(url, id) {
		  if (d.getElementById(id)) {return;}
		  js = d.createElement(s); js.src = url; js.id = id;
		  fjs.parentNode.insertBefore(js, fjs);
		};
		load('//connect.facebook.net/en/all.js#xfbml=1', 'fbjssdk');
		load('https://apis.google.com/js/plusone.js', 'gplus1js');
		load('//platform.twitter.com/widgets.js', 'tweetjs');
	  }
	  if (w.addEventListener) { w.addEventListener("load", go, false); }
	  else if (w.attachEvent) { w.attachEvent("onload",go); }
	}(window, document, 'script'));
	</script>
	<ul>			
	<?php if( stf_get_option( 'share_tweet' ) ): ?>
		<li><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-via="<?php echo stf_get_option( 'share_twitter_username' ) ?>" data-lang="en">tweet</a></li>
	<?php endif; ?>
	<?php if( stf_get_option( 'share_facebook' ) ): ?>
		<li>
			<div id="fb-root"></div>
			<div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false"></div>
		</li>
	<?php endif; ?>
	<?php if( stf_get_option( 'share_google' ) ): ?>
		<li style="width:80px;"><div class="g-plusone" data-size="medium" data-href="<?php the_permalink(); ?>"></div>
		</li>
	<?php endif; ?>
	<?php if( stf_get_option( 'share_linkdin' ) ): ?>
		<li><script src="http://platform.linkedin.com/in.js" type="text/javascript"></script><script type="IN/Share" data-url="<?php the_permalink(); ?>" data-counter="right"></script></li>
	<?php endif; ?>
	<?php if( stf_get_option( 'share_pinterest' ) ): ?>
		<li style="width:80px;"><script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo stf_thumb_src( 'slider' ); ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="http://assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></li>
	<?php endif; ?>
	</ul>
	<div class="clear"></div>
</div> <!-- .share-post -->