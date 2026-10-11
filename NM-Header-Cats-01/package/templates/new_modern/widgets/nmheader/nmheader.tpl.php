<?php
/**
 * Шаблон виджета «Шапка New Modern».
 * Переменные: $o (настройки и готовый HTML меню), $home_url, $is_logged, $user, $counters, $debug, $messages_url, $notices_url
 *
 * Кнопки управляются скриптом nm-header.js по атрибуту data-nm-toggle (panel или search).
 * Раскрывающиеся блоки: .nm-hw__panel (меню) и .nm-hw__search-drop (поиск), оба лежат внутри .nm-hw__sticky.
 * Цвета зон шапки приходят CSS-переменными --nm-hw-tb-*, --nm-hw-hd-*, --nm-hw-nv-* (см. $o['colors_style']).
 */
$this->addJS('templates/new_modern/js/nm-header.js');

$variant = $o['variant'];

// Обёртка содержимого. container — контейнер шаблона, остальное — собственная обёртка шапки,
// которая не зависит от настроек ширины шаблона
$cont = $o['width_mode'] === 'container' ? 'container' : 'nm-hw__wrap nm-hw__wrap--' . $o['width_mode'];

$root_class = 'nm-hw nm-hw--' . $variant
            . ' nm-hw--ml-' . ($o['mobile_layout'] === 'one_row' ? 'one' : 'two')
            . ' nm-hw--mm-' . $o['mobile_menu'];
if ($o['burger'] === 'always') { $root_class .= ' nm-hw--burger-always'; }
if ($o['sticky'])              { $root_class .= ' nm-hw--sticky'; }
if ($o['sticky'] && $o['sticky_compact']) { $root_class .= ' nm-hw--compact'; }
if ($o['blur'])                { $root_class .= ' nm-hw--blur'; }

$style = '--nm-hw-logo-h:' . (int)$o['logo_h'] . 'px;'
       . '--nm-hw-logo-w:' . (int)$o['logo_maxw'] . 'px;'
       . '--nm-hw-logo-h-m:' . (int)$o['logo_h_mobile'] . 'px;'
       . '--nm-hw-logo-h-s:' . (int)$o['logo_h_sticky'] . 'px;'
       . '--nm-hw-top:' . (int)$o['sticky_offset'] . 'px;'
       . '--nm-hw-wrap-pad:' . (int)$o['width_pad'] . 'px;';
if ($o['width_mode'] === 'custom') {
    // Ширина содержимого плюс боковые отступы: именно столько занимает обёртка
    $style .= '--nm-hw-wrap-w:' . ((int)$o['width_custom'] + 2 * (int)$o['width_pad']) . 'px;';
}
// Значения собираются в виджете из проверенных чисел и цветов
$style .= $o['colors_style'];

$search_placeholder = $o['search_placeholder'] !== '' ? $o['search_placeholder'] : LANG_WD_NMHEADER_SEARCH_DEFAULT;

$svg_search = '<svg width="18" height="18" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.868-3.834zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg>';
$svg_login  = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><path d="m10 17 5-5-5-5"/><path d="M15 12H3"/></svg>';
$svg_reg    = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M19 8v6M22 11h-6"/></svg>';

$render_logo = function () use ($o, $home_url) { ?>
    <a class="nm-hw__logo" href="<?php html($home_url); ?>">
        <?php if ($o['logo_mobile_url']) { ?>
            <img class="nm-hw__logo-img nm-hw__logo-img--desktop" src="<?php html($o['logo_url']); ?>" alt="<?php html($o['logo_alt']); ?>">
            <img class="nm-hw__logo-img nm-hw__logo-img--mobile" src="<?php html($o['logo_mobile_url']); ?>" alt="<?php html($o['logo_alt']); ?>">
        <?php } else { ?>
            <img class="nm-hw__logo-img" src="<?php html($o['logo_url']); ?>" alt="<?php html($o['logo_alt']); ?>">
        <?php } ?>
    </a>
<?php };

// Форма поиска: кнопка отправки всегда в виде лупы
$render_search = function () use ($search_placeholder, $svg_search) { ?>
    <form class="nm-hw__search" action="<?php echo href_to('search'); ?>" method="get" role="search">
        <div class="input-group">
            <input type="search" name="q" class="form-control" autocomplete="off"
                   placeholder="<?php html($search_placeholder); ?>"
                   aria-label="<?php html($search_placeholder); ?>">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit" aria-label="<?php echo LANG_WD_NMHEADER_FIND; ?>"><?php echo $svg_search; ?></button>
            </div>
        </div>
    </form>
<?php };

$burger_btn = function ($extra_class) { ?>
    <button class="nm-hw__burger <?php echo $extra_class; ?>" type="button" data-nm-toggle="panel"
            aria-controls="nm-hw-panel" aria-expanded="false" aria-label="<?php echo LANG_WD_NMHEADER_MENU_LABEL; ?>">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>
<?php };

$search_btn = function ($extra_class) use ($o, $svg_search) {
    if (!$o['show_search']) { return; } ?>
    <button class="nm-hw__icon nm-hw__search-toggle <?php echo $extra_class; ?>" type="button" data-nm-toggle="search"
            aria-controls="nm-hw-search" aria-expanded="false" aria-label="<?php echo LANG_WD_NMHEADER_SEARCH_OPEN; ?>"><?php echo $svg_search; ?></button>
<?php };

$render_user = function () use ($o, $is_logged, $user, $counters, $messages_url, $notices_url, $svg_login, $svg_reg) {

    if (!$o['show_user']) { return; }

    // Гость: на широких экранах кнопки с текстом, на узких только значки
    if (!$is_logged) { ?>
        <div class="nm-hw__user nm-hw__user--guest">
            <a class="btn btn-sm nm-hw__guest-text nm-hw__login" href="<?php echo href_to('auth', 'login'); ?>"><?php echo LANG_WD_NMHEADER_LOGIN; ?></a>
            <a class="btn btn-sm btn-primary nm-hw__guest-text nm-hw__register" href="<?php echo href_to('auth', 'register'); ?>"><?php echo LANG_WD_NMHEADER_REGISTER; ?></a>
            <a class="nm-hw__icon nm-hw__guest-icon" href="<?php echo href_to('auth', 'login'); ?>"
               title="<?php echo LANG_WD_NMHEADER_LOGIN; ?>" aria-label="<?php echo LANG_WD_NMHEADER_LOGIN; ?>"><?php echo $svg_login; ?></a>
            <a class="nm-hw__icon nm-hw__guest-icon nm-hw__icon--accent" href="<?php echo href_to('auth', 'register'); ?>"
               title="<?php echo LANG_WD_NMHEADER_REGISTER; ?>" aria-label="<?php echo LANG_WD_NMHEADER_REGISTER; ?>"><?php echo $svg_reg; ?></a>
        </div>
    <?php return; }

    $profile_url = function_exists('href_to_profile')
        ? href_to_profile(['id' => $user['id'], 'slug' => $user['slug']])
        : href_to('users', $user['id']);
    ?>
    <div class="nm-hw__user nm-hw__user--auth">

        <?php if ($o['show_messages'] && cmsController::enabled('messages')) { ?>
            <a class="nm-hw__icon messages messages-counter ajax-modal" href="<?php echo $messages_url; ?>"
               title="<?php echo LANG_WD_NMHEADER_MESSAGES; ?>" aria-label="<?php echo LANG_WD_NMHEADER_MESSAGES; ?>">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1z"/><path d="m3 7 9 6 9-6"/></svg>
                <span class="counter nm-hw__badge"<?php if (!$counters['messages']) { echo ' hidden'; } ?>><?php echo (int)$counters['messages']; ?></span>
            </a>
            <a class="nm-hw__icon info notices-counter ajax-modal" href="<?php echo $notices_url; ?>"
               title="<?php echo LANG_WD_NMHEADER_NOTICES; ?>" aria-label="<?php echo LANG_WD_NMHEADER_NOTICES; ?>">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.7 21a2 2 0 0 1-3.4 0"/></svg>
                <span class="counter nm-hw__badge"<?php if (!$counters['notices']) { echo ' hidden'; } ?>><?php echo (int)$counters['notices']; ?></span>
            </a>
        <?php } ?>

        <div class="dropdown">
            <a href="#" class="nm-hw__user-toggle icms-user-menu d-flex align-items-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="nm-hw__avatar">
                    <?php if (function_exists('html_avatar_image')) {
                        echo html_avatar_image($user['avatar'], 'micro', $user['nickname']);
                    } else { ?>
                        <span class="nm-hw__avatar-letter"><?php html(mb_substr($user['nickname'], 0, 1)); ?></span>
                    <?php } ?>
                </span>
                <span class="nm-hw__nick icms-user-menu__nickname d-none d-md-inline"><?php html($user['nickname']); ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right nm-hw__dropdown">
                <?php if ($o['user_menu_html']) { ?>
                    <?php echo $o['user_menu_html']; ?>
                <?php } else { ?>
                    <a class="dropdown-item" href="<?php echo $profile_url; ?>"><?php echo LANG_WD_NMHEADER_PROFILE; ?></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo href_to('auth', 'logout'); ?>"><?php echo LANG_WD_NMHEADER_LOGOUT; ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
<?php };

// Раскрывающиеся блоки: форма поиска и меню для бургера
$render_drops = function ($with_search) use ($o, $cont, $render_search) { ?>
    <?php if ($with_search && $o['show_search']) { ?>
        <div class="nm-hw__search-drop" id="nm-hw-search"><div class="<?php echo $cont; ?>"><?php $render_search(); ?></div></div>
    <?php } ?>
    <div class="nm-hw__panel" id="nm-hw-panel">
        <div class="<?php echo $cont; ?>"><?php echo $o['menu_panel_html']; ?></div>
    </div>
<?php };
?>
<div class="<?php echo $root_class; ?>" id="nm-hw"
     data-nm-sticky="<?php echo $o['sticky'] ? '1' : '0'; ?>"
     data-nm-sticky-mobile="<?php echo $o['sticky_mobile'] ? '1' : '0'; ?>"
     data-nm-submenu-label="<?php echo LANG_WD_NMHEADER_SUBMENU_LABEL; ?>"
     style="<?php echo $style; ?>">

    <?php if ($debug) { ?>
        <div class="nm-hw__debug" role="note">
            <strong><?php echo LANG_WD_NMHEADER_DEBUG; ?>:</strong>
            <?php foreach ($debug as $line) { ?><div><?php html($line); ?></div><?php } ?>
        </div>
    <?php } ?>

    <?php if ($o['show_topbar'] && ($o['topbar_text'] !== '' || $o['topbar_links'])) { ?>
        <div class="nm-hw__topbar">
            <div class="<?php echo $cont; ?> d-flex align-items-center justify-content-between">
                <div class="nm-hw__topbar-text"><?php html($o['topbar_text']); ?></div>
                <?php if ($o['topbar_links']) { ?>
                    <ul class="nm-hw__topbar-links list-inline mb-0">
                        <?php foreach ($o['topbar_links'] as $link) { ?>
                            <li class="list-inline-item"><a href="<?php html($link['url']); ?>"><?php html($link['title']); ?></a></li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </div>
        </div>
    <?php } ?>

    <?php if ($variant !== 'line') { ?>

        <div class="nm-hw__top">
            <div class="<?php echo $cont; ?> nm-hw__top-row">
                <?php $burger_btn('nm-hw__burger--top'); ?>
                <?php $render_logo(); ?>
                <?php if ($o['show_search']) { ?>
                    <div class="nm-hw__search-wrap d-none d-lg-block"><?php $render_search(); ?></div>
                <?php } ?>
                <?php $render_user(); ?>
                <?php $search_btn('nm-hw__search-toggle--top'); ?>
            </div>
        </div>

        <div class="nm-hw__sentinel" aria-hidden="true"></div>
        <div class="nm-hw__sticky">
            <nav class="nm-hw__bar nm-hw__bar--nav" aria-label="<?php echo LANG_WD_NMHEADER_MENU_LABEL; ?>">
                <div class="<?php echo $cont; ?> d-flex align-items-center">
                    <?php $burger_btn('nm-hw__burger--bar'); ?>
                    <div class="nm-hw__menu-inline"><?php echo $o['menu_html']; ?></div>
                    <?php $search_btn('nm-hw__search-toggle--bar'); ?>
                </div>
            </nav>
            <?php $render_drops(true); ?>
        </div>

    <?php } else { ?>

        <div class="nm-hw__sentinel" aria-hidden="true"></div>
        <div class="nm-hw__sticky">
            <div class="nm-hw__bar nm-hw__bar--line">
                <div class="<?php echo $cont; ?> d-flex align-items-center nm-hw__line-row">
                    <?php $burger_btn('nm-hw__burger--line'); ?>
                    <?php $render_logo(); ?>
                    <nav class="nm-hw__menu-inline" aria-label="<?php echo LANG_WD_NMHEADER_MENU_LABEL; ?>"><?php echo $o['menu_html']; ?></nav>
                    <div class="nm-hw__line-right ml-auto d-flex align-items-center">
                        <?php $render_user(); ?>
                        <?php $search_btn('nm-hw__search-toggle--line'); ?>
                    </div>
                </div>
            </div>
            <?php $render_drops(true); ?>
        </div>

    <?php } ?>
</div>
