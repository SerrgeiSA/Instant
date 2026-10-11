<?php

class actionNmGetPageAjax extends cmsAction {

    public function run(){
		
		
		    if (!$this->request->isAjax()) { cmsCore::error404(); }


            if (!$this->cms_user->is_logged) { cmsCore::errorForbidden('', true); }

            if (!$this->cms_user->is_admin) { cmsCore::error404(); }
			
			$page_id = $this->request->get('page_id', '');
			
			if(empty($page_id)){ cmsCore::error404(); }	
			
			
					
				
            $data = $this->model->getItemById('widgets_pages', $page_id);
			
			
		    return $this->cms_template->renderJSON(array('error'=>false,'data'=>$data));

				
            
		
			
		
        
	

    }


	
	


}
