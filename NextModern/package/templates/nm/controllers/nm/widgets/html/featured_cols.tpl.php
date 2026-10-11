 	<?php if($widget->options['sl_on']){ $this->addCSS('templates/modern/widgets/obj/css/jquery-owl.carousel.css'); } ?> 
	<?php $this->addMainCSS('templates/modern/widgets/obj/css/styles.css'); ?>
	<?php $this->addMainCSS('templates/modern/widgets/obj/css/featured_cols.css'); ?>	
	<?php $this->addMainJS('templates/modern/widgets/obj/js/script.js'); ?>
	<?php if($widget->options['sl_on']){ $this->addMainJS('templates/default/js/jquery-owl.carousel.js'); } ?>
	
    <?php if ($items){ ?>
	
<div class="container wo_wrap">

<?php if(!empty($teaser)){ include('inc/teaser.tpl.php'); } ?>	

<div class="row mbr-justify-content-center<?php if($widget->options['sl_on']){ ?> owl-carousel owl-theme<?php } ?><?php if(!empty($widget->options['objs_class'])){ echo ' '.$widget->options['objs_class']; } ?>" id="widget_<?php echo $widget->bind_id; ?>">
 
    <?php 
	      $count = 1;
	      foreach($items as $obj){ 
	
	   
	      $image = !empty($obj['paths']) ? $obj['paths'] : '';		  
	      $image_small = $image[$widget->options['img_small']];
	      $image_normal = $image[$widget->options['img_normal']];
	      $image_full = $image[$widget->options['img_full']];
		  $image_size = $widget->options['img_normal'];
		  $image_size_small = $widget->options['img_small'];	
          
		  $preset = $widget->options['sl_on'] ? $widget->options['sl_image_preset'] : $widget->options['preset'];	  
	
		  $item = $obj['titles'];
		  $title  = !empty($item['title']) ? $item['title'] : '';
		  
          $teaser  = !empty($item['teaser']) ? cmsEventsManager::hook('html_filter', array(
                'text'                => $item['teaser'],
                'is_auto_br'          => true,
                'build_redirect_link' => true
            )) : '';	
			


         for ($x=1; $x<3; $x++){ 

          $idx = ($x==1) ? '' : $x;

          $link = !empty($item['link'.$idx]) ? $item['link'.$idx] : '';		  
		  $data['link'.$idx.'_attr']  = !empty($item['link'.$idx.'_attr']) ? $item['link'.$idx.'_attr'] : '';
        if($link){		  
		  $link = explode('|',$link);
		  $data['link'.$idx.'_title']  = !empty($link[0]) ? $link[0] : '';
		  $data['link'.$idx.'_url']  = !empty($link[1]) ? href_to($link[1]) : '';
        }else{
	      $data['link'.$idx.'_title']  = '';
	      $data['link'.$idx.'_url']  = '';
		  $data['link'.$idx.'_attr'] = '';
        }

        }
		
		 $item_tag = !empty($data['link_url']) ? 'a' : 'div';
		 
		  
	?>
	


 <div class="<?php if(!$widget->options['sl_on']){ ?>col-lg-6 mbr-col-md-10<?php } ?>">
 <<?php echo $item_tag; ?> class="fi_wrap"<?php if($data['link_url']){ ?> href="<?php echo $data['link_url']; ?>"<?php } ?>>

 <div class="wo_img_wrap<?php echo empty($img_w) ? ' w-auto' : ''; ?>" style="<?php if($widget->options['image_style']=='cover'){ ?>background:url(<?php echo html_image_src($image, $preset, true); ?>);<?php if(!empty($widget->options['img_radius'])){ ?>border-radius:<?php echo $widget->options['img_radius']; ?>;overflow:hidden;<?php } ?><?php } ?><?php echo $img_w ? 'width:'.$img_w.';' : ''; ?><?php echo $img_h ? 'height:'.$img_h.';' : ''; ?>">			  
<?php if(empty($widget->options['image_style'])){ ?>
<img src="<?php echo html_image_src($image, $preset, true); ?>" alt="<?php echo $title; ?>"<?php if(!empty($widget->options['img_radius'])){ ?>style="border-radius:<?php echo $widget->options['img_radius']; ?>;overflow:hidden;"<?php } ?>>
<?php } ?>
</div>

 <div class="text-wrap vcenter">
 <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5"><?php echo $title; ?></h2>
 <p class="mbr-fonts-style text1 mbr-text display-6"><?php echo $teaser; ?></p>
 </div>
 </<?php echo $item_tag; ?>>
 </div>						
 
	
	<?php $count++; } ?>


</div>
</div>
	
	
<?php if($widget->options['sl_on']){ ?>

<?php ob_start(); ?>
    <script>

	$(function(){
		
    var widget_<?php echo $widget->bind_id; ?>_owl = $('#widget_<?php echo $widget->bind_id; ?>').owlCarousel({
	rtl:false,
    loop:false,
	rewind : <?php echo $widget->options['sl_rewind'] ? 1 : 0; ?>,
    margin:<?php echo $widget->options['sl_margin']; ?>,
    autoHeight:true, 
    nav:true, 
	navText:['',''],
	dots:false,
	smartSpeed:1000,
	autoplay:<?php echo $widget->options['sl_autoplay']; ?>,
    autoplayTimeout: <?php echo $widget->options['sl_autoplaytimeout']; ?>,
    autoplayHoverPause: <?php echo $widget->options['sl_autoplayHoverPause']; ?>,		
	items:<?php echo $widget->options['sl_items']; ?>,
    responsiveClass: true,
	<?php if($widget->options['sl_animateIn']){ ?>
	animateIn:<?php echo $widget->options['sl_animateIn']; ?>,
	<?php } ?>
	<?php if($widget->options['sl_animateOut']){ ?>
	animateOut:<?php echo $widget->options['sl_animateOut']; ?>,
	<?php } ?>	
	
	
	<?php if($widget->options['sl_items'] > 1){ ?>
    responsive: {
        0:{
          items: 1
        },
        480:{
          items: 2
        },
        750:{
          items: 3
        },
        768:{
          items: 3
        },
        800:{
          items: <?php echo $widget->options['sl_items']; ?>
        },
	}
	<?php } ?>	
	});


   
	});
  
	</script>

<?php $this->addBottom(ob_get_clean()); ?>

	<?php } ?>
	
	
	<?php } ?>
	
	
	
