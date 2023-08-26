<?php
/**
 * @var \PrintMyBlog\orm\entities\Project $pmb_project
 * @var PrintMyBlog\orm\entities\Design $pmb_design
 * @var string $featured_image_class
 */
?>
<div <?php pmb_section_wrapper_class($featured_image_class . '-featured-image');?> <?php pmb_section_wrapper_id();?>>
    <article <?php pmb_section_class(); ?> <?php pmb_section_id(); ?>>
        <header class="entry-header has-text-align-center">
            <div class="entry-header-inner section-inner medium">
                <?php pmb_the_title();?>
                <?php
                $subtitle = get_post_meta(get_the_ID(), 'pmb_subtitle', true);
                if($subtitle){
                    ?>
                    <div class="pmbcpm-subtitle">
                        <h2><?php esc_html_e($subtitle);?></h2>
                    </div>
                    <?php
                }
                ?>
                <div class="byline-wrapper">
                    <?php echo strtoupper(sprintf( __('%1$sAuthor:%2$s %3$s', 'print-my-blog'), '<b>', '</b>', do_shortcode('[molongui_author_name]')));?>
                    <?php
                    $photo_credit = get_post_meta(get_the_ID(), 'pmb_photo_credit', true);
                    if($photo_credit){
                        ?>&nbsp;.&nbsp;
                        <?php
                        echo strtoupper(sprintf(__('%1$sPhoto:%2$s %3$s', 'print-my-blog'), '<b>' , '</b>', esc_html($photo_credit)));
                    }
                    ?>
                </div>
            </div><!-- .entry-header-inner -->
            <figure class="post-thumbnail <?php esc_attr_e($featured_image_class);?>">
                <?php the_post_thumbnail('full', ['class' => 'alignnone pmb-featured-image','loading' => 'eager']); ?>
                <?php if (wp_get_attachment_caption(get_post_thumbnail_id())) : ?>
                    <figcaption
                            class="wp-caption-text"><span class="pmbcpm-caption-span"><?php echo wp_kses_post(wp_get_attachment_caption(get_post_thumbnail_id())); ?></span></figcaption>
                <?php endif; ?>
            </figure>
        </header><!-- .entry-header -->
        <?php pmb_include_design_template( 'partials/content' ); ?>
    </article>
<?php // end of file. For some reason this comment was needed to prevent a fatal parsing error on dev.printmy.blog