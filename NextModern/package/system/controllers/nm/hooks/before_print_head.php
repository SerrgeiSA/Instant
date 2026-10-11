<?php

class onNmBeforePrintHead extends cmsAction {

    public function run($template){

       
		$core = cmsCore::getInstance();

        if(empty($template)){
            $template = cmsTemplate::getInstance();
        }
				
if( $core->controller == 'admin' ){
      
		$template->addMainCSS('templates/nm/controllers/nm/css/admin.css');		
		$template->addMainJS('templates/nm/controllers/nm/js/admin.js');		
   
	     
}

    return $template;



    }

}
