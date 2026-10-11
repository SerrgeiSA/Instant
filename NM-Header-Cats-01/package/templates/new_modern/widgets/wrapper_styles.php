<?php
/*
 * Стили обёрток виджетов New Modern.
 * Выбираются в настройках виджета («Оформление» → «Стиль») для обёртки «wrapper».
 * Несколько стилей сразу (заголовок + карточка) можно задать в поле
 * «CSS класс обёртки», например: nm-wt-bar nm-card-shadow
 */
require_once dirname(__DIR__) . '/options.form.php';

$styles = [
    'icms-widget__square'      => LANG_MODERN_WIDGETS_SQUARE,
    'icms-widget__transparent' => LANG_MODERN_WIDGETS_TRANSPARENT,
    'icms-widget__compact'     => LANG_MODERN_WIDGETS_COMPACT
];

foreach (formNewModernTemplateOptions::getWidgetTitleStyles() as $id => $title) {
    $styles['nm-wt-' . $id] = LANG_NM_WS_TITLE . ': ' . $title;
}
foreach (formNewModernTemplateOptions::getCardStyles() as $id => $title) {
    $styles['nm-card-' . $id] = LANG_NM_WS_CARD . ': ' . $title;
}

return ['wrapper' => $styles];
