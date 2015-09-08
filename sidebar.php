<?php
	$sidebar = mts_custom_sidebar();
    if ( $sidebar != 'mts_nosidebar' ) {
?>
<aside class="sidebar c-4-12" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">
	<div id="sidebars" class="g">
		<div class="sidebar">
			<?php if (!dynamic_sidebar($sidebar)) : ?>
				<div id="sidebar-search" class="widget">
					<h3 class="widget-title"><?php _e('Search', 'mythemeshop'); ?></h3>
					<?php get_search_form(); ?>
				</div>
				<div id="sidebar-archives" class="widget">
					<h3 class="widget-title"><?php _e('Archives', 'mythemeshop') ?></h3>
					<ul>
						<?php wp_get_archives( 'type=monthly' ); ?>
					</ul>
				</div>
				<div id="sidebar-meta" class="widget">
					<h3 class="widget-title"><?php _e('Meta', 'mythemeshop') ?></h3>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</div>
			<?php endif; ?>
            <?php if(is_single() && get_the_ID() < 1888){?>
            <div class="widget widget_mts_link_slider_widget">
            	<h3>Link</h3>
                <ul>
                    <li class="link-item"><a href="http://www.rolecosplay.com/anime-costume/angel-beats.html" title="Angel Beats Cosplay Costumes">Angel Beats Costumes</a></li>
               </ul>
            </div>
            <?php }?>
            <?php if(is_tag() && trim(single_tag_title('',false)) == 'Sword Art Online'){?>
            <div class="widget widget_mts_link_slider_widget">
            	<h3>Link</h3>
                <ul>
                    <li class="link-item"><a href="http://www.rolecosplay.com/anime-costume/sword-art-online.html" title="Sword Art Online Cosplay Costume">Sword Art Online Costume</a></li>
                    <li class="link-item"><a href="http://www.rolecosplay.com/sword-art-online-kirito-cosplay-costume-for-men.html" title="Kirito Cosplay Costume">Kirito Cosplay</a></li>
               </ul>
            </div>
			<?php }?>
            <?php if(is_tag() && trim(single_tag_title('',false)) == 'Kirito Cosplay'){?>
            <div class="widget widget_mts_link_slider_widget">
            	<h3>Link</h3>
                <ul>
                    <li class="link-item"><a href="http://www.rolecosplay.com/anime-costume/sword-art-online.html" title="Sword Art Online Cosplay Costume">Sword Art Online Cosplay</a></li>
                    <li class="link-item"><a href="http://www.rolecosplay.com/sword-art-online-kirito-cosplay-costume-for-men.html" title="Kirito Cosplay Costume">Kirito Cosplay</a></li>
               </ul>
            </div>
			<?php }?>
            <?php if(is_home()){?>
            <div class="widget widget_mts_link_slider_widget">
            	<h3>Link</h3>
                <ul>
                    <li class="link-item"><a href="http://www.rolecosplay.com/anime-costume/sword-art-online.html" title="Sword Art Online Cosplay Costume">Sword Art Online Costume</a></li>
                    <li class="link-item"><a href="http://www.rolecosplay.com/sword-art-online-kirito-cosplay-costume-for-men.html" title="Kirito Cosplay Costume">Kirito Cosplay</a></li>
               </ul>
            </div>
			<?php }?>
		</div>
	</div><!--sidebars-->
</aside>
<?php } ?>