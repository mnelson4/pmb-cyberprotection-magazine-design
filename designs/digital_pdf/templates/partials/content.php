<div class="post-inner">
	<div class="entry-content post-content">
        <?php
        if(is_post_publicly_viewable()){
        ?>
            <div class="pmbcpm-qr-code-wrapper">
                <span class="pmbcpm-qr-code" data-url="<?php echo esc_attr(get_permalink());?>"></span>
                <span class="pmbcpm-full-article-link"><?php
                    printf(
                        __('For the full online version, visit: %s.', 'print-my-blog'),
                        '<a href="' . get_permalink() . '">' . get_permalink() . '</a>'
                    );
                    ?></span>
            </div>
        <?php
        }
        ?>

		<?php the_content();?>
	</div><!-- .entry-content -->

</div><!-- .post-inner -->