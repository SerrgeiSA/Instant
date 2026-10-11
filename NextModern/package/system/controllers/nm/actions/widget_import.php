<?php

class actionNmWidgetImport extends cmsAction {

    public function run(){
		
		
            if (!$this->cms_user->is_logged) { cmsCore::errorForbidden('', true); }

            if (!$this->cms_user->is_admin) { cmsCore::error404(); }
			
			if(empty($_GET['bind_id']) || empty($_FILES['file']['name'])){ cmsCore::error404(); }	
				
            $file = $_FILES['file'];
		
		    $json = file_get_contents($file['tmp_name']);
		    $data = (array) json_decode($json,true);
			
			if(empty($data['options'])){  cmsCore::error404(); }			
			
			$bind = $this->model->getItemById('widgets_bind', $_GET['bind_id']);
            if(!$bind){ cmsCore::error404(); }
			
			
            $this->model->update('widgets_bind', $_GET['bind_id'], array(
            'options'       => $data['options']
            ));

				
            
		
			
		
        
	

    }


	
	


}
