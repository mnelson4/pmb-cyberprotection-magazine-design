<?php
/**
 * @var $pmb_project \PrintMyBlog\orm\entities\Project
 * @var $pmb_design \PrintMyBlog\orm\entities\Design
*
 */
?>
<div class="pmb-title-page">
    <div class="pmbcpm-title-page-logo-wrapper">
        <?php
        $logo_url = $pmb_design->getSetting('title_page_logo');
        if($logo_url){
            ?>
                <img src="<?php echo esc_url($logo_url);?>" title="<?php esc_attr_e($pmb_design->getSetting('magazine_name'));?>" class="pmbcpm-title-page-logo">
            <?php
        } else {
            ?>
                <h1><?php echo $pmb_design->getSetting('magazine_name');?></h1>
            <?php
        }
        ?>
        <div class="pmbcpm-title-page-issue-wrapper"><span class="pmbcpm-title-page-issue"><?php echo $pmb_project->getSetting('month');?> || <?php echo $pmb_project->getSEtting('year');?></span></div>
    </div>
    <?php
    $cover_image = $pmb_project->getSetting('title_page_image');
    if($cover_image){
        ?>
        <div class="pmbcpm-title-page-cover-image-wrapper">
            <img src="<?php esc_attr_e($cover_image);?>" class="pmbcpm-title-page-cover-image">
        </div>
        <?php
    }
    ?>
</div>