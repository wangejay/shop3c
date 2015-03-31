<?php 
/*
Template Name: 文章存檔時間牆
*
* @file 		 template-timeline.php
* @package	 StartPress Business
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://startpress.cc
*/
?>
<?php get_header(); ?>
	<div class="content">
		<?php stf_breadcrumbs() ?>
				
		<?php if ( ! have_posts() ) : ?>
			<div id="post-0" class="post not-found post-listing">
				<h1 class="post-title">沒有任何相關資料</h1>
				<div class="entry">
					<p>很抱歉，但找不到您所要求的資料！或許使用以下的搜尋可以幫助您。</p>
					<?php get_search_form(); ?>
				</div>
			</div>
		<?php endif; ?>
		
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		
		<?php $get_meta = get_post_custom($post->ID);  ?>
		<?php //文章上方的廣告 Banner
		if( empty( $get_meta["stf_hide_above"][0] ) ){
			if( !empty( $get_meta["stf_banner_above"][0] ) ) echo '<div class="ads-post">' .htmlspecialchars_decode($get_meta["stf_banner_above"][0]) .'</div>';
			else stf_banner('banner_above' , '<div class="ads-post">' , '</div>' );
		}
		?>
		<article class="post-listing post">
			<?php get_template_part( 'includes/post-head' ); ?>
			<div class="post-inner">
				<h1 class="post-title"><?php the_title(); ?></h1>
				<p class="post-meta"></p>
				<div class="clear"></div>
				<div class="entry">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . _( '文章分頁:' ), 'after' => '</div>' ) ); ?>
					<?php
					$where = apply_filters( 'getarchives_where', "WHERE post_type = 'post' AND post_status = 'publish'" );
					$join = apply_filters( 'getarchives_join', '' );
					$query = "SELECT YEAR(post_date) AS `year`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date) ORDER BY post_date DESC";
					$key = md5($query);
					$cache = wp_cache_get( 'wp_get_archives' , 'general');
					if ( !isset( $cache[ $key ] ) ) {
						$arcresults = $wpdb->get_results($query);
						$cache[ $key ] = $arcresults;
						wp_cache_set( 'wp_get_archives', $cache, 'general' );
					} else {
						$arcresults = $cache[ $key ];
					}
					if ($arcresults) {
						foreach ( (array) $arcresults as $arcresult) { ?>

						<h2 class="timeline-head"><?php echo $arcresult->year ?></h2>					
						<?php 
						$year = (int) $arcresult->year;
						$query = new WP_Query( 'year='.$year.'&no_found_rows=1&posts_per_page=100' ); ?>
						<ul class="timeline">
						<?php while ( $query->have_posts() ) : $query->the_post()?>
						<li>	
							<span><?php the_time('j F') ?></span><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
						</li>
					<?php endwhile; ?>
						</ul>
					<?php	}
					}	 
					?>
					
				</div><!-- .entry /-->	
			
			</div><!-- .post-inner -->
		</article><!-- .post-listing -->
		<?php endwhile; ?>
		
		<?php wp_reset_query(); ?>
		<?php edit_post_link( _( '編輯' ), '<span class="edit-link">', '</span>' ); ?>

		<?php //文章下方的廣告 Banner
		if( empty( $get_meta["stf_hide_below"][0] ) ){
			if( !empty( $get_meta["stf_banner_below"][0] ) ) echo '<div class="ads-post">' .htmlspecialchars_decode($get_meta["stf_banner_below"][0]) .'</div>';
			else stf_banner('banner_below' , '<div class="ads-post">' , '</div>' );
		}
		?>
		
		<?php comments_template( '', true ); ?>
	</div><!-- .content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>