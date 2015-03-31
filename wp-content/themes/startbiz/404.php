<?php 
/**
* 404 錯誤頁面
*
* @file 		 404.php
* @package	 StartPress Business
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://startpress.cc
*/
get_header(); ?>
	<div class="content">
			
		<div class="post-listing post error404">
			<div class="post-inner">
				<h2 class="post-title">沒有任何相關資料</h2>
				<div class="clear"></div>
				<div class="entry">
				    <p>很抱歉，但找不到您所要求的資料！或許使用以下的搜尋可以幫助您。</p>

					<div id="sitemap">
						<div class="sitemap-col">
							<h2>本站所有頁面</h2>
							<ul id="sitemap-pages"><?php wp_list_pages('title_li='); ?></ul>
						</div> <!-- end .sitemap-col -->
							
						<div class="sitemap-col">
							<h2>本站分類目錄</h2>
							<ul id="sitemap-categories"><?php wp_list_categories('title_li='); ?></ul>
						</div> <!-- end .sitemap-col -->
							
						<div class="sitemap-col">
							<h2>本站文章標籤</h2>
							<ul id="sitemap-tags">
								<?php $tags = get_tags();
								if ($tags) {
									foreach ($tags as $tag) {
										echo '<li><a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a></li> ';
									}
								} ?>
							</ul>
						</div> <!-- end .sitemap-col -->
														
						<div class="sitemap-col<?php echo ' last'; ?>">
							<h2>本站作者</h2>
							<ul id="sitemap-authors" ><?php wp_list_authors('optioncount=1&exclude_admin=0'); ?></ul>
						</div> <!-- end .sitemap-col -->
					
					</div> <!-- end #sitemap -->
						
				</div><!-- .entry /-->	
			
			</div><!-- .post-inner -->
		</div><!-- .post-listing -->
	</div>
<?php get_footer(); ?>