<?php

class onNmAdminRowSchemeOptions extends cmsAction {

	public function run($data){

        list($do, $row, $col) = $data;

        $template = new cmsTemplate($row['template']);

        $manifest = $template->getManifest();

        if(empty($manifest['properties']['vendor'])){
            return false;
        }

        // Нам нужны только шаблоны на bootstrap4
        if($manifest['properties']['vendor'] !== 'bootstrap4'){
            return false;
        }

        $fields = [
            new fieldCheckbox('options:no_gutters', array(
                'title' => LANG_CP_WIDGETS_ROW_NO_GUTTERS,
                'visible_depend' => array('tag' => array('hide' => array('')))
            )),
            new fieldList('options:vertical_align', array(
                'title' => LANG_CP_WIDGETS_COL_VA,
                'items' => array(
                    '' => LANG_BY_DEFAULT,
                    'align-items-start'   => LANG_CP_WIDGETS_COL_VA1,
                    'align-items-center'  => LANG_CP_WIDGETS_COL_VA2,
                    'align-items-end'     => LANG_CP_WIDGETS_COL_VA3
                ),
                'visible_depend' => array('tag' => array('hide' => array('')))
            )),
            new fieldList('options:horizontal_align', array(
                'title' => LANG_CP_WIDGETS_COL_HA,
                'items' => array(
                    '' => LANG_BY_DEFAULT,
                    'justify-content-start'   => LANG_CP_WIDGETS_COL_HA1,
                    'justify-content-center'  => LANG_CP_WIDGETS_COL_VA2,
                    'justify-content-end'     => LANG_CP_WIDGETS_COL_HA3,
                    'justify-content-around'  => LANG_CP_WIDGETS_COL_HA4,
                    'justify-content-between' => LANG_CP_WIDGETS_COL_HA5
                ),
                'visible_depend' => array('tag' => array('hide' => array('')))
            )),
            new fieldList('options:container', array(
                'title' => LANG_CP_WIDGETS_ROW_CONT,
                'default' => 'container',
                'items' => array(
                    'container'       => '100% <576px',
                    'container-md'    => '100% <768px',
                    'container-lg'    => '100% <992px',
                    'container-xl'    => '100% <1200px',
                    'container-fluid' => '100%',
                    ''                => LANG_CP_WIDGETS_ROW_CONT_NO
                )
            )),
            new fieldList('options:container_tag', array(
                'title' => LANG_CP_WIDGETS_ROW_CONT_TAG,
                'default' => 'div',
                'items' => array(
                    'article' => '<article>',
                    'aside'   => '<aside>',
                    'main'    => '<main>',
                    'div'     => '<div>',
                    'footer'  => '<footer>',
                    'header'  => '<header>',
                    'nav'     => '<nav>',
                    'section' => '<section>'
                ),
                'visible_depend' => array('options:container' => array('hide' => array('')))
            )),
            new fieldString('options:container_tag_class', array(
                'title' => LANG_CP_WIDGETS_ROW_CONT_CSS,
                'rules' => array(
                    array('max_length', 255)
                ),
                'visible_depend' => array('options:container' => array('hide' => array('')))
            )),
            new fieldList('options:parrent_tag', array(
                'title' => LANG_CP_WIDGETS_ROW_PARRENT_TAG,
                'items' => array(
                    ''        => LANG_NO,
                    'article' => '<article>',
                    'aside'   => '<aside>',
                    'main'    => '<main>',
                    'div'     => '<div>',
                    'footer'  => '<footer>',
                    'header'  => '<header>',
                    'nav'     => '<nav>',
                    'section' => '<section>'
                )
            )),
			
            new fieldString('options:parrent_tag_class', array(
                'title' => LANG_CP_WIDGETS_ROW_PARRENT_TAG_C,
                'rules' => array(
                    array('max_length', 255)
                ),
                'visible_depend' => array('options:parrent_tag' => array('hide' => array('')))
            )),
			
			new fieldColor('options:parrent_tag_bgcolor', array(
                'title' => 'Цвет фона',	
				'options'=>array(				
				'format'=>'rgb',
				'opacity'=>true
				),
               'visible_depend' => array('options:parrent_tag' => array('hide' => array('')))
            )),
			
			
			new fieldImage('options:parrent_tag_bg', array(
                'title' => 'Обложка фона',
               'visible_depend' => array('options:parrent_tag' => array('hide' => array('')))
            )),
			new fieldCheckbox('options:parrent_tag_bg_fixed', array(
                'title' => 'Включить parallax эффект для обложки фона',
               'visible_depend' => array('options:parrent_tag' => array('hide' => array('')))
            )),
			new fieldColor('options:parrent_tag_bgoverlay', array(
                'title' => 'Цвет затемнения',	
				'options'=>array(				
				'format'=>'rgb',
				'opacity'=>true
				),
               'visible_depend' => array('options:parrent_tag' => array('hide' => array('')))
            )),
		
			
			
			new fieldColor('options:parrent_tag_textscolor', array(
                'title' => 'Цвет текста',	
				'options'=>array(				
				'format'=>'rgb',
				'opacity'=>true
				),
               'visible_depend' => array('options:parrent_tag' => array('hide' => array('')))
            )),
			new fieldColor('options:parrent_tag_linkscolor', array(
                'title' => 'Цвет ссылок',	
				'options'=>array(				
				'format'=>'rgb',
				'opacity'=>true
				),
               'visible_depend' => array('options:parrent_tag' => array('hide' => array('')))
            )),
			
			
			
			
			new fieldColor('options:parrent_tag_borders_color', array(
                'title' => 'Цвет контура',	
				'options'=>array(				
				'format'=>'rgb',
				'opacity'=>true
				),
               'visible_depend' => array('options:parrent_tag' => array('hide' => array('')))
            )),			
			new fieldNumber('options:parrent_tag_border_top', array(
                'title' => 'Контур сверху',
                'prefix' => 'px',
				  'visible_depend' => array('options:parrent_tag_borders_color' => array('hide' => array('')))
            )),			
			new fieldNumber('options:parrent_tag_border_bottom', array(
                'title' => 'Контур снизу',				
                'prefix' => 'px',
				  'visible_depend' => array('options:parrent_tag_borders_color' => array('hide' => array('')))
            )),	
			
			
			
			
			
			
			
			
			
			
				
			
			new fieldString('options:parrent_title', array(
                'title' => '<br/>Заголовок секции', 
				'visible_depend' => array('options:parrent_tag' => array('hide' => array('')))
            )),
			new fieldText('options:parrent_teaser', array(
                'title' => 'Описание секции',  
				'visible_depend' => array('options:parrent_title' => array('hide' => array('')))
            )),
			
				new fieldString('options:parrent_title_class', array(
                'title' => 'Класс заголовка',  
                'default' => 'pr-5',  
				'visible_depend' => array('options:parrent_title' => array('hide' => array('')))
            )),
				new fieldString('options:parrent_teaser_class', array(
                'title' => 'Класс описания',  
                'default' => 'pr-5 pt-3 text-small text-muted',  
				'visible_depend' => array('options:parrent_title' => array('hide' => array('')))
            )),
		
			new fieldList('options:parrent_title_valign', array(
                'title' => 'Вертикальное выравнивание',
               'items' => array(
			   'flex-start'=>'Сверху',
			   'center'=>'Посередине',
			   'flex-end'=>'Снизу'
			   ),
			   'visible_depend' => array('options:parrent_title' => array('hide' => array('')))
            )),
			new fieldList('options:parrent_title_align', array(
                'title' => 'Горизонтальное выравнивание',
               'items' => array(
			   'left'=>'Слева',
			   'center'=>'Посередине',
			   'right'=>'Справа'
			   ),
			   'visible_depend' => array('options:parrent_title' => array('hide' => array('')))
            )),
			
	
			
			
			
        ];

        return $fields;

    }

}
