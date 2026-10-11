 	
    <?php 
	$items = $widget->options['images'];		  
	if ($items){ ?>
	
	
<div id="widget_images_slider_<?php echo $widget->bind_id; ?>" class="owl-carousel owl-theme nm-owl">


 

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
		  $link_title  = !empty($item['link_title']) ? $item['link_title'] : '';
		  $link_blank  = !empty($item['link_target']) && $item['link_target'] =='blank' ? ' target="_blank"' : '';
		  
		 
		  $link2  = !empty($item['link2']) ? $item['link2'] : '';
		  $link2_title  = !empty($item['link2_title']) ? $item['link2_title'] : '';
		  
		  $link3  = !empty($item['link3']) ? $item['link3'] : '';
		  $link3_title  = !empty($item['link3_title']) ? $item['link3_title'] : '';
		  
		  
		  
		  $title_tag  = !empty($widget->options['title_tag']) ? $widget->options['title_tag'] : 'h3';
		  
		  
	?>
	
	
	<?php if($link && !$link_title){ ?>
	<a href="<?php echo $link; ?>" class="sl_item"<?php echo $link_blank; ?><?php if(!empty($widget->options['sl_cover'])){ ?> style="background:url(<?php echo html_image_src($image, $preset, true); ?>) no-repeat center center"<?php } ?>>
	<?php }else{ ?>
	<div class="sl_item"<?php if(!empty($widget->options['sl_cover'])){ ?> style="background:url(<?php echo html_image_src($image, $preset, true); ?>) no-repeat center center"<?php } ?>>
	<?php } ?>
	
	
	<?php if($title){ ?>
	
	<div class="container d-flex flex-column h-100 	
<?php if(!empty($widget->options['valign'])){ ?>
	 justify-content-<?php echo $widget->options['valign']; ?>
<?php } ?>	 
<?php if(!empty($widget->options['align'])){ ?>
	 align-items-center
<?php } ?>	 
<?php if(!empty($widget->options['text_align'])){ ?>
	 text-center
<?php } ?>	 
	">
	
	<div>
	
	<?php if($title){ ?>
	<<?php echo $title_tag; ?> class="sl_title"><?php echo $title; ?></<?php echo $title_tag; ?>>
	<?php } ?>
	
	<?php if($teaser){ ?>
	<p class="sl_teaser"><?php echo $teaser; ?></p>
	<?php } ?>
	
	<?php if($link_title){ ?>
	<a class="<?php if(!empty($widget->options['button_class'])){ echo $widget->options['button_class']; } ?> sl_button"<?php echo $link_blank; ?> href="<?php echo $link; ?>"><?php echo $link_title; ?></a>
	<?php if($link2_title){ ?>
	<a class="btn sl_button2"<?php echo $link_blank; ?> href="<?php echo $link2; ?>"><?php echo $link2_title; ?></a>
	<?php } ?>	
	<?php if($link3_title){ ?>
	<a class="btn sl_button3"<?php echo $link_blank; ?> href="<?php echo $link3; ?>"><?php echo $link3_title; ?></a>
	<?php } ?>
	<?php } ?>
	
	</div>
	
	</div>
	
	<?php } ?>
	
		
    <?php if(empty($widget->options['sl_cover'])){ echo html_image($image, $preset, $title); } ?>	
	
	<?php if($link && !$link_title){ ?>
	</a>
	<?php }else{ ?>
	</div>
	<?php } ?>

  
					
 
	
	<?php $count++; } ?>



  
</div>

<style>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_item{
	background-size:cover !important;
	display:flex;
	flex-direction:column;
	width:100%;	
	overflow:hidden;
	position:relative;
}


<?php if(!empty($widget->options['overlay'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_item:before{
	content:"";
	background:<?php echo $widget->options['overlay']; ?>;
	position:absolute;
	top:0;
	bottom:0;
	left:0;
	right:0;
	z-index:1;
}
<?php } ?>

#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_item > div{
	position:relative;
	z-index:3;
}

<?php if(!empty($widget->options['padding_y']) || !empty($widget->options['padding_x'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_item > div{
<?php if(!empty($widget->options['padding_y'])){ ?>
	padding-top:<?php echo $widget->options['padding_y']; ?>px; 
	padding-bottom:<?php echo $widget->options['padding_y']; ?>px; 
<?php } ?>
<?php if(!empty($widget->options['padding_x'])){ ?>
	padding-left:<?php echo $widget->options['padding_x']; ?>px; 
	padding-right:<?php echo $widget->options['padding_x']; ?>px; 
<?php } ?>
}
<?php } ?>

<?php if(!empty($widget->options['title_color'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_title{
	color:<?php echo $widget->options['title_color']; ?>;
}
<?php } ?>

<?php if(!empty($widget->options['teaser_color'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_teaser{
	color:<?php echo $widget->options['teaser_color']; ?>;
}
<?php } ?>

#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_button{
	box-sizing:border-box;
	text-align:center;	
	display:inline-flex;
	align-items:center;
	justify-content:center;
		
}


<?php if(!empty($widget->options['button_color']) || !empty($widget->options['button_bg'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_button{
<?php if(!empty($widget->options['button_color'])){ ?>
	color:<?php echo $widget->options['button_color']; ?> !important;
<?php } ?>
<?php if(!empty($widget->options['button_bg'])){ ?>
    border:0 !important;
	background:<?php echo $widget->options['button_bg']; ?> !important;
<?php } ?>
}
<?php if(!empty($widget->options['button_color'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_button2,
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_button3{
	color:<?php echo $widget->options['button_color']; ?> !important;
}
<?php } ?>
<?php } ?>



<?php if(!empty($widget->options['button_color_hover']) || !empty($widget->options['button_bg_hover'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_button:hover{
<?php if(!empty($widget->options['button_color_hover'])){ ?>
	color:<?php echo $widget->options['button_color_hover']; ?> !important;
<?php } ?>
<?php if(!empty($widget->options['button_bg_hover'])){ ?>
	background:<?php echo $widget->options['button_bg_hover']; ?> !important;
<?php } ?>
}
<?php } ?>




<?php if(empty($widget->options['sl_autoHeight'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_item{
	height:<?php echo $widget->options['sl_height_sm']; ?>;
}
<?php } ?>

<?php if(!empty($widget->options['title_size_sm'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_title{
	font-size:<?php echo $widget->options['title_size_sm']; ?>px !important;
}
<?php } ?>

<?php if(!empty($widget->options['teaser_size_sm'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_teaser{
	font-size:<?php echo $widget->options['teaser_size_sm']; ?>px !important;
}
<?php } ?>



 
 @media (min-width: 768px) { 
 
<?php if(empty($widget->options['sl_autoHeight'])){ ?>
 #widget_images_slider_<?php echo $widget->bind_id; ?> .sl_item{
	height:<?php echo $widget->options['sl_height_md']; ?>;
}
<?php } ?>

<?php if(!empty($widget->options['title_size_md'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_title{
	font-size:<?php echo $widget->options['title_size_md']; ?>px !important;
}
<?php } ?>
 
<?php if(!empty($widget->options['teaser_size_md'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_teaser{
	font-size:<?php echo $widget->options['teaser_size_md']; ?>px !important;
}
<?php } ?>


<?php if(!empty($widget->options['teaser_mt_mob']) || !empty($widget->options['teaser_mb_mob'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_teaser{
<?php if(!empty($widget->options['teaser_mt_mob'])){ ?>
	margin-top:<?php echo $widget->options['teaser_mt_mob']; ?>px !important;
<?php } ?>
<?php if(!empty($widget->options['teaser_mb_mob'])){ ?>
	margin-bottom:<?php echo $widget->options['teaser_mb_mob']; ?>px !important;
<?php } ?>
}
<?php } ?>

<?php if(!empty($widget->options['button_mt_mob'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_button{
	margin-top:<?php echo $widget->options['button_mt_mob']; ?>px !important;
}
<?php } ?>

<?php if(!empty($widget->options['button_height_mob'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_button{
	height:<?php echo $widget->options['button_height_mob']; ?>px !important;
}
<?php } ?>

<?php if(!empty($widget->options['button_width_mob'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_button{
	width:<?php echo $widget->options['button_width_mob']; ?>px;
}
<?php } ?>

<?php if(!empty($widget->options['button_title_size_mob'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_button{
	font-size:<?php echo $widget->options['button_title_size_mob']; ?>px;
}
<?php } ?>

 }
 
@media (min-width: 992px) { 

<?php if(empty($widget->options['sl_autoHeight'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_item{
	height:<?php echo $widget->options['sl_height_lg']; ?>;
}
<?php } ?>

<?php if(!empty($widget->options['title_size_lg'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_title{
	font-size:<?php echo $widget->options['title_size_lg']; ?>px !important;
}
<?php } ?>

<?php if(!empty($widget->options['teaser_size_lg'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_teaser{
	font-size:<?php echo $widget->options['teaser_size_lg']; ?>px !important;
}
<?php } ?>

 }
 
 @media (min-width: 1200px) { 
 
<?php if(empty($widget->options['sl_autoHeight'])){ ?>
 #widget_images_slider_<?php echo $widget->bind_id; ?> .sl_item{
	height:<?php echo $widget->options['sl_height_xl']; ?>;
}
<?php } ?>

<?php if(!empty($widget->options['title_size_xl'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_title{
	font-size:<?php echo $widget->options['title_size_xl']; ?>px !important;
}
<?php } ?>
 
<?php if(!empty($widget->options['teaser_size_xl'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_teaser{
	font-size:<?php echo $widget->options['teaser_size_xl']; ?>px !important;
}
<?php } ?>


<?php if(!empty($widget->options['teaser_mt']) || !empty($widget->options['teaser_mb'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_teaser{
<?php if(!empty($widget->options['teaser_mt'])){ ?>
	margin-top:<?php echo $widget->options['teaser_mt']; ?>px !important;
<?php } ?>
<?php if(!empty($widget->options['teaser_mb'])){ ?>
	margin-bottom:<?php echo $widget->options['teaser_mb']; ?>px !important;
<?php } ?>
}
<?php } ?>


<?php if(!empty($widget->options['button_mt'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_button{
	margin-top:<?php echo $widget->options['button_mt']; ?>px !important;
}
<?php } ?>

<?php if(!empty($widget->options['button_height'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_button{
	height:<?php echo $widget->options['button_height']; ?>px !important;
}
<?php } ?>

<?php if(!empty($widget->options['button_width'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_button{
	width:<?php echo $widget->options['button_width']; ?>px;
}
<?php } ?>

<?php if(!empty($widget->options['button_title_size'])){ ?>
#widget_images_slider_<?php echo $widget->bind_id; ?> .sl_button{
	font-size:<?php echo $widget->options['button_title_size']; ?>px;
}
<?php } ?>


 }
 

 
</style>

<?php ob_start(); ?>

<script>


		$('#widget_images_slider_<?php echo $widget->bind_id; ?>').owlCarousel({
			
	        smartSpeed:<?php echo $widget->options['sl_smartSpeed']; ?>,
			autoplay:<?php echo $widget->options['sl_autoplay'] ? 1 : 0; ?>,
            autoplayTimeout: <?php echo $widget->options['sl_autoplaytimeout']; ?>,
            autoplayHoverPause: '<?php echo $widget->options['sl_autoplayHoverPause']; ?>',	
            loop: false,			
            rewind : <?php echo $widget->options['sl_rewind'] ? 1 : 0; ?>,
            margin:<?php echo $widget->options['sl_margin']; ?>,
            dots: false,
            center: <?php echo $widget->options['sl_center'] ? 1 : 0; ?>,
            autoHeight: <?php echo $widget->options['sl_autoHeight'] ? 1 : 0; ?>,      
            nav: <?php echo $widget->options['sl_nav'] ? 1 : 0; ?>,            
            items:<?php echo $widget->options['sl_items_xl']; ?>,
            navText: ['<span class="btn"><svg class="icms-svg-icon w-16" fill="currentColor"><use href="/templates/nm/images/icons/solid.svg#chevron-left"></use></svg></span>', '<span class="btn"><svg class="icms-svg-icon w-16" fill="currentColor"><use href="/templates/nm/images/icons/solid.svg#chevron-right"></use></svg></span>'],
		
		    <?php if($widget->options['sl_animateIn']){ ?>
	        animateIn:'<?php echo $widget->options['sl_animateIn']; ?>',
	        <?php } ?>
	        <?php if($widget->options['sl_animateOut']){ ?>
	        animateOut:'<?php echo $widget->options['sl_animateOut']; ?>',
	        <?php } ?>	
		  
	
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: <?php echo $widget->options['sl_items_sm']; ?>			
                },
                768: {
                    items: <?php echo $widget->options['sl_items_md']; ?>,
					dots: <?php echo $widget->options['sl_dots'] ? 1 : 0; ?>
                },
                992: {
                    items: <?php echo $widget->options['sl_items_lg']; ?>,
					dots: <?php echo $widget->options['sl_dots'] ? 1 : 0; ?>
                },
                1200: {
                    items: <?php echo $widget->options['sl_items_xl']; ?>,
					dots: <?php echo $widget->options['sl_dots'] ? 1 : 0; ?>
                }
			}

		  
        });
		
		
		
</script>


<?php $this->addBottom(ob_get_clean()); ?>

	<?php } ?>
	
	
