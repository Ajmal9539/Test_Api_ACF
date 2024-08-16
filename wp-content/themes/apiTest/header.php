<?php

global $menu, $options;
$template_url = template_url();
$home_url     = base_url();
$upload_url   = upload_url();
$menu_items   = main_mavigation();
$mobile_nav_items = mobile_navigation();

// var_dump($template_url);
// die;

?>

<header>

    <!-- Desktop Utility Nav -->
    <div class="util-nav bg-lightbluegrey d-none d-lg-flex align-items-center justify-content-end">

        <?php if (isset($options['desktop_utility_menu']['menu_item']) && is_array($options['desktop_utility_menu']['menu_item']) && !empty($options['desktop_utility_menu']['menu_item'])) : ?>
            <?php foreach ($options['desktop_utility_menu']['menu_item'] as $desktop_utility_nav) : ?>
                <a href="<?php echo $desktop_utility_nav['link']['url'] ?>" target="<?php echo $desktop_utility_nav['link']['target'] ?>">

                    <?php if (isset($desktop_utility_nav['icon']['url'])) : ?>

                        <img src="<?php echo $desktop_utility_nav['icon']['url'] ?>">
                    <?php endif; ?>

                    <?php echo $desktop_utility_nav['link']['title']; ?></a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Desktop Nav -->
    <nav class="primary w-100 p-0">
        <div class="nav-left w-100 px-3 d-flex align-items-center">
            <a class="logo mx-auto mx-lg-0" href="<?= $home_url ?>/"><img src="<?php echo $options['logo']['url'] ?>" alt=""></a>
            <ul class="d-none d-lg-flex">

                <?php foreach ($menu_items as $index => $menu_item) : ?>
                    <li data-menu-target="<?php echo $index; ?>" class="<?php echo !empty($menu_item['submenu']) ? 'has-child' : ''; ?>">
                        <a href="<?php echo $menu_item['url']; ?>" target="<?php echo $menu_item['target'] ?>"><?php echo $menu_item['title']; ?></a>

                        <?php if (isset($menu_item['submenu']) && count($menu_item['submenu']) > 0) : ?>

                            <div class="subnav" data-menu="<?php echo $index; ?>">
                                <ul>
                                    <?php foreach ($menu_item['submenu'] as $submenu_item) : ?>

                                        <li>
                                            <a href="<?php echo $submenu_item['url']; ?>" target="<?php echo $menu_item['target'] ?>"><?php echo $submenu_item['title']; ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>

                <li class="close-menu d-lg-none"><a href="#"></a></li>
            </ul>

        </div>

        <!-- Nav Right Buttons  -->
        <div class="nav-right h-100 d-none d-lg-flex">

            <?php if (isset($options['nav_right_buttons']['menu_item']) && is_array($options['nav_right_buttons']['menu_item']) && !empty($options['nav_right_buttons']['menu_item'])) : ?>
                <?php foreach ($options['nav_right_buttons']['menu_item'] as $mobile_utility_nav) : ?>

                    <a href="<?php echo $mobile_utility_nav['link']['url']; ?>" target="<?php echo $mobile_utility_nav['link']['target'] ?>" class="<?php echo $mobile_utility_nav['custom_class'] ?>"> <img src="<?php echo $mobile_utility_nav['icon']['url'] ?>" alt="<?php echo $mobile_utility_nav['icon']['title'] ?>"><span class="ml-1"><?php echo $mobile_utility_nav['link']['title']; ?></span></a>

                <?php endforeach; ?>
            <?php endif; ?>

        </div>

        <div class="menu-wrap d-lg-none">
            <span></span>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Mobile nav -->
    <div class="mobile-nav bg-lightergrey">
        <ul>
            <li><a href="#" class="mobile-nav-close font-bold">Close <img src="<?= $template_url ?>/assets/images/icons/icon-close.svg" alt=""></a></li>

            <?php foreach ($mobile_nav_items as $index => $menu_item) : ?>
                <li class="<?= !empty($menu_item['submenu']) ? 'has-child' : ''; ?>">
                    <a class="font-bold" href="<?= $menu_item['url']; ?>" target="<?= isset($menu_item['target']) ? $menu_item['target'] : '_self'; ?>"><?= $menu_item['title']; ?></a>
                    <?php if (isset($menu_item['submenu']) && count($menu_item['submenu']) > 0) : ?>
                        <div class="show-submenu" data-menu-target="<?= $index; ?>"></div>
                        <div class="mobile-subnav" data-menu="<?= $index; ?>">
                            <ul>
                                <?php foreach ($menu_item['submenu'] as $submenu_item) : ?>
                                    <li>
                                        <a href="<?= $submenu_item['url']; ?>" target="<?= isset($submenu_item['target']) ? $submenu_item['target'] : '_self'; ?>"><?= $submenu_item['title']; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>

        </ul>

        <!-- Mobile Utility Nav -->
        <ul class="mobile-nav-util patient_mobile_utility_menu">

            <?php if (isset($options['mobile_utility_menu']['menu_item']) && is_array($options['mobile_utility_menu']['menu_item']) && !empty($options['mobile_utility_menu']['menu_item'])) : ?>
                <?php foreach ($options['mobile_utility_menu']['menu_item'] as $mobile_utility_nav) : ?>
                    <li><a class="util-item" href="<?php echo $mobile_utility_nav['link']['url']; ?>" target="<?php echo $mobile_utility_nav['link']['target'] ?>"><?php if (isset($mobile_utility_nav['icon']['url'])) : ?><img src="<?php echo $mobile_utility_nav['icon']['url'] ?>"><?php endif; ?>
                            <?php echo $mobile_utility_nav['link']['title']; ?></a></li>
                <?php endforeach; ?>
            <?php endif; ?>

        </ul>
    </div>

    <!-- Mobile nav red buttons. -->
    <div class="util-nav-mobile d-flex d-lg-none">

        <?php if (isset($options['mobile_nav_red_buttons']) && is_array($options['mobile_nav_red_buttons']) && !empty($options['mobile_nav_red_buttons'])) : ?>
            <?php foreach ($options['mobile_nav_red_buttons'] as $mobile_nav_redbuttons) : ?>

                <a href="<?php echo $mobile_nav_redbuttons['link']['url']; ?>" target="<?php echo $mobile_nav_redbuttons['link']['target'] ?>" class="btn btn-primary h-100"><?php echo $mobile_nav_redbuttons['link']['title']; ?></a>

            <?php endforeach; ?>
        <?php endif; ?>

    </div>

</header>

<a href="#0" class="cd-top"></a>