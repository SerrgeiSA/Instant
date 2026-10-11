<?php

class formWidgetNmStylesOptions extends cmsForm {

    public function init() {
		
define('LANG_WD_HTML_JS_INLINE_SCRIPTS', 'JavaScript код');
define('LANG_WD_HTML_JS_INLINE_SCRIPTS_HINT', 'Без &lt;script&gt; тегов. Код будет добавлен вниз страницы.');
define('LANG_WD_HTML_JS_FILES', 'Пути к JavaScript файлам');
define('LANG_WD_HTML_JS_FILES_HINT', 'Без расширения, каждый с новой строки. Файлы будут подключены на странице, где выведен виджет.');
define('LANG_WD_HTML_CSS_FILES', 'Пути к CSS файлам');
define('LANG_WD_HTML_CSS_FILES_HINT', 'Без расширения, каждый с новой строки. Файлы будут подключены на странице, где выведен виджет.');


define('LANG_WD_HTML_CSS_INLINE_SCRIPTS', 'CSS код');
define('LANG_WD_HTML_CSS_INLINE_SCRIPTS_HINT', 'Без &lt;style&gt; тегов. Код будет добавлен вниз страницы.');


        return [
		
            [
                'type'   => 'fieldset',
                'title'  => 'CSS',
                'childs' => [
                    new fieldText('options:css_files', [
                        'title' => LANG_WD_HTML_CSS_FILES,
                        'hint' => LANG_WD_HTML_CSS_FILES_HINT,
                        'is_strip_tags' => true
                    ]),
					
					new fieldHtml('options:css_inline_styles', [
                        'title' => LANG_WD_HTML_CSS_INLINE_SCRIPTS,
                        'hint' => LANG_WD_HTML_CSS_INLINE_SCRIPTS_HINT,
                        'options' => ['editor' => 'ace', 'editor_options' => ['mode' => 'ace/mode/javascript']],
                    ])
                ]
            ],
            [
                'type'   => 'fieldset',
                'title'  => 'JavaScript',
                'childs' => [
                    new fieldText('options:js_files', [
                        'title' => LANG_WD_HTML_JS_FILES,
                        'hint' => LANG_WD_HTML_JS_FILES_HINT,
                        'is_strip_tags' => true
                    ]),
                    new fieldHtml('options:js_inline_scripts', [
                        'title' => LANG_WD_HTML_JS_INLINE_SCRIPTS,
                        'hint' => LANG_WD_HTML_JS_INLINE_SCRIPTS_HINT,
                        'options' => ['editor' => 'ace', 'editor_options' => ['mode' => 'ace/mode/javascript']],
                    ])
                ]
            ],
			
			
        ];
    }

}
