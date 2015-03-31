<?php 
/**
* 即時新聞函式
*
* @file 		 breaking-news.php
* @package	 StartPress Company
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://carrielis.com
*/
if( stf_get_option('breaking_news') && (  !stf_get_option('breaking_home') || ( stf_get_option('breaking_home') && is_home() ) ) ):
	$query = stf_get_option('breaking_type');
	$cat = stf_get_option('breaking_cat');
	$tag = stf_get_option('breaking_tag');
	$breaking_custom = stf_get_option('breaking_custom');
	$title = stf_get_option('breaking_title');
	$number = stf_get_option('breaking_number');
	$effect = stf_get_option('breaking_effect');
	$speed =  stf_get_option('breaking_speed') ;
	$timeout = stf_get_option('breaking_time') ;

	if( !$number || $number == ' ' || !is_numeric($number) )	$number = 5;
	if( !$effect )	$effect = 'fade';
	if( !$speed || $speed == ' ' || !is_numeric($speed))	$speed = 750 ;
	if( !$timeout || $timeout == ' ' || !is_numeric($timeout))	$timeout = 3500; ?>
	
	<div class="breaking-news">
		<span><?php if( $title ) echo $title; else '即時新聞' ; ?></span>
		<?php
			global $post;
			$orig_post = $post;
		?>
		
		<?php
		if( $query != 'custom' ):
			if( $query == 'tag' ){
				$tags = explode (',' , $tag );
				foreach ($tags as $tag){
					$theTagId = get_term_by( 'name', $tag, 'post_tag' );
					if($fea_tags) $sep = ' , ';
					$fea_tags .=  $sep . $theTagId->slug;
				}
				$args=array('tag' => $fea_tags, 'posts_per_page'=> $number, 'no_found_rows' => 1 );
			}else{
				$args=array('category__in' => $cat, 'posts_per_page'=> $number, 'no_found_rows' => 1 );
			}
			
			$breaking_query = new wp_query( $args  );
			
			if( $breaking_query->have_posts() ) : $count=0; ?>
			<ul>
			<?php while( $breaking_query->have_posts() ) : $breaking_query->the_post();	$count++;?>
				<li><a href="<?php the_permalink()?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
			<?php endwhile; ?>
			</ul>
			<?php endif; ?>
		
		<?php else: ?>
			<?php if( is_array( $breaking_custom ) ){ ?>
			<ul>
				<?php foreach ($breaking_custom as $custom_text) {  ?>
				<li><a href="<?php echo $custom_text['link'] ?>" title="<?php echo $custom_text['text'] ?>"><?php echo $custom_text['text'] ?></a></li>				
			<?php } ?>
			</ul>
			<?php }	?>
		<?php endif; ?>
		<?php $post = $orig_post; ?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				<?php if( $effect == 'ticker' ): ?>
				createTicker(); 
				<?php else: ?>
				jQuery('.breaking-news ul').innerfade({animationtype: '<?php echo $effect ?>', speed: <?php echo $speed ?> , timeout: <?php echo $timeout ?>});
				<?php endif; ?>
			});
		</script>
	</div> <!-- .breaking-news -->
<?php endif; ?>