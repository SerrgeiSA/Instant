<?php
/**
 * New Modern: помощник шаблонов виджета «Категории»
 * (controllers/content/widgets/categories/categories_nm_*.tpl.php)
 *
 * Ядро передаёт в шаблон $cats — плоский список категорий в порядке вложенных множеств
 * (ключи ns_level, is_active, is_hidden, slug, title, img_src, item_count_recursive),
 * а также $ctype_name и $show_counts. Здесь список превращается в дерево и выводится вложенными списками.
 *
 * Вид маркера задаёт параметр mark в шаблоне: line (по умолчанию), dot, dash, diamond.
 */

if (isset($this) && is_object($this) && method_exists($this, 'addCSS')) {
    $this->addCSS('templates/new_modern/css/nm-cats-v2.css');
}

if (function_exists('nm_cats_tree')) {
    return;
}

function nm_cats_tree(array $cats) {

    $cats = array_values($cats);
    $n    = count($cats);

    if (!$n) { return []; }

    $min = null;
    foreach ($cats as $cat) {
        $lvl = (int)(isset($cat['ns_level']) ? $cat['ns_level'] : 0);
        if ($min === null || $lvl < $min) { $min = $lvl; }
    }

    $i = 0;

    $walk = function ($level) use (&$walk, &$i, $cats, $n) {

        $nodes = [];

        while ($i < $n) {

            $cat = $cats[$i];
            $lvl = (int)(isset($cat['ns_level']) ? $cat['ns_level'] : 0);

            if ($lvl < $level) { break; }

            $i++;

            $children = [];
            if ($i < $n && (int)(isset($cats[$i]['ns_level']) ? $cats[$i]['ns_level'] : 0) > $lvl) {
                $children = $walk($lvl + 1);
            }

            $nodes[] = ['cat' => $cat, 'children' => $children];
        }

        return $nodes;
    };

    return $walk($min);
}

function nm_cats_has_active(array $node) {

    if (!empty($node['cat']['is_active'])) { return true; }

    foreach ($node['children'] as $child) {
        if (nm_cats_has_active($child)) { return true; }
    }

    return false;
}

function nm_cats_classes($cat) {

    if (empty($cat['css_classes']) || !is_array($cat['css_classes'])) { return ''; }

    $out = [];
    foreach ($cat['css_classes'] as $class) {
        $class = preg_replace('/[^a-zA-Z0-9_\-]/', '', (string)$class);
        if ($class !== '') { $out[] = $class; }
    }

    return $out ? ' ' . implode(' ', $out) : '';
}

/**
 * Счётчик записей: стоит сразу после названия, при нуле не выводится
 */
function nm_cats_count($cat, $show) {

    if (!$show || !isset($cat['item_count_recursive'])) { return ''; }

    $count = (int)$cat['item_count_recursive'];

    if ($count <= 0) { return ''; }

    return '<span class="nm-cats__cnt">' . $count . '</span>';
}

/**
 * Маркер категории вместо иконки папки. Цвета берутся из переменных скина шаблона
 */
function nm_cats_icon($mark = 'line') {

    if (!in_array($mark, ['line', 'dot', 'dash', 'diamond'], true)) { $mark = 'line'; }

    return '<span class="nm-cats__mark nm-cats__mark--' . $mark . '" aria-hidden="true"></span>';
}

/**
 * Дерево вложенными списками.
 *
 * $o: skip_hidden — не выводить категории, скрытые ядром (is_hidden);
 *     toggle — кнопка раскрытия у пунктов с вложенными;
 *     icon — маркер категории; mark — вид маркера (line, dot, dash, diamond);
 *     open_all — раскрыть все ветки; counts — счётчики.
 */
function nm_cats_render(array $nodes, $ctype_name, array $o, $depth = 0) {

    $mark = isset($o['mark']) ? (string)$o['mark'] : 'line';

    $html = '<ul class="nm-cats__list nm-cats__list--l' . (int)$depth . '">';

    foreach ($nodes as $node) {

        $cat = $node['cat'];

        if (!empty($o['skip_hidden']) && !empty($cat['is_hidden'])) { continue; }

        $children = $node['children'];

        if (!empty($o['skip_hidden'])) {
            $children = array_values(array_filter($children, function ($child) {
                return empty($child['cat']['is_hidden']);
            }));
        }

        $has_sub = !empty($children);
        $active  = !empty($cat['is_active']);
        $open    = $has_sub && (!empty($o['open_all']) || nm_cats_has_active($node));

        $class = 'nm-cats__item'
               . ($has_sub ? ' has-sub' : '')
               . ($active ? ' is-active' : '')
               . ($open ? ' is-open' : '')
               . nm_cats_classes($cat);

        $url   = html(href_to($ctype_name, $cat['slug']), false);
        $title = html($cat['title'], false);

        $html .= '<li class="' . $class . '"><div class="nm-cats__row">';
        $html .= '<a class="nm-cats__link" href="' . $url . '">'
               . (!empty($o['icon']) ? nm_cats_icon($mark) : '')
               . '<span class="nm-cats__title">' . $title . '</span>'
               . nm_cats_count($cat, !empty($o['counts']))
               . '</a>';

        if ($has_sub && !empty($o['toggle'])) {
            $html .= '<button type="button" class="nm-cats__toggle" aria-expanded="' . ($open ? 'true' : 'false') . '" aria-label="' . html(LANG_NM_WC_TOGGLE, false) . '"></button>';
        }

        $html .= '</div>';

        if ($has_sub) {
            $html .= nm_cats_render($children, $ctype_name, $o, $depth + 1);
        }

        $html .= '</li>';
    }

    return $html . '</ul>';
}
