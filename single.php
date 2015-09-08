<?php get_header(); ?>
<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<?php if ($mts_options['mts_header_slider'] == '1' ) { ?>
	<div class="full-slider-container clearfix loading">
	    <div id="slider" class="full-slider">
	        <?php // prevent implode error
	        if ( empty( $mts_options['mts_header_slider_cat'] ) || !is_array( $mts_options['mts_header_slider_cat'] ) ) {
	            $mts_options['mts_header_slider_cat'] = array('0');
	        }

	        $slider_cat = implode( ",", $mts_options['mts_header_slider_cat'] );
	        $slider_query = new WP_Query('cat='.$slider_cat.'&posts_per_page='.$mts_options['mts_header_slider_num']);
	        while ( $slider_query->have_posts() ) : $slider_query->the_post(); ?>
	            <div class="slider-inner"> 
	                <a href="<?php the_permalink() ?>">
	                    <?php the_post_thumbnail('slider1',array('class' => 'attachment-slider wp-post-image')); ?>                                  
	                    <div class="slide-caption">
	                        <div class="post-info"><div class="thecategory" title="View all posts in Content" itemprop="articleSection"><?php mts_the_category(', ') ?></div></div>
	                        <h2 class="slide-title"><?php the_title(); ?></h2>
	                        <div class="slide-description"><?php the_excerpt(20); ?></div>
	                        <div class="thetime updated"><span itemprop="datePublished"> <?php the_time( get_option( 'date_format' ) ); ?></span></div>
	                    </div>
	                </a> 
	            </div>
	    	<?php endwhile; wp_reset_query(); ?>   
	    </div><!-- .primary-slider -->
	</div><!-- .primary-slider-container -->
<?php } ?>

<div id="page" class="<?php mts_single_page_class(); ?>">
	
	<?php $header_animation = mts_get_post_header_effect(); ?>
	<?php if ( 'parallax' === $header_animation ) {?>
		<?php if (mts_get_thumbnail_url()) : ?>
	        <div id="parallax" <?php echo 'style="background-image: url('.mts_get_thumbnail_url().');"'; ?>></div>
	    <?php endif; ?>
	<?php } else if ( 'zoomout' === $header_animation ) {?>
		 <?php if (mts_get_thumbnail_url()) : ?>
	        <div id="zoom-out-effect"><div id="zoom-out-bg" <?php echo 'style="background-image: url('.mts_get_thumbnail_url().');"'; ?>></div></div>
	    <?php endif; ?>
	<?php } ?>

	<article class="<?php mts_article_class(); ?>" itemscope itemtype="http://schema.org/BlogPosting">
		<div id="content_box" >
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class('g post'); ?>>
					<?php if ($mts_options['mts_breadcrumb'] == '1') { ?>
						<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#"><?php mts_the_breadcrumb(); ?></div>
					<?php } ?>
					
					<?php
					// Single post parts ordering
					if ( isset( $mts_options['mts_single_post_layout'] ) && is_array( $mts_options['mts_single_post_layout'] ) && array_key_exists( 'enabled', $mts_options['mts_single_post_layout'] ) ) {
						$single_post_parts = $mts_options['mts_single_post_layout']['enabled'];
					} else {
						$single_post_parts = array( 'content' => 'content', 'related' => 'related', 'author' => 'author' );
					}
					foreach( $single_post_parts as $part => $label ) { 
						switch ($part) {
							case 'content':
								?>
								<div class="single_post">
									
				                    <header>
					                    <?php if ($mts_options['mts_category_show'] == '1') { ?>
				                        <div class="thecategory" title="View all posts in Content" itemprop="articleSection"><?php mts_the_category(', ') ?></div>
				                        <?php } ?>
						                <h1 class="title single-title entry-title" itemprop="headline"><?php the_title(); ?></h1>
									    <?php mts_the_postinfo( 'single' ); ?>
							    	</header><!--.headline_area-->
								
									<div class="post-single-content box mark-links entry-content">
											<?php if ($mts_options['mts_posttop_adcode'] != '') { ?>
												<?php $toptime = $mts_options['mts_posttop_adcode_time']; if (strcmp( date("Y-m-d", strtotime( "-$toptime day")), get_the_time("Y-m-d") ) >= 0) { ?>
													<div class="topad">
														<?php echo do_shortcode($mts_options['mts_posttop_adcode']); ?>
													</div>
												<?php } ?>
											<?php } ?>
											<?php if (isset($mts_options['mts_social_button_position']) && $mts_options['mts_social_button_position'] !== 'bottom') mts_social_buttons(); ?>
		
											<div class="thecontent" itemprop="articleBody">
												<?php the_content(); ?>
												<?php if ($mts_options['mts_tag_show'] == '1') { ?>
													<div class="tags">
													<?php mts_the_tags('<span class="tagtext">'.__('Tags','mythemeshop').':</span>',' ') ?>
													</div>
												<?php } ?>
											</div>

											<?php if ($mts_options['mts_postend_adcode'] != '') { ?>
												<?php $endtime = $mts_options['mts_postend_adcode_time']; if (strcmp( date("Y-m-d", strtotime( "-$endtime day")), get_the_time("Y-m-d") ) >= 0) { ?>
													<div class="bottomad">
														<?php echo do_shortcode($mts_options['mts_postend_adcode']); ?>
													</div>
												<?php } ?>
											<?php } ?> 
										
										<?php if (empty($mts_options['mts_social_button_position']) || $mts_options['mts_social_button_position'] == 'bottom') mts_social_buttons(); ?>
									</div><!--.post-single-content-->
								</div>
							<?php break;

							case 'related':
								mts_related_posts();
							break;

							case 'author': ?>
								<h4 class="single-page-title"><?php _e('About The Author', 'mythemeshop'); ?></h4>
           						<div class="postauthor">
		        					<?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '100' );  } ?>
	        						<h5 class="vcard"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="nofollow" class="fn"><?php the_author_meta( 'nickname' ); ?></a></h5>
									<p><?php the_author_meta('description') ?></p>
        						</div>
							<?php break;
						}
					} ?>
				</div><!--.g post-->
				 <div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'rolecosplay'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
			<?php endwhile; /* end loop */ ?>
		</div>
	</article>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>