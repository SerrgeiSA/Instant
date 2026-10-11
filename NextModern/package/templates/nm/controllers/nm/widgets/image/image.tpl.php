
<?php 

$opt = $widget->options;

if(!empty($opt['image'])){ ?>


<?php 
	
	      $image = !empty($opt['image']) ? $opt['image'] : '';		  	
		  $preset = 'original';		  
			
		  $title  = !empty($opt['title']) ? $opt['title'] : '';
		  $link  = !empty($opt['link']) ? $opt['link'] : '';
		  $link_blank  = !empty($opt['target_blank']) ? ' target="_blank"' : '';
		

	?>	
	
	
	
	<?php if($link){ ?>
	<a href="<?php echo $link; ?>" class="d-block w-100"<?php echo $link_blank; ?>>
	<?php } ?>
		
    <?php echo html_image($image, $preset, $title); ?>	
	
	<?php if($link){ ?>
	</a>
	<?php } ?>

  
	

<?php } ?>	
	

