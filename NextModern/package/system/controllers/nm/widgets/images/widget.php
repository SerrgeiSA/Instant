<?php
class widgetNmImages extends cmsWidget {

	public $is_cacheable = false;

    public function run(){
		
	
		
			
			  $this->setTemplate($this->tpl_body);
			  return array(
		      'items'=>$this->getOption('images'),
			  );
			  	
	
			
		

    }
	
	
	
	
	

}
