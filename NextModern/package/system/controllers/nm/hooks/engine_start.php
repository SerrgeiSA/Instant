<?php
    
    class onNmEngineStart extends cmsAction
    {
        public function run()
        { 
		
		    $core = cmsCore::getInstance();
			
			$device_type = 'desktop';
			
            $options = $this->controller->getOptions();
			
			$home_theme = 'nm_landing';
            
            $matched_pages = $core->detectMatchedWidgetPages(cmsCore::getModel('widgets')->getPages());

            if($matched_pages && $matched_pages != [0, 1]){
                foreach ($matched_pages as $matched_page) {
                    if(!empty($matched_page['theme_'.$device_type])){
                     $this->cms_template->setName($matched_page['theme_'.$device_type]);
                    }
                }
            }else{
				
				     //$this->cms_template->setName($home_theme);
				
			}
              
				
				
           
            
            return true;
        }
    }