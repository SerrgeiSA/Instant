
<?php 


if($items){ ?>

<div class="wim_images_x4 row" style="margin:-<?php echo $widget->options['padding']; ?>px" style="padding:<?php echo $widget->options['padding']; ?>px">

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
		  $link  = !empty($item['link']) ? $item['link'] : '';
		    $link_blank  = !empty($item['link_target']) && $item['link_target'] =='blank' ? ' target="_blank"' : '';
		  
		 
		  $link2  = !empty($item['link2']) ? $item['link2'] : '';
		  $link2_title  = !empty($item['link2_title']) ? $item['link2_title'] : '';
		  
		  $link3  = !empty($item['link3']) ? $item['link3'] : '';
		  $link3_title  = !empty($item['link3_title']) ? $item['link3_title'] : '';

	?>	
	
	
		  
		  
		  
	
	
	
<div class="col-6 col-md-3 d-flex align-items-center justify-content-center"<?php if(!empty($widget->options['padding'])){ ?> style="padding:<?php echo $widget->options['padding']; ?>px"<?php } ?>>
	<?php if($link){ ?>
	<a href="<?php echo $link; ?>"<?php echo $link_blank; ?>>
	<?php } ?>
		
    <?php echo html_image($image, $preset, $title); ?>	
	
	<?php if($link){ ?>
	</a>
	<?php } ?>
</div>
  
			  
			  
        

 

    <?php } ?>	
	
</div>

    <?php } ?>	
	

