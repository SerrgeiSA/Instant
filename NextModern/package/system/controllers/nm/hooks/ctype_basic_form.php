<?php

class onNmCtypeBasicForm extends cmsAction {
	

     public function run($form){	
	 
	    $core = cmsCore::getInstance();
		$uri = explode('/',$core->uri);
		if(empty($uri[3])){
			return $form;
		}
	    $content_model = cmsCore::getModel('content');
		$ctype = $content_model->getContentType($uri[3]);
	 	$fields = $content_model->getContentFields($ctype['name']);
		$badge_list = array(0=>'','category'=>'Категория записи');
		
	    if ($fields){ 
		
		$fields_list = array(''=>'') + array_collection_to_list($fields, 'name', 'title');
		
		
		}

			
		
		$fieldset = $form->addFieldsetAfter('listview', 'Настройки NextModern : Список', 'nm_list', array('is_collapsed' => true));		
						
	
		$form->addField($fieldset,   
		new fieldList('options:nm_desktop:list:cats_theme', array(
                        'title' => '<i title="Настольные ПК" class="icon-screen-desktop icons mr-1"></i> Шаблон списка категорий над списком записей для пк:',						
						'items' => array(
						''=>'По умолчанию',						
						'none'=>'-- Не показывать --',
						'cols'=>'Колонки',
						'tiles'=>'Плитка',
						'slider'=>'Слайдер',
						'slider_tiles'=>'Слайдер карточек',
						'dropdown'=>'Выпадающий список меню',
						'list'=>'Cписок',
						)
                      )));			
		
					  
		$form->addField($fieldset,   
		new fieldList('options:nm_mobile:list:cats_theme', array(
                        'title' => '<i title="Телефоны" class="icon-screen-smartphone icons mr-1"></i> Шаблон списка категорий над списком записей для мобильных:',
						'items' => array(
						''=>'По умолчанию',						
						'none'=>'-- Не показывать --',
						'cols'=>'Колонки',
						'tiles'=>'Плитка',
						'slider'=>'Слайдер',
						'slider_tiles'=>'Слайдер карточек',
						'dropdown'=>'Выпадающий список меню',
						'list'=>'Cписок',
						)
                      )));	
		
					  
					  
		$form->addField($fieldset,   
		new fieldList('options:nm_desktop:list:infobar_skips', array(
                        'title' => '<br/>Не выводить в инфобаре в списке:', 
						'is_multiple' => true,
						'default' => '',
						'items' => array(
						'date_pub'=>'Дата публикации',
						'user'=>'Автор',
						'comments'=>'Кол-во комментариев',
						'rating'=>'Рейтинг'
						)
                      )));	
	 					  
		$form->addField($fieldset,   
		new fieldList('options:nm_desktop:item:infobar_skips', array(
                        'title' => 'Не выводить в инфобаре в записи:', 
						'is_multiple' => true,
						'default' => '',
						'items' => array(
						'date_pub'=>'Дата публикации',
						'user'=>'Автор',
						'comments'=>'Кол-во комментариев',
						'rating'=>'Рейтинг'
						)
                      )));		
					  			  
					  
					  
		$form->addField($fieldset,   
		new fieldColor('options:nm_desktop:list:cards_wrap_bg', array(
                        'title' => '<br/><i title="Настольные ПК" class="icon-screen-desktop icons mr-1"></i> Фон контейнера списка:', 
				'options'=>array(				
				        'format'=>'rgb',
				        'opacity'=>true
				)
                      )));	
					  
		$form->addField($fieldset,   
		new fieldColor('options:nm_mobile:list:cards_wrap_bg', array(
                        'title' => '<i title="Телефоны" class="icon-screen-smartphone icons mr-1"></i> Фон контейнера списка:', 
				'options'=>array(				
				        'format'=>'rgb',
				        'opacity'=>true
				)
                      )));	
					  
					  		  
					  
		$form->addField($fieldset,   
		new fieldColor('options:nm_desktop:list:cards_bg', array(
                        'title' => '<br/><i title="Настольные ПК" class="icon-screen-desktop icons mr-1"></i> Фон карточек:', 
				'options'=>array(				
				        'format'=>'rgb',
				        'opacity'=>true
				)
                      )));	
					  
		$form->addField($fieldset,   
		new fieldColor('options:nm_mobile:list:cards_bg', array(
                        'title' => '<i title="Телефоны" class="icon-screen-smartphone icons mr-1"></i> Фон карточек:', 
				'options'=>array(				
				        'format'=>'rgb',
				        'opacity'=>true
				)
                      )));	
					  
					  				
									
		$form->addField($fieldset,   
		new fieldString('options:nm_desktop:list:cards_wrap_margin', array(
                        'title' => '<br/><i title="Настольные ПК" class="icon-screen-desktop icons mr-1"></i> Внешние отступы для контейнера списка:', 
						'prefix'=>'rem', 
						'hint'=>'Например: 1 или 1 1 1 1'
                      )));	
					  
		$form->addField($fieldset,   
		new fieldString('options:nm_mobile:list:cards_wrap_margin', array(
                        'title' => '<i title="Телефоны" class="icon-screen-smartphone icons mr-1"></i> Внешние отступы для контейнера списка:', 
						'prefix'=>'rem', 
						'hint'=>'Например: 1 или 1 1 1 1'
                      )));		  				
									
		$form->addField($fieldset,   
		new fieldString('options:nm_desktop:list:cards_margin', array(
                        'title' => '<br/><i title="Настольные ПК" class="icon-screen-desktop icons mr-1"></i> Внешние отступы для карточек:', 
						'prefix'=>'rem'
                      )));	
					  
		$form->addField($fieldset,   
		new fieldString('options:nm_mobile:list:cards_margin', array(
                        'title' => '<i title="Телефоны" class="icon-screen-smartphone icons mr-1"></i> Внешние отступы для карточек:', 
						'prefix'=>'rem'
                      )));	
					  
					  
					  					  
					  				  
		$form->addField($fieldset,   
		new fieldString('options:nm_desktop:list:cards_padding', array(
                        'title' => '<br/><i title="Настольные ПК" class="icon-screen-desktop icons mr-1"></i> Внутренние отступы для карточек:', 
						'prefix'=>'rem', 
						'hint'=>'Например: 1 или 1 1 1 1'
                      )));	
					  
		$form->addField($fieldset,   
		new fieldString('options:nm_mobile:list:cards_padding', array(
                        'title' => '<i title="Телефоны" class="icon-screen-smartphone icons mr-1"></i> Внутренние отступы для карточек:', 
						'prefix'=>'rem', 
						'hint'=>'Например: 1 или 1 1 1 1'
                      )));	
					  			
								
		$form->addField($fieldset,   
		new fieldString('options:nm_desktop:list:cards_content_padding', array(
                        'title' => '<br/><i title="Настольные ПК" class="icon-screen-desktop icons mr-1"></i> Внутренние отступы для контента карточек:', 
						'prefix'=>'rem', 
						'hint'=>'Например: 1 или 1 1 1 1'
                      )));	
					  
		$form->addField($fieldset,   
		new fieldString('options:nm_mobile:list:cards_content_padding', array(
                        'title' => '<i title="Телефоны" class="icon-screen-smartphone icons mr-1"></i> Внутренние отступы для контента карточек:', 
						'prefix'=>'rem', 
						'hint'=>'Например: 1 или 1 1 1 1'
                      )));	
					  			
								
		$form->addField($fieldset,   
		new fieldString('options:nm_desktop:list:cards_infobar_padding', array(
                        'title' => '<br/><i title="Настольные ПК" class="icon-screen-desktop icons mr-1"></i> Внутренние отступы для инфобара у карточек:', 
						'prefix'=>'rem', 
						'hint'=>'Например: 1 или 1 1 1 1'
                      )));	
					  
		$form->addField($fieldset,   
		new fieldString('options:nm_mobile:list:cards_infobar_padding', array(
                        'title' => '<i title="Телефоны" class="icon-screen-smartphone icons mr-1"></i> Внутренние отступы для инфобара у карточек:', 
						'prefix'=>'rem', 
						'hint'=>'Например: 1 или 1 1 1 1'
                      )));	
					  					  			
								
		$form->addField($fieldset,   
		new fieldString('options:nm_desktop:list:cards_bottombar_padding', array(
                        'title' => '<br/><i title="Настольные ПК" class="icon-screen-desktop icons mr-1"></i> Внутренние отступы для нижнего инфобара у карточек:', 
						'prefix'=>'rem', 
						'hint'=>'Например: 1 или 1 1 1 1'
                      )));	
					  
		$form->addField($fieldset,   
		new fieldString('options:nm_mobile:list:cards_bottombar_padding', array(
                        'title' => '<i title="Телефоны" class="icon-screen-smartphone icons mr-1"></i> Внутренние отступы для нижнего инфобара у карточек:', 
						'prefix'=>'rem', 
						'hint'=>'Например: 1 или 1 1 1 1'
                      )));	
					  				
									
		$form->addField($fieldset,   
		new fieldString('options:nm_desktop:list:cards_image_height', array(
                        'title' => '<br/><i title="Настольные ПК" class="icon-screen-desktop icons mr-1"></i> Высота изображения:', 
						'prefix'=>'px', 
					
                      )));	
					  
		$form->addField($fieldset,   
		new fieldString('options:nm_mobile:list:cards_image_height', array(
                        'title' => '<i title="Телефоны" class="icon-screen-smartphone icons mr-1"></i>  Высота изображения', 
						'prefix'=>'px', 
                      )));	
					  
					  
					  
							  
		$form->addField($fieldset,   
		new fieldCheckbox('options:nm_desktop:list:cards_button_on', array(
                        'title' => '<i title="Настольные ПК" class="icon-screen-desktop icons mr-1"></i> Показывать кнопку подробнее:',
                      )));	
					  
		$form->addField($fieldset,   
		new fieldCheckbox('options:nm_mobile:list:cards_button_on', array(
                        'title' => '<i title="Телефоны" class="icon-screen-smartphone icons mr-1"></i> Показывать кнопку подробнее:', 
                      )));			


				$form->addField($fieldset,   
		new fieldString('options:nm_desktop:list:cards_content_title_class', array(
                        'title' => '<br/><i title="Настольные ПК" class="icon-screen-desktop icons mr-1"></i> Класс заголовка в контенте карточек:', 
                      )));	
					  			$form->addField($fieldset,   
		new fieldString('options:nm_mobile:list:cards_content_title_class', array(
                        'title' => '<i title="Телефоны" class="icon-screen-smartphone icons mr-1"></i> Класс заголовка в контенте карточек:', 
                      )));	
					  			  
	 
					  
         return $form;


    

    }

}
