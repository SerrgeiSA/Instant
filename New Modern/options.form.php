<?php
/**
 * Опции установщика New Modern (показываются перед установкой)
 */
class formInstallPackageOptions extends cmsForm {

    public function init() {

        // Шаблоны сайта, у которых есть расставленные виджеты
        $model = new cmsModel();
        $templates = $model->selectOnly('template')->filterNotEqual('template', 'new_modern')->
                groupBy('template')->get('widgets_bind_pages', function ($item) {
                    return $item['template'];
                }, 'template') ?: [];

        $sources = [];
        foreach ($templates as $name) {
            $sources[$name] = sprintf('Из шаблона «%s»', $name);
        }
        $sources[''] = 'Не переносить, расставить штатный набор';

        return [
            [
                'type'   => 'fieldset',
                'title'  => 'Установка New Modern',
                'childs' => [
                    new fieldCheckbox('import_scheme', [
                        'title'   => 'Создать готовую сетку виджетов',
                        'hint'    => 'Ряды и колонки New Modern. Если у New Modern уже есть своя схема, она будет заменена. При первой установке сетка создаётся всегда.',
                        'default' => 1
                    ]),
                    new fieldList('widgets_from', [
                        'title'   => 'Виджеты для сетки',
                        'hint'    => 'Виджеты исходного шаблона (тело страницы, меню, логотип, ваши блоки) раскладываются по позициям New Modern с прежними настройками и привязками к страницам. Это копии: правки в New Modern не затронут исходный шаблон. Виджеты из нестандартных позиций попадут в «Неиспользуемые».',
                        'default' => isset($sources['modern']) ? 'modern' : '',
                        'items'   => $sources
                    ]),
                    new fieldCheckbox('set_default', [
                        'title'   => 'Сделать New Modern шаблоном сайта',
                        'hint'    => 'Можно включить позже: Настройки → Шаблон сайта.',
                        'default' => 0
                    ])
                ]
            ]
        ];
    }

}
