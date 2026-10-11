<?php
class widgetNmHtml extends cmsWidget {

	public $is_cacheable = false;

    public function run(){
		
		
		if($this->tpl_body == 'html'){
			
	      
	      $items = $this->getOption('images');	
		  
	
	      $data = array();	
	      foreach($items as $key=>$obj){ 
	
	      $image = !empty($obj['paths']) ? $obj['paths'] : '';		  
	
		  $item = $obj['titles'];
		  $data[$key]['title']  = !empty($item['title']) ? $item['title'] : '';		  
		  
	      $data[$key]['image_small'] = html_image_src($image,$this->getOption('img_small'),true);
	      $data[$key]['image_normal'] = html_image_src($image,$this->getOption('img_normal'),true);
	      $data[$key]['image_full'] = html_image_src($image,$this->getOption('img_full'), true);
		  
		  $data[$key]['teaser']  = !empty($item['teaser']) ? cmsEventsManager::hook('html_filter', array(
                'text'                => $item['teaser'],
                'is_auto_br'          => true,
                'build_redirect_link' => false
            )) : '';	
			
		  
        for ($x=1; $x<3; $x++){ 

          $idx = ($x==1) ? '' : $x;

          $link = !empty($item['link'.$idx]) ? $item['link'.$idx] : '';		  
		  $data[$key]['link'.$idx.'_attr']  = !empty($item['link'.$idx.'_attr']) ? $item['link'.$idx.'_attr'] : '';
        if($link){		  
		  $link = explode('|',$link);
		  $data[$key]['link'.$idx.'_title']  = !empty($link[0]) ? $link[0] : '';
		  $data[$key]['link'.$idx.'_url']  = !empty($link[1]) ? href_to($link[1]) : '';
        }else{
	      $data[$key]['link'.$idx.'_title']  = '';
	      $data[$key]['link'.$idx.'_url']  = '';
		  $data[$key]['link'.$idx.'_attr'] = '';
        }

        }

		 

		  }
		  
		  
		  $html = '';
		  $html.= $this->getOption('tpl_start');
	      foreach($items as $key=>$obj){ 

          $html.= $this->string_fields($this->getOption('tpl_item'), $data[$key]);	

		  }		
		  $html.= $this->getOption('tpl_end');
		
	
          $this->setTemplate($this->tpl_body);
      
	  
          return array(
		  'html'=>$html);
		  
		  
		}else{
			
			$teaser = $this->getOption('teaser');
			
			$teaser['teaser']  = !empty($teaser['teaser']) ? cmsEventsManager::hook('html_filter', array(
                'text'                => $teaser['teaser'],
                'is_auto_br'          => true,
                'build_redirect_link' => true
            )) : '';
			
			$tlink = explode('|',$teaser['link']);
		    $teaser['link_title']  = !empty($tlink[0]) ? $tlink[0] : '';
		    $teaser['link_url']  = !empty($tlink[1]) ? href_to($tlink[1]) : '';
			
			$tlink2 = explode('|',$teaser['link2']);
		    $teaser['link2_title']  = !empty($tlink2[0]) ? $tlink2[0] : '';
		    $teaser['link2_url']  = !empty($tlink2[1]) ? href_to($tlink2[1]) : '';
			
			  $this->setTemplate($this->tpl_body);
			  return array(
		      'teaser'=>$teaser,
		      'items'=>$this->getOption('images'),
		      'img_w'=>$this->getOption('img_w'),
		      'img_h'=>$this->getOption('img_h'),
			  );
			  	
	
			
		}

    }
	
	
	
	
/**
 * Находит внутри строки $string все выражения вида {key}, где key - это ключ
 * массива $data и заменяет на значение соответствующего элемента
 * отличительной особенностью от функции выше является возможность обработки значений функциями
 * например, выражение {age|html_spellcount:год:года:лет} после обработки напишет "21 год, 22 года, 29 лет"
 * при значении age 21, 22 и 29 соответственно
 * выражение {nickname:профиль пользователя %s самый лучший} после обработки станет "профиль пользователя Василий самый лучший"
 * при значении поля nickname в массиве $data "Василий"
 *
 * @param string $string
 * @param array $data
 */
function string_fields($string, $data){		

    $matches_count = preg_match_all('/{([^}]+)}/ui', $string, $matches);


    if ($matches_count){		


        for($i=0; $i<$matches_count; $i++){

            $tag = $matches[0][$i];
            $property = $matches[1][$i];

            $func = false; $func_params = array(); $func_params_property_key = 0;

            // есть ли обработка функцией
            if(strpos($property, '|') !== false){
                $params = explode('|', $property);
                // второй параметр - функция
                $func = $params[1];
                if(function_exists($func) || strpos($func, ':') !== false){

                    // первый параметр остаётся как $property
                    $property = $params[0];
                    // $property ставим как первый параметр функции
                    $func_params = array($property);
                    // смотрим есть ли у функции параметры
                    if(strpos($func, ':') !== false){
                        $par = explode(':', $func);
                        $func = $par[0]; unset($par[0]);
                        if(function_exists($func)){
                            foreach ($par as $k => $p) {
                                // если параметр - массив
                                if(strpos($p, '=') !== false){
                                    $out = array(); parse_str($p, $out);
                                    $par[$k] = $out;
                                }
                            }
                            $func_params = $func_params + $par;
                        } else {
                            $func = false;
                        }
                    }

                } else {

                    // значит рандомные значения из списка
                    $values = explode('|', $property);

                    $string = str_replace($tag, $values[mt_rand(0, (count($values)-1))], $string);

                    continue;

                }
            } else
            // нужно прогнать через sprintf
            if(strpos($property, ':') !== false){
                $params = explode(':', $property);
                $property = $params[0];
                $func = 'sprintf';
                $func_params = array_reverse($params);
                $func_params_property_key = 1;
            }

            if (isset($data[$property]) && !is_array($data[$property]) && !is_object($data[$property])){

                $data_property = $data[$property];

                if($func && function_exists($func)){

                    $func_params[$func_params_property_key] = $data_property;

                    $data_property = call_user_func_array($func, $func_params);

                }

                $string = str_replace($tag, $data_property, $string);

            } else {
                $string = str_replace($tag, '', $string);
            }

        }

    }

    return $string;

}
	
	

}
