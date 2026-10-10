<?php
/**
 * Установщик шаблона New Modern
 */

function install_package($options = []) {
    return true;
}

function after_install_package($options = []) {

    $template_name = 'new_modern';

    $model = new cmsModel();
    $model->localizedOff();

    $has_rows = $model->filterEqual('template', $template_name)->getCount('layout_rows', 'id', true);

    // При первой установке сетка создаётся всегда, при повторной — по галочке
    if (!$has_rows || !empty($options['import_scheme'])) {
        nm_install_scheme($model, $template_name, $options);
    }

    nm_install_default_options($template_name);

    // Компилируем CSS из сохранённых настроек (при обновлении сохраняется выбранный скин)
    nm_compile_css($template_name);

    if (!empty($options['set_default'])) {
        $config = cmsConfig::getInstance();
        $values = $config->getConfig();
        $values['template'] = $template_name;
        $config->save($values);
    }

    cmsCache::getInstance()->clean('layout.rows');
    cmsCache::getInstance()->clean('widgets.bind_pages');
    cmsCache::getInstance()->clean('widgets.bind');

    return true;
}

/**
 * Компиляция SCSS шаблона, как кнопка «Сохранить и скомпилировать SCSS»
 */
function nm_compile_css($template_name) {

    try {

        $template = new cmsTemplate($template_name);

        $renderer = cmsCore::getController('renderer', new cmsRequest([
            'middleware' => 'scss'
        ]), cmsRequest::CTX_INTERNAL);

        $renderer->cms_template = $template;

        $renderer->render($template_name, $template->getOptions() ?: []);

        // Сброс кэша браузера для CSS
        $config = cmsConfig::getInstance();
        if ($config->production_time > 0) {
            $values = $config->getConfig();
            $values['production_time'] += 1;
            $config->save($values);
        }

    } catch (Throwable $e) {
        // В пакете есть заранее скомпилированный CSS скина «Океан»
        cmsUser::addSessionMessage('New Modern: CSS не скомпилирован автоматически, нажмите «Сохранить и скомпилировать SCSS» в настройках шаблона', 'info');
        return false;
    }

    return true;
}

/**
 * Настройки шаблона по умолчанию.
 * Логотипы, favicon, копирайт и прочие общие настройки берутся у modern, если они там заданы.
 */
function nm_install_default_options($template_name) {

    $config = cmsConfig::getInstance();
    $file   = $config->root_path . ltrim(ICMS_CONFIG_DIR, '/') . 'theme_' . $template_name . '.yml';

    $options = [];

    if (is_readable($file)) {
        // Обновление: сохраняем выбранное, дописываем только новые настройки
        $options = cmsModel::yamlToArray(file_get_contents($file)) ?: [];
    } else {
        $modern_file = $config->root_path . ltrim(ICMS_CONFIG_DIR, '/') . 'theme_modern.yml';
        if (is_readable($modern_file)) {
            $options = cmsModel::yamlToArray(file_get_contents($modern_file)) ?: [];
            // Цвета modern не используются: их заменяют скины
            foreach (['primary','secondary','success','info','warning','danger','body-bg','body-color','link-color',
                      'header-bg','header-color','footer-bg','footer-color','white','black','blue','indigo','purple','pink',
                      'red','orange','yellow','green','teal','cyan','gray-100','gray-200','gray-300','gray-400','gray-500',
                      'gray-600','gray-700','gray-800','gray-900'] as $key) {
                unset($options['scss'][$key], $options['custom_scss'][$key]);
            }
        }
    }

    // Шрифт задаётся вкладкой «Шрифты» New Modern; поля modern убираем,
    // иначе main.tpl modern подгрузит ещё и его Google-шрифт
    $options['font_type'] = '';
    unset($options['gfont'], $options['font_string']);

    foreach (nm_default_scss() as $key => $value) {
        if (!isset($options['scss'][$key])) {
            $options['scss'][$key] = $value;
        }
    }

    return @file_put_contents($file, cmsModel::arrayToYaml($options)) !== false;
}

/**
 * Значения по умолчанию настроек New Modern (совпадают с формой и !default в SCSS)
 */
function nm_default_scss() {
    return [
        'nm-skin'              => 'ocean',
        'nm-layout'            => 'adaptive',
        'nm-container-width'   => '1200px',
        'nm-container-padding' => '15px',
        'nm-density'           => 'normal',
        'nm-widget-gap'        => '1.5rem',
        'nm-widget-padding'    => '1.25rem',
        'nm-section-y'         => '1.5rem',
        'nm-radius'            => 'md',
        'nm-controls'          => 'base',
        'nm-img-radius'        => 'same',
        'nm-font'              => 'l-inter',
        'nm-hfont'             => 'body',
        'nm-headings-weight'   => '700',
        'nm-wt'                => 'accent',
        'nm-wt-size'           => 'md',
        'nm-card'              => 'bordered'
    ];
}

/**
 * Готовая сетка виджетов New Modern.
 * Имена позиций постоянные (nm_*), поэтому одинаковы на любом сайте.
 */
function nm_install_scheme(cmsModel $model, $template_name, $options = []) {

    // Удаляем прежнюю схему и виджеты этого шаблона
    $rows = $model->filterEqual('template', $template_name)->get('layout_rows');
    if ($rows) {
        $model->filterIn('row_id', array_keys($rows))->deleteFiltered('layout_cols');
        $model->filterEqual('template', $template_name)->deleteFiltered('layout_rows');
    }
    $binds = $model->filterEqual('template', $template_name)->get('widgets_bind_pages');
    if ($binds) {
        $bind_ids = array_unique(array_column($binds, 'bind_id'));
        $model->filterEqual('template', $template_name)->deleteFiltered('widgets_bind_pages');
        // Удаляем только привязки, которые больше нигде не используются
        foreach ($bind_ids as $bind_id) {
            if (!$model->filterEqual('bind_id', $bind_id)->getCount('widgets_bind_pages', 'id', true)) {
                $model->delete('widgets_bind', $bind_id);
            }
        }
    }

    $row_opts = function ($o = []) {
        return array_merge([
            'no_gutters'          => null,
            'vertical_align'      => '',
            'horizontal_align'    => '',
            'container'           => 'container',
            'container_tag'       => 'div',
            'container_tag_class' => '',
            'parrent_tag'         => '',
            'parrent_tag_class'   => ''
        ], $o);
    };

    $col_opts = function ($o = []) {
        return array_merge([
            'cut_before'        => null,
            'default_col_class' => '',
            'md_col_class'      => '',
            'lg_col_class'      => '',
            'xl_col_class'      => '',
            'col_class'         => '',
            'default_order'     => 0,
            'sm_order'          => 0,
            'md_order'          => 0,
            'lg_order'          => 0,
            'xl_order'          => 0
        ], $o);
    };

    // Ряд => колонки. tag ряда null — без обёртки .row
    $scheme = [
        [
            'title' => 'Верхняя панель', 'tag' => 'div', 'class' => 'align-items-center nm-topbar__row',
            'options' => $row_opts(['parrent_tag' => 'div', 'parrent_tag_class' => 'nm-topbar']),
            'cols' => [
                ['title' => 'Слева',  'name' => 'nm_topbar_left',  'options' => $col_opts(['default_col_class' => 'col'])],
                ['title' => 'Справа', 'name' => 'nm_topbar_right', 'class' => 'd-flex justify-content-end', 'options' => $col_opts(['default_col_class' => 'col-auto'])]
            ]
        ],
        [
            'title' => 'Шапка', 'tag' => 'div', 'class' => 'align-items-center flex-nowrap nm-header__row',
            'options' => $row_opts(['parrent_tag' => 'header', 'parrent_tag_class' => 'nm-header']),
            'cols' => [
                ['title' => 'Логотип', 'name' => 'nm_logo', 'class' => 'nm-header__logo', 'options' => $col_opts(['default_col_class' => 'col-auto'])],
                ['title' => 'Центр шапки (поиск)', 'name' => 'nm_header_center', 'class' => 'd-none d-lg-block', 'options' => $col_opts(['default_col_class' => 'col'])],
                ['title' => 'Справа (меню пользователя)', 'name' => 'nm_header_right', 'class' => 'd-flex align-items-center justify-content-end ml-auto', 'options' => $col_opts(['default_col_class' => 'col-auto'])]
            ]
        ],
        [
            'title' => 'Главное меню', 'tag' => null, 'class' => null,
            'options' => $row_opts(['parrent_tag' => 'nav', 'parrent_tag_class' => 'nm-nav']),
            'cols' => [
                ['title' => 'Меню', 'name' => 'nm_menu', 'type' => 'custom', 'options' => $col_opts()]
            ]
        ],
        [
            'title' => 'Единая шапка-виджет', 'tag' => null, 'class' => null,
            'options' => $row_opts(['container' => '', 'parrent_tag' => 'div', 'parrent_tag_class' => 'nm-header-widget']),
            'cols' => [
                ['title' => 'Шапка во всю ширину', 'name' => 'nm_header_full', 'type' => 'custom', 'options' => $col_opts()]
            ]
        ],
        [
            'title' => 'Первый экран', 'tag' => null, 'class' => null,
            'options' => $row_opts(['container' => '', 'parrent_tag' => 'section', 'parrent_tag_class' => 'nm-hero']),
            'cols' => [
                ['title' => 'Во всю ширину', 'name' => 'nm_hero', 'type' => 'custom', 'options' => $col_opts()]
            ]
        ],
        [
            'title' => 'Над контентом', 'tag' => 'div', 'class' => null,
            'options' => $row_opts(['parrent_tag' => 'div', 'parrent_tag_class' => 'nm-before']),
            'cols' => [
                ['title' => 'Глубиномер и действия', 'name' => 'nm_breadcrumbs', 'class' => 'd-flex justify-content-between align-items-center flex-wrap', 'options' => $col_opts(['default_col_class' => 'col-12'])],
                ['title' => 'Перед телом страницы', 'name' => 'nm_before', 'class' => 'mt-3', 'options' => $col_opts(['default_col_class' => 'col-12'])]
            ]
        ],
        [
            'title' => 'Контент', 'tag' => 'div', 'class' => null,
            'options' => $row_opts(['container_tag' => 'main', 'container_tag_class' => 'nm-main']),
            'cols' => [
                ['title' => 'Левая колонка', 'name' => 'nm_left', 'tag' => 'aside', 'class' => 'nm-aside', 'options' => $col_opts(['lg_col_class' => 'col-lg-3', 'default_order' => 2, 'lg_order' => 1])],
                ['title' => 'Тело страницы', 'name' => 'nm_body', 'tag' => 'article', 'class' => 'nm-body mb-4', 'options' => $col_opts(['lg_col_class' => 'col-lg', 'default_order' => 1, 'lg_order' => 2])],
                ['title' => 'Правая колонка', 'name' => 'nm_right', 'tag' => 'aside', 'class' => 'nm-aside', 'options' => $col_opts(['lg_col_class' => 'col-lg-4', 'xl_col_class' => 'col-xl-3', 'default_order' => 3, 'lg_order' => 3])]
            ]
        ],
        [
            'title' => 'Под контентом', 'tag' => 'div', 'class' => null,
            'options' => $row_opts(['parrent_tag' => 'section', 'parrent_tag_class' => 'nm-after']),
            'cols' => [
                ['title' => 'Слева', 'name' => 'nm_after_left', 'options' => $col_opts(['md_col_class' => 'col-md'])],
                ['title' => 'Справа', 'name' => 'nm_after_right', 'options' => $col_opts(['md_col_class' => 'col-md'])]
            ]
        ],
        [
            'title' => 'Во всю ширину внизу', 'tag' => null, 'class' => null,
            'options' => $row_opts(['container' => '', 'parrent_tag' => 'section', 'parrent_tag_class' => 'nm-promo']),
            'cols' => [
                ['title' => 'Во всю ширину', 'name' => 'nm_promo', 'type' => 'custom', 'options' => $col_opts()]
            ]
        ],
        [
            'title' => 'Подвал', 'tag' => 'div', 'class' => null,
            'options' => $row_opts(['parrent_tag' => 'footer', 'parrent_tag_class' => 'nm-footer']),
            'cols' => [
                ['title' => 'Подвал 1', 'name' => 'nm_footer_1', 'class' => 'mb-4', 'options' => $col_opts(['md_col_class' => 'col-md-6', 'lg_col_class' => 'col-lg-3'])],
                ['title' => 'Подвал 2', 'name' => 'nm_footer_2', 'class' => 'mb-4', 'options' => $col_opts(['md_col_class' => 'col-md-6', 'lg_col_class' => 'col-lg-3'])],
                ['title' => 'Подвал 3', 'name' => 'nm_footer_3', 'class' => 'mb-4', 'options' => $col_opts(['md_col_class' => 'col-md-6', 'lg_col_class' => 'col-lg-3'])],
                ['title' => 'Подвал 4', 'name' => 'nm_footer_4', 'class' => 'mb-4', 'options' => $col_opts(['md_col_class' => 'col-md-6', 'lg_col_class' => 'col-lg-3'])]
            ]
        ],
        [
            'title' => 'Нижняя строка', 'tag' => 'div', 'class' => 'align-items-center nm-footer-bottom__row',
            'options' => $row_opts(['parrent_tag' => 'div', 'parrent_tag_class' => 'nm-footer-bottom']),
            'cols' => [
                ['title' => 'Копирайт', 'name' => 'nm_copyright', 'class' => 'py-2', 'options' => $col_opts(['md_col_class' => 'col-md'])],
                ['title' => 'Меню подвала', 'name' => 'nm_footer_menu', 'class' => 'py-2', 'options' => $col_opts(['md_col_class' => 'col-md-auto'])]
            ]
        ]
    ];

    $ordering = 0;
    foreach ($scheme as $row) {
        $ordering++;
        $row_id = $model->insert('layout_rows', [
            'parent_id'       => null,
            'title'           => $row['title'],
            'tag'             => $row['tag'],
            'template'        => $template_name,
            'ordering'        => $ordering,
            'nested_position' => null,
            'class'           => $row['class'],
            'options'         => $row['options']
        ], true);
        $col_ordering = 0;
        foreach ($row['cols'] as $col) {
            $col_ordering++;
            $model->insert('layout_cols', [
                'row_id'   => $row_id,
                'title'    => $col['title'],
                'name'     => $col['name'],
                'type'     => $col['type'] ?? 'typical',
                'ordering' => $col_ordering,
                'tag'      => $col['tag'] ?? 'div',
                'class'    => $col['class'] ?? null,
                // У custom-колонок обязательна обёртка с {position}, иначе виджеты не выводятся
                'wrapper'  => $col['wrapper'] ?? (($col['type'] ?? 'typical') === 'custom' ? '{position}' : null),
                'options'  => $col['options']
            ], true);
        }
    }

    $from = $options['widgets_from'] ?? 'modern';

    if (!$from || !nm_install_widgets_from($model, $template_name, $from)) {
        nm_install_widgets($model, $template_name);
    }

    return true;
}

/**
 * Соответствие позиций modern (стандартная схема 2.18) позициям New Modern
 */
function nm_positions_map() {
    return [
        'pos_26'     => 'nm_topbar_right',  // Верхний ряд
        'pos_27'     => 'nm_logo',          // Лого, поиск, меню пользователя (уточняется по виджету)
        'pos_31'     => 'nm_header_right',  // Меню пользователя
        'pos_29'     => 'nm_menu',          // Позиция меню
        'con_header' => 'nm_hero',          // Во всю ширину
        'pos_22'     => 'nm_before',        // Инфо (сообщение об отключении сайта)
        'pos_10'     => 'nm_breadcrumbs',   // Глубиномер
        'pos_33'     => 'nm_before',        // Перед телом страницы
        'pos_34'     => 'nm_left',          // Левая колонка
        'pos_8'      => 'nm_body',          // Тело страницы
        'pos_9'      => 'nm_right',         // Правая колонка
        'pos_17'     => 'nm_after_left',    // После контента, слева
        'pos_18'     => 'nm_after_right',   // После контента, справа
        'pos_38'     => 'nm_footer_1',      // Перед футером, слева
        'pos_39'     => 'nm_footer_2',      // Перед футером, в центре
        'pos_40'     => 'nm_footer_3',      // Перед футером, справа
        'pos_11'     => 'nm_copyright',     // Футер
        'pos_32'     => 'nm_footer_menu'    // Меню в футере
    ];
}

/**
 * Перенос виджетов из другого шаблона (по умолчанию modern).
 * Виджеты копируются: общие привязки опасны, штатный импорт схемы
 * удаляет виджеты целиком, и они пропали бы и у исходного шаблона.
 * Возвращает false, если в исходном шаблоне нет виджетов.
 */
function nm_install_widgets_from(cmsModel $model, $template_name, $from) {

    $binds = $model->filterEqual('template', $from)->orderBy('position, ordering')->limit(false)->get('widgets_bind_pages');
    if (!$binds) {
        return false;
    }

    $map = nm_positions_map();

    // Сведения о виджетах привязок (контроллер, имя, тип элемента шаблона)
    $bind_ids = array_unique(array_column($binds, 'bind_id'));
    $model->select('w.controller', 'w_controller')->select('w.name', 'w_name')->join('widgets', 'w', 'w.id = i.widget_id');
    $wb = $model->filterIn('i.id', $bind_ids)->limit(false)->get('widgets_bind') ?: [];

    $new_bind_ids = [];
    $moved = 0;
    $unused = [];

    foreach ($binds as $bp) {

        $bind = $wb[$bp['bind_id']] ?? null;
        if (!$bind) {
            continue;
        }

        $position = $bp['position'];

        if ($position === '_unused') {
            $target = '_unused';
        } elseif ($position === 'pos_27') {
            $opts = cmsModel::yamlToArray($bind['options']);
            if ($bind['w_name'] === 'template' && ($opts['type'] ?? '') === 'logo') {
                $target = 'nm_logo';
            } elseif ($bind['w_controller'] === 'search') {
                $target = 'nm_header_center';
            } else {
                $target = 'nm_header_right';
            }
        } elseif (isset($map[$position])) {
            $target = $map[$position];
        } else {
            $target = '_unused';
            $unused[] = $bind['title'] ?: $bind['w_name'];
        }

        $bind_id = $bp['bind_id'];

        if (!isset($new_bind_ids[$bind_id])) {
            $row = $model->getItemById('widgets_bind', $bind_id);
            unset($row['id']);
            $new_bind_ids[$bind_id] = $model->insert('widgets_bind', $row);
        }
        $bind_id = $new_bind_ids[$bind_id];

        $model->insert('widgets_bind_pages', [
            'bind_id'    => $bind_id,
            'template'   => $template_name,
            'is_enabled' => $target === '_unused' ? 0 : $bp['is_enabled'],
            'page_id'    => $bp['page_id'],
            'position'   => $target,
            'ordering'   => $bp['ordering']
        ]);

        $moved++;
    }

    $message = sprintf('New Modern: из шаблона «%s» скопировано виджетов: %d.', $from, $moved);
    if ($unused) {
        $message .= ' Из нестандартных позиций в «Неиспользуемые»: ' . implode(', ', array_unique($unused)) . '.';
    }
    cmsUser::addSessionMessage($message, 'info');

    return true;
}

/**
 * Штатные виджеты в позициях сетки
 */
function nm_install_widgets(cmsModel $model, $template_name) {

    $menu_opts = function ($o) {
        return array_merge([
            'menu' => 'main', 'template' => 'menu', 'class' => '', 'is_detect' => 1, 'is_detect_strict' => null,
            'max_items' => 0, 'navbar_color_scheme' => 'navbar-dark', 'menu_nav_style' => '', 'menu_nav_style_add' => '',
            'menu_type' => 'navbar', 'navbar_expand' => '', 'show_search_form' => 0, 'toggler_icon' => null,
            'toggler_show_sitename' => null, 'menu_is_pills' => null, 'menu_is_fill' => ''
        ], $o);
    };
    $tpl_opts = function ($type, $session_type = 'on_position') {
        return ['type' => $type, 'session_type' => $session_type, 'breadcrumbs' => ['template' => 'breadcrumbs', 'strip_last' => null]];
    };

    // [controller, name, title, position, ordering, tpl_body, options, extra]
    $widgets = [
        [null, 'template', 'Сообщение об отключении сайта', 'nm_before', 0, 'template', $tpl_opts('site_closed'), []],
        [null, 'template', 'Лого', 'nm_logo', 0, 'template', $tpl_opts('logo'), []],
        ['search', 'search', 'Поиск', 'nm_header_center', 0, 'search', ['show_input' => 1, 'show_btn' => 1, 'show_search_params' => null], []],
        [null, 'menu', 'Меню авторизации', 'nm_header_right', 0, 'menu', $menu_opts(['menu' => 'header', 'navbar_color_scheme' => 'navbar-light']), ['groups_view' => [1]]],
        [null, 'menu', 'Меню уведомлений', 'nm_header_right', 1, 'menu', $menu_opts(['menu' => 'notices', 'navbar_color_scheme' => 'navbar-light']), ['class_wrap' => 'mr-3']],
        ['users', 'avatar', 'Меню пользователя', 'nm_header_right', 2, 'avatar', ['menu' => 'personal', 'is_detect' => null, 'max_items' => 0], ['groups_hide' => [1]]],
        [null, 'menu', 'Главное меню', 'nm_menu', 0, 'menu', $menu_opts([
            'class' => 'icms-menu-hovered', 'navbar_expand' => 'navbar-expand-lg', 'show_search_form' => 2,
            'toggler_icon' => 1, 'toggler_show_sitename' => 1
        ]), []],
        [null, 'template', 'Глубиномер', 'nm_breadcrumbs', 0, 'template', $tpl_opts('breadcrumbs'), []],
        [null, 'menu', 'Действия', 'nm_breadcrumbs', 1, 'menu_dropdown', $menu_opts([
            'menu' => 'toolbar', 'is_detect' => null, 'navbar_color_scheme' => '', 'menu_type' => 'nav', 'toggler_icon' => 1
        ]), ['class_wrap' => 'ml-auto icms-actions-menu', 'is_title' => 1]],
        [null, 'template', 'Сообщения сессии', 'nm_body', 0, 'template', $tpl_opts('smessages', 'toastr'), []],
        [null, 'template', 'Тело страницы', 'nm_body', 1, 'template', $tpl_opts('body'), []],
        [null, 'template', 'Копирайт/отладка', 'nm_copyright', 0, 'template', $tpl_opts('copyright'), []]
    ];

    foreach ($widgets as $w) {

        [$controller, $name, $title, $position, $ordering, $tpl_body, $options, $extra] = $w;

        if ($controller) {
            $model->filterEqual('controller', $controller);
        } else {
            $model->filterIsNull('controller');
        }
        $widget = $model->filterEqual('name', $name)->getItem('widgets');
        if (!$widget) {
            continue;
        }

        $bind_id = $model->insert('widgets_bind', [
            'widget_id'    => $widget['id'],
            'title'        => $title,
            'class_wrap'   => $extra['class_wrap'] ?? null,
            'is_title'     => $extra['is_title'] ?? null,
            'groups_view'  => $extra['groups_view'] ?? [],
            'groups_hide'  => $extra['groups_hide'] ?? null,
            'options'      => $options,
            'tpl_body'     => $tpl_body,
            'is_cacheable' => 1
        ]);

        $model->insert('widgets_bind_pages', [
            'bind_id'    => $bind_id,
            'template'   => $template_name,
            'is_enabled' => 1,
            'page_id'    => 0,
            'position'   => $position,
            'ordering'   => $ordering
        ]);
    }

    return true;
}
