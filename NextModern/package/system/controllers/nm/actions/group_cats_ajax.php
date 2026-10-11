<?php

class actionNmGroupCatsAjax extends cmsAction {

    public function run(){

		if (!$this->request->isAjax() || !cmsUser::isAdmin()){ return cmsCore::error404(); }

        $html = '';

		$field_name = $this->request->get('fname', 'cats');
		$id = $this->request->get('id', 0);
		if (!$id) {
			$message = 'Не определён id';
           return $this->cms_template->renderJSON(array('error'=>true,'html'=>$html,'message'=>$message));
        }

		$item = $this->model->selectOnly('i.'.$field_name)->getItemById('groups',$id);
		if (!$item) {
		    $message = 'Не определён item';
              return $this->cms_template->renderJSON(array('error'=>true,'html'=>$html,'message'=>$message));
        }
		
		
		if(empty($item[$field_name])){
			$message = 'Не определён field_name';
			    return $this->cms_template->renderJSON(array('error'=>true,'html'=>$html,'message'=>$message));
		}

		$cats = string_explode_list($item[$field_name]);

		if ($cats){
			$html.='<select class="form-control mb-3" id="group_category" name="group_category">';
			foreach($cats as $idx=>$cat){				
				
				$html.='<option value="'.$idx.'">'.$cat.'</option>';
				

			}
			$html.='</select>';
		}

		return $this->cms_template->renderJSON(array('error'=>false,'html'=>$html));

    }

}
