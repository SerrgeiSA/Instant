<div class="gm_images_first">  
   <?php
		    if($has_first_image){
				
				 echo '<a title="'.html($title, false).'" class="img-'.$this->getName().'" href="'.html_image_src($images[0], $normal_preset, true).'">'.html_image($images[0], $small_preset, $title.' '.$key, ['class' => 'img-thumbnail']).'</a>';
				 
				unset($images[0]);
			}
			
	?>
</div>
<div class="gm_images_list">
	<?php            

        foreach($images as $key => $paths){

            if (!isset($paths[$normal_preset])){ continue; }

            $title = (empty($this->item['title']) ? $this->name : $this->item['title']);

      

            if(!empty($paths['original']) &&  strtolower(pathinfo($paths['original'], PATHINFO_EXTENSION)) === 'gif'){
                echo html_gif_image($paths, 'small', $title.' '.$key, array('class'=>'img-'.$this->getName()));
            } else {
                echo '<a title="'.html($title, false).'" class="img-'.$this->getName().'" href="'.html_image_src($paths, $normal_preset, true).'">'.html_image($paths, $small_preset, $title.' '.$key, ['class' => 'img-thumbnail']).'</a>';
            }

        }
		
    ?>
</div>