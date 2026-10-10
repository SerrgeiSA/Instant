<?php
/**
 * New Modern: общий помощник шаблонов списков контента (content/default_list_nm_*.tpl.php)
 *
 * Шаблоны работают с любым типом контента: картинка, анонс, цена и т.д.
 * определяются по типам полей, а в «Опциях стилей списка» типа контента
 * можно задать JSON с уточнениями, например:
 * {"cols": 3, "ratio": "4x3", "image": "photo", "teaser": "teaser", "price": "price",
 *  "subtitle": "city", "badge": "is_verified", "highlight": "is_vip",
 *  "more": "button", "auto_pages": 3, "meta": 1, "cat": 1}
 */

if (function_exists('nm_list_opt')) {
    return;
}

/**
 * Опции стиля: значения из типа контента ($list_opt) поверх значений шаблона
 */
function nm_list_opt($list_opt, $defaults = []) {

    $template = cmsTemplate::getInstance();

    $base = [
        'cols'       => 3,
        'ratio'      => '16x9',
        'image'      => '',
        'image_preset' => '',
        'teaser'     => '',
        'price'      => '',
        'subtitle'   => '',
        'badge'      => '',
        'highlight'  => '',
        'meta'       => 1,
        'cat'        => 1,
        'teaser_lines' => 3,
        'more'       => $template->getOption('nm_list_more', 'button'),
        'auto_pages' => (int) $template->getOption('nm_list_auto_pages', 3),
        'pages'      => (int) $template->getOption('nm_list_keep_pages', 1)
    ];

    $opt = array_merge($base, $defaults, is_array($list_opt) ? $list_opt : []);

    $opt['cols'] = max(1, min(6, (int) $opt['cols']));
    if (!in_array($opt['ratio'], ['16x9', '4x3', '3x2', '1x1', '3x4', '21x9'], true)) {
        $opt['ratio'] = '16x9';
    }
    if (!in_array($opt['more'], ['pages', 'button', 'auto', 'auto_button'], true)) {
        $opt['more'] = 'button';
    }

    return $opt;
}

/**
 * Разбирает запись на части для вывода
 */
function nm_list_item($item, $ctype, $opt) {

    $parts = [
        'url'       => href_to($ctype['name'], $item['slug'] . '.html'),
        'title'     => $item['title'] ?? '',
        'image'     => null,
        'teaser'    => '',
        'price'     => '',
        'has_price' => false,
        'subtitle'  => '',
        'badge'     => false,
        'highlight' => false,
        'props'     => [],
        'category'  => null,
        'date'      => $item['date_pub'] ?? null
    ];

    if (!empty($item['category']['title']) && !empty($item['category']['slug']) && $item['category_id'] > 1) {
        $parts['category'] = [
            'title' => $item['category']['title'],
            'url'   => href_to($ctype['name'], $item['category']['slug'])
        ];
    }

    $used = ['title' => true];

    // Картинка: заданное поле или первое поле-картинка
    foreach ($item['fields'] as $name => $field) {
        if ($opt['image'] ? $name === $opt['image'] : in_array($field['type'], ['image', 'images'], true)) {
            $src = nm_list_image_src($item[$name] ?? null, $field, $opt);
            if ($src) {
                $parts['image'] = ['src' => $src, 'field' => $field, 'value' => $item[$name]];
            }
            $used[$name] = true;
            break;
        }
    }

    // Цена: заданное поле, поле price или первое числовое
    foreach ($item['fields'] as $name => $field) {
        if (isset($used[$name])) { continue; }
        if ($opt['price'] ? $name === $opt['price'] : ($name === 'price' || $name === 'cost')) {
            $parts['price'] = $field['html'];
            $parts['has_price'] = true;
            $used[$name] = true;
            break;
        }
    }

    if (!$parts['has_price']) {
        $price_name = $opt['price'] ?: (isset($item['price']) ? 'price' : (isset($item['cost']) ? 'cost' : ''));
        $parts['has_price'] = $price_name && array_key_exists($price_name, $item);
    }

    // Анонс: заданное поле или первое текстовое
    foreach ($item['fields'] as $name => $field) {
        if (isset($used[$name])) { continue; }
        if ($opt['teaser'] ? $name === $opt['teaser'] : in_array($field['type'], ['string', 'text', 'html'], true)) {
            $parts['teaser'] = trim(strip_tags($field['html']));
            $used[$name] = true;
            break;
        }
    }

    // Подзаголовок (город, должность...)
    if ($opt['subtitle'] && isset($item['fields'][$opt['subtitle']])) {
        $parts['subtitle'] = trim(strip_tags($item['fields'][$opt['subtitle']]['html']));
        $used[$opt['subtitle']] = true;
    }

    // Отметка «проверено» и выделение (VIP)
    foreach (['badge', 'highlight'] as $key) {
        if ($opt[$key]) {
            $parts[$key] = !empty($item[$opt[$key]]);
            $used[$opt[$key]] = true;
        }
    }

    // Остальные поля — небольшой список характеристик
    foreach ($item['fields'] as $name => $field) {
        if (isset($used[$name]) || $field['html'] === '' || $field['html'] === null) { continue; }
        $parts['props'][$name] = [
            'title' => $field['label_pos'] !== 'none' ? $field['title'] : '',
            'html'  => $field['html'],
            'type'  => $field['type']
        ];
    }

    return $parts;
}

/**
 * URL картинки: пресет из опций стиля или подходящий по размеру из доступных у записи
 * $size: large — карточки и обложки (~600px), small — миниатюры (~150px)
 */
function nm_list_image_src($value, $field, $opt, $size = 'large') {

    if (!$value) { return ''; }

    if (!is_array($value)) {
        $value = cmsModel::yamlToArray($value);
    }

    // Поле «images» — берём первую картинку
    if ($field['type'] === 'images') {
        $value = is_array($value) ? reset($value) : null;
    }
    if (!$value || !is_array($value)) { return ''; }

    if ($opt['image_preset'] && !empty($value[$opt['image_preset']])) {
        return html_image_src($value, $opt['image_preset'], true);
    }

    $preset = nm_list_pick_preset(array_keys($value), $size === 'small' ? 150 : 560);
    if (!$preset) {
        $preset = $field['options']['size_teaser'] ?? 'normal';
    }

    return html_image_src($value, $preset, true) ?: '';
}

/**
 * Наименьший пресет не уже $min_width; если таких нет — наибольший
 */
function nm_list_pick_preset($keys, $min_width) {

    static $widths = null;

    if ($widths === null) {
        $widths = [];
        $presets = (new cmsModel())->get('images_presets', false, false) ?: [];
        foreach ($presets as $preset) {
            $widths[$preset['name']] = (int) ($preset['width'] ?: $preset['height']);
        }
        $widths['original'] = 10000;
    }

    $best = null; $best_w = 0; $max = null; $max_w = -1;
    foreach ($keys as $key) {
        if (!isset($widths[$key]) || $key === 'original') { continue; }
        $w = $widths[$key];
        if ($w >= $min_width && ($best === null || $w < $best_w)) { $best = $key; $best_w = $w; }
        if ($w > $max_w) { $max = $key; $max_w = $w; }
    }

    return $best ?: $max;
}

/**
 * Картинка с обрезкой под пропорции (или заглушка)
 */
function nm_list_media($parts, $opt, $class = '', $ratio = null, $size = 'large') {

    $ratio = $ratio ?: $opt['ratio'];

    $src = '';
    if ($parts['image']) {
        $src = nm_list_image_src($parts['image']['value'], $parts['image']['field'], $opt, $size);
    }

    echo '<a class="nm-media nm-ratio-' . $ratio . ' ' . $class . '" href="' . $parts['url'] . '" tabindex="-1" aria-hidden="true">';
    if ($src) {
        echo '<img src="' . html($src, false) . '" alt="' . html($parts['title'], false) . '" loading="lazy" decoding="async">';
    } else {
        echo '<span class="nm-media__empty">' . html_svg_icon('solid', 'image', 32, false) . '</span>';
    }
    echo '</a>';
}

/**
 * Заголовок записи со ссылкой, родителем, приватностью и меню действий
 */
function nm_list_title($item, $ctype, $parts, $tag = 'h3', $class = '') {

    $template = cmsTemplate::getInstance();

    echo '<' . $tag . ' class="nm-title ' . $class . '">';

    if (!empty($template->menus['list_actions_menu'])) {
        echo '<span class="dropdown nm-actions">';
        echo '<button class="btn btn-sm" type="button" data-toggle="dropdown" aria-label="' . html(LANG_MENU, false) . '">' . html_svg_icon('solid', 'ellipsis-v', 16, false) . '</button>';
        echo '<span class="dropdown-menu dropdown-menu-right">';
        foreach ($template->menus['list_actions_menu'] as $menu) {
            echo '<a class="dropdown-item ' . ($menu['options']['class'] ?? '') . '" href="' . string_replace_keys_values($menu['url'], $item) . '">' . $menu['title'] . '</a>';
        }
        echo '</span></span>';
    }

    if (!empty($item['parent_id'])) {
        echo '<a class="nm-title__parent" href="' . rel_to_href($item['parent_url']) . '">' . html($item['parent_title'], false) . '</a> &rarr; ';
    }

    if (!empty($item['is_private_item'])) {
        html($parts['title']);
        echo ' <span class="text-muted" title="' . html($item['private_item_hint'], false) . '">' . html_svg_icon('solid', 'lock', 14, false) . '</span>';
    } elseif (empty($ctype['options']['item_on'])) {
        html($parts['title']);
    } else {
        echo '<a href="' . $parts['url'] . '">' . html($parts['title'], false) . '</a>';
        if (!empty($item['is_private'])) {
            echo ' <span class="text-muted" title="' . html(LANG_PRIVACY_HINT, false) . '">' . html_svg_icon('solid', 'lock', 14, false) . '</span>';
        }
    }

    echo '</' . $tag . '>';
}

/**
 * Мета-строка (дата, автор, комментарии, рейтинг...) из info_bar записи
 * $only — список ключей info_bar, $skip — исключить
 */
function nm_list_meta($item, $only = [], $skip = [], $class = '') {

    if (empty($item['info_bar'])) { return; }

    $bars = [];
    foreach ($item['info_bar'] as $key => $bar) {
        if ($only && !in_array($key, $only, true)) { continue; }
        if ($skip && in_array($key, $skip, true)) { continue; }
        $bars[$key] = $bar;
    }
    if (!$bars) { return; }

    echo '<div class="nm-meta ' . $class . '">';
    foreach ($bars as $key => $bar) {
        echo '<span class="nm-meta__item ' . html($bar['css'] ?? '', false) . '"' . (!empty($bar['title']) ? ' title="' . html($bar['title'], false) . '"' : '') . '>';
        if (!empty($bar['icon'])) {
            html_svg_icon('solid', $bar['icon'], 14);
        }
        if (!empty($bar['href'])) {
            echo '<a href="' . $bar['href'] . '">' . $bar['html'] . '</a>';
        } else {
            echo $bar['html'];
        }
        echo '</span>';
    }
    echo '</div>';
}

/**
 * Категория-бейдж
 */
function nm_list_cat($parts, $opt, $class = '') {
    if (!$opt['cat'] || !$parts['category']) { return; }
    echo '<a class="nm-cat ' . $class . '" href="' . $parts['category']['url'] . '">' . html($parts['category']['title'], false) . '</a>';
}

/**
 * Теги записи
 */
function nm_list_tags($item, $ctype) {
    if (empty($item['show_tags'])) { return; }
    echo '<div class="nm-tags">' . html_tags_bar($item['tags'], 'content-' . $ctype['name'], 'nm-tag', '') . '</div>';
}

/**
 * Начало списка: панель фильтра и сообщение о пустом списке.
 * Возвращает false, если записей нет.
 */
function nm_list_start($data) {

    $template = cmsTemplate::getInstance();
    $ctype = $data['ctype'];

    // На подгружаемых страницах фильтр не нужен
    $is_more = !empty($data['request']) && $data['request']->isAjax() && (int) ($data['page'] ?? 1) > 1;

    if (!empty($ctype['options']['list_show_filter']) && !$is_more) {
        $template->renderAsset('ui/filter-panel', [
            'css_prefix'   => $ctype['name'],
            'page_url'     => $data['page_url'],
            'fields'       => $data['fields'],
            'props_fields' => $data['props_fields'],
            'props'        => $data['props'],
            'filters'      => $data['filters'],
            'ext_hidden_params' => $data['ext_hidden_params'],
            'is_expanded'  => $ctype['options']['list_expand_filter']
        ]);
    }

    if (empty($data['items'])) {
        echo '<p class="alert alert-info mt-4 alert-list-empty">';
        echo !empty($ctype['labels']['many']) ? sprintf(LANG_TARGET_LIST_EMPTY, $ctype['labels']['many']) : LANG_LIST_EMPTY;
        echo '</p>';
        return false;
    }

    $template->addTplJSName('nm-list');

    return true;
}

/**
 * Атрибуты контейнера списка для подгрузки
 */
function nm_list_attrs($data, $style, $opt) {

    $id = $data['ctype']['name'] . '-' . $style;

    return ' data-nm-list="' . html($id, false) . '"'
         . ' data-nm-page="' . (int) $data['page'] . '"';
}

/**
 * URL страницы списка — так же, как строит cmsPaginator
 */
function nm_list_page_url($page_url, $page, $query = []) {

    if (!is_array($query)) { parse_str((string) $query, $query); }

    $anchor = '';
    if (is_string($page_url) && strpos($page_url, '#') !== false) {
        list($page_url, $anchor) = explode('#', $page_url);
    }
    if (!$page_url) { $page_url = cmsCore::getInstance()->uri_absolute; }
    if (!is_array($page_url)) { $page_url = ['first' => $page_url, 'base' => $page_url]; }
    if (!isset($page_url['first'])) { $page_url['first'] = $page_url['base']; }

    $query['page'] = $page;
    $uri = $page == 1 ? $page_url['first'] : $page_url['base'];
    if ($page == 1) { unset($query['page']); }

    $sep = strpos($uri, '?') !== false ? '&' : '?';

    return $uri . ($query ? $sep . http_build_query($query) : '') . ($anchor ? '#' . $anchor : '');
}

/**
 * Конец списка: кнопка «Загрузить ещё» / автоподгрузка + постраничная навигация
 */
function nm_list_end($data, $style, $opt) {

    $page    = (int) $data['page'];
    $perpage = (int) $data['perpage'];
    $total   = (int) $data['total'];
    $pages   = $perpage ? (int) ceil($total / $perpage) : 1;

    $id = $data['ctype']['name'] . '-' . $style;

    if ($opt['more'] !== 'pages' && $page < $pages) {

        $next = nm_list_page_url($data['page_url'], $page + 1, $data['filter_query'] ?? []);
        $shown = min($total, $page * $perpage);

        echo '<div class="nm-more" data-nm-more="' . html($id, false) . '" data-mode="' . $opt['more'] . '"'
           . ' data-auto-pages="' . (int) $opt['auto_pages'] . '" data-next="' . html($next, false) . '"'
           . ' data-page="' . $page . '" data-pages="' . $pages . '" data-perpage="' . $perpage . '" data-total="' . $total . '">';
        echo '<a class="btn btn-outline-primary nm-more__btn" href="' . html($next, false) . '" rel="next">'
           . '<span class="nm-more__text">' . LANG_NM_LOAD_MORE . '</span>'
           . '<span class="nm-more__spinner spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
           . '</a>';
        echo '<div class="nm-more__stat" data-error="' . html(LANG_NM_LOAD_ERROR, false) . '">' . sprintf(LANG_NM_SHOWN_OF, '<span class="nm-more__shown">' . $shown . '</span>', $total) . '</div>';
        echo '</div>';
    }

    if ($opt['more'] === 'pages' || $opt['pages']) {
        echo '<div class="nm-pagebar' . ($opt['more'] !== 'pages' ? ' nm-pagebar--more' : '') . '" data-nm-pagebar="' . html($id, false) . '">';
        echo html_pagebar($page, $perpage, $total, $data['page_url'], $data['filter_query'] ?? []);
        echo '</div>';
    }
}

/**
 * Группировка по дням для лент: «Сегодня», «Вчера», «10 октября»
 */
function nm_list_day($date) {

    $ts = strtotime((string) $date);
    if (!$ts) { return ['key' => '', 'title' => '']; }

    $key = date('Y-m-d', $ts);

    if ($key === date('Y-m-d')) {
        $title = LANG_TODAY;
    } elseif ($key === date('Y-m-d', strtotime('-1 day'))) {
        $title = LANG_YESTERDAY;
    } else {
        $title = html_date($date);
        $title = function_exists('lang_date') ? lang_date(date('j F' . (date('Y', $ts) != date('Y') ? ' Y' : ''), $ts)) : $title;
    }

    return ['key' => $key, 'title' => $title];
}
