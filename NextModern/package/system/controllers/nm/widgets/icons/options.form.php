<?php

class formWidgetNmIconsOptions extends cmsForm {

    public function init() {

        return [
                [
                'type'   => 'fieldset',
                'title'  => 'Список',
                'childs' => [
				
                   new fieldGmlisticons('options:list', array(
                        'title' => '',
                    )),
					
                ]],
                [
                'type'   => 'fieldset',
                'title'  => 'Опции',
                'childs' => [
				
				      new fieldNumber('options:buttons_size', array(
                        'title' => 'Размер иконок',
						'default'  => '16',
						'prefix'  => 'px',
                    )),
				
        					
					new fieldList('options:style', array(
                        'title' => 'Вариант отображения списка',
						'items'=>array(
						''  => 'По умолчанию',
						
						'list'  => 'Список',
						'cols6'  => 'Колонки x6',
						'cols5'  => 'Колонки x5',
						'cols4'  => 'Колонки x4',
						'cols3'  => 'Колонки x3',
						'cols2'  => 'Колонки x2',
						'cols1'  => 'Колонки x2',
						
						),
                    )),		
					
					new fieldList('options:style_md', array(
                        'title' => 'Вариант отображения списка для планшетов',
						'items'=>array(
						''  => 'По умолчанию',
						
						'list'  => 'Список',
						'cols6'  => 'Колонки x6',
						'cols5'  => 'Колонки x5',
						'cols4'  => 'Колонки x4',
						'cols3'  => 'Колонки x3',
						'cols2'  => 'Колонки x2',
						'cols1'  => 'Колонки x1',
						
						),
                    )),	
					
					new fieldList('options:style_sm', array(
                        'title' => 'Вариант отображения списка для мобильных',
						'items'=>array(
						''  => 'По умолчанию',
						
						'list'  => 'Список',
						'cols6'  => 'Колонки x6',
						'cols5'  => 'Колонки x5',
						'cols4'  => 'Колонки x4',
						'cols3'  => 'Колонки x3',
						'cols2'  => 'Колонки x2',
						'cols1'  => 'Колонки x1',
						
						),
                    )),
					
					new fieldList('options:icon_pos', array(
                        'title' => 'Позиция иконки',
						'items'=>array(
						'left'  => 'Слева',
						'top'  => 'Сверху',
						),
						'hint'  => '',
                    )),
					
					new fieldList('options:content_align', array(
                        'title' => 'Выравнивание содержимого позиции списка',
						'items'=>array(
						'center'  => 'По центру',
						'left'  => 'Слева',
						),
						'hint'  => '',
                    )),
					
					
					new fieldString('options:wrap_class', array(
                        'title' => '<br/>Класс CSS для контейнера списка',
						'default'  => 'd-inline-flex align-items-center',
                    )),
					
			
                   new fieldString('options:buttons_class', array(
                        'title' => 'Класс CSS для позиции списка по умолчанию',
						'default'  => 'btn pl-1_5 pr-1_5 d-inline-flex align-items-center',
                    )),
					
                   new fieldString('options:icon_wrap_class', array(
                        'title' => 'Класс CSS для контейнера иконки',
						'default'  => '',
						'hint'  => '',
                    )),
                   new fieldString('options:title_class', array(
                        'title' => 'Класс CSS для заголовка',
						'default'  => '',
                    )),
					
                   new fieldString('options:teaser_class', array(
                        'title' => 'Класс CSS для описания',
						'default'  => 'p-0 m-0 text-muted',
                    )),
					
					
                    new fieldColor('options:svg_color', array(
                        'title' => '<br/>Цвет иконок',
			        	'options'=>array(				
			        	'format'=>'rgb',
			        	'opacity'=>true
				)
                    )),
					
                    new fieldColor('options:title_color', array(
                        'title' => 'Цвет заголовка',
				        'options'=>array(				
			        	'format'=>'rgb',
			        	'opacity'=>true
				)
                    )),
					
                    new fieldColor('options:teaser_color', array(
                        'title' => 'Цвет описания',
				        'options'=>array(				
			        	'format'=>'rgb',
			        	'opacity'=>true
				)
                    )),		
					
					
                    new fieldColor('options:svg_color_hover', array(
                        'title' => '<br/>При наведении:: Цвет иконок',
			        	'options'=>array(				
			        	'format'=>'rgb',
			        	'opacity'=>true
				)
                    )),
					
                    new fieldColor('options:title_color_hover', array(
                        'title' => 'При наведении:: Цвет заголовка',
				        'options'=>array(				
			        	'format'=>'rgb',
			        	'opacity'=>true
				)
                    )),
					
                    new fieldColor('options:teaser_color_hover', array(
                        'title' => 'При наведении:: Цвет описания',
				        'options'=>array(				
			        	'format'=>'rgb',
			        	'opacity'=>true
				)
                    )),
					
             
					
                ]
				]
       
       
        ];
    }

}
