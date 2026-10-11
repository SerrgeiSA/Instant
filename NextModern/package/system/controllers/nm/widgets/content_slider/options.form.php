<?php

class formWidgetNmContentSliderOptions extends cmsForm {

    public function init($options) {
        $content_model = cmsCore::getModel('content');

        $field_generator = function ($item, $request) use($content_model) {
            $list     = ['' => ''];
            $ctype_id = is_array($item) ? array_value_recursive('options:ctype_id', $item) : false;
            if (!$ctype_id && $request) {
                $ctype_id = $request->get('options:ctype_id', 0);
            }
            if (!$ctype_id) {
                return $list;
            }
            $ctype = $content_model->getContentType($ctype_id);
            if (!$ctype) {
                return $list;
            }
            $fields = $content_model->getContentFields($ctype['name']);
            if ($fields) {
                $list = $list + array_collection_to_list($fields, 'name', 'title');
            }
            return $list;
        };

		
        return array(
          
	
            'woptions' => array(
                'type'   => 'fieldset',
                'title'  => LANG_OPTIONS,
                'childs' => array(
                    new fieldList('options:widget_type', array(
                        'title'   => LANG_WD_NM_CONTENT_SLIDER_WIDGET_TYPE,
                        'default' => 'list',
                        'items'   => array(
                            'list'    => LANG_WD_NM_CONTENT_SLIDER_WIDGET_TYPE1,
                            'related' => LANG_WD_NM_CONTENT_SLIDER_WIDGET_TYPE2
                        )
                    )),
                    new fieldList('options:ctype_id', array(
                        'title'     => LANG_CONTENT_TYPE,
                        'generator' => function($ctype) use($content_model) {

                            $tree = $content_model->getContentTypes();

                            $items = array(0 => LANG_WD_CONTENT_FILTER_DETECT);

                            if ($tree) {
                                foreach ($tree as $item) {
                                    $items[$item['id']] = $item['title'];
                                }
                            }
                            return $items;
                        },
                    )),
                    new fieldList('options:category_id', array(
                        'title'     => LANG_CATEGORY,
                        'parent'    => array(
                            'list' => 'options:ctype_id',
                            'url'  => href_to('content', 'widget_cats_ajax')
                        ),
                        'generator' => function($item, $request) use($content_model) {
                            $list     = ['' => ''];
                            $ctype_id = is_array($item) ? array_value_recursive('options:ctype_id', $item) : false;
                            if (!$ctype_id && $request) {
                                $ctype_id = $request->get('options:ctype_id', 0);
                            }
                            if (!$ctype_id) {
                                return $list;
                            }
                            $ctype = $content_model->getContentType($ctype_id);
                            if (!$ctype) {
                                return $list;
                            }

                            $cats = $content_model->getCategoriesTree($ctype['name']);

                            if ($cats) {
                                foreach ($cats as $cat) {
                                    if ($cat['ns_level'] > 1) {
                                        $cat['title'] = str_repeat('-', $cat['ns_level']) . ' ' . $cat['title'];
                                    }
                                    $list[$cat['id']] = $cat['title'];
                                }
                            }
                            return $list;
                        },
                        'visible_depend' => array('options:ctype_id' => array('hide' => array('0')))
                    )),
                    new fieldList('options:dataset', array(
                        'title'     => LANG_WD_NM_CONTENT_SLIDER_DATASET,
                        'parent'    => array(
                            'list' => 'options:ctype_id',
                            'url'  => href_to('content', 'widget_datasets_ajax')
                        ),
                        'generator' => function($item, $request) use($content_model) {
                            $list     = ['0' => ''];
                            $ctype_id = is_array($item) ? array_value_recursive('options:ctype_id', $item) : false;
                            if (!$ctype_id && $request) {
                                $ctype_id = $request->get('options:ctype_id', 0);
                            }
                            if (!$ctype_id) {
                                return $list;
                            }
                            $datasets = $content_model->getContentDatasets($ctype_id);
                            if ($datasets) {
                                $list = $list + array_collection_to_list($datasets, 'id', 'title');
                            }
                            return $list;
                        },
                        'visible_depend' => array('options:ctype_id' => array('hide' => array('0')))
                    )),
                    new fieldList('options:relation_id', array(
                        'title'     => LANG_WD_NM_CONTENT_SLIDER_RELATION,
                        'parent'    => array(
                            'list' => 'options:ctype_id',
                            'url'  => href_to('content', 'widget_relations_ajax')
                        ),
                        'generator' => function($item, $request) use($content_model) {
                            $list     = ['0' => ''];
                            $ctype_id = is_array($item) ? array_value_recursive('options:ctype_id', $item) : false;
                            if (!$ctype_id && $request) {
                                $ctype_id = $request->get('options:ctype_id', 0);
                            }
                            if (!$ctype_id) {
                                return $list;
                            }
                            $ctype = $content_model->getContentType($ctype_id);
                            if (!$ctype) {
                                return $list;
                            }
                            $parents = $content_model->getContentTypeParents($ctype_id);
                            if (is_array($parents)) {
                                foreach ($parents as $parent) {
                                    $list[$parent['id']] = "{$ctype['title']} > {$parent['ctype_title']}";
                                }
                            }
                            return $list;
                        },
                        'visible_depend' => array('options:ctype_id' => array('hide' => array('0')))
                    )),
                    new fieldList('options:filter_id', array(
                        'title'     => LANG_WD_NM_CONTENT_SLIDER_FILTER,
                        'parent'    => array(
                            'list' => 'options:ctype_id',
                            'url'  => href_to('content', 'widget_filters_ajax')
                        ),
                        'generator' => function($item, $request) use($content_model) {
                            $list     = ['0' => ''];
                            $ctype_id = is_array($item) ? array_value_recursive('options:ctype_id', $item) : false;
                            if (!$ctype_id && $request) {
                                $ctype_id = $request->get('options:ctype_id', 0);
                            }
                            if (!$ctype_id) {
                                return $list;
                            }
                            $ctype = $content_model->getContentType($ctype_id);
                            if (!$ctype) {
                                return $list;
                            }
                            if(!$content_model->isFiltersTableExists($ctype['name'])){
                                return $list;
                            }
                            $filters = $content_model->getContentFilters($ctype['name']);
                            if (is_array($filters)) {
                                foreach ($filters as $filter) {
                                    $list[$filter['id']] = $filter['title'];
                                }
                            }
                            return $list;
                        },
                        'visible_depend' => array('options:ctype_id' => array('hide' => array('0')))
                    )),
                    new fieldCheckbox('options:auto_group', array(
                        'title' => LANG_CP_WO_AUTO_GROUP,
                        'hint'  => LANG_CP_WO_AUTO_GROUP_HINT
                    )),
                    new fieldCheckbox('options:auto_user', array(
                        'title' => LANG_WD_NM_CONTENT_SLIDER_AUTO_USER,
                        'hint'  => LANG_WD_NM_CONTENT_SLIDER_AUTO_USER_HINT
                    )),
					
                    new fieldNumber('options:teaser_line', array(
                        'title' => 'Ккол-во видимых строк описания для пк',
                        'hint'  => '0 - чтобы не применять'
                    )),
                    new fieldNumber('options:teaser_line_mob', array(
                        'title' => 'Кол-во видимых строк описания для мобильных',
                        'hint'  => '0 - чтобы не применять'
                    )),
                    new fieldNumber('options:limit', array(
                        'title'   => LANG_LIST_LIMIT,
                        'default' => 10,
                        'rules'   => [
                            ['required'],
                            ['min', 1]
                        ]
                    ))
                )
            ),
            'fields_options' => array(
                'type'   => 'fieldset',
                'title'  => LANG_CP_CTYPE_FIELDS,
                'is_empty' => true,
                'parent' => array(
                    'list' => 'options:ctype_id',
                    'url'  => href_to('content', 'widget_fields_options_ajax')
                ),
                'childs' => array(
                    new cmsFormField('fake',array(
                        'title' => LANG_CP_CTYPE_NOT_SET,
                        'html' => ''
                    ))
                )
            ),
			
			
            'deprecated' => array(
                'type'   => 'fieldset',
                'title'  => LANG_WD_NM_CONTENT_SLIDER_DEPRECATED,
                'childs' => array(
                    new cmsFormField('fake_deprecated_hint',array(
                        'title' => '',
                        'hint' => LANG_WD_NM_CONTENT_SLIDER_FIELD_HINT,
                        'html' => ''
                    )),
                    new fieldList('options:image_field', array(
                        'title'  => LANG_WD_NM_CONTENT_SLIDER_IMAGE,
                        'parent' => array(
                            'list' => 'options:ctype_id',
                            'url'  => href_to('content', 'widget_fields_ajax')
                        ),
                        'generator' => $field_generator
                    )),
                    new fieldList('options:teaser_field', array(
                        'title'  => LANG_WD_NM_CONTENT_SLIDER_TEASER,
                        'parent' => array(
                            'list' => 'options:ctype_id',
                            'url'  => href_to('content', 'widget_fields_ajax')
                        ),
                        'generator' => $field_generator
                    )),
                    new fieldNumber('options:teaser_len', array(
                        'title' => LANG_PARSER_HTML_TEASER_LEN,
                        'hint'  => LANG_PARSER_HTML_TEASER_LEN_HINT
                    )),
                    new fieldCheckbox('options:show_details', array(
                        'title' => LANG_WD_NM_CONTENT_SLIDER_DETAILS
                    ))
                )
            ),
			
			
				array(
                'type' => 'fieldset',
                'title' => 'Слайдер',
                'childs' => array(
				
						
                     new fieldNumber('options:sl_items_xl', array(
                        'title' => 'Кол-во видимых слайдов для больших разрешений',
                        'default' => 1,
                    )),
                     new fieldNumber('options:sl_items_lg', array(
                        'title' => 'Кол-во видимых слайдов для ПК',
                        'default' => 1,
                    )),
                     new fieldNumber('options:sl_items_md', array(
                        'title' => 'Кол-во видимых слайдов для планшетов',
                        'default' => 1,
                    )),
					
                     new fieldNumber('options:sl_items_sm', array(
                        'title' => 'Кол-во видимых слайдов для мобильных',
                        'default' => 1,
                    )),
					
                     new fieldNumber('options:sl_margin', array(
                        'title' => '<br/>Отступы между слайдами',
                        'default' => 0,
                    )),
					
			
					new fieldCheckbox('options:sl_nav', array(
                        'title' => 'Включить стрелки навигации',
                        'default' => true,
                    )),
					
			
					new fieldCheckbox('options:sl_dots', array(
                        'title' => 'Включить пагинацию',
                        'default' => false,
                    )),
					
			
					new fieldCheckbox('options:sl_autoplay', array(
                        'title' => 'Включить автопрокрутку',
                        'default' => true,
                    )),
					
					new fieldCheckbox('options:sl_autoplayHoverPause', array(
                        'title' => 'Приостановливать автопрокрутку при наведении указателя мыши на слайдер',
                        'default' => true,
                    )),
					
					new fieldCheckbox('options:sl_rewind', array(
                        'title' => 'Зациклить прокрутку',
                        'default' => true,
                    )),
					
					new fieldCheckbox('options:sl_center', array(
                        'title' => 'Включить выравнивание по центру',
                        'default' => false,
                        'hint' => 'Опция для нескольких слайдов',
                    )),
					
					
					new fieldCheckbox('options:sl_autoHeight', array(
                        'title' => "Включить адаптивную высоту для слайдов<script>$('#options_sl_autoHeight').on('change', function(event){
	  $('#options_sl_cover').prop('checked', false);
  });</script>",
                        'default' => false,
                    )),
					
			
					new fieldCheckbox('options:sl_cover', array(
                        'title' => "Включить отображение изображения обложкой<script>$('#options_sl_cover').on('change', function(event){
	  $('#options_sl_autoHeight').prop('checked', false);
  });</script>",
                        'default' => true,
                    )),
					
						
				new fieldString('options:sl_height_xl', [
                        'title'   => '<br/>Высота слайдов для больших разрешений',
						 'default' => '400px',
                        'hint' => 'Изображение будет обрезано по высоте. Если этого не нужно, тогда включите опцию [Включить отображение изображения обложкой]',
                    ]),					
				new fieldString('options:sl_height_lg', [
                        'title'   => 'Высота слайдов для ПК',
                        'default' => '400px',
                    ]),					
				new fieldString('options:sl_height_md', [
                        'title'   => 'Высота слайдов для планшетов',
                         'default' => '400px',
                    ]),					
				new fieldString('options:sl_height_sm', [
                        'title'   => 'Высота слайдов для мобильных',
                         'default' => '300px',
                    ]),
					
		   
				
				   new fieldNumber('options:sl_smartSpeed', array(
                        'title' => '<br/>Скорость прокрутки',
                        'default' => 1000,
                        'units' => 'Миллисекунд'
                    )),
					
				
				   new fieldNumber('options:sl_autoplaytimeout', array(
                        'title' => 'Задержка перед появлением следующего слайда',
                        'default' => 5000,
                        'units' => 'Миллисекунд'
                    )),
					
				
					
					new fieldString('options:sl_animateIn', array(
                        'title' => '<br/>Эффект появления',
                        'hint' => 'Например с использованием <a href="https://daneden.github.io/animate.css/" target="_blank">animate.css</a>: flipInX'
                    )),
					new fieldString('options:sl_animateOut', array(
                        'title' => 'Эффект убывания',
                        'hint' => 'Например с использованием <a href="https://daneden.github.io/animate.css/" target="_blank">animate.css</a>: slideOutDown'
                    )),
					
					
					
					
					
			
					
					
	
				)
            ),
			
			
			
	
			
			
			
			
			array(
                'type' => 'fieldset',
                'title' => 'Шаблон',
                'childs' => array(
				
				  new fieldColor('options:overlay', [
                        'title'   => '<h5>Общие</h5>Оверлей\затемнение',
						'options'=> array('format'=>'rgb','opacity'=>true)
                    ]),
			
				
		            new fieldList('options:align', array(
                        'title' => '<br/>Выравнивание по горизонтали',
                        'items' => array(
						''=>'Слева',
						'center'=>'По центру',
						),
                    )),
		            new fieldList('options:valign', array(
                        'title' => 'Выравнивание по вертикали',
                        'items' => array(
						'top'=>'Сверху',
						'center'=>'По центру',
						'end'=>'Снизу',
						),
						'default'=>'center'
                    )),
		            new fieldList('options:text_align', array(
                        'title' => 'Выравнивание текста',
                        'items' => array(
						''=>'Слева',
						'center'=>'По центру',
						),
                    )),
					
					  new fieldNumber('options:padding_x', [
                        'title'   => '<br/>Отступы горизонатальные',
                        'default'   => '0',
						 'prefix'   => 'px',
                    ]),
					  new fieldNumber('options:padding_y', [
                        'title'   => 'Отступы вертикальные',
                        'default'   => '0',
						 'prefix'   => 'px',
                    ]),
					
				
		            new fieldString('options:title_tag', array(
                        'title' => '<h5>Заголовок</h5>Тег заголовка',
                        'default' => 'h3',
                    )),
					new fieldColor('options:title_color', [
                        'title'   => 'Цвет заголовка',
						'options'=> array('format'=>'rgb','opacity'=>true)
                    ]),				
					
					new fieldNumber('options:title_size_xl', [
                        'title'   => '<br/>Размер заголовка для больших разрешений',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:title_size_lg', [
                        'title'   => 'Размер заголовка для ПК',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:title_size_md', [
                        'title'   => 'Размер заголовка для планшетов',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:title_size_sm', [
                        'title'   => 'Размер заголовка для мобильных',
                        'prefix'   => 'px',
                    ]),					
					
				
				
				
				  new fieldColor('options:teaser_color', [
                        'title'   => '<br/><h5>Описание</h5>Цвет описания',
						'options'=> array('format'=>'rgb','opacity'=>true)
                    ]),
			
				    new fieldNumber('options:teaser_size_xl', [
                        'title'   => '<br/>Размер описания для больших разрешений',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:teaser_size_lg', [
                        'title'   => 'Размер описания для ПК',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:teaser_size_md', [
                        'title'   => 'Размер описания для планшетов',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:teaser_size_sm', [
                        'title'   => 'Размер описания для мобильных',
                        'prefix'   => 'px',
                    ]),
					
					new fieldNumber('options:teaser_mt', [
                        'title'   => '<br/>Отступ сверху от заголовка',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:teaser_mt_mob', [
                        'title'   => 'Отступ сверху от заголовка для мобильных',
                        'prefix'   => 'px',
                    ]),
					
				
				
				
				    new fieldString('options:button_title', array(
                        'title' => '<br/><h5>Кнопка</h5>Заголовок кнопки',
                        'default' => '',
                    )),
				    new fieldString('options:button_class', array(
                        'title' => 'CSS класс для кнопки',
                        'default' => 'btn btn-primary',
                    )),
				    new fieldColor('options:button_bg', array(
                        'title' => 'Цвет кнопки',
                        'options'=> array('format'=>'rgb','opacity'=>true)
                    )),
				    new fieldColor('options:button_color', array(
                        'title' => 'Цвет заголовка кнопки',
                    )),
				    new fieldColor('options:button_bg_hover', array(
                        'title' => 'Цвет кнопки при наведении',
                        'options'=> array('format'=>'rgb','opacity'=>true)
                    )),
				    new fieldColor('options:button_color_hover', array(
                        'title' => 'Цвет заголовка кнопки при наведении',
                    )),
						
					new fieldNumber('options:button_title_size', [
                        'title'   => '<br/>Размер заголовка кнопки',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:button_title_size_mob', [
                        'title'   => 'Размер заголовка кнопки для мобильных',
                        'prefix'   => 'px',
                    ]),
					
					new fieldNumber('options:button_width', [
                        'title'   => '<br/>Ширина кнопки',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:button_width_mob', [
                        'title'   => 'Ширина кнопки для мобильных',
                        'prefix'   => 'px',
                    ]),
					
					new fieldNumber('options:button_height', [
                        'title'   => '<br/>Высота кнопки',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:button_height_mob', [
                        'title'   => 'Высота кнопки для мобильных',
                        'prefix'   => 'px',
                    ]),
					
					new fieldNumber('options:button_mt', [
                        'title'   => '<br/>Отступ сверху для кнопки',
                        'prefix'   => 'px',
                    ]),
					new fieldNumber('options:button_mt_mob', [
                        'title'   => 'Отступ сверху для мобильных для кнопки',
                        'prefix'   => 'px',
                    ]),
					
					
					
				
				
				
			      )
            ),	
			
	
			
		
		
			
			
			
			

        );

    }

}
