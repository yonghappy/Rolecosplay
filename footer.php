<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<?php
// default = 3
$first_footer_num  = empty($mts_options['mts_first_footer_num']) ? 3 : $mts_options['mts_first_footer_num'];
$second_footer_num = empty($mts_options['mts_second_footer_num']) ? 3 : $mts_options['mts_second_footer_num'];
?>
	</div><!--#page-->
	<footer class="footer clearfix" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
        <div class="container">
            <?php if ($mts_options['mts_first_footer']) : ?>
                <div class="footer-widgets first-footer-widgets widgets-num-<?php echo $first_footer_num; ?>">
                <?php
                for ( $i = 1; $i <= $first_footer_num; $i++ ) {
                    $sidebar = ( $i == 1 ) ? 'footer-first' : 'footer-first-'.$i;
                    $class = ( $i == $first_footer_num ) ? 'f-widget last f-widget-'.$i : 'f-widget f-widget-'.$i;
                    ?>
                    <div class="<?php echo $class;?>">
                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( $sidebar ) ) : ?><?php endif; ?>
                    </div>
                    <?php
                }
                ?>
                </div><!--.first-footer-widgets-->
            <?php endif; ?>
            
            <?php if ($mts_options['mts_second_footer']) : ?>
                <div class="footer-widgets second-footer-widgets widgets-num-<?php echo $second_footer_num; ?>">
                <?php
                for ( $i = 1; $i <= $second_footer_num; $i++ ) {
                    $sidebar = ( $i == 1 ) ? 'footer-second' : 'footer-second-'.$i;
                    $class = ( $i == $second_footer_num ) ? 'f-widget last f-widget-'.$i : 'f-widget f-widget-'.$i;
                    ?>
                    <div class="<?php echo $class;?>">
                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( $sidebar ) ) : ?><?php endif; ?>
                    </div>
                    <?php
                }
                ?>
                </div><!--.second-footer-widgets-->
            <?php endif; ?>

            <div class="copyrights">
				Copyright © 2010-2015 Rolecosplay.com. All Rights Reserved. <a href= "http://www.rolecosplay.com/" target="_blank"> Cosplay Costumes</a> <a href= "http://www.rolecosplay.com/cosplay-wigs.html" target="_blank">Cosplay Wigs</a> - Your reliable Cosplay online store !
			</div> 
		</div><!--.container-->
	</footer><!--footer-->
</div><!--.main-container-->
<?php mts_footer(); ?>
<?php wp_footer(); ?>
</body>
</html>