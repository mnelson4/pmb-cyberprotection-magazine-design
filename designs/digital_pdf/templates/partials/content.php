<div class="post-inner">
	<div class="entry-content post-content">
        <?php
        if(is_post_publicly_viewable()){
        ?>
            <div class="pmbcpm-qr-code-wrapper">
                <span class="pmbcpm-qr-code" data-url="<?php echo esc_attr(get_permalink());?>"></span>
            </div>
        <?php
        }
        ?>

		<?php the_content();?>
	</div><!-- .entry-content -->

</div><!-- .post-inner -->