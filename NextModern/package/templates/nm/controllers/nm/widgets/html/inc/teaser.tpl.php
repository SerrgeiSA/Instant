        <div class="wo-teaser <?php echo $widget->options['teaser_class']; ?><?php if(!empty($widget->options['teaser_pos'])){ echo ' pos_'.$widget->options['teaser_pos']; } ?>">
		
          <?php if(!empty($teaser['title']) && empty($teaser['image_pos'])){ ?>	
          <h2 class="title"><?php echo $teaser['title']; ?></h2>
		  <?php } ?>		  
		  
		 <?php if(!empty($teaser['image']) || !empty($teaser['teaser'])){ ?>	
		  <div class="teaser-content<?php if(!empty($teaser['image_pos'])){ echo ' image_pos_'.$teaser['image_pos']; } ?>">	
		  
          <?php if(!empty($teaser['image'])){ ?>		  
          <div class="teaser-image<?php if(empty($teaser['image_pos'])){ ?> p-3<?php } ?>"<?php if(!empty($teaser['image_w'])){ ?> style="min-width:<?php echo $teaser['image_w']; ?>"<?php } ?>><img src="<?php echo html_image_src($teaser['image'], $teaser['image_preset'], true); ?>" alt="<?php echo @$teaser['title']; ?>"<?php if(!empty($teaser['image_class'])){ ?>class="<?php echo $teaser['image_class']; ?>"<?php } ?>></div>
		  <?php } ?>
		  <?php if(!empty($teaser['teaser'])){ ?>
		  <div class="teaser-teaser">
		  	
          <?php if(!empty($teaser['title']) && !empty($teaser['image_pos'])){ ?>	
          <h2 class="title"><?php echo $teaser['title']; ?></h2>
		  <?php } ?>		  
		  
          <p class="title-sub"><?php echo $teaser['teaser']; ?></p>
		  
		  <div class="d-flex align-items-center<?php if(!empty($widget->options['teaser_btn_pos'])){ echo ' pos_'.$widget->options['teaser_btn_pos']; }else{ echo ' justify-content-center'; } ?> teaser-buttons">
		  <?php if(!empty($teaser['link_title'])){ ?>
          <a<?php if(!empty($teaser['link_url'])){ ?> href="<?php echo $teaser['link_url']; ?>"<?php } ?><?php if(!empty($teaser['link_attr'])){ ?> <?php echo $teaser['link_attr']; ?><?php } ?>><?php echo $teaser['link_title']; ?></a>
		  <?php } ?>  
		  <?php if(!empty($teaser['link2_title'])){ ?>
          <a<?php if(!empty($teaser['link2_url'])){ ?> href="<?php echo $teaser['link2_url']; ?>"<?php } ?><?php if(!empty($teaser['link2_attr'])){ ?> <?php echo $teaser['link2_attr']; ?><?php } ?>><?php echo $teaser['link2_title']; ?></a>
		  <?php } ?>
		  </div>
		  
		  </div>
		  <?php } ?>
		  
		  </div>
		  <?php } ?> 
		  
        </div>