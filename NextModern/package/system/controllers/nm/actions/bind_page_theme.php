<?php

class actionNmBindPageTheme extends cmsAction {

    public function run(){
		
		
		    if (!$this->request->isAjax()) { cmsCore::error404(); }


            if (!$this->cms_user->is_logged) { cmsCore::errorForbidden('', true); }

            if (!$this->cms_user->is_admin) { cmsCore::error404(); }
			
			$device = $this->request->get('device', '');
			$page_id = $this->request->get('page_id', '');
			$theme = $this->request->get('theme', '');
			
			if(empty($device) || empty($page_id) || empty($theme)){ cmsCore::error404(); }	
			
			
					
			$field = 'theme_'.$device;
			
				
            $this->model->update('widgets_pages', $page_id, array(
            $field       => $theme
            ));

				
            
		
			
		
        
	

    }


	
	


}
