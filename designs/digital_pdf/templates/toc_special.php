<?php
/**
* @var \PrintMyBlog\orm\entities\Project $pmb_project
 */
?>
<?php
// set the featured image in the background
$image_src = null;
$post_thumbnail_id = get_post_thumbnail_id();
if($post_thumbnail_id){
    $image_data = wp_get_attachment_image_src( $post_thumbnail_id, 'full', false);
    if(isset($image_data[0])){
        $image_src = $image_data[0];
    }
}
if($image_src){
    $color_guru = new \PrintMyBlog\services\ColorGuru();

    ?>
    <style>
        article.pmbcpm-toc-article{
            background:
                    linear-gradient(<?php echo $color_guru->convertHextToRgba('#ffffff', 0) . ', ' . $color_guru->convertHextToRgba('#ffffff', 1);?>),
                    url('<?php echo esc_url($image_src);?>') no-repeat center center;

            /*-webkit-background-size: cover;*/
            /*-moz-background-size: cover;*/
            /*-o-background-size: cover;*/
            background-size:
                    /* gradient */ 40%,
                    /* image */ cover;

        }
    </style>
    <?php
}
?>

<div <?php pmb_section_wrapper_class('pmbcpm-toc-article-wrapper');?> <?php pmb_section_wrapper_id();?>>
    <div <?php pmb_section_class('pmbcpm-toc-title-wrapper'); ?> <?php pmb_section_id(); ?>>
        <header class="entry-header has-text-align-center">
            <div class="entry-header-inner section-inner medium">
                <span class="pmbcpm-top-margin-title pmbcpm-toc-title pmb-title pmbcpm-part-underline"><?php _e('Content', 'print-my-blog');?></span>
            </div>
        </header>
    </div>
    <article <?php pmb_section_class('pmbcpm-toc-article'); ?> <?php pmb_section_id(); ?>>
        <header class="entry-header">
            <h1 class="pmbcpm-toc-issue-h1"><?php echo $pmb_project->getSetting('month');?>.<?php echo substr($pmb_project->getSetting( 'year'), 2);?></h1>
        </header>
        <div class="pmbcpm-toc-article-inner">
            <?php pmb_include_design_template( 'partials/content' ); ?>
        </div>
    </article>
<?php // doesn't close div because that's done in the closing template
