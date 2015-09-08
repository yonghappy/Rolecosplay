<?php
$mts_options = get_option(MTS_THEME_NAME);
/*------------[ Meta ]-------------*/
if ( ! function_exists( 'mts_meta' ) ) {
	function mts_meta(){
	global $mts_options, $post;
?>
<?php if ( !empty( $mts_options['mts_favicon'] ) ) { ?>
<link rel="icon" href="<?php echo $mts_options['mts_favicon']; ?>" type="image/x-icon" />
<?php } ?>
<?php if ( !empty( $mts_options['mts_metro_icon'] ) ) { ?>
    <!-- IE10 Tile.-->
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="<?php echo $mts_options['mts_metro_icon']; ?>">
<?php } ?>
<!--iOS/android/handheld specific -->
<?php if ( !empty( $mts_options['mts_touch_icon'] ) ) { ?>
    <link rel="apple-touch-icon-precomposed" href="<?php echo $mts_options['mts_touch_icon']; ?>" />
<?php } ?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<?php if($mts_options['mts_prefetching'] == '1') { ?>
<?php if (is_front_page()) { ?>
	<?php $my_query = new WP_Query('posts_per_page=1'); while ($my_query->have_posts()) : $my_query->the_post(); ?>
	<link rel="prefetch" href="<?php the_permalink(); ?>">
	<link rel="prerender" href="<?php the_permalink(); ?>">
	<?php endwhile; wp_reset_query(); ?>
<?php } elseif (is_singular()) { ?>
	<link rel="prefetch" href="<?php echo home_url(); ?>">
	<link rel="prerender" href="<?php echo home_url(); ?>">
<?php } ?>
<?php } ?>
    <meta itemprop="name" content="<?php bloginfo( 'name' ); ?>" />
    <meta itemprop="url" content="<?php echo site_url(); ?>" />
    <?php if ( is_singular() ) { ?>
    <meta itemprop="creator accountablePerson" content="<?php $user_info = get_userdata($post->post_author); echo $user_info->first_name.' '.$user_info->last_name; ?>" />
    <?php } ?>
<?php }
}

/*------------[ Head ]-------------*/
if ( ! function_exists( 'mts_head' ) ){
	function mts_head() {
	global $mts_options
?>
<?php echo $mts_options['mts_header_code']; ?>
<?php }
}
add_action('wp_head', 'mts_head');

/*------------[ Copyrights ]-------------*/
if ( ! function_exists( 'mts_copyrights_credit' ) ) {
	function mts_copyrights_credit() { 
	global $mts_options
?>
<!--start copyrights-->

        <div class="container">       
                <div class="row" id="copyright-note">
                       <span><?php echo date("Y") ?> &copy; copyright&nbsp;<a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></span>
                       <div class="to-top"><?php echo $mts_options['mts_copyrights']; ?>&nbsp; <a href="#blog" id="footer-to-top" class="to-top"><i class="fa fa-angle-double-up"></i></a></div>
                    </div> 
<!--end copyrights-->
            </div>
        
<?php }
}

/*------------[ footer ]-------------*/
if ( ! function_exists( 'mts_footer' ) ) {
	function mts_footer() { 
	global $mts_options
?>
<?php if ($mts_options['mts_analytics_code'] != '') { ?>
<!--start footer code-->
<?php echo $mts_options['mts_analytics_code']; ?>
<!--end footer code-->
<?php } ?>
<?php }
}

/*------------[ breadcrumb ]-------------*/
if (!function_exists('mts_the_breadcrumb')) {
    function mts_the_breadcrumb() {
    	echo '<div><i class="fa fa-home"></i></div> <div typeof="v:Breadcrumb" class="root"><a rel="v:url" property="v:title" href="';
        echo home_url();
        echo '" rel="nofollow">'.sprintf( __( "Home","mythemeshop"));
        echo '</a></div><div><i class="fa fa-caret-right"></i></div>';
        if (is_category() || is_single()) {
            $categories = get_the_category();
            $output = '';
            if($categories){
                foreach($categories as $category) {
                    echo '<div typeof="v:Breadcrumb"><a href="'.get_category_link( $category->term_id ).'" rel="v:url" property="v:title">'.$category->cat_name.'</a></div><div><i class="fa fa-caret-right"></i></div>';
                }
            }
            if (is_single()) {
                echo "<div typeof='v:Breadcrumb'><span property='v:title'>";
                the_title();
                echo "</span></div>";
            }
        } elseif (is_page()) {
            echo "<div typeof='v:Breadcrumb'><span property='v:title'>";
            the_title();
            echo "</span></div>";
        }
    }
}

/*------------[ schema.org-enabled the_category() and the_tags() ]-------------*/
function mts_the_category( $separator = ', ' ) {
    $categories = get_the_category();
    $count = count($categories);
    foreach ( $categories as $i => $category ) {
        echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s", 'mythemeshop' ), $category->name ) . '" ' . ' itemprop="articleSection">' . $category->name.'</a>';
        if ( $i < $count - 1 )
            echo $separator;
    }
}
function mts_the_tags($before = null, $sep = ', ', $after = '') {
    if ( null === $before ) 
        $before = __('Tags: ', 'mythemeshop');
    
    $tags = get_the_tags();
    if (empty( $tags ) || is_wp_error( $tags ) ) {
        return;
    }
    $tag_links = array();
    foreach ($tags as $tag) {
        $link = get_tag_link($tag->term_id);
        $tag_links[] = '<a href="' . esc_url( $link ) . '" rel="tag" itemprop="keywords">' . $tag->name . '</a>';
    }
    echo $before.join($sep, $tag_links).$after;
}

/*------------[ pagination ]-------------*/
if (!function_exists('mts_pagination')) {
    function mts_pagination($pages = '', $range = 3) {
        $mts_options = get_option(MTS_THEME_NAME);
        if (isset($mts_options['mts_pagenavigation_type']) && $mts_options['mts_pagenavigation_type'] == '1' ) { // numeric pagination
            $showitems = ($range * 3)+1;
            global $paged; if(empty($paged)) $paged = 1;
            if($pages == '') {
                global $wp_query; $pages = $wp_query->max_num_pages; 
                if(!$pages){ $pages = 1; } 
            }
            if(1 != $pages) { 
                echo '<div class="pagination pagination-numeric"><ul>';
                
                if($paged > 2 && $paged > $range+1 && $showitems < $pages) 
                    echo "<li><a rel='nofollow' href='".get_pagenum_link(1)."'><i class='fa fa-angle-double-left'></i> ".__('First','mythemeshop')."</a></li>";
                if($paged > 1 && $showitems < $pages) 
                    echo "<li><a rel='nofollow' href='".get_pagenum_link($paged - 1)."' class='inactive'><i class='fa fa-angle-left'></i> ".__('Previous','mythemeshop')."</a></li>";
                for ($i=1; $i <= $pages; $i++){ 
                    if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) { 
                        echo ($paged == $i)? "<li class='current'><span class='currenttext'>".$i."</span></li>":"<li><a rel='nofollow' href='".get_pagenum_link($i)."' class='inactive'>".$i."</a></li>";
                    } 
                } 
                if ($paged < $pages && $showitems < $pages) 
                    echo "<li><a rel='nofollow' href='".get_pagenum_link($paged + 1)."' class='inactive'>".__('Next','mythemeshop')." <i class='fa fa-angle-right'></i></a></li>";
                if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) 
                    echo "<li><a rel='nofollow' class='inactive' href='".get_pagenum_link($pages)."'>".__('Last','mythemeshop')." <i class='fa fa-angle-double-right'></i></a></li>";
                
                echo '</ul></div>';
            }
        } else { // traditional or ajax pagination
            ?>
            <div class="pagination pagination-previous-next">
            <ul>
                <li class="nav-previous"><?php next_posts_link( '<i class="fa fa-angle-left"></i> '. __( 'Previous', 'mythemeshop' ) ); ?></li>
                <li class="nav-next"><?php previous_posts_link( __( 'Next', 'mythemeshop' ).' <i class="fa fa-angle-right"></i>' ); ?></li>
            </ul>
            </div>
            <?php
        }
    }
}

/*------------[ Related Posts ]-------------*/
if (!function_exists('mts_related_posts')) {
    function mts_related_posts() {
        global $post;
        $mts_options = get_option(MTS_THEME_NAME);
        //if(!empty($mts_options['mts_related_posts'])) { ?>	
    		<!-- Start Related Posts -->
    		<?php 
            $empty_taxonomy = false;
            if (empty($mts_options['mts_related_posts_taxonomy']) || $mts_options['mts_related_posts_taxonomy'] == 'tags') {
                // related posts based on tags
                $tags = get_the_tags($post->ID); 
                if (empty($tags)) { 
                    $empty_taxonomy = true;
                } else {
                    $tag_ids = array(); 
                    foreach($tags as $individual_tag) {
                        $tag_ids[] = $individual_tag->term_id; 
                    }
                    $args = array( 'tag__in' => $tag_ids, 
                        'post__not_in' => array($post->ID), 
                        'posts_per_page' => $mts_options['mts_related_postsnum'], 
                        'ignore_sticky_posts' => 1, 
                        'orderby' => 'rand' 
                    );
                }
             } else {
                // related posts based on categories
                $categories = get_the_category($post->ID); 
                if (empty($categories)) { 
                    $empty_taxonomy = true;
                } else {
                    $category_ids = array(); 
                    foreach($categories as $individual_category) 
                        $category_ids[] = $individual_category->term_id; 
                    $args = array( 'category__in' => $category_ids, 
                        'post__not_in' => array($post->ID), 
                        'posts_per_page' => $mts_options['mts_related_postsnum'],  
                        'ignore_sticky_posts' => 1, 
                        'orderby' => 'rand' 
                    );
                }
             }
            if (!$empty_taxonomy) {
    		$my_query = new wp_query( $args ); if( $my_query->have_posts() ) {
    		   echo '<h4 class="single-page-title related-posts-title">'.__('Related Posts','mythemeshop').'</h4>';
            echo '<div class="related-posts most-popular-posts">';
                echo '<div class="clear">';
                $posts_per_row = 3;
                $j = 0;
    			while( $my_query->have_posts() ) { $my_query->the_post(); ?>
                 <article class="latestPost excerpt  <?php echo (++$j % $posts_per_row == 0) ? 'last' : ''; ?>">
                    <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="post-image post-image-left">
                       <div class="featured-thumbnail">
                            <?php the_post_thumbnail('featured2',array('class' => 'attachment-featured wp-post-image')); ?> 
                            <div class="most-popular-hover"> 
                                <header>
                                    <h3 class="title front-view-title" itemprop="headline"><?php the_title(); ?></h3>
                                </header>
                                <div class="front-view-content"> <?php echo mts_excerpt(10); ?></div>
                           </div>
                        </div>
             
                        <div class="post-info">
                            <div class="thetime updated"><div itemprop="datePublished"><?php the_time( get_option( 'date_format' ) ); ?></div></div>
                            <div class="thecomment"><?php if ($mts_options['mts_minutes_to_read'] == '1') { ?><span class="mts-minutes-to-read"><?php echo mts_minutes_to_read();?></span><?php } ?></div>
                        </div>
                    </a>
                </article> <!--Most-Popular-article-4-->
    			<?php } echo '</div></div>'; }} wp_reset_query(); ?>
    		<!-- .related-posts -->
    	<?php }
}


if ( ! function_exists('mts_the_postinfo' ) ) {
    function mts_the_postinfo( $section = 'home' ) {
        $mts_options = get_option( MTS_THEME_NAME );
        $opt_key = 'mts_'.$section.'_headline_meta_info';
        
        if ( isset( $mts_options[ $opt_key ] ) && is_array( $mts_options[ $opt_key ] ) && array_key_exists( 'enabled', $mts_options[ $opt_key ] ) ) {
            $headline_meta_info = $mts_options[ $opt_key ]['enabled'];
        } else {
            $headline_meta_info = array();
        }
        if ( ! empty( $headline_meta_info ) ) { ?>
			<div class="post-info">
                <?php foreach( $headline_meta_info as $key => $meta ) { mts_the_postinfo_item( $key ); } ?>
			</div>
		<?php }
    }
}
if ( ! function_exists('mts_the_postinfo_item' ) ) {
    function mts_the_postinfo_item( $item ) {
        switch ( $item ) {
            case 'author':
            ?>
                <span class="theauthor">By&nbsp;<span itemprop="author"><?php the_author_posts_link(); ?></span></span>
            <?php
            break;
            case 'date':
            ?>
                <span class="thetime updated">On&nbsp;<span itemprop="datePublished"><?php the_time( get_option( 'date_format' ) ); ?></span></span>
            <?php
            break;
           
            case 'comment':
            ?>
                <span class="thecomment"><a rel="nofollow" href="<?php comments_link(); ?>" itemprop="interactionCount"><?php echo comments_number();?></a></span>
            <?php
            break;
        }
    }
}

if (!function_exists('mts_social_buttons')) {
    function mts_social_buttons() {
        $mts_options = get_option( MTS_THEME_NAME );

        if ( isset( $mts_options['mts_social_buttons'] ) && is_array( $mts_options['mts_social_buttons'] ) && array_key_exists( 'enabled', $mts_options['mts_social_buttons'] ) ) {
            $buttons = $mts_options['mts_social_buttons']['enabled'];
        } else {
            $buttons = array();
        }

        if ( ! empty( $buttons ) ) {
        ?>
    		<!-- Start Share Buttons -->
    		<div class="shareit <?php echo $mts_options['mts_social_button_position']; ?>">
                <?php foreach( $buttons as $key => $button ) { mts_social_button( $key ); } ?>
    		</div>
    		<!-- end Share Buttons -->
    	<?php
        }
    }
}

if ( ! function_exists('mts_social_button' ) ) {
    function mts_social_button( $button ) {
        $mts_options = get_option( MTS_THEME_NAME );
        switch ( $button ) {
            case 'twitter':
            ?>
                <!-- Twitter -->
                <span class="share-item twitterbtn">
                    <a href="https://twitter.com/share" class="twitter-share-button" data-via="<?php echo $mts_options['mts_twitter_username']; ?>">Tweet</a>
                </span>
            <?php
            break;
            case 'gplus':
            ?>
                <!-- GPlus -->
                <span class="share-item gplusbtn">
                    <g:plusone size="medium"></g:plusone>
                </span>
            <?php
            break;
            case 'facebook':
            ?>
                <!-- Facebook -->
                <span class="share-item facebookbtn">
                    <div id="fb-root"></div>
                    <div class="fb-like" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false"></div>
                </span>
            <?php
            break;
            case 'pinterest':
                global $post;
            ?>
                <!-- Pinterest -->
                <span class="share-item pinbtn">
                    <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ); echo $thumb['0']; ?>&description=<?php the_title(); ?>" class="pin-it-button" count-layout="horizontal">Pin It</a>
                </span>
            <?php
            break;
            case 'linkedin':
            ?>
                <!--Linkedin -->
                <span class="share-item linkedinbtn">
                    <script type="IN/Share" data-url="<?php get_permalink(); ?>"></script>
                </span>
            <?php
            break;
            case 'stumble':
            ?>
                <!-- Stumble -->
                <span class="share-item stumblebtn">
                    <su:badge layout="1"></su:badge>
                </span>
            <?php
            break;
        }
    }
}

/*------------[ Class attribute for <article> element ]-------------*/
if ( ! function_exists( 'mts_article_class' ) ) {
    function mts_article_class() {
        $mts_options = get_option( MTS_THEME_NAME );
        $class = '';
        
        // sidebar or full width
        if ( mts_custom_sidebar() == 'mts_nosidebar' ) {
            $class = 'ss-full-width';
        } else {
            $class = 'article';
        }
        
        echo $class;
    }
}

/*------------[ Class attribute for #page element ]-------------*/
if ( ! function_exists( 'mts_single_page_class' ) ) {
    function mts_single_page_class() {
        $class = '';

        if ( is_single() || is_page() ) {

            $class = 'single';

            $header_animation = mts_get_post_header_effect();
            if ( !empty( $header_animation )) $class .= ' '.$header_animation;
        }

        echo $class;
    }
}

if ( ! function_exists( 'mts_archive_post' ) ) {
    function mts_archive_post( $layout = '' ) {

        $mts_options = get_option(MTS_THEME_NAME);

        ?>
        <header>
            <h2 class="title front-view-title" itemprop="headline"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
            <?php mts_the_postinfo(); ?>
        </header>
        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow" class="post-image post-image-left">
            <?php echo '<div class="featured-thumbnail">'; the_post_thumbnail('featured',array('title' => '')); echo '</div>'; ?>
            <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
        </a>
        <?php if (empty($mts_options['mts_full_posts'])) : ?>
            <div class="front-view-content">
                <?php echo mts_excerpt(29); ?>
            </div>
            <?php mts_readmore(); ?>
        <?php else : ?>
            <div class="front-view-content full-post">
                <?php the_content(); ?>
            </div>
            <?php if (mts_post_has_moretag()) : ?>
                <?php mts_readmore(); ?>
            <?php endif; ?>
        <?php endif;
    }
}