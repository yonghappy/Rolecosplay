<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<?php get_header(); ?>

<?php if ($mts_options['mts_header_slider'] == '1' ) { ?>
    <div class="full-slider-container clearfix loading">
      <div id="slider" class="full-slider">
       <?php if ( empty( $mts_options['mts_header_slider_cat'] ) || !is_array( $mts_options['mts_header_slider_cat'] ) ) {
              $mts_options['mts_header_slider_cat'] = array('0');
          }

          $slider_cat = implode( ",", $mts_options['mts_header_slider_cat'] );
          $slider_query = new WP_Query('cat='.$slider_cat.'&posts_per_page='.$mts_options['mts_header_slider_num']);
          while ( $slider_query->have_posts() ) : $slider_query->the_post();
          ?>
          <div class="slider-inner"> 
            <a href="<?php the_permalink() ?>">
              <?php the_post_thumbnail('slider1',array('class' => 'attachment-slider wp-post-image')); ?>                                  
              <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
              <div class="slide-caption">
                <div class="post-info"><div class="thecategory" itemprop="articleSection"><?php $i =0; foreach((get_the_category()) as $category) { $i++; if($i==1){echo $category->cat_name;}else{echo ', '.$category->cat_name;} } ?></div></div>
                <h2 class="slide-title"><?php the_title(); ?></h2>
                <div class="slide-description"><?php echo mts_excerpt(20); ?></div>
                <div class="thetime updated"><span itemprop="datePublished"> <?php the_time( get_option( 'date_format' ) ); ?></span></div>
              </div>
            </a> 
          </div>
        <?php endwhile; wp_reset_query(); ?>   
      </div><!-- .primary-slider -->
  </div><!-- .primary-slider-container -->
<?php } ?>

<div id="page">
  <div class="article">
    <div id="content_box">
      <?php if ($mts_options['mts_featured_slider'] == '1' ) { ?>
        <div class="primary-slider-container clearfix loading">
          <div id="slider" class="primary-slider">
            <?php
            // prevent implode error
            if ( empty( $mts_options['mts_featured_slider_cat'] ) || !is_array( $mts_options['mts_featured_slider_cat'] ) ) {
                $mts_options['mts_featured_slider_cat'] = array('0');
            }

            $slider_cat = implode( ",", $mts_options['mts_featured_slider_cat'] );
            $slider_query = new WP_Query('cat='.$slider_cat.'&posts_per_page='.$mts_options['mts_featured_slider_num']);
            while ( $slider_query->have_posts() ) : $slider_query->the_post();
            ?>
              <div> 
                  <a href="<?php the_permalink() ?>">
                      <?php the_post_thumbnail('slider2',array('class' => 'attachment-slider wp-post-image')); ?>                                    
                       <div class="slide-caption">
                          <div class="post-info"><div class="thecategory" itemprop="articleSection"><?php $i =0; foreach((get_the_category()) as $category) { $i++; if($i==1){echo $category->cat_name;}else{echo ', '.$category->cat_name;} } ?></div></div>
                          <h2 class="slide-title"><?php the_title(); ?></h2>
                       </div>
                  </a> 
              </div>
            <?php endwhile; wp_reset_query(); ?>
          </div><!-- .primary-slider -->
        </div><!-- .primary-slider-container -->
      <?php } ?>

      <?php $latest_posts_used = false;
      if ( !empty( $mts_options['mts_featured_categories'] ) ) {
        foreach ( $mts_options['mts_featured_categories'] as $section ) {
          $category_id = $section['mts_featured_category'];
          $featured_category_layout = $section['mts_featured_category_layout'];
          $posts_num = $section['mts_featured_category_postsnum'];
          if( $category_id === 'latest' && $featured_category_layout =='popular' ) {
              $latest_posts_used = true; ?>
          <h3 class="featured-category-title"><?php _e( "Latest", "mythemeshop" ); ?></h3>
          <div class="latestpost most-popular-posts latest-only">
            <?php $j = 1; if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
              <?php if($j == 1) { ?>
                <article class="latestPost latestBig excerpt" itemscope itemtype="http://schema.org/BlogPosting">
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-image post-image-left">
                    <div class="featured-thumbnail">
                      <?php the_post_thumbnail('featured1',array('class' => 'attachment-featured wp-post-image')); ?>
                      <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
                    </div>
                    <header>
                      <h2 class="title front-view-title" itemprop="headline"><?php the_title(); ?></h2>
                      <div class="post-info">
                        <?php if ($mts_options['mts_date_show'] == '1') { ?><span class="thetime updated"><span itemprop="datePublished"> <?php the_time( get_option( 'date_format' ) ); ?></span></span><?php } ?>
                        <?php if ($mts_options['mts_minutes_to_read'] == '1') { ?><span class="mts-minutes-to-read"><?php echo mts_minutes_to_read();?></span><?php } ?>
                      </div>
                    </header>
                  </a>
                </article> <!--Most-Popular-article-1-->
              <?php } else { ?>
                <article class="latestPost most-popular excerpt " itemscope itemtype="http://schema.org/BlogPosting">
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-image post-image-left">
                    <div class="featured-thumbnail">
                      <?php the_post_thumbnail('featured2',array('class' => 'attachment-featured wp-post-image')); ?>
                      <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
                      <div class="most-popular-hover">  
                        <header>
                          <h2 class="title front-view-title" itemprop="headline"><?php the_title(); ?></h2>
                        </header>
                        <div class="front-view-content"><?php echo mts_excerpt(15); ?></div>
                      </div>
                    </div>
                    <div class="post-info">
                      <?php if ($mts_options['mts_date_show'] == '1') { ?><span class="thetime updated"><span itemprop="datePublished"> <?php the_time( get_option( 'date_format' ) ); ?></span></span><?php } ?>
                      <?php if ($mts_options['mts_minutes_to_read'] == '1') { ?><span class="mts-minutes-to-read"><?php echo mts_minutes_to_read();?></span><?php } ?>
                    </div>
                  </a>
                </article> <!--Most-Popular-article-2-->
              <?php }  ?>
            <?php $j++; endwhile; endif; ?>
            <!--Start Pagination-->
            <?php if (isset($mts_options['mts_pagenavigation_type']) && $mts_options['mts_pagenavigation_type'] == '1' ) { ?>
              <?php $additional_loop = 0; mts_pagination($additional_loop['max_num_pages']); ?>
            <?php } else { ?>
              <div class="pagination pagination-previous-next">
                <ul>
                  <li class="nav-previous"><?php next_posts_link( '<i class="fa fa-chevron-left"></i> '. __( 'Previous', 'mythemeshop' ) ); ?></li>
                  <li class="nav-next"><?php previous_posts_link( __( 'Next', 'mythemeshop' ).' <i class="fa fa-chevron-right"></i>' ); ?></li>
                </ul>
              </div>
            <?php } ?>
          </div>
        <?php } elseif( $category_id === 'latest' && $featured_category_layout =='column_3') { ?>
          <h3 class="featured-category-title"><?php _e( "Latest", "mythemeshop" ); ?></h3>
          <div class="random-posts latestpost latest-only">
            <?php  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
              <article class="latestPost excerpt " itemscope itemtype="http://schema.org/BlogPosting">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-image post-image-left">
                  <div class="featured-thumbnail">
                    <?php the_post_thumbnail('featured2',array('class' => 'attachment-featured wp-post-image')); ?>
                    <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
                    <div class="random-post-overlay">  
                      <header>
                        <h2 class="title front-view-title" itemprop="headline"><?php the_title(); ?></h2>
                      </header>
                      <div class="front-view-content">
                        <?php echo mts_excerpt(15); ?>
                      </div>
                    </div>
                  </div> 
                  <div class="post-info">
                    <?php if ($mts_options['mts_date_show'] == '1') { ?><span class="thetime updated"><span itemprop="datePublished"> <?php the_time( get_option( 'date_format' ) ); ?></span></span><?php } ?>
                    <?php if ($mts_options['mts_minutes_to_read'] == '1') { ?><span class="mts-minutes-to-read"><?php echo mts_minutes_to_read();?></span><?php } ?>
                  </div>
                </a>
              </article> <!--Random-Posts-article-1-->
            <?php endwhile; endif; ?>
            <!--Start Pagination-->
            <?php if (isset($mts_options['mts_pagenavigation_type']) && $mts_options['mts_pagenavigation_type'] == '1' ) { ?>
              <?php $additional_loop = 0; mts_pagination($additional_loop['max_num_pages']); ?>
            <?php } else { ?>
              <div class="pagination pagination-previous-next">
                <ul>
                  <li class="nav-previous"><?php next_posts_link( '<i class="fa fa-chevron-left"></i> '. __( 'Previous', 'mythemeshop' ) ); ?></li>
                  <li class="nav-next"><?php previous_posts_link( __( 'Next', 'mythemeshop' ).' <i class="fa fa-chevron-right"></i>' ); ?></li>
                </ul>
              </div>
            <?php } ?>
          </div>
        <?php } elseif ( $category_id === 'latest' && $featured_category_layout =='column_2') { ?>
          <h3 class="featured-category-title"><?php _e( "Latest", "mythemeshop" ); ?></h3>
          <div class="latest-post latestpost latest-only">
            <?php  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
              <article class="latestPost grid-2 excerpt " itemscope itemtype="http://schema.org/BlogPosting">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="nofollow" class="post-image post-image-left">
                   <div class="featured-thumbnail">
                      <?php the_post_thumbnail('featured3',array('class' => 'attachment-featured wp-post-image')); ?>            
                      <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
                    </div>
                    <div class="thecategory" title="<?php the_title(); ?>" itemprop="articleSection"><?php mts_the_category(', ') ?></div>
                </a>
                <header>
                    <h2 class="title front-view-title" itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h2>
                </header>
             
                <div class="post-info">
                      <?php if ($mts_options['mts_date_show'] == '1') { ?><span class="thetime updated"><span itemprop="datePublished"> <?php the_time( get_option( 'date_format' ) ); ?></span></span><?php } ?>
                      <?php if ($mts_options['mts_minutes_to_read'] == '1') { ?><span class="mts-minutes-to-read"><?php echo mts_minutes_to_read();?></span><?php } ?>
                </div>
              </article> <!--Latest-Posts-article-1-->
            <?php endwhile; endif; ?>
            <!--Start Pagination-->
            <?php if (isset($mts_options['mts_pagenavigation_type']) && $mts_options['mts_pagenavigation_type'] == '1' ) { ?>
                <?php $additional_loop = 0; mts_pagination($additional_loop['max_num_pages']); ?>
            <?php } else { ?>
                <div class="pagination pagination-previous-next">
                    <ul>
                        <li class="nav-previous"><?php next_posts_link( '<i class="fa fa-chevron-left"></i> '. __( 'Previous', 'mythemeshop' ) ); ?></li>
                        <li class="nav-next"><?php previous_posts_link( __( 'Next', 'mythemeshop' ).' <i class="fa fa-chevron-right"></i>' ); ?></li>
                    </ul>
                </div>
            <?php } ?>
          </div>
        <?php } elseif ( $category_id === 'latest' && $featured_category_layout =='column_1') { ?>
          <h3 class="featured-category-title"><?php _e( "Latest", "mythemeshop" ); ?></h3>
          <div class="latest-post latestpost latest-only">
           <?php  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
              <article class="latestPost grid-1 excerpt " itemscope itemtype="http://schema.org/BlogPosting">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="nofollow" class="post-image post-image-left">
                  <div class="featured-thumbnail">
                    <?php the_post_thumbnail('featured4',array('class' => 'attachment-featured wp-post-image')); ?>                       
                    <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
                  </div>   
                </a>
                <header>
                  <div class="thecategory" itemprop="articleSection"><a href="#"><?php mts_the_category(' ') ?></a></div>
                  <h2 class="title front-view-title" itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"<?php the_title(); ?></a></h2>
                </header>
                <div class="post-info">
                  <div class="thetime updated"><span itemprop="datePublished"> <?php if ($mts_options['mts_date_show'] == '1') { ?><?php the_time( get_option( 'date_format' ) ); ?><?php } ?></span></div>
                </div>
                <div class="front-view-content">
                  <?php echo mts_excerpt(15); ?>
                </div>
              </article> <!--Latest-Posts-article-3-->
            <?php endwhile; endif; ?>
            <!--Start Pagination-->
            <?php if (isset($mts_options['mts_pagenavigation_type']) && $mts_options['mts_pagenavigation_type'] == '1' ) { ?>
                <?php $additional_loop = 0; mts_pagination($additional_loop['max_num_pages']); ?>
            <?php } else { ?>
                <div class="pagination pagination-previous-next">
                    <ul>
                        <li class="nav-previous"><?php next_posts_link( '<i class="fa fa-chevron-left"></i> '. __( 'Previous', 'mythemeshop' ) ); ?></li>
                        <li class="nav-next"><?php previous_posts_link( __( 'Next', 'mythemeshop' ).' <i class="fa fa-chevron-right"></i>' ); ?></li>
                    </ul>
                </div>
            <?php } ?>

          </div>
        <?php } else {?>
          <?php $cat_query = new WP_Query('cat='.$category_id.'&posts_per_page='.$posts_num); ?>
          <?php if($category_id != 'latest' && $featured_category_layout =='popular') {?>
            <h3 class="featured-category-title"><?php _e( get_cat_name($category_id), "mythemeshop" ); ?></h3>
            <div class="latestpost most-popular-posts">
              <?php $j = 1; if ($cat_query->have_posts()) : while ($cat_query->have_posts()) : $cat_query->the_post();
                if($j == 1) {?>
                  <article class="latestPost latestBig excerpt" itemscope itemtype="http://schema.org/BlogPosting">
                      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-image post-image-left">
                        <div class="featured-thumbnail">
                          <?php the_post_thumbnail('featured1',array('class' => 'attachment-featured wp-post-image')); ?>
                          <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
                        </div>
                          <header>
                             <h2 class="title front-view-title" itemprop="headline"><?php the_title(); ?></h2>
                              <div class="post-info">
                                  <?php if ($mts_options['mts_date_show'] == '1') { ?><span class="thetime updated"><span itemprop="datePublished"> <?php the_time( get_option( 'date_format' ) ); ?></span></span><?php } ?>
                                  <?php if ($mts_options['mts_minutes_to_read'] == '1') { ?><span class="mts-minutes-to-read"><?php echo mts_minutes_to_read(); ?></span><?php } ?>
                              </div>
                          </header>
                      </a>
                  </article> <!--Most-Popular-article-1-->
                <?php } else {?>
                  <article class="latestPost most-popular excerpt " itemscope itemtype="http://schema.org/BlogPosting">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-image post-image-left">
                     <div class="featured-thumbnail">
                        <?php the_post_thumbnail('featured2',array('class' => 'attachment-featured wp-post-image')); ?>
                        <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
                        <div class="most-popular-hover">  
                          <header>
                            <h2 class="title front-view-title" itemprop="headline"><?php the_title(); ?></h2>
                          </header>
                          <div class="front-view-content"><?php echo mts_excerpt(15); ?></div>
                        </div>
                      </div>
                      <div class="post-info">
                        <?php if ($mts_options['mts_date_show'] == '1') { ?><span class="thetime updated"><span itemprop="datePublished"> <?php the_time( get_option( 'date_format' ) ); ?></span></span><?php } ?>
                        <?php if ($mts_options['mts_minutes_to_read'] == '1') { ?><span class="mts-minutes-to-read"><?php echo mts_minutes_to_read();?></span><?php } ?>
                      </div>
                    </a>
                  </article> <!--Most-Popular-article-2-->
                <?php } ?>
              <?php $j++; endwhile; endif; wp_reset_postdata();?>
            </div>
          <?php } else if( $category_id != 'latest' && $featured_category_layout =='column_3') { ?>
            <h3 class="featured-category-title"><?php _e(get_cat_name($category_id), "mythemeshop" ); ?></h3>
            <div class="random-posts latestpost">
              <?php $j = 1; if ($cat_query->have_posts()) : while ($cat_query->have_posts()) : $cat_query->the_post(); ?>
              <article class="latestPost excerpt " itemscope itemtype="http://schema.org/BlogPosting">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-image post-image-left">
                  <div class="featured-thumbnail">
                    <?php the_post_thumbnail('featured2',array('class' => 'attachment-featured wp-post-image')); ?>
                    <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
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
              <?php $j++; endwhile; endif; wp_reset_postdata();?>
            </div>         
          <?php } elseif ( $category_id != 'latest' && $featured_category_layout =='column_2') { ?>
            <h3 class="featured-category-title"><?php _e( get_cat_name($category_id), "mythemeshop" ); ?></h3>
            <div class="latest-post latestpost">
              <?php $j = 1; if ($cat_query->have_posts()) : while ($cat_query->have_posts()) : $cat_query->the_post(); ?>
                <article class="latestPost grid-2 excerpt " itemscope itemtype="http://schema.org/BlogPosting">
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="nofollow" class="post-image post-image-left">
                    <div class="featured-thumbnail">
                      <?php the_post_thumbnail('featured3',array('class' => 'attachment-featured wp-post-image')); ?>            
                      <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
                    </div>
                    <div class="thecategory" title="<?php the_title(); ?>" itemprop="articleSection"><?php mts_the_category(', ') ?></div>
                  </a>
                  <header>
                    <h2 class="title front-view-title" itemprop="headline"><a href="<?php the_permalink(); ?>" title="Most-Popular-title"><?php the_title(); ?></a></h2>
                  </header>
                  <div class="post-info">
                    <?php if ($mts_options['mts_date_show'] == '1') { ?><span class="thetime updated"><span itemprop="datePublished"> <?php the_time( get_option( 'date_format' ) ); ?></span></span><?php } ?>
                    <?php if ($mts_options['mts_minutes_to_read'] == '1') { ?><span class="mts-minutes-to-read"><?php echo mts_minutes_to_read();?></span><?php } ?>
                  </div>
                </article> <!--Latest-Posts-article-1-->
              <?php $j++; endwhile; endif; wp_reset_postdata();?>
            </div>
          <?php } elseif ( $category_id != 'latest' && $featured_category_layout =='column_1') { ?>
            <h3 class="featured-category-title"><?php _e(get_cat_name($category_id), "mythemeshop" ); ?></h3>
            <div class="latest-post latestpost">
              <?php $j = 1; if ($cat_query->have_posts()) : while ($cat_query->have_posts()) : $cat_query->the_post(); ?>
                <article class="latestPost grid-1 excerpt " itemscope itemtype="http://schema.org/BlogPosting">
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="nofollow" class="post-image post-image-left">
                    <div class="featured-thumbnail">
                      <?php the_post_thumbnail('featured4',array('class' => 'attachment-featured wp-post-image')); ?>                       
                      <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
                    </div> 
                  </a>
                  <header>
                    <div class="thecategory" itemprop="articleSection"><?php mts_the_category(' ') ?></div>
                    <h2 class="title front-view-title" itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                  </header>
                  <div class="post-info">
                    <div class="thetime updated"><span itemprop="datePublished"><?php if ($mts_options['mts_date_show'] == '1') { ?><?php the_time( get_option( 'date_format' ) ); ?><?php } ?></span></div>
                  </div>
                  <div class="front-view-content">
                    <?php echo mts_excerpt(15); ?>
                  </div>
                </article> <!--Latest-Posts-article-3-->
              <?php $j++; endwhile; endif; wp_reset_postdata();?>
            </div>
          <?php }
        }
      }
    } ?>
  </div>
  </div>
  <?php get_sidebar(); ?>
  <?php get_footer(); ?>