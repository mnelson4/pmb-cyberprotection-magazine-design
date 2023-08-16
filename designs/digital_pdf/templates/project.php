<?php
/**
 * @var $pmb_project \PrintMyBlog\orm\entities\Project
 * @var $pmb_design \PrintMyBlog\orm\entities\Design
 *
 */

pmb_include_design_template('partials/html_header');
?>
<body class="<?php
//phpcs:ignore -- get_body_class does the escaping
echo str_replace('has-sidebar', '', implode(' ', get_body_class('pmb-print-page pmb-pro-print-page pmb-pro-print-pdf')));
?>">
<?php do_action('pmb_pro_print_window'); ?>
<div class="pmb-posts pmb-project-content site">
<div class="pmbcpm-footer-margin-wrap" id="pmbcpm-footer-margin-wrap">
    <div id="pmbcpm-footer-margin" class="pmbcpm-footer-margin">
        <div class="pmbcpm-pagenum-wrapper">
            <span class="pmb-page-number"></span>
        </div>
        <div class="pmbcpm-publication-data-wrapper" >
            <span class="pmb-publication-data">
                <?php echo $pmb_design->getSetting('magazine_name'); ?> <?php echo $pmb_project->getSetting('month');?>.<?php echo $pmb_project->getSetting('year');?>
            </span>
        </div>
    </div>
</div>
