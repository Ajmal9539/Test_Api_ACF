<?php

include __DIR__ . '/components/hero_module.php';
include __DIR__ . '/components/grid_cards_module.php';
include __DIR__ . '/components/text_image_card_module.php';
include __DIR__ . '/components/text_icon_grid_module.php';
include __DIR__ . '/components/centred_content_module.php';
include __DIR__ . '/components/linked_list_module.php';
include __DIR__ . '/components/image_grid_module.php';
include __DIR__ . '/components/accordion_module.php';
include __DIR__ . '/components/form_block_module.php';
include __DIR__ . '/components/hero_form_module.php';
include __DIR__ . '/components/text_over_image_grid.php';
include __DIR__ . '/components/quiz_module.php';
include __DIR__ . '/components/card_carousel_module.php';
include __DIR__ . '/components/image_text_option_module.php';
include __DIR__ . '/components/resource_downloads_module.php';
include __DIR__ . '/components/headline_with_text_module.php';
include __DIR__ . '/components/full_width_cta_split_module.php';
include __DIR__ . '/components/before_after_photo_grid_module.php';
include __DIR__ . '/components/content_with_columns_module.php';

$modules = get_fields()["modules"];
// var_dump(get_fields());die;
// var_dump((get_fields()["modules"]));

if (is_array($modules) || is_object($modules)) {
    foreach ($modules as $module) {
        switch ($module["acf_fc_layout"]) {
            case 'hero':
                hero_module($module);
                break;
            case 'grid_cards':
                grid_cards_module($module);
                break;
            case 'text_image_card':
                text_image_card_module($module);
                break;
            case 'text_icon_grid':
                text_icon_grid_module($module);
                break;
            case 'headline_text_two_column':
                centered_content_module($module);
                break;
            case 'linked_list':
                linked_list_module($module);
                break;
            case 'image_grid':
                image_grid_module($module);
                break;
            case 'accordion':
                accordion_module($module);
                break;
            case 'form_block':
                form_block_module($module);
                break;
            case 'hero_form':
                hero_form($module);
                break;
            case 'image_text_four_column':
                image_text_four_column($module);
                break;
            case 'quiz_module':
                quiz_module($module);
                break;
            case 'default_carousel':
                default_carousel($module);
                break;
            case 'text_image':
                text_image_option_module($module);
                break;
            case 'resource_downloads':
                resource_downloads_module($module);
                break;
            case 'headline_text':
                headline_text_module($module);
                break;
            case 'fullwidth_cta_split':
                fullwidth_cta_split_module($module);
                break;
            case 'before_after_photo_grid':
                before_after_photo_grid_module($module);
                break;
            case 'content_with_columns':
                content_with_columns_module($module);
                break;
            default:
                break;
        }
    }
}

?>