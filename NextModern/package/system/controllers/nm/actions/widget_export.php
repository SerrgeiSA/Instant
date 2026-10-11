<?php

class actionNmWidgetExport extends cmsAction {

    public function run($id){

            if (!$this->cms_user->is_logged) { cmsCore::errorForbidden('', true); }

            if (!$this->cms_user->is_admin) { cmsCore::error404(); }
			
    	if(!$id) { cmsCore::error404(); }

    	$bind = $this->getWidgetBinding($id);
    	if(!$bind) { cmsCore::error404(); }
		
    	$widget = $this->model->getItemById('widgets', $bind['widget_id']);

    	$title = $widget['title'].' ('.$bind['title'].')';
		//$title = str_replace(' ','_',$title);
		
    	$item = json_encode($bind);		
    	
    	header("Content-disposition: attachment; filename={$title}.json");
        header('Content-type: application/json; charset=utf-8');

    	echo $item;

		$this->halt();

    }
	
	public function getWidgetBinding($id) {

		
        return $this->model->getItemById('widgets_bind', $id, function($item, $model) {
			$data = array();
            $data['options'] = cmsModel::yamlToArray($item['options']);
            $data['title'] = $item['title'];
            $data['id'] = $item['id'];
            $data['widget_id'] = $item['widget_id'];
            return $data;
        });

    }

}
