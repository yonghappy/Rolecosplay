<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<?php get_header(); ?>
<div id="page">
	<div class="article">
		<div id="content_box">
			<h1 class="postsby">
				<span><?php _e("Search Results for:", "mythemeshop"); ?></span> <?php the_search_query(); ?>
			</h1>
			<div class="random-posts latestpost latest-only">
                      <?php $j = 0; if (have_posts()) : while (have_posts()) : the_post(); ?>
                          <article class="latestPost excerpt  <?php echo (++$j % 3 == 0) ? 'last' : ''; ?>" itemscope itemtype="http://schema.org/BlogPosting">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-image post-image-left">
                               <div class="featured-thumbnail">
                                 <?php the_post_thumbnail('featured2',array('class' => 'attachment-featured wp-post-image')); ?>
                                <div class="random-post-overlay">  
                                  <header>
                                    <h2 class="title front-view-title" itemprop="headline"><?php the_title(); ?></h2>
                                  </header>
                                </div>
                               </div> 
                           
                            <div class="post-info">
                                  <?php if ($mts_options['mts_date_show'] == '1') { ?><span class="thetime updated"><span itemprop="datePublished"> <?php the_time( get_option( 'date_format' ) ); ?></span></span><?php } ?>
                                  <?php if ($mts_options['mts_minutes_to_read'] == '1') { ?><span class="mts-minutes-to-read"><?php echo mts_minutes_to_read();?></span><?php } ?>
                            </div>
                             </a>
                        </article> <!--Random-Posts-article-1-->
                       <?php endwhile; else: ?>
                               

                                
				<div class="no-results">
					<h2><?php _e('We apologize for any inconvenience, please hit back on your browser or use the search form below.', 'mythemeshop'); ?></h2>
					<?php get_search_form(); ?>
				</div><!--noResults-->
			<?php endif; ?>
			</div>

			<?php if ( $j !== 0 ) { // No pagination if there is no posts ?>
				<?php mts_pagination(); ?>
			<?php } ?>
		</div>
	</div>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>