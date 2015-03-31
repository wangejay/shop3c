<?php
/**
* Header
*
* @file 		 header.php
* @package	 StartPress Business
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://startpress.cc
*/
?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title( ' » ', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
	<?php wp_head(); ?>
</head>
<?php global $is_IE ?>
<body id="top" <?php body_class(); ?>>
<?php if( stf_get_option('banner_bg_url') && stf_get_option('banner_bg') ): ?>
	<a href="<?php echo stf_get_option('banner_bg_url') ?>" target="_blank" class="background-cover"></a>
<?php else: ?>
	<div class="background-cover"></div>
<?php endif; ?>
	<?php $full_width =''; if( stf_get_option( 'full_logo' ) ) $full_width = ' full-logo';
		  $center_logo =''; if( stf_get_option( 'center_logo' ) ) $center_logo = ' center-logo';
	?>
		<header id="theme-header" class="theme-header<?php echo $full_width.$center_logo ?>">
			<?php if(!stf_get_option( 'top_menu' )): ?>
			<div class="top-nav">
			<?php if(stf_get_option( 'top_date' )):
				if( stf_get_option('todaydate_format') ) $date_format = stf_get_option('todaydate_format');
				else $date_format = 'l , j F Y';
			?>
				<span class="today-date">
					<?php echo date_i18n( $date_format , current_time( 'timestamp' ) ); ?>
				</span>
				<?php endif; ?>
				
				<?php wp_nav_menu( array( 'container_class' => 'top-menu', 'theme_location' => 'top-menu', 'fallback_cb' => 'stf_nav_fallback' ) ); ?>
				
	<?php if(stf_get_option( 'top_right' ) == 'search'): ?>
					<div class="search-block">
						<form method="get" id="searchform-header" action="<?php echo home_url(); ?>/">
							<button class="search-button" type="submit" value="<?php if( !$is_IE ) "搜尋" ?>"></button>
							<input type="text" id="s" name="s" value="搜尋..." onfocus="if (this.value == '搜尋...') {this.value = '';}" onblur="if (this.value == '') {this.value = '搜尋';}" />
						</form>
					</div><!-- end .search-block /-->
	<?php elseif( stf_get_option('top_right') == 'social' ):
		stf_get_social( 'yes' , 16 , 'tooldown' ); ?>
	<?php endif; ?>
	
	<?php stf_language_selector_flags(); ?>
	
			</div><!-- end .top-menu /-->
			<?php endif; ?>
		
		<div class="header-content">
<?php if( is_category() || is_single() ){
	if( is_category() ) $category_id = get_query_var('cat');
	if( is_single() ){
		$categories = get_the_category( $post->ID );
		$category_id = $categories[0]->term_id;
	}
	$cat_options = get_option( "stf_cat_$category_id" );
}

if( !empty($cat_options['cat_custom_logo']) ){
	$logo_margin =''; if( $cat_options['logo_margin'] ) $logo_margin = ' style="margin-top:'.$cat_options['logo_margin'].'px"'; ?>
			<div class="logo"<?php echo $logo_margin ?>>
			<h2>
<?php if( $cat_options['logo_setting'] == 'title' ): ?>
				<a href="<?php echo home_url() ?>/"><?php echo single_cat_title( '', false ) ?></a>
				<?php else : ?>
				<?php if( !empty($cat_options['logo']) ) $logo = $cat_options['logo'];
				elseif( stf_get_option( 'logo' ) ) $logo = stf_get_option( 'logo' );
					else $logo = get_stylesheet_directory_uri().'images/logo.png';
				?>
				<a title="<?php bloginfo('name'); ?>" href="<?php echo home_url(); ?>/">
					<img src="<?php echo $logo ; ?>" alt="<?php echo single_cat_title( '', false ) ?>" />
					<strong><?php echo single_cat_title( '', false ) ?></strong>
				</a>
<?php endif; ?>
			</h2>
			</div><!-- end .logo /-->
<?php
}else{
	$logo_margin =''; if( stf_get_option( 'logo_margin' ) ) $logo_margin = ' style="margin-top:'.stf_get_option( 'logo_margin' ).'px"'; ?>
			<div class="logo"<?php echo $logo_margin ?>>
			<?php if( is_home() ) echo '<h1>'; else echo '<h2>'; ?>
<?php if( stf_get_option('logo_setting') == 'title' ): ?>
				<a href="<?php echo home_url() ?>/"><?php bloginfo('name'); ?></a>
				<span><?php bloginfo( 'description' ); ?></span>
				<?php else : ?>
				<?php if( stf_get_option( 'logo' ) ) $logo = stf_get_option( 'logo' );
						else $logo = get_stylesheet_directory_uri().'/images/logo.png';
				?>
				<a title="<?php bloginfo('name'); ?>" href="<?php echo home_url(); ?>/">
					<img src="<?php echo $logo ; ?>" alt="<?php bloginfo('name'); ?>" /><strong><?php bloginfo('name'); ?> <?php bloginfo( 'description' ); ?></strong>
				</a>
<?php endif; ?>
			<?php if( is_home() ) echo '</h1>'; else echo '</h2>'; ?>
			</div><!-- end .logo /-->
<?php } ?>
			<?php stf_banner('banner_top' , '<div class="ads-top">' , '</div>'); ?>
			<div class="clear"></div>
		</div><!-- end .top-nav /-->
		<?php $stick = ''; ?>	
		<?php if( stf_get_option( 'stick_nav' ) ) $stick = 'class="fixed-enabled"' ?>
			<?php if(!stf_get_option( 'main_nav' )): ?>
			<nav id="main-nav"<?php echo $stick; ?>>
				<?php $orig_post = $post; wp_nav_menu( array( 'container_class' => 'main-menu', 'theme_location' => 'primary' ,'fallback_cb' => 'tie_nav_fallback'  ) ); $post = $orig_post; ?>
			</nav><!-- end .main-nav /-->
			<?php endif; ?>
		</header><!-- end #header /-->
	
	<?php get_template_part( 'includes/breaking-news' ); // 獲取即時新聞的模版 ?>
<?php
$sidebar = '';
if( stf_get_option( 'sidebar_pos' ) == 'left' ) $sidebar = ' sidebar-left';
if( is_singular() ){

	$current_ID = $post->ID;
	
	$get_meta = get_post_custom( $current_ID );
	if( !empty($get_meta["stf_sidebar_pos"][0]) ){
		$sidebar_pos = $get_meta["stf_sidebar_pos"][0];
		
		if( $sidebar_pos == 'left' ) $sidebar = ' sidebar-left';
		elseif( $sidebar_pos == 'full' ) $sidebar = ' full-width';
		elseif( $sidebar_pos == 'right' ) $sidebar = ' sidebar-right';
	}
}
?>
	<div id="main-content" class="container<?php echo $sidebar ; ?>">