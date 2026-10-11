
<?php 
$this->addMainCSS('templates/'.$this->name.'/vendors/lg/css/lightgallery.min.css');
$this->addMainCSS('templates/'.$this->name.'/controllers/nm/widgets/images/css/grid_gallery.css');
$this->addMainJS('templates/'.$this->name.'/vendors/lg/js/lightgallery-all.min.js');
	
	
    $photo_wrap_id = 'widget_images_'.$widget->bind_id;
	
if($items){ ?>

			  
  <div class="child-page-listing" id="<?php echo $photo_wrap_id; ?>">

  <div class="grid-container">
  
<?php 
 $count = 1; 
 foreach($items as $obj){ 
	
	      $image = !empty($obj['paths']) ? $obj['paths'] : '';		  
	      $image_small = $image[$widget->options['img_small']];
	      $image_normal = $image[$widget->options['img_normal']];
	      $image_full = $image[$widget->options['img_full']];
		  $image_size = $widget->options['img_normal'];
		  $image_size_small = $widget->options['img_small'];	
          
		  $preset = $widget->options['img_preset'];		  
	
		  $item = $obj['titles'];		
		  $title  = !empty($item['title']) ? $item['title'] : '';
		  $teaser  = !empty($item['teaser']) ? $item['teaser'] : '';
		  $link  = !empty($item['link']) ? $item['link'] : '';
		    $link_blank  = !empty($item['link_target']) && $item['link_target'] =='blank' ? ' target="_blank"' : '';
		  
		 
		  $link2  = !empty($item['link2']) ? $item['link2'] : '';
		  $link2_title  = !empty($item['link2_title']) ? $item['link2_title'] : '';
		  
		  $link3  = !empty($item['link3']) ? $item['link3'] : '';
		  $link3_title  = !empty($item['link3_title']) ? $item['link3_title'] : '';
		

	?>	
	
	
		  
		  


    <div class="location-listing">
	
   <<?php echo $link ? 'a' : 'div'; ?> class="text-white location-title<?php echo !$link ? ' lg_link' : ''; ?>" href="<?php echo $link ? $link : html_image_src($image, $widget->options['img_full'], true, false); ?>" data-thumb="<?php echo html_image_src($image, $preset, true, false); ?>"<?php if(!$title && !$teaser){ ?> style="background:none;"<?php } ?><?php echo $link_blank; ?>>
   <?php if($title){ ?>
   <h4><?php html($title); ?></h4>
   <?php } ?>
    <?php if($teaser){ ?>
   <p><?php html($teaser); ?></p>   
   <?php } ?>
   </<?php echo $link ? 'a' : 'div'; ?>>
   
    <div class="location-image" style="background:url(<?php echo html_image_src($image, $preset, true, false); ?>)"></div>

    </div>



 

    <?php } ?>	
	
</div>
</div>      


	

<?php ob_start(); ?>
    <script>
        $(function(){     

			
			$("#<?php echo $photo_wrap_id; ?>").lightGallery({  selector: '.lg_link',   exThumbImage: 'data-thumb'}); 
			
        });
    </script>
<?php $this->addBottom(ob_get_clean()); ?>

    <?php } ?>	
	

