<?php
/*
Plugin Name: Print My Blog - Cyberprotection Magazine Design
Plugin URI: https://github.com/mnelson4/pmb-cyberprotection-magazine-design
Description: Custom digital PDF design for Cyber Protection Magazine (https://cyberprotection-magazine.com)
Author: Mike Nelson (Developer of Print My Blog)
Version: 1.0.0
*/

use PrintMyBlog\entities\DesignTemplate;
use PrintMyBlog\orm\entities\Design;
use Twine\forms\base\FormSection;
use Twine\forms\inputs\AdminFileUploaderInput;
use Twine\forms\inputs\ColorInput;
use Twine\forms\inputs\DatepickerInput;
use Twine\forms\inputs\TextAreaInput;
use Twine\forms\inputs\TextInput;
use Twine\forms\strategies\validation\TextValidation;

define('PMBCPM_MAIN_FILE', __FILE__);
define('PMBCPM_MAIN_DIR', __DIR__);
define('PMBCPM_DESIGN_DIR', PMBCPM_MAIN_DIR . '/designs/digital_pdf');
define('PMBCPM_TEMPLATES_DIR', PMBCPM_DESIGN_DIR . '/templates');
add_action( 'pmb_register_designs', 'pmbcpm_register_design', 1 );
register_activation_hook(PMBCPM_MAIN_FILE,'pmbcpm_activation');

/**
 * Called when this plugin is activated, and gets PMB to check this design exists in the database (and if not, adds it)
 */
function pmbcpm_activation(){
    pmbcpm_register_design();
    pmb_check_db();
}

/**
 * Registers the design and design template. This should be done on every request so PMB knows they exist.
 */
function pmbcpm_register_design() {
    if(! function_exists('pmb_register_design')){
        return;
    }
    pmb_register_design_template(
        'cyber_protection_digital',
        function () {

            return [
                'title' => __('Cyber Protection Magazine Digital PDF'),
                'format' => 'digital_pdf',
                'dir' => PMBCPM_DESIGN_DIR,
                'default' => 'cyber_protection_digital',
                'url' => plugins_url('designs/digital_pdf/', PMBCPM_MAIN_FILE),
//                'docs' => '',
                'supports' => [
                    'front_matter',
                    'back_matter',
                    'part',
                ],
                'custom_templates' => [
                    'just_content',
                ],
                'design_form_callback' => function () {
                    $icon = get_site_icon_url();
                    if( ! $icon){
                        $icon = PMB_IMAGES_URL . 'icon-128x128.jpg';
                    }
                    $context = \PrintMyBlog\system\Context::instance();
                    /**
                     * @var $default_design_templates \PrintMyBlog\domain\DefaultDesignTemplates
                     */
                    $default_design_templates = $context->reuse('PrintMyBlog\domain\DefaultDesignTemplates');
                    return (new FormSection([
                        'subsections' =>
                            [
                                'magazine_name' => new TextInput(
                                    [
                                        'html_label_text' => __('Magazine Name', 'print-my-blog')
                                    ]
                                ),
                                'title_page_logo' => new AdminFileUploaderInput([
                                    'html_label_text' => __('Title Page Logo Image', 'print-my-blog'),
                                    'html_help_text' => __('A full-width logo that will occupy the full width of the title page.', 'print-my-blog'),
                                    'default' => $icon
                                ]),
                                'article_ending_icon' => new AdminFileUploaderInput([
                                    'html_label_text' => __('Article End Icon', 'print-my-blog'),
                                    'html_help_text' => __('Icon that appears inline with text at the end of each article.', 'print-my-blog'),
                                    'default' => $icon
                                ]),
                                'fonts' => $default_design_templates->getPdfFontSettings(),
                                'page' => $default_design_templates->getPageSubsection(),
                            ],
                    ]))->merge(pmb_generic_design_form());
                },
                'project_form_callback' => function (Design $design) {
                    return new FormSection([
                        'subsections' => [
                            'month' => new TextInput(
                                [
                                    'html_label_text' => __('Issue Month', 'print-my-blog'),
                                    'html_help_text' => __('In any format you like: full month name, abbreviation, number, etc. This is primarily used in footers and title page.'),
                                ]
                            ),
                            'year' => new TextInput(
                                [
                                    'html_label_text' => __('Issue Year', 'print-my-blog'),
                                    'html_help_text' => __('Year as a four-digit number. Eg, "2023". This is primarily used in the footers and title page.', 'print-my-blog'),
                                ]
                            ),
                            'title_page_image' => new AdminFileUploaderInput([
                                'html_label_text' => __('Title Page Cover Image', 'print-my-blog'),
                                'html_help_text' => __('Image that will occupy the majority of the title page.', 'print-my-blog'),
                            ]),
                            'last_page_image' => new AdminFileUploaderInput([
                                'html_label_text' => __('Last Page Image', 'print-my-blog'),
                                'html_help_text' => __('Image that will occupy the last page.', 'print-my-blog'),
                            ]),
                        ]
                    ]);
                }
            ];
        }
    );
    pmb_register_section_template(
        'featured_image_top',
        [
            'cyber_protection_digital'
        ],
        function(){
            return [
                'title' => __('Featured Image on Top', 'print-my-blog'),
                'filepath' => PMBCPM_TEMPLATES_DIR . '/featured_image_at_top.php'
            ];
        }
    );
    pmb_register_section_template(
        'featured_image_bottom',
        [
            'cyber_protection_digital'
        ],
        function(){
            return [
                'title' => __('Featured Image at Bottom', 'print-my-blog'),
                'filepath' => PMBCPM_TEMPLATES_DIR . '/featured_image_at_bottom.php'
            ];
        }
    );
    pmb_register_section_template(
        'fullpage_no_margins',
        [
            'cyber_protection_digital'
        ],
        function(){
            return [
                'title' => __('Fullpage No Margins', 'print-my-blog'),
                'filepath' => PMBCPM_TEMPLATES_DIR . '/fullpage_no_margins.php'
            ];
        }
    );
    pmb_register_design(
        'cyber_protection_digital',
    'cyber_protection_digital',
        function (DesignTemplate $design_template) {
            $preview_folder_url = plugins_url('/designs/digital_pdf/assets/', PMBCPM_MAIN_FILE);
            return [
                'title' => __('Cyber Protection Magazine Digital PDF', 'print-my-blog'),
                'quick_description' => __('Custom design for Cyber Protection Magazine\'s Digital PDF.', 'print-my-blog'),
                'description' => pmb_get_contents(PMBCPM_MAIN_DIR . '/designs/digital_pdf/description.php'),
                'author' => [
                    'name' => 'Mike Nelson',
                    'url' => 'https://printmy.blog'
                ],
                'previews' => [
                    [
                        'url' => $preview_folder_url . '/preview1.jpg',
                        'desc' => __('Title page', 'print-my-blog')
                    ],
                    [
                        'url' => $preview_folder_url . '/preview2.jpg',
                        'desc' => __('')
                    ]
                ],
                'design_defaults' => [
                    'magazine_name' => get_bloginfo('name'),
                    'custom_css' => ''
                ],
                'project_defaults' => [

                ],
            ];
        }
    );
}