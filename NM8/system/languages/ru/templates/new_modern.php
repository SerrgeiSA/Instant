<?php
// Подписи modern нужны унаследованной части формы настроек
include_once __DIR__ . '/modern.php';

define('LANG_NM_TAB_SKIN',          'Цветовая схема');
define('LANG_NM_SKIN',              'Скин');
define('LANG_NM_SKIN_HINT',         'Готовая цветовая схема перекрашивает весь сайт: ссылки, кнопки, формы, меню, шапку и подвал. После выбора нажмите «Сохранить и скомпилировать SCSS».');
define('LANG_NM_CUSTOM_COLORS',     'Свои цвета поверх скина');
define('LANG_NM_CUSTOM_COLORS_HINT','Пустое поле — цвет берётся из выбранного скина.');
define('LANG_NM_C_PRIMARY',         'Основной цвет (кнопки, активные элементы)');
define('LANG_NM_C_ACCENT',          'Акцентный цвет');
define('LANG_NM_C_LINK',            'Цвет ссылок');
define('LANG_NM_C_BG',              'Фон страницы');
define('LANG_NM_C_SURFACE',         'Фон блоков и карточек');
define('LANG_NM_C_TEXT',            'Цвет текста');
define('LANG_NM_C_HEADING',         'Цвет заголовков');
define('LANG_NM_C_TOPBAR',          'Фон верхней панели');
define('LANG_NM_C_HEADER',          'Фон шапки');
define('LANG_NM_C_NAV',             'Фон главного меню');
define('LANG_NM_C_FOOTER',          'Фон подвала');

define('LANG_NM_SKIN_OCEAN',    'Океан — синий');
define('LANG_NM_SKIN_EMERALD',  'Изумруд — зелёно-бирюзовый');
define('LANG_NM_SKIN_SUNSET',   'Закат — коралловый');
define('LANG_NM_SKIN_BERRY',    'Ягода — малиновый');
define('LANG_NM_SKIN_INDIGO',   'Индиго — фиолетово-синий');
define('LANG_NM_SKIN_GRAPHITE', 'Графит — монохром с янтарём');
define('LANG_NM_SKIN_FOREST',   'Лес — тёмно-зелёный');
define('LANG_NM_SKIN_WINE',     'Бордо — винный с золотом');
define('LANG_NM_SKIN_SAND',     'Песок — тёплый терракотовый');
define('LANG_NM_SKIN_NIGHT',    'Ночь — тёмная тема');

// Этап 3. Макет и отступы
define('LANG_NM_TAB_LAYOUT',          'Ширина сайта');
define('LANG_NM_LAYOUT',              'Ширина');
define('LANG_NM_LAYOUT_ADAPTIVE',     'Адаптивная — ступенями Bootstrap');
define('LANG_NM_LAYOUT_FIXED',        'Фиксированная — плавно до заданной ширины');
define('LANG_NM_LAYOUT_FLUID',        'Во всю ширину окна');
define('LANG_NM_LAYOUT_BOXED',        'В рамке — сайт на фоне');
define('LANG_NM_CONTAINER_WIDTH',     'Максимальная ширина');
define('LANG_NM_CONTAINER_WIDTH_HINT','Например, 1200px или 1320px. Для адаптивной ширины — ширина на больших экранах.');
define('LANG_NM_CONTAINER_PADDING',   'Поля слева и справа');
define('LANG_NM_CSS_SIZE_HINT',       'CSS-размер: px или rem, например 15px или 1.5rem.');
define('LANG_NM_TAB_SPACING',         'Отступы');
define('LANG_NM_DENSITY',             'Плотность');
define('LANG_NM_DENSITY_COMPACT',     'Компактно');
define('LANG_NM_DENSITY_NORMAL',      'Обычно');
define('LANG_NM_DENSITY_SPACIOUS',    'Просторно');
define('LANG_NM_MANUAL',              'Вручную');
define('LANG_NM_WIDGET_GAP',          'Между виджетами');
define('LANG_NM_WIDGET_PADDING',      'Внутри виджета');
define('LANG_NM_SECTION_Y',           'Сверху и снизу у основной области');

// Этап 4. Скругления
define('LANG_NM_TAB_RADIUS',          'Скругления');
define('LANG_NM_RADIUS',              'Скругление углов');
define('LANG_NM_RADIUS_NONE',         'Без скруглений');
define('LANG_NM_RADIUS_SM',           'Малое');
define('LANG_NM_RADIUS_MD',           'Среднее');
define('LANG_NM_RADIUS_LG',           'Большое');
define('LANG_NM_RADIUS_XL',           'Очень большое');
define('LANG_NM_CONTROLS',            'Кнопки и поля ввода');
define('LANG_NM_CONTROLS_BASE',       'Как остальные элементы');
define('LANG_NM_CONTROLS_PILL',       'Овальные');
define('LANG_NM_IMG_RADIUS',          'Картинки в контенте');
define('LANG_NM_IMG_RADIUS_SAME',     'Со скруглением');
define('LANG_NM_IMG_RADIUS_NONE',     'Без скругления');

// Этап 5. Шрифты
define('LANG_NM_TAB_FONTS',           'Шрифты');
define('LANG_NM_FONT',                'Основной шрифт');
define('LANG_NM_FONT_HINT',           'Шрифты «В шаблоне» загружаются с вашего сайта, без обращения к Google.');
define('LANG_NM_HFONT',               'Шрифт заголовков');
define('LANG_NM_FONT_AS_BODY',        'Как основной');
define('LANG_NM_FONT_SYSTEM',         'Системный');
define('LANG_NM_FONT_CUSTOM',         'Свой шрифт');
define('LANG_NM_FONT_GROUP_LOCAL',    'В шаблоне (без Google)');
define('LANG_NM_FONT_GROUP_GOOGLE',   'Google Fonts — без засечек');
define('LANG_NM_FONT_GROUP_GOOGLE_SERIF', 'Google Fonts — с засечками');
define('LANG_NM_FONT_CUSTOM_FAMILY',  'Название шрифта (font-family)');
define('LANG_NM_FONT_CUSTOM_HINT',    'Например: "My Font", sans-serif. Подключите шрифт в поле «Код в начале &lt;head&gt;» на вкладке &lt;head&gt;.');
define('LANG_NM_HEADINGS_WEIGHT',     'Жирность заголовков');

// Этап 6. Виджеты
define('LANG_NM_TAB_WIDGETS',         'Виджеты');
define('LANG_NM_WT',                  'Стиль заголовков виджетов');
define('LANG_NM_WT_HINT',             'Для основной области и ряда «Под контентом». У отдельного виджета стиль меняется в его настройках: «Оформление» → «Стиль».');
define('LANG_NM_WT_SIZE',             'Размер заголовка');
define('LANG_NM_SIZE_SM',             'Маленький');
define('LANG_NM_SIZE_MD',             'Средний');
define('LANG_NM_SIZE_LG',             'Крупный');
define('LANG_NM_CARD',                'Вид виджета');
define('LANG_NM_WT_CARD',             'Шапка карточки');
define('LANG_NM_WT_PLAIN',            'Просто текст');
define('LANG_NM_WT_LINE',             'Линия снизу');
define('LANG_NM_WT_ACCENT',           'Цветной штрих снизу');
define('LANG_NM_WT_BAR',              'Полоса слева');
define('LANG_NM_WT_FILLED',           'Залитая шапка');
define('LANG_NM_WT_LINES',            'По центру между линиями');
define('LANG_NM_WT_CAPS',             'Капсом с точкой');
define('LANG_NM_WT_TAB',              'Вкладка');
define('LANG_NM_CARD_BORDERED',       'Карточка с рамкой');
define('LANG_NM_CARD_SHADOW',         'Карточка с тенью');
define('LANG_NM_CARD_FLAT',           'Плоская подложка');
define('LANG_NM_CARD_CLEAN',          'Без рамки и фона');
define('LANG_NM_WS_TITLE',            'Заголовок');
define('LANG_NM_WS_CARD',             'Вид');

// Списки контента
define('LANG_NM_TAB_LISTS',             'Списки контента');
define('LANG_NM_LIST_MORE',             'Подгрузка записей');
define('LANG_NM_LIST_MORE_HINT',        'Для стилей списков New Modern. Можно переопределить для стиля в типе контента: «Опции стилей списка», {"more": "auto"}');
define('LANG_NM_LIST_MORE_BUTTON',      'Кнопка «Загрузить ещё»');
define('LANG_NM_LIST_MORE_AUTO',        'Автоподгрузка при прокрутке');
define('LANG_NM_LIST_MORE_AUTO_BUTTON', 'Автоподгрузка, затем кнопка');
define('LANG_NM_LIST_MORE_PAGES',       'Только постраничная навигация');
define('LANG_NM_LIST_AUTO_PAGES',       'Сколько страниц подгружать автоматически');
define('LANG_NM_LIST_KEEP_PAGES',       'Показывать номера страниц под кнопкой');
define('LANG_NM_LIST_KEEP_PAGES_HINT',  'Полезно для навигации и поисковых систем');
define('LANG_NM_LOAD_MORE',             'Загрузить ещё');
define('LANG_NM_SHOWN_OF',              'Показано %s из %s');
define('LANG_NM_LOAD_ERROR',            'Не удалось загрузить, попробуйте ещё раз');
define('LANG_NM_MORE_LINK',             'Подробнее');
define('LANG_NM_VERIFIED',              'Проверено');
define('LANG_NM_NO_PRICE',              'Цена не указана');

define('LANG_NM_LS_CARDS',          'NM: Карточки сеткой');
define('LANG_NM_LS_OVERLAY',        'NM: Карточки с текстом на фото');
define('LANG_NM_LS_HORIZONTAL',     'NM: Горизонтальные карточки (блог)');
define('LANG_NM_LS_MAGAZINE',       'NM: Журнал');
define('LANG_NM_LS_NEWS',           'NM: Лента новостей по дням');
define('LANG_NM_LS_COMPACT',        'NM: Компактный список');
define('LANG_NM_LS_BOARD',          'NM: Объявления строками');
define('LANG_NM_LS_BOARD_GRID',     'NM: Объявления плиткой');
define('LANG_NM_LS_CATALOG',        'NM: Каталог карточками');
define('LANG_NM_LS_CATALOG_ROWS',   'NM: Каталог строками');
define('LANG_NM_LS_TIMELINE',       'NM: Хронология');
define('LANG_NM_LS_TOP',            'NM: Нумерованный топ');
define('LANG_NM_LS_MASONRY',        'NM: Кирпичная кладка');

// Стили списков: крупная запись
define('LANG_NM_LS_LEAD_LIST',      'NM: Крупная запись и список с миниатюрами');
define('LANG_NM_LS_LEAD_GRID',      'NM: Крупная запись и сетка карточек');

// Скины: мягкие светлые и тёмные
define('LANG_NM_SKIN_GROUP_CLASSIC', 'Яркие');
define('LANG_NM_SKIN_GROUP_SOFT', 'Мягкие светлые: серые, бежевые, пастельные');
define('LANG_NM_SKIN_GROUP_DARK', 'Тёмные: от светлых к самым тёмным');
define('LANG_NM_SKIN_MIST', 'Туман — серо-голубая');
define('LANG_NM_SKIN_PEARL', 'Жемчуг — светло-серая');
define('LANG_NM_SKIN_STONE', 'Камень — тёплая серо-бежевая');
define('LANG_NM_SKIN_OAT', 'Овёс — светло-бежевая');
define('LANG_NM_SKIN_LATTE', 'Латте — кофе с молоком');
define('LANG_NM_SKIN_LINEN', 'Лён — тёплая с шалфеем');
define('LANG_NM_SKIN_SAGE', 'Шалфей — пастельная зелёная');
define('LANG_NM_SKIN_MINT', 'Мята — пастельная бирюзовая');
define('LANG_NM_SKIN_SKY', 'Небо — пастельная голубая');
define('LANG_NM_SKIN_LAVENDER', 'Лаванда — пастельная сиреневая');
define('LANG_NM_SKIN_BLUSH', 'Пудра — пастельная розовая');
define('LANG_NM_SKIN_PEACH', 'Персик — пастельная тёплая');
define('LANG_NM_SKIN_DUSK', 'Сумерки — тёмная, самая светлая');
define('LANG_NM_SKIN_SLATE', 'Сланец — тёмная, светлая');
define('LANG_NM_SKIN_MOCHA', 'Мокко — тёплая тёмная');
define('LANG_NM_SKIN_PLUM', 'Слива — тёмная сиреневая');
define('LANG_NM_SKIN_MOSS', 'Мох — тёмная зелёная');
define('LANG_NM_SKIN_ABYSS', 'Бездна — самая тёмная');

// Виджет «Категории»: стили
define('LANG_NM_WC_LIST', 'NM: Список с иконками');
define('LANG_NM_WC_TREE', 'NM: Дерево с линиями');
define('LANG_NM_WC_ACC', 'NM: Аккордеон со стрелкой');
define('LANG_NM_WC_ACC_PLUS', 'NM: Аккордеон с плюсом');
define('LANG_NM_WC_ACC_CARDS', 'NM: Аккордеон карточками');
define('LANG_NM_WC_FLY', 'NM: Выпадающее меню (вправо или влево по месту)');
define('LANG_NM_WC_CHIPS', 'NM: Кнопки-метки');
define('LANG_NM_WC_TILES', 'NM: Плитки с картинками');
define('LANG_NM_WC_TOGGLE', 'Показать подкатегории');
