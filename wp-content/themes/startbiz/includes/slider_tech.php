<?php
/**
* 幻燈片函式
*
* @file 		 slider.php
* @package	 StartPress Business
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://startpress.cc
*/
if( stf_get_option( 'slider_tech' ) ):

	global $post;
	$orig_post = $post;
		
	$size = 'slider' ;
	if( stf_get_option( 'slider_pos' ) == 'big') {
		$size = 'big-slider' ;
	}
	$fea_tags = $sep = '';
	$number = stf_get_option( 'slider_number' );
	$slider_query = stf_get_option( 'slider_tech_query' );
	$caption_length = stf_get_option( 'slider_caption_length' );
	if( empty($caption_length) || $caption_length == ' ' || !is_numeric($caption_length))	$caption_length = 100;

	if( $slider_query == 'custom' ){
		$custom_slider_id = stf_get_option( 'slider_tech_custom' );
		
		$get_custom_slider = get_post_custom( $custom_slider_id );
		$custom_slider = unserialize( $get_custom_slider["custom_slider"][0] );
		$number = count($custom_slider);
	}else{
		if( $slider_query  == 'tag'){
			$tags = explode (' , ' , stf_get_option('slider_tag'));
			foreach ($tags as $tag){
				$theTagId = get_term_by( 'name', $tag, 'post_tag' );
				if( !empty($fea_tags) ) $sep = ' , ';
				$fea_tags .=  $sep . $theTagId->slug;
			}
			$args= array('posts_per_page'=> $number , 'tag' => $fea_tags, 'no_found_rows' => 1 );
		}
		elseif( $slider_query  == 'category'){
			$args= array('posts_per_page'=> $number , 'category__in' => stf_get_option('slider_cat'), 'no_found_rows' => 1 );
		}
		elseif( $slider_query  == 'post'){
			$posts_var = explode (',' , stf_get_option('slider_posts'));
			$args= array('posts_per_page'=> $number , 'post_type' => 'post', 'post__in' => $posts_var, 'no_found_rows' => 1 );
		}
		elseif( $slider_query  == 'page'){
			$pages_var = explode (',' , stf_get_option('slider_pages'));
			$args= array('posts_per_page'=> $number , 'post_type' => 'page', 'post__in' => $pages_var, 'no_found_rows' => 1 );
		}
	
		$featured_query = new wp_query( $args );
	}
	
	
if( stf_get_option('slider_type') == 'elastic' ):

	$effect = stf_get_option( 'elastic_slider_effect' );
	$autoplay = stf_get_option( 'elastic_slider_autoplay' );
	$speed = stf_get_option( 'elastic_slider_speed' );
	$interval = stf_get_option( 'elastic_slider_interval' );
	
	if( !$speed || $speed == ' ' || !is_numeric($speed))	$speed = 800 ;
	if( !$interval || $interval == ' ' || !is_numeric($interval))	$interval = 3000;
	
	if( $effect == 'sides' ) $effect = 'sides';
	else $effect = 'center';

	if( $autoplay ) $autoplay = 'true';
	else $autoplay = 'false';
?>

<?php if( $slider_query != 'custom' ): ?>		
	<?php if( $featured_query->have_posts() ) : ?>
	<div id="ei-slider" class="ei-slider">
		<ul class="ei-slider-large">
		<?php $i= 0;
			while ( $featured_query->have_posts() ) : $featured_query->the_post(); $i++; ?>
			<li>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink(); ?>"><?php stf_thumb( $size ); ?></a>
			<?php endif; ?>
				<div class="ei-title">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php if (stf_get_option( 'slider_caption' )) : ?><h3><?php echo stf_content_limit( get_the_excerpt() , $caption_length ) ?></h3><?php endif; ?>
				</div>
			</li>
		<?php endwhile;?>
		</ul>
		 <ul class="ei-slider-thumbs">
			<li class="ei-slider-element">目前</li>
		<?php $i= 0;
			while ( $featured_query->have_posts() ) : $featured_query->the_post(); $i++; ?>
			<li><a href="#">幻燈片 <?php echo $i; ?><?php stf_thumb( 'stf-medium' ); ?></a></li>
    		<?php endwhile;?>
		</ul><!-- ei-slider-thumbs -->
	</div>
	<?php endif; ?>
<?php else: ?>
					
	<div id="ei-slider" class="ei-slider">
		<ul class="ei-slider-large">
		<?php $i= 0;
			if( $custom_slider ){
			foreach( $custom_slider as $slide ): ?>
			<li>
			<?php if( !empty( $slide['link'] ) ):?><a href="<?php  echo stripslashes( $slide['link'] )  ?>"><?php endif; ?>
				<img src="<?php echo stf_slider_img_src( $slide['id'] , $size ) ?>" alt="<?php  echo stripslashes( $slide['title'] )  ?>" />
				<?php if( !empty( $slide['link'] ) ):?></a><?php endif; ?>
				<?php if( !empty( $slide['title'] ) || !empty( $slide['caption'] ) ) :?>
				<div class="ei-title">
					<?php if( !empty( $slide['title'] ) ):?>
					<h2><?php if( !empty( $slide['link'] ) ):?><a href="<?php  echo stripslashes( $slide['link'] )  ?>"><?php endif; ?>
						<?php  echo stripslashes( $slide['title'] )  ?>
						<?php if( !empty( $slide['link'] ) ):?></a><?php endif; ?>
					</h2>
					<?php endif; ?>
					<?php if( !empty( $slide['caption'] ) ):?><h3><?php echo stripslashes($slide['caption']) ; ?></h3><?php endif; ?>
				</div>
				<?php endif; ?>
			</li>
			<?php endforeach; ?>
			
		</ul>
		
		 <ul class="ei-slider-thumbs">
			<li class="ei-slider-element">目前</li>
			<?php $i= 0; foreach( $custom_slider as $slide ): $i++; ?>	
			<li><a href="#">幻燈片 <?php echo $i; ?></a><img src="<?php echo stf_slider_img_src($slide['id'] , 'stf-medium' ); ?>" alt="<?php  echo stripslashes( $slide['title'] )  ?>" /></li>
			<?php endforeach; ?>
			
		</ul><!-- ei-slider-thumbs -->
	
	<?php
		}?>
	</div>
	
	
<?php endif; ?>

        <script type="text/javascript">
            jQuery(function() {
                jQuery('#ei-slider').eislideshow({
					animation			: '<?php echo $effect ?>',
					autoplay			: <?php echo $autoplay ?>,
					slideshow_interval	: <?php echo $interval ?>,
					speed          		: <?php echo $speed ?>,
					titlesFactor		: 0.60,
					titlespeed          : 1000,
					thumbMaxWidth       : 100
                });
            });
        </script>
					
	<?php
	
else:
	
	$effect = stf_get_option( 'flexi_slider_effect' );
	$speed = stf_get_option( 'flexi_slider_speed' );
	$time = stf_get_option( 'flexi_slider_time' );
	
	if( !$speed || $speed == ' ' || !is_numeric($speed))	$speed = 7000 ;
	if( !$time || $time == ' ' || !is_numeric($time))	$time = 600;
	
	if( $effect == 'slideV' )
			$effect = 'animation: "slide",
					  direction: "vertical",';
	elseif( $effect == 'slideH' )
				$effect = 'animation: "slide",';
	else
		$effect = 'animation: "fade",'; ?>


<?php if( $slider_query != 'custom' ): ?>		
	<?php if( $featured_query->have_posts() ) : ?>
	<div id="flexslider" class="flexslider">
		<ul class="slides">
		<?php while ( $featured_query->have_posts() ) : $featured_query->the_post()?>
			<li>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
				<a href="<?php the_permalink(); ?>">
				<?php stf_thumb( $size ); ?>
				</a>
			<?php endif; ?>
				<div class="slider-caption">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php if (stf_get_option( 'slider_caption' )) : ?><p><?php echo stf_content_limit( get_the_excerpt() , $caption_length ) ?></p><?php endif; ?>
				</div>
			</li>
		<?php endwhile;?>
		</ul>
	</div>
	<?php endif; ?>
<?php else: ?>
	<div class="flexslider" id="flexslider">
		<ul class="slides">
		<?php
			if( $custom_slider ){
			foreach( $custom_slider as $slide ): ?>
			<li>
				<?php if( !empty( $slide['link'] ) ):?><a href="<?php  echo stripslashes( $slide['link'] )  ?>"><?php endif; ?>
				<img src="<?php echo stf_slider_img_src( $slide['id'] , $size ) ?>" alt="" />
				<?php if( !empty( $slide['link'] ) ):?></a><?php endif; ?>
				<?php if( !empty( $slide['title'] ) || !empty( $slide['caption'] ) ) :?>
				<div class="slider-caption">
					<?php if( !empty( $slide['title'] ) ):?><h2><?php if( !empty( $slide['link'] ) ):?><a href="<?php  echo stripslashes( $slide['link'] )  ?>"><?php endif; ?><?php  echo stripslashes( $slide['title'] )  ?><?php if( !empty( $slide['link'] ) ):?></a><?php endif; ?></h2><?php endif; ?>
					<?php if( !empty( $slide['caption'] ) ):?><p><?php echo stripslashes($slide['caption']) ; ?></p><?php endif; ?>
				</div>
				<?php endif; ?>
			</li>
			<?php endforeach; 
			}?>
		</ul>
	</div>
<?php endif; ?>

<script>
jQuery(document).ready(function() {
  jQuery('#flexslider').flexslider({
    <?php echo $effect  ?>
	slideshowSpeed: <?php echo $speed ?>,
	animationSpeed: <?php echo $time ?>,
	randomize: false,
	pauseOnHover: true,
	prevText: "",
	nextText: "",
	after: function(slider) {
		jQuery('#flexslider .slider-caption').animate({bottom:12,}, 400)
	},
	before: function(slider) {
		jQuery('#flexslider .slider-caption').animate({ bottom:-105,}, 400)
	},	
	start: function(slider) {
       	var slide_control_width = 100/<?php echo $number; ?>;
    	jQuery('#flexslider .flex-control-nav li').css('width', slide_control_width+'%');
		jQuery('#flexslider .slider-caption').animate({ bottom:12,}, 400)
	}
  });
});
</script>

	<?php
		endif;
		$post = $orig_post;
		wp_reset_query();
	?>
<?php endif; ?>