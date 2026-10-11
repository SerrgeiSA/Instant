<?php

class onNmWidgetOptionsFullForm extends cmsAction {
	

     public function run($form){	

        $form->addFieldset('<svg class="icms-svg-icon w-16" fill="currentColor"><use href="/templates/nm/images/icons/solid.svg#cog"></use></svg>','nm_options');
		



		$form->addField('nm_options',  					
					
			
			new fieldList('options:nm:shodow', array(
                'title' => 'Тень',
                'items' => array(
				0=>'',
				1=>'Тень 1',
				2=>'Тень 2',
				3=>'Тень 3',
				),
            ))					
					
	    );	

		$form->addField('nm_options',  					
					
			
			new fieldString('options:nm:margin', array(
                'title' => 'Внешние отступы',
                'hint' => 'Например 1 2 1 2',
                'prefix' => 'rem',
            ))					
					
	    );	

		$form->addField('nm_options',  					
					
			
			new fieldString('options:nm:padding', array(
                'title' => 'Внутренние отступы',
                'hint' => 'Например 1 2 1 2',
                'prefix' => 'rem',
            ))						
					
	    );					
					
	
        $form->addFieldset('<svg class="icms-svg-icon w-16" fill="currentColor"><use href="/templates/nm/images/icons/solid.svg#palette"></use></svg>','nm_colors');
		


		$form->addField('nm_colors',  					
					
			new fieldColor('options:nm:bgcolor', array(
                'title' => 'Цвет фона',	
				'options'=>array(				
				'format'=>'rgb',
				'opacity'=>true
				),
            ))
			
		);	

		$form->addField('nm_colors',  					
					
			new fieldImage('options:nm:bg', array(
                'title' => 'Обложка фона',
            ))
			
	    );		

		$form->addField('nm_colors',  					
					
			new fieldCheckbox('options:nm:bg_fixed', array(
                'title' => 'Включить parallax эффект для обложки фона',
            ))
			
	    );		


		$form->addField('nm_colors',  					
				
			new fieldColor('options:nm:bgoverlay', array(
                'title' => 'Цвет затемнения',	
				'options'=>array(				
				'format'=>'rgb',
				'opacity'=>true
				),
            ))
		
		
	    );		
			

		$form->addField('nm_colors',  					
					
			new fieldColor('options:nm:textscolor', array(
                'title' => 'Цвет текста',	
				'options'=>array(				
				'format'=>'rgb',
				'opacity'=>true
				),
            ))
			
			
	    );		

		$form->addField('nm_colors',  					
						
			new fieldColor('options:nm:linkscolor', array(
                'title' => 'Цвет ссылок',	
				'options'=>array(				
				'format'=>'rgb',
				'opacity'=>true
				),
            ))
			
	    );			
		
		$form->addField('nm_colors',  					
						
			new fieldColor('options:nm:btnbgcolor', array(
                'title' => 'Цвет кнопок',	
				'options'=>array(				
				'format'=>'rgb',
				'opacity'=>true
				),
            ))
			
	    );			
		$form->addField('nm_colors',  					
						
			new fieldColor('options:nm:btncolor', array(
                'title' => 'Цвет текста в кнопках',	
				'options'=>array(				
				'format'=>'rgb',
				'opacity'=>true
				),
            ))
			
	    );			
			
			

		$form->addField('nm_colors',  					
					
			
			new fieldColor('options:nm:borders_color', array(
                'title' => 'Цвет контура',	
				'options'=>array(				
				'format'=>'rgb',
				'opacity'=>true
				),
            ))					
					
	    );		




     $form->addFieldset("<svg class='icms-svg-icon w-16' fill='currentColor'><use href='/templates/nm/images/icons/solid.svg#braille'></use></svg>",'nm_ani');
		



		$form->addField('nm_ani',  					
					
			
			
			new fieldAnimate('options:nm:animate', array(
                'title' => 'Выберите типа анимации',           
            ))		
			
		
			
			
		 );	
		 
		$form->addField('nm_ani',  
		
			new fieldString('options:nm:animation_delay', array(
                'title' => 'Задержка перед стартом анимации',					
				'default'=>'0.5s'
            ))	

		 );	 
		 
			 
		$form->addField('nm_ani',  		
		
			new fieldString('options:nm:animation_duration', array(
                'title' => 'Изменение длительности анимации',					
				'default'=>'1s'
            ))	
			
		 );		
		  
		 
	
		$form->addField('nm_ani',  		
		
			new fieldString('options:nm:animation_offset', array(
                'title' => 'Дистанция от нижнего края браузера для начала анимации',					
				'default'=>'10'
            ))	
				
		 );			
	

		 
		$form->addField('nm_ani',  	
		
			new fieldString('options:nm:animation_iteration', array(
                'title' => 'Сколько раз повторять анимацию?',					
				'default'=>'1'
            ))
			
        );	


	
		
					
	
         return $form;


    

    }

}
