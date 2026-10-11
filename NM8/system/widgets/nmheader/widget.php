<?php
/**
 * Виджет «Шапка New Modern»: логотип, верхняя строка, меню, поиск, меню пользователя.
 * Три варианта: classic, center (поиск посередине), line (всё в одну строку).
 */
class widgetNmheader extends cmsWidget {

    // Блок пользователя зависит от авторизации
    public $is_cacheable = false;

    // Сообщения для администратора
    private $nm_debug = [];

    public function run() {

        $config = cmsConfig::getInstance();

        $variant = $this->getOption('variant', 'classic');
        if (!in_array($variant, ['classic', 'center', 'line'])) {
            $variant = 'classic';
        }

        $mobile_layout = $this->getOption('mobile_layout', 'two_rows');
        if (!in_array($mobile_layout, ['two_rows', 'one_row'])) {
            $mobile_layout = 'two_rows';
        }

        $mobile_menu = $this->getOption('mobile_menu', 'accordion');
        if (!in_array($mobile_menu, ['accordion', 'expanded', 'top'])) {
            $mobile_menu = 'accordion';
        }

        // Ширина содержимого: container — как у шаблона, fluid — 100% окна, custom — своя ширина в px
        $width_mode = $this->getOption('container', 'container');
        if (!in_array($width_mode, ['container', 'fluid', 'custom'])) {
            $width_mode = 'container';
        }

        $this->is_title = false;

        $logo_text = (string)$this->getOption('logo_text', '');

        $o = [
            'variant'        => $variant,
            'mobile_layout'  => $mobile_layout,
            'mobile_menu'    => $mobile_menu,
            'width_mode'     => $width_mode,
            'width_custom'   => max(320, (int)$this->getOption('container_width', 1400)),
            'width_pad'      => max(0, (int)$this->getOption('container_pad', 15)),
            'burger'         => $this->getOption('burger', 'mobile'),
            'show_search'    => (bool)$this->getOption('show_search', true) && cmsController::enabled('search'),
            'search_placeholder' => (string)$this->getOption('search_placeholder', ''),
            'show_user'      => (bool)$this->getOption('show_user', true),
            'show_messages'  => (bool)$this->getOption('show_messages', true),
            // По умолчанию меню пользователя берётся из «Персонального меню»
            'user_menu_name' => (string)$this->getOption('user_menu_name', 'personal'),
            'menu_name'      => (string)$this->getOption('menu_name', 'main'),
            'menu_max'       => (int)$this->getOption('menu_max', 0),
            'show_topbar'    => (bool)$this->getOption('show_topbar', false),
            'topbar_text'    => (string)$this->getOption('topbar_text', ''),
            'topbar_links'   => $this->parseLinks((string)$this->getOption('topbar_links', '')),
            'logo_alt'       => $logo_text !== '' ? $logo_text : (string)$config->sitename,
            'logo_h'         => max(16, (int)$this->getOption('logo_height', 48)),
            'logo_maxw'      => max(40, (int)$this->getOption('logo_max_width', 240)),
            'logo_h_mobile'  => max(16, (int)$this->getOption('logo_height_mobile', 36)),
            'logo_h_sticky'  => max(16, (int)$this->getOption('logo_height_sticky', 36)),
            'sticky'         => (bool)$this->getOption('sticky', false),
            'sticky_mobile'  => (bool)$this->getOption('sticky_mobile', false),
            'sticky_compact' => (bool)$this->getOption('sticky_compact', true),
            'sticky_offset'  => max(0, (int)$this->getOption('sticky_offset', 0)),
            'blur'           => (bool)$this->getOption('blur', false),
        ];

        // Цвета трёх зон: верхняя строка, ряд с логотипом (или вся строка), ряд с меню
        $o['colors_style'] = $this->buildZoneStyle('tb', '--nm-topbar-rgb', '15, 27, 45')
                           . $this->buildZoneStyle('hd', '--nm-header-rgb', '255, 255, 255')
                           . $this->buildZoneStyle('nv', '--nm-nav-rgb', '29, 111, 224');

        // Логотип. Приоритет: адрес файла, загруженный SVG, загруженное растровое изображение
        $o['logo_url']        = $this->resolveImagePath($this->getOption('logo_path', ''))
                             ?: $this->getFileUrl($this->getOption('logo_svg'))
                             ?: $this->getImageUrl($this->getOption('logo'));
        $o['logo_mobile_url'] = $this->resolveImagePath($this->getOption('logo_mobile_path', ''))
                             ?: $this->getFileUrl($this->getOption('logo_mobile_svg'))
                             ?: $this->getImageUrl($this->getOption('logo_mobile'));

        if (!$o['logo_url']) {
            $o['logo_url'] = rtrim((string)$config->host, '/') . '/templates/new_modern/images/logo.svg';
        }

        // Класс navbar-nav не используем: в Bootstrap 4 он делает выпадающие списки статичными и растягивает шапку
        $o['menu_html']       = $this->buildMenu($o['menu_name'], 'nav nm-hw__menu', $o['menu_max'], false, true);
        $o['menu_panel_html'] = $this->buildMenu($o['menu_name'], 'nav flex-column nm-hw__menu nm-hw__menu--panel', $o['menu_max'], false, false);

        $is_logged = cmsUser::isLogged();

        $user     = [];
        $counters = ['messages' => 0, 'notices' => 0];
        $o['user_menu_html'] = '';

        if ($is_logged) {

            $user = [
                'id'       => cmsUser::get('id'),
                'nickname' => (string)cmsUser::get('nickname'),
                'slug'     => cmsUser::get('slug'),
                'avatar'   => cmsUser::get('avatar'),
            ];

            if ($o['show_user']) {

                if ($o['show_messages']) {
                    $counters = $this->getCounters($user['id']);
                }

                if ($o['user_menu_name']) {
                    $o['user_menu_html'] = $this->buildMenu($o['user_menu_name'], 'nm-hw__user-menu list-unstyled mb-0', 0, true, true);
                }
            }
        }

        return [
            'o'            => $o,
            'home_url'     => rtrim((string)$config->host, '/') . '/',
            'is_logged'    => $is_logged,
            'user'         => $user,
            'counters'     => $counters,
            'debug'        => cmsUser::isAdmin() ? $this->nm_debug : [],
            'messages_url' => href_to('messages'),
            'notices_url'  => href_to('messages', 'notices'),
        ];
    }

    /**
     * Цвет зоны шапки в виде CSS-переменных.
     *
     * Режим skin без прозрачности ничего не переопределяет: цвета берутся из скина сайта.
     * Остальные режимы задают --nm-hw-{зона}-bg (цвет или градиент) и --nm-hw-{зона}-color (цвет текста).
     * Для прозрачности цвета скина используются RGB-переменные скина (--nm-*-rgb).
     *
     * @param string $p           Префикс зоны: tb, hd, nv
     * @param string $rgb_var     RGB-переменная скина для этой зоны
     * @param string $rgb_default Значение по умолчанию, если переменной нет в собранном CSS
     * @return string
     */
    private function buildZoneStyle($p, $rgb_var, $rgb_default) {

        $modes = ['skin', 'primary', 'accent', 'bg', 'surface', 'color', 'gradient', 'skin_gradient'];

        $mode = (string)$this->getOption($p . '_mode', 'skin');
        if (!in_array($mode, $modes)) { $mode = 'skin'; }

        $opacity = max(0, min(100, (int)$this->getOption($p . '_opacity', 100)));
        $alpha   = rtrim(rtrim(sprintf('%.2F', $opacity / 100), '0'), '.');
        if ($alpha === '') { $alpha = '0'; }

        $text_mode = (string)$this->getOption($p . '_text', 'auto');
        $angle     = max(0, min(360, (int)$this->getOption($p . '_angle', 135)));

        $c1 = $this->cleanColor($this->getOption($p . '_color', ''));
        $c2 = $this->cleanColor($this->getOption($p . '_color2', ''));

        // Цвета скина: сплошной, RGB для прозрачности, цвет текста
        $presets = [
            'primary' => ['var(--nm-primary)', 'var(--nm-primary-rgb)', 'var(--nm-on-primary)'],
            'accent'  => ['var(--nm-accent)', 'var(--nm-accent-rgb, 255, 122, 26)', 'var(--nm-on-accent)'],
            'bg'      => ['var(--nm-bg)', 'var(--nm-bg-rgb, 243, 246, 251)', 'var(--nm-text)'],
            'surface' => ['var(--nm-surface)', 'var(--nm-surface-rgb, 255, 255, 255)', 'var(--nm-text)'],
        ];

        $bg    = null;
        $color = null;

        if (isset($presets[$mode])) {

            list($solid, $rgb, $color) = $presets[$mode];
            $bg = $opacity < 100 ? 'rgba(' . $rgb . ', ' . $alpha . ')' : $solid;

        } elseif ($mode === 'color' && $c1) {

            $bg    = $this->colorCss($c1, $alpha);
            $color = $this->contrastText([$c1]);

        } elseif ($mode === 'gradient' && $c1 && $c2) {

            $bg    = 'linear-gradient(' . $angle . 'deg, ' . $this->colorCss($c1, $alpha) . ', ' . $this->colorCss($c2, $alpha) . ')';
            $color = $this->contrastText([$c1, $c2]);

        } elseif ($mode === 'skin_gradient') {

            $bg = 'linear-gradient(' . $angle . 'deg, rgba(var(--nm-primary-rgb), ' . $alpha . '), rgba(var(--nm-accent-rgb, 255, 122, 26), ' . $alpha . '))';
            $color = 'var(--nm-on-primary)';

        } elseif ($mode === 'skin' && $opacity < 100) {

            $bg = 'rgba(var(' . $rgb_var . ', ' . $rgb_default . '), ' . $alpha . ')';
        }

        // Цвет текста можно задать вручную
        if ($text_mode === 'light') { $color = '#ffffff'; }
        if ($text_mode === 'dark')  { $color = '#1b1f24'; }

        $css = '';
        if ($bg !== null)    { $css .= '--nm-hw-' . $p . '-bg:' . $bg . ';'; }
        if ($color !== null) { $css .= '--nm-hw-' . $p . '-color:' . $color . ';'; }

        return $css;
    }

    /**
     * Проверка цвета вида #rgb или #rrggbb. Возвращает [r, g, b] или null.
     */
    private function cleanColor($value) {

        $value = trim((string)$value);

        if (!preg_match('/^#([0-9a-f]{3}|[0-9a-f]{6})$/i', $value, $m)) { return null; }

        $hex = $m[1];
        if (strlen($hex) === 3) { $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2]; }

        return [hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2))];
    }

    /**
     * Цвет в CSS: с прозрачностью rgba, без неё hex
     */
    private function colorCss(array $rgb, $alpha) {

        if ($alpha === '1') {
            return sprintf('#%02x%02x%02x', $rgb[0], $rgb[1], $rgb[2]);
        }

        return 'rgba(' . $rgb[0] . ', ' . $rgb[1] . ', ' . $rgb[2] . ', ' . $alpha . ')';
    }

    /**
     * Светлый или тёмный текст для фона (по формуле YIQ, как в Bootstrap)
     */
    private function contrastText(array $colors) {

        $sum = 0;

        foreach ($colors as $rgb) {
            $sum += ($rgb[0] * 299 + $rgb[1] * 587 + $rgb[2] * 114) / 1000;
        }

        return ($sum / count($colors)) >= 150 ? '#1b1f24' : '#ffffff';
    }

    /**
     * Адрес загруженного через поле «Файл» (fieldFile) изображения.
     * Значение — массив с ключом path (путь внутри папки загрузок), так же, как у логотипа в шаблоне modern.
     * Путь собирается так же, как в modern: корень загрузок плюс path.
     *
     * @return string Адрес от корня сайта или пустая строка
     */
    private function getFileUrl($file) {

        if (empty($file)) { return ''; }

        if (is_string($file)) {
            $decoded = json_decode($file, true);
            $file    = is_array($decoded) ? $decoded : ['path' => $file];
        }

        if (empty($file['path']) || !is_string($file['path'])) { return ''; }

        $path = $file['path'];

        // Адрес выводится в атрибут src: лишние символы не пропускаем
        if (preg_match('/["\'<>\s\\\\]/', $path)) { return ''; }

        $config = cmsConfig::getInstance();

        return rtrim((string)$config->upload_root, '/') . '/' . ltrim($path, '/');
    }

    /**
     * Адрес картинки из текстового поля (запасной вариант, подходит для SVG, уже лежащего на сайте).
     *
     * Допустимы полный адрес http(s), путь от корня сайта (/upload/logo.svg)
     * или путь без начальной косой черты (upload/logo.svg). Другие схемы отбрасываются.
     * В кавычках и угловых скобках адрес не допускается: он выводится в атрибут src.
     *
     * @return string Готовый адрес или пустая строка
     */
    private function resolveImagePath($value) {

        $value = trim((string)$value);

        if ($value === '' || preg_match('/["\'<>\s\\\\]/', $value)) { return ''; }

        if (preg_match('#^([a-z][a-z0-9+.\-]*):#i', $value, $m)) {
            return in_array(strtolower($m[1]), ['http', 'https']) ? $value : '';
        }

        if (strpos($value, '//') === 0) { return $value; }

        $host = rtrim((string)cmsConfig::getInstance()->host, '/');

        return $host . '/' . ltrim($value, '/');
    }

    /**
     * Все меню сайта: системное имя => название. Читаем таблицу напрямую.
     */
    public static function getSiteMenus() {

        $list = [];

        try {
            $model = new cmsModel();
            $model->localizedOff();
            $rows = $model->get('menu');
            foreach ((array)$rows as $row) {
                if (!empty($row['name'])) {
                    $list[$row['name']] = !empty($row['title']) ? $row['title'] : $row['name'];
                }
            }
        } catch (Throwable $e) {
            // Список необязателен
        }

        return $list;
    }

    /**
     * Меню ядра в строку.
     *
     * cmsTemplate::menu() только выводит уже загруженные пункты. Загружает их виджет «Меню»
     * (modelMenu::getMenuItemsByName + setMenuItems), поэтому делаем то же самое здесь.
     *
     * @param string  $name      Системное имя меню
     * @param string  $css_class Класс списка
     * @param int     $max_items Максимум пунктов, 0 — без ограничения
     * @param boolean $strict    true — не подбирать другое меню
     * @param boolean $report    true — записывать проблемы для администратора
     */
    private function buildMenu($name, $css_class, $max_items, $strict, $report) {

        $site_menus = self::getSiteMenus();

        $names = $name ? [$name] : [];

        if (!$strict) {

            foreach (['main', 'header', 'top', 'mainmenu'] as $fallback) {
                if (isset($site_menus[$fallback]) && !in_array($fallback, $names)) { $names[] = $fallback; }
            }

            foreach (array_keys($site_menus) as $menu_name) {
                if (in_array($menu_name, $names)) { continue; }
                if (preg_match('/footer|bottom|personal|profile|user|toolbar|cabinet|notice/i', $menu_name)) { continue; }
                $names[] = $menu_name;
            }
        }

        $tried = [];

        foreach ($names as $menu_name) {

            $tried[] = $menu_name;
            $level   = ob_get_level();

            try {

                $template = cmsTemplate::getInstance();

                if (!$template->hasMenu($menu_name)) {

                    // Загружает класс modelMenu
                    cmsCore::getModel('menu');

                    $menu_items = modelMenu::getMenuItemsByName($menu_name, false);

                    if (!$menu_items) {
                        if ($report) { $this->nm_debug[] = 'В меню «' . $menu_name . '» нет доступных пунктов.'; }
                        continue;
                    }

                    $template->setMenuItems($menu_name, $menu_items);
                }

                ob_start();
                $result = $template->menu($menu_name, true, $css_class, (int)$max_items, false);
                $html   = ob_get_clean();

                if (trim((string)$html) === '' && is_string($result)) {
                    $html = $result;
                }

                if (trim((string)$html) !== '') {
                    if ($report && $name && $menu_name !== $name) {
                        $this->nm_debug[] = 'Меню «' . $name . '» пустое, использовано «' . $menu_name . '». Выберите нужное в настройках виджета.';
                    }
                    return (string)$html;
                }

                if ($report) { $this->nm_debug[] = 'Меню «' . $menu_name . '» загружено, но шаблон вернул пустой результат.'; }

            } catch (Throwable $e) {

                while (ob_get_level() > $level) { ob_end_clean(); }

                if ($report) {
                    $this->nm_debug[] = 'Меню «' . $menu_name . '»: ' . $e->getMessage();
                }
            }
        }

        if ($report) {

            $available = [];
            foreach ($site_menus as $menu_name => $title) { $available[] = $menu_name . ' (' . $title . ')'; }

            $this->nm_debug[] = 'Меню не выведено, проверены имена: ' . ($tried ? implode(', ', $tried) : 'нет') . '.';
            $this->nm_debug[] = 'Меню на сайте: ' . ($available ? implode('; ', $available) : 'список получить не удалось') . '.';
        }

        return '';
    }

    /**
     * Непрочитанные сообщения и уведомления пользователя
     */
    private function getCounters($user_id) {

        $counters = ['messages' => 0, 'notices' => 0];

        try {

            if (!cmsController::enabled('messages')) { return $counters; }

            $model = cmsCore::getModel('messages');

            if ($model && method_exists($model, 'getNewMessagesCount')) {
                $counters['messages'] = (int)$model->getNewMessagesCount($user_id);
            }
            if ($model && method_exists($model, 'getNoticesCount')) {
                $counters['notices'] = (int)$model->getNoticesCount($user_id);
            }

        } catch (Throwable $e) {
            // Счётчики необязательны
        }

        return $counters;
    }

    /**
     * Строки «Название|адрес» в массив ссылок.
     *
     * Адрес может быть:
     * - полным: https://example.com/page, mailto:a@b.ru, tel:+7900...;
     * - от корня сайта: /news;
     * - относительным: news или news/sport (добавляется адрес сайта);
     * - якорем: #contacts.
     * Остальные схемы (javascript:, data: и т.п.) отбрасываются.
     */
    private function parseLinks($text) {

        $links = [];
        $host  = rtrim((string)cmsConfig::getInstance()->host, '/');

        foreach (preg_split('/\r\n|\r|\n/', $text) as $line) {

            $line = trim($line);
            if ($line === '') { continue; }

            $parts = explode('|', $line, 2);
            if (count($parts) < 2) { continue; }

            $title = trim($parts[0]);
            $url   = trim($parts[1]);

            if ($title === '' || $url === '') { continue; }

            if (preg_match('#^([a-z][a-z0-9+.\-]*):#i', $url, $m)) {

                // Есть схема: разрешаем только безопасные
                if (!in_array(strtolower($m[1]), ['http', 'https', 'mailto', 'tel'])) { continue; }

            } elseif (strpos($url, '//') === 0 || $url[0] === '#') {

                // Адрес без схемы или якорь: оставляем как есть

            } elseif ($url[0] === '/') {

                $url = $host . $url;

            } else {

                $url = $host . '/' . $url;
            }

            $links[] = ['title' => $title, 'url' => $url];
        }

        return $links;
    }

    /**
     * Адрес картинки из значения fieldImage (массив размеров) или строки
     */
    private function getImageUrl($image) {

        if (empty($image)) { return ''; }

        if (is_string($image)) {
            $path = $image;
        } else {
            $path = '';
            foreach (['original', 'normal', 'big', 'small'] as $k) {
                if (!empty($image[$k])) { $path = $image[$k]; break; }
            }
            if (!$path) {
                $first = reset($image);
                $path  = is_string($first) ? $first : '';
            }
        }

        if (!$path) { return ''; }

        if (preg_match('#^(https?:)?//#i', $path)) { return $path; }

        $config = cmsConfig::getInstance();

        return rtrim((string)$config->upload_host, '/') . '/' . ltrim($path, '/');
    }

}
